<?php
/*
 * Main Plugin File
 * Does all the magic!
 *
 * @package    pcDTR
 * @version    3.0.1
 *
 * @author     Otherland <info@otherland.se>
 * @link       http://www.otherland.se
 * @copyright  Copyright (C) 2009 Otherland! All Rights Reserved
 * @license    http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL
*/

/* 
    PCDTR - PHP+CSS Dynamic Text Replacement
    by Joao Makray <joaomak.net/util/pcdtr> 
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
defined( 'DS' ) || define( 'DS', DIRECTORY_SEPARATOR );

if($mainframe->isAdmin()) {
	return;
}

jimport( 'joomla.plugin.plugin' );

/**
 * Joomla! pcDTR plugin
 *
 * @package		Joomla
 * @subpackage	System
 */
class  plgSystempcDTR extends JPlugin
{

	function plgSystempcDTR(& $subject, $config)
	{
		global $mainframe;
		if ($mainframe->isAdmin())
		{
			// This plugin is only relevant for use within the frontend!
			return;
		}
		parent::__construct($subject, $config);
	}

	function onAfterInitialise()
	{
		global $mainframe;
		$plugin			=& JPluginHelper::getPlugin('system', 'pcdtr');
		$pluginParams	= new JParameter($plugin->params);

		$mainframe->addCustomHeadTag('<link rel="stylesheet" href="'.JURI::base(true).'/'.$pluginParams->get('heading_css').'" type="text/css" media="screen" />');
		$mainframe->addCustomHeadTag('<link rel="stylesheet" href="'.JURI::base(true).'/plugins/system/pcdtr/css.php" type="text/css" media="screen" />');
	}

	function onAfterRender() 
	{
		$plugin			=& JPluginHelper::getPlugin('system', 'pcdtr');
		$pluginParams	= new JParameter($plugin->params);

		$dtr = new pcDTR($pluginParams);

		require_once('pcdtr/parseCSS.php');
		$css = new CSS();
		$css->parseFile($pluginParams->get('heading_css'));
		$css->css = array_reverse($css->css,true);		

		require_once('pcdtr/simple_html_dom.php');
		$dom = new simple_html_dom();
	
		$body = JResponse::getBody();
		$dom->load($body);
		$parentel = '';

		foreach ($css->css as $el=>$styles)
		{
			if(isset($styles['font-size']))	$styles['font-size']=floatval($styles['font-size']);
			if(isset($styles['font-family'])) $styles['font-family']=$dtr->findFont($styles['font-family']);
			// cascade
			$parentExists=false;

			$tmp=explode(' ',$el);
			array_pop($tmp);
			$parentNode=implode(' ',$tmp);
			if(isset($css->css[$parentNode]))
			{
				$parentExists=true;
				$parentStyles=$css->css[$parentNode];
				if(!isset($styles['font-size']) && isset($parentStyles['font-size'])) $styles['font-size']=floatval($parentStyles['font-size']);
				if(!isset($styles['font-family']) && isset($parentStyles['font-family'])) $styles['font-family']=$dtr->findFont($parentStyles['font-family']);
			}

			$styles[0]=$el;
			$dtr->setCss($el, $styles);
		
			foreach($dom->find($el) as $node)
			{
				// skip if inner tag
				if(substr($node->class,-5)=='pcdtr' || $parentExists) continue;
				// Add spans with ids
				if ($node->parent->class=='mce_editable' || $node->parent->class=='mceEditor') continue; 
				$split=$dtr->splitElement($node, $el);
				if(!$split)
				{
					$node->outertext.='<!--font not found-->';
					continue;
				}	
				// Add class
				if(substr($node->parent->class,-5)!='pcdtr')
				{
					if($node->class)$node->class.=' ';
						$node->class.='pcdtr';
				}
				$node->innertext=$split;
			}
		}
		// create the images and change the temp name to image path
		list($groups, $change) = $dtr->createImage();
		if ($groups) {
			foreach ($groups as $n=>$group) {
				$dom = str_replace('changeme.'.$group, JURI::base(true).'/'.$this->params->get('cache_dir').'/'.$change[$n], $dom);
			}
		}
		JResponse::setBody($dom);
	}
}

class pcDTR 
{
	var $params = null;
	var $selector = null;
	var $hover = array();
	var $hoverselector = null;
	var $styles = null;
	var $width = array();
	var $height = array();
	var $_items = array();
	var $dummy = null;

	function __construct(&$params)
	{
		$this->params = $params;
		//check resample rate
		if ($this->params->get('resample_rate') > 4 || $this->params->get('resample_rate') < 1)
			$this->params->set('resample_rate', 1);
		$this->id = 1;
		$this->dummy = imagecreate(1, 1);
	}

	function setCss($el, $style) 
	{
		$this->styles[$el] = $style;
		if (preg_match('/:hover/', $el))
		{
			$this->hover[] = str_replace(':hover', '', $el);
			$this->hoverselector[str_replace(':hover', '', $el)] = $el;
		}
		$this->selector = $el;
	}

	function splitElement($node, $selector)
	{
		$tag = $node->tag;
		$txtNode = $node->innertext;
		$innerSplit = explode('<', $txtNode);
		$inner = '';

		foreach ($innerSplit as $icount=>$innerstr)
		{ 
			$tmp = explode('>', $innerstr);
			if(count($tmp)>1 && substr($innerstr,0,1)!='/')
			{
				$attrs = explode(' ', trim($tmp[0]));
				$innerTag = array_shift($attrs);
				$this->styles[$selector][0] = $selector.' '.$innerTag;
				$innerHTML = $this->addSpans($tmp[1]);
				if ($innerHTML===false)return $inner;
					$inner .= '<'.$tmp[0].'>'.trim($innerHTML).'</'.$innerTag.'>';
			} else {
				$inner .= $this->addSpans(array_pop($tmp));
			}
		}
		return $inner;
	}

	function addSpans($string)
	{
		$inline = 'span';
		$font_file = isset($this->styles[$this->selector]['font-family']) ? JPATH_SITE.DS.$this->params->get('fonts_dir').DS.$this->styles[$this->selector]['font-family'] : null;
		if(!file_exists($font_file)) return false;		
		
		$string = trim($string);
		if (!$string) return '';	
		$decoded = html_entity_decode($string, ENT_COMPAT, 'UTF-8');
		//create our pcDTR item and read all css info
		$item = new pcDTRItem($this->params);
		$this->setCssItem($item);
		$string=$decoded;
		if ($item->get('text-transform'))
		{
			if ($item->get('text-transform')=='uppercase') $string=mb_strtoupper($string);
			if ($item->get('text-transform')=='lowercase') $string=mb_strtolower($string);
		}
		//wrap lines and get widths
		list($lines,$line_widths) = $this->imagettftextbox($item->get('font-size'),$item->get('font-family'),$string,$item->get('letter-spacing',0),$item->get('width'),$item->get('group', 'default'));
		$item->set('lines', $lines);
		$item->set('line-widths', $line_widths);
		//set line height
		if ($item->get('line-height',0)) {
			$height = $item->get('line-height');
		} else {
			$bbox = imagettfbbox($item->get('font-size'),0,$item->get('font-family'),$this->params->get('test_string'));
			$height = abs($bbox[5])+abs($bbox[3]);
		}
		$item->set('height', $height);

		if ($item->get('hover')) {
			$string=$decoded;
			if ($item->get('text-transform',null,'hover'))
			{
				if ($item->get('text-transform',null,'hover')=='uppercase') $string=mb_strtoupper($string);
				if ($item->get('text-transform',null,'hover')=='lowercase') $string=mb_strtolower($string);
			}
		
			list($lines,$line_widths) = $this->imagettftextbox($item->get('font-size',null,'hover'),$item->get('font-family',null,'hover'),$string,$item->get('letter-spacing',0,'hover'),$item->get('width',null,'hover'),$item->get('group', 'default'));
			$item->set('lines',$lines,'hover');
			$item->set('line-widths',$line_widths,'hover');
		
			if ($item->get('line-height',0,'hover')) {
				$height = $item->get('line-height',null,'hover');
			} else {
				$bbox = imagettfbbox($item->get('font-size',null,'hover'),0,$item->get('font-family',null,'hover'),$this->params->get('test_string'));
				$height = abs($bbox[5])+abs($bbox[3]);
			}
			$item->set('height',$height,'hover');
		}
		if (!isset($this->height[$item->get('group', 'default')])) $this->height[$item->get('group', 'default')] = 0;
		//create the span and style html
		$out = '';
		foreach($lines as $n=>$text)
		{	
			$css = "<style type=\"text/css\">";
			$width = $item->get('line-widths');
			$width = $item->get('width', 0) > 0 ? $item->get('width') : $width[$n];
			$css .= "#pcdtr".$this->id."{background-image:url(changeme.".$item->get('group', 'default').");background-position:0 -".$this->height[$item->get('group', 'default')]."px;width:".$width."px;height:".$item->get('height')."px;}";
			$this->height[$item->get('group', 'default')] += $item->get('height');
			if ($item->get('hover', 0))
			{
				$width = $item->get('line-widths',null,'hover');
				$width = $item->get('width',0,'hover') > 0 ? $item->get('width',null,'hover') : $width[$n];
				$css .= "\n".$item->get('hover-selector')." #pcdtr".$this->id."{background-position:0 -".$this->height[$item->get('group', 'default')]."px;width:".$width."px;height:".$item->get('height',null,'hover')."px;}";
				$this->height[$item->get('group', 'default')] += $item->get('height',null,'hover');
			}
			$css .= "</style>";
			$out .= $css;
			$out .= '<'.$inline.' id="pcdtr'.$this->id.'">'.htmlspecialchars($text).'</'.$inline.'>';
			$this->id++;
		}
		//save our pcDTR item
		$this->_items[$item->get('group', 'default')][] = $item;
		return $out;
	}

	function setCssItem($item)
	{	
		$tmp = explode(' ', $this->selector);
		$innertag = array_pop($tmp);
		$parentSelector = implode(' ',$tmp);
		$parent_info = $hover_style = null;
	
		if(isset($this->styles[$parentSelector]))
			$parent_info = $this->styles[$parentSelector];

		if(!isset($this->styles[$this->selector]) && isset($parent_info))
			$style = $parent_info;
		else if(isset($this->styles[$this->selector]))
			$style = $this->styles[$this->selector];
		else 
			$style=array();

		if (in_array($style[0], $this->hover))
		{
			$item->set('hover', true);
			$item->set('hover-selector', $this->hoverselector[$style[0]]);

			$hover_style = $this->styles[$item->get('hover-selector')];
		}

		$values = array('group', 'width', 'font-size', 'font-family', 'text-align', 'text-decoration', 'text-transform', 'letter-spacing', 'line-height', 'color', 'background-color', 'background-transparent');
		foreach ($values as $value)
		{
			$item->setCss($value, $style, $parent_info, $hover_style);
			if (in_array($value, array('width', 'letter-spacing', 'line-height')))
			{
				if ($item->get($value)) $item->set($value,floatval($item->get($value)));
				if ($item->get($value,null,'hover')) $item->set($value, floatval($item->get($value,null,'hover')),'hover');
			}
			if (in_array($value, array('font-family')))
			{				
				if ($item->get($value)) $item->set($value,JPATH_SITE.DS.$this->params->get('fonts_dir').DS.$item->get($value));
				if ($item->get($value,null,'hover')) $item->set($value,JPATH_SITE.DS.$this->params->get('fonts_dir').DS.$item->get($value,null,'hover'),'hover');
			}
		}
	}

	function createImage() {
		// check if we have any items to process
		if (count($this->_items) == 0) return array(false, false);;
		
		// check for GD support
		if(!function_exists('ImageCreate'))
    		$this->fatal_error('Error: Server does not support PHP image generation');

		$extension = '.png';
		foreach ($this->_items as $n=>$group)
		{
			// look for cached copy, send if it exists
			$height = 0;
			$hashText = '';
			foreach ($group as $n=>$item) {
				$hashText .= $this->createHashText($item);
			}
			$hash = md5($hashText);
			$cache_filename = JPATH_SITE.DS.$this->params->get('cache_dir').DS.$hash.$extension;
			if ($this->params->get('cache_images') && (file_exists($cache_filename)))
			{
				$groups[] = $item->get('group', 'default');
				$hashfiles[] = $hash.$extension;
				continue;
			}

			// create big image for resampling
			$canvas = imagecreatetruecolor($this->width[$item->get('group', 'default')]*$this->params->get('resample_rate'), $this->height[$item->get('group', 'default')]*$this->params->get('resample_rate'));
			imagesavealpha($canvas, true);
			$transcolor = imagecolorallocatealpha($canvas, 0,0,0,127);
			imagefill($canvas ,0,0 ,$transcolor);
	
			foreach ($group as $n=>$item)
			{
				$font_found = is_readable($item->get('font-family'));
				if (!$font_found)
					$this->fatal_error('Error: The server is missing the specified font.');
	
				for ($i = 0; $i < sizeof($item->get('lines',0)); ++$i)
				{	
					//create text image
					list($image, $width) = $item->createItem($i, $this->params);
					//copy text image to big image
					imagecopy($canvas, $image, 0, $height, 0, 0, $width*$this->params->get('resample_rate'), $item->get('height')*$this->params->get('resample_rate'));
					$height += $item->get('height')*$this->params->get('resample_rate');
					imagedestroy($image);
	
					if ($item->get('hover'))
					{
						//create hover text image
						list($image_hover, $width) = $item->createItem($i, $this->params, 'hover');
						//copy text image to big image
						imagecopy($canvas, $image_hover, 0, $height, 0,0, $width*$this->params->get('resample_rate'), $item->get('height',null,'hover')*$this->params->get('resample_rate'));
						$height += $item->get('height',null,'hover')*$this->params->get('resample_rate');
						imagedestroy($image_hover);
					}
				}
			}
			
			//create final image for resampling and keep alpha settings
			$final = imagecreatetruecolor($this->width[$item->get('group', 'default')], $this->height[$item->get('group', 'default')]);
			imagealphablending($final, false);
			imagesavealpha($final, true);
			imagecopyresampled( $final, $canvas, 0,0,0,0, $this->width[$item->get('group', 'default')], $this->height[$item->get('group', 'default')], $this->width[$item->get('group', 'default')]*$this->params->get('resample_rate'), $this->height[$item->get('group', 'default')]*$this->params->get('resample_rate') );
			
			//for testing!!
			//header('Content-type: ' . $mime_type);
			//imagepng($final);
			
			// save copy of image for cache
			imagepng($final, $cache_filename);
			
			imagedestroy($final);
			imagedestroy($canvas);

			$groups[] = $item->get('group', 'default');
			$hashfiles[] = $hash.$extension;
		}
		imagedestroy($this->dummy);		
		return array($groups, $hashfiles);
	}

	function imagettftextbox($font_size, $font_file, $string, $kerning, $width, $group) {
 		$black = imagecolorallocate($this->dummy, 0, 0, 0);
		$lines = array();
		$line_widths = array();
			
		if ($width==0)
		{
			// wrap word with number from params
			$wrap = wordwrap($string, $this->params->get('letter_wrap'), '\n');
			$text_lines = explode('\n',$wrap);
			foreach ($text_lines as $word)
			{
				$line_width = 0;
				if ($this->params->get('letter_wrap_space')) $word.= end($text_lines)==$word ? '' : ' ';
				$letters = preg_split('//u', $word, -1, PREG_SPLIT_NO_EMPTY);
				
				foreach ($letters as $letter)
				{
					$bbox = imagettftext($this->dummy, $font_size*$this->params->get('resample_rate'), 0, 0, 0, $black, $font_file, $letter);
					$line_width = $line_width + (($bbox[2] + $kerning) / $this->params->get('resample_rate'));
				}
				$lines[] = $word;
				$line_widths[] = round($line_width);
				$this->width[$group] = $this->width[$group] < $line_width ? $line_width : $this->width[$group];
			}
		} 
		else
		{
			// wrap words from css property width:
			$this->width[$group] = $this->width[$group] < $width ? $width : $this->width[$group];
			$text = "";
			$line_width_total = 0;
			$text_line = explode(' ', $string);
			foreach ($text_line as $word)
			{
				$line_width = 0;
				$word.= end($text_line)==$word ? '' : ' ';
				$letters = preg_split('//u', $word, -1, PREG_SPLIT_NO_EMPTY);

				foreach ($letters as $letter)
				{
					$bbox = imagettftext($this->dummy, $font_size*$this->params->get('resample_rate'), 0, 0, 0, $black, $font_file, $letter);
					$line_width = $line_width + (($bbox[2] + $kerning) / $this->params->get('resample_rate'));
				}
				$line_width_total += $line_width;
				
				if ( $line_width_total > $width )
				{
					$lines[] = $text;
					$line_widths[] = round($line_width_total - $line_width - ($bbox[2]-$bbox[1]) / $this->params->get('resample_rate'));
					$this->width[$group] = $this->width[$group] < $line_width ? $line_width : $this->width[$group];
					$line_width_total = $line_width;
					$text = $word;
				} else {
					$text .= $word;
				}
				
			}
			$lines[] = $text;
			$line_widths[] = round($line_width_total);
			$this->width[$group] = $this->width[$group] < $line_width_total ? $line_width_total : $this->width[$group];
		}
		return array($lines,$line_widths);
	}

	function findFont($family)
	{
		$fontList = explode(',', $family);
		$fontName = array_shift($fontList);
		$extensions = array('.ttf', '.TTF', '.otf', '.OTF');
		foreach($extensions as $ext)
		{
			$test_file = JPATH_SITE.DS.$this->params->get('fonts_dir').DS.$fontName.$ext;

			if(file_exists($test_file))
			{
				$fontName .= $ext;
				break;
			}
		}
		return $fontName;
	}

	function createHashText($item)
	{
		$text = '';
		$text .= basename($item->get('font-family'));
		$text .= basename($item->get('font-family',null,'hover'));
		$values = array('group', 'width', 'font-size', 'text-align', 'text-decoration', 'text-transform', 'letter-spacing', 'line-height', 'color', 'background-color', 'background-transparent');
		foreach ($values as $value)	{
			$text .= $item->get($value);
		}
		foreach ($values as $value)	{
			$text .= $item->get($value,null,'hover');
		}
		$text .= implode(",", $item->get('lines'));
		return $text;
	}

	function fatal_error($message)
	{
		if (isset($_GET['debug']))die($message);
		
		// send an image
		if (function_exists('ImageCreate'))
		{
			$width = ImageFontWidth(5) * strlen($message) + 10;
			$height = ImageFontHeight(5) + 10;
			if($image = ImageCreate($width, $height))
			{
				$background = ImageColorAllocate($image, 255, 255, 255);
				$text_color = ImageColorAllocate($image, 0, 0, 0);
				ImageString($image, 5, 5, 5, $message, $text_color);    
				header('Content-type: image/png'); 
				imagepng($image);
				imagedestroy($image);
				exit ;
			}
		}
	
		// send 500 code
		header("HTTP/1.0 500 Internal Server Error");
		print($message);
		exit ;
	}
}

class pcDTRItem {
	var $params= null;
	var $_item = array();
					
	function __construct(&$params)
	{
		$this->params = $params;	
	}
	
	function set($property, $value=null, $group='default')
	{
		$this->_item[$group]->$property = $value;
	}
	
	function get($property, $default=null, $group='default')
	{
		if(isset($this->_item[$group]->$property)) {
			return $this->_item[$group]->$property;
		}
		return $default;
	}

	function setCss($value, $style, $parent_info=null, $hover_style=null) {
		if(isset($style[$value])) $this->set($value ,$style[$value]); 
		else if(isset($parent_info[$value])) $this->set($value ,$parent_info[$value]);
		
		if ($hover_style)
		{
			if (isset($hover_style[$value])) $this->set($value ,$hover_style[$value], 'hover');
			else if(isset($style[$value])) $this->set($value ,$style[$value], 'hover'); 
			else if(isset($parent_info[$value])) $this->set($value ,$parent_info[$value], 'hover');
		}
	}

	function createItem($n, $params, $type='default') {
		// allocate colors, size and draw text
		$background_rgb = $this->hex_to_rgb($this->get('background-color','#ffffff',$type));
		$font_rgb = $this->hex_to_rgb($this->get('color','#000000',$type));
		
		$maxhbox = imagettfbbox($this->get('font-size',20,$type)*$this->params->get('resample_rate'), 0, $this->get('font-family',null,$type), $params->get('test_string'));
		// calculate font baseline
		$int_y = abs($maxhbox[5]-$maxhbox[3])-$maxhbox[1];
		// calculate line-height
		$line_height = ($this->get('height',null,$type)*$this->params->get('resample_rate') - (abs($maxhbox[5])+abs($maxhbox[3])))/2;
		$int_y += $line_height;

		$dip = $this->get_dip($this->get('font-family',null,$type), $this->get('font-size',null,$type));
		
		$line_width = $this->get('line-widths',null,$type);
		if ($this->get('text-align','left',$type) == 'right') 
		{
			$underline_x = $x = $this->get('width',0,$type) > 0 ? ($this->get('width',null,$type) - $line_width[$n])*$this->params->get('resample_rate') : 0;
		} 
		elseif ($this->get('text-align','left',$type) == 'center')
		{	
			$underline_x = $x = $this->get('width',0,$type) > 0 ? (($this->get('width',null,$type) - $line_width[$n])*$this->params->get('resample_rate')) / 2 : 0;
		} 
		else 
		{
			$underline_x = $x = 0;	
		}
		$width = $this->get('width',0,$type) > 0 ? $this->get('width',null,$type)+$this->params->get('resample_rate') : $line_width[$n]+$this->params->get('resample_rate')+$this->get('letter-spacing',0,$type);

		$image = imagecreatetruecolor($width*$this->params->get('resample_rate'), $this->get('height',null,$type)*$this->params->get('resample_rate'));
		$background_color = imagecolorallocate($image, $background_rgb['red'], $background_rgb['green'], $background_rgb['blue']);
		imagefill($image, 0, 0, $background_color);
		$font_color = imagecolorallocate($image, $font_rgb['red'], $font_rgb['green'], $font_rgb['blue']) ;
		// set transparency
		if ($this->get('background-transparent',false,$type))
		{
			$background_color = imagecolorallocatealpha($image, $background_rgb['red'], $background_rgb['green'], $background_rgb['blue'], 127);
			imagefill($image, 0, 0, $background_color);
		}
		$text = $this->get('lines',null,$type);
		$letters = preg_split('//u', $text[$n], -1, PREG_SPLIT_NO_EMPTY);
		foreach ($letters as $letter)
		{	
			$bbox = imagettftext($image, $this->get('font-size',20,$type)*$this->params->get('resample_rate'), 0, $x, $int_y, $font_color, $this->get('font-family',null,$type), $letter );
			$x = $bbox[2] + $this->get('letter-spacing', 0,$type);				
		}
		// underline
		$underline_y = (abs($maxhbox[5])+abs($maxhbox[3])+($this->params->get('resample_rate')*2))-($dip/2)+$line_height;
		if ($this->get('text-decoration',null,$type)=='underline') imagefilledrectangle($image, $underline_x, $underline_y, $underline_x+$line_width[$n]*$this->params->get('resample_rate'), $underline_y+($this->params->get('resample_rate')/2), $font_color);

		return array($image, $width);
	}

	function hex_to_rgb($hex)
	{
		// remove '#'
		if(substr($hex,0,1) == '#')
			$hex = substr($hex,1);
	
		// expand short form ('fff') color
		if(strlen($hex) == 3) {
			$hex = substr($hex,0,1).substr($hex,0,1).substr($hex,1,1).substr($hex,1,1).substr($hex,2,1).substr($hex,2,1);
		}
	
		if(strlen($hex) != 6)
			pcDTR::fatal_error('Error: Invalid color "'.$hex.'"');
	
		// convert
		$rgb['red'] = hexdec(substr($hex,0,2));
		$rgb['green'] = hexdec(substr($hex,2,2));
		$rgb['blue'] = hexdec(substr($hex,4,2));
	
		return $rgb ;
	}

	function get_dip($font,$size)
	{
		$test_chars = range("a", "z");
		$test_chars = $test_chars.strtoupper($test_chars).range(0, 9).'!@#$%^&*()\'"\\/;.,`~<>[]{}-+_-='; 
		$box = imagettfbbox($size*$this->params->get('resample_rate'), 0, $font, $test_chars);
		return $box[3];
	}	
}