<?php   
/* 
* Copyright (c) 2007 Adam Florizone. All rights reserved.
* Copyright (c) 2008-2009 Digihaven Technology & Design Canada. All rights reserved. http://www.digihaven.com/
*
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2, or (at your option)
 * any later version.

 * This program is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * General Public License for more details.

 * You should have received a copy of the GNU General Public License
 * along with Content Optimizer; see the file COPYING. If not, write to the
 * Free Software Foundation, Inc., 59 Temple Place - Suite 330, Boston,
 * MA 02111-1307, USA.
*/

defined( '_JEXEC' ) or die( 'Restricted access' );
$mainframe->registerEvent( 'onPrepareContent', 'plgContentOptimizer_PrepareContent'  );

function plgContentOptimizer_PrepareContent( &$row, &$params, $page=0  ) 
{
	$plugin =& JPluginHelper::getPlugin('content', 'contentoptimizer');

	$buffer = $row->text;
	$matches = array();
	
	if (preg_match_all("|<[\s\v]*img[\s\v][^>]*>|Ui", $buffer, $matches, PREG_PATTERN_ORDER) > 0)
	{         
		foreach ($matches[0] as $match) 
		{
			$newtext = plgContentOptimizer_resize($match);
			$buffer = str_replace($match, $newtext, $buffer);
		}
		$row->text = $buffer;      
	}
}

function return_bytes($val) {
    $val = trim($val);
    $last = strtolower($val[strlen($val)-1]);
    if ($last=="b")
    	$val=substr(0,-1);
    	
    $last = strtolower($val[strlen($val)-1]);
    switch($last) {
        // The 'G' modifier is available since PHP 5.1.0
        case 'g':
            $val *= 1024;
        case 'm':
            $val *= 1024;
        case 'k':
            $val *= 1024;
    }

    return $val;
}

function plgContentOptimizer_resize($buffer) 
{
	$plugin =& JPluginHelper::getPlugin('content', 'contentoptimizer');
	$botParams = new JParameter( $plugin->params );
	
	$quality = (integer) $botParams->def( 'image_quality', '75' );
	$show_errors = (bool) $botParams->def( 'debug', 0 );
	
	$cache_path = dirname(__FILE__) ."/contentoptimizer";
	$cache_path_http = JURI::base() ."plugins/content/contentoptimizer";
	
	if (!class_exists('XMLReader'))
	{
		trigger_error("Content Optimizer: Unable to load the required class XMLReader! http://us3.php.net/manual/en/xmlreader.installation.php", E_USER_WARNING);
		return false;
	}
	
	// Load the tag as XML
	$node = new XMLReader();
	$node->XML($buffer);
	if ($show_errors)
	{
	    if (!$node->read()) { 
	    	trigger_error("Content Optimizer XMLReader failed " . $image . "!", E_USER_WARNING);
	    	
			return $buffer;
		}
	} else
	{
		if (!@$node->read()) 
			return $buffer;
	}

	// Get what we want
	if ($node->nodeType==1 && $node->hasAttributes)
    {
		if ($node->getAttribute("height")!="" && is_numeric($node->getAttribute("height")))
			$height_new = (integer) $node->getAttribute("height");
			
		if ($node->getAttribute("width")!="" && is_numeric($node->getAttribute("width")))
			$width_new= (integer) $node->getAttribute("width");
			
		if ($node->getAttribute("src")!="")
			$src = $node->getAttribute("src");
	}

	if (!isset($src))
	{
		if ($show_errors)
				trigger_error("Content Optimizer could not get src!", E_USER_WARNING);
		return $buffer;
	}
		
	if (!isset($height_new) && !isset($width_new)) 
	{
		if ($show_errors)
				trigger_error("Content Optimizer could not get height or width for \"$src\"! (Consider setting it)", E_USER_NOTICE);
		return $buffer;
	}
	
	// Need to remove encoding
	$orginalsrc=$src;
	$src=urldecode($src);

	$path_parts = pathinfo($src);
	
	switch(strtolower($path_parts['extension']))
	{
		case 'jpeg': case 'jpg': case 'swf': case 'psd': case 'bmp': 
		case 'tiff': case 'jpc': case 'jp2': case 'jpf': case 'jb2':
		case 'swc': case 'aiff': case 'wbmp': case 'xbm': 
			$new_ext = 'jpeg'; 
			break;
		case 'gif': 
			//!! GD dosent support resizing animated gifs
			$support_gif = (bool) $botParams->def( 'image_support_gif', 1 );
			if ($support_gif)
			{
				$new_ext = 'png'; 
			}
			else
			{
				if ($show_errors)
					trigger_error("Content Optimizer is ignoring \"$src\" because \"Optimize Gif Images\" is set to false.", E_USER_NOTICE);
				return $buffer;
			}
			
			break;
		case 'png':
			$new_ext = 'png'; 
			break;
		default: 
			$new_ext = 'png'; 
			$pref = $src;
			break;
	}

	$base = sha1($path_parts['basename']) . "_";

	if (isset($width_new)) 
		$base .= $width_new;
	$base .= 'x';
	if (isset($height_new)) 
		$base .= $height_new;
	if ($new_ext == 'jpeg')
		$base .= '_Q' . $quality;

	$filename = $base.".".$new_ext;
	$full_path_filename = $cache_path."/".$filename;

	if (parse_url($src,PHP_URL_HOST)=="")
	{
		//$src=join_url(parse_url($src),true);
		
		// If cache file exists and is newer then src files
		// !! Make it work with remote files! (Neeed to caculate time zone too)
		if (@is_file($full_path_filename) && @is_file($src) && @filemtime($full_path_filename) > @filemtime($src)) 
		{
			// Files that are 0bytes, mean that they sould be ignored.
			if (filesize($full_path_filename)==0)
				return $buffer;
				
			$url = $cache_path_http."/".$filename;
		} 
		else
		{
			$imageInfo = getimagesize($src);
			list($width_new_original, $heigh_original, $image_type, $attr) = $imageInfo;
			
			// For some image types, the presence of channels and bits values can be a bit confusing. As an example, GIF always uses 3 channels per pixel, but the number of bits per pixel cannot be calculated for an animated GIF with a global color table. 
			//$channels = $imageInfo["channels"];
			$channels=4; // 4=truecolor becasue GD sucks at telling us the real channels...
			
			$image_file_size=filesize($src);
			$extra=1.5; // For header and buffers to be safe
						
			$MemRequired = $width_new_original * $heigh_original * $channels * $extra + $image_file_size;
			$InUse=memory_get_usage();
			
			// Check if we need to set it
			if ($MemRequired > return_bytes(ini_get('memory_limit')) - $InUse)
			{
				//Try to set it
				ini_set('memory_limit',$MemRequired + $InUse);
			}
			
			// Check to see if it was set
			if ($MemRequired > return_bytes(ini_get('memory_limit')) - $InUse)
			{
				trigger_error("Content Optimizer: Your trying to load an image that is greater then the amout of the memory_limit parameter (right now " . return_bytes(ini_get('memory_limit')) . " bytes). This image requires $MemRequired  bytes and $InUse bytes are allready in use. See the faq: http://www.digihaven.com/products/joomla-software/content-optimizer.html", E_USER_WARNING);
				return $buffer;
			}
			
			$image=null;
		    switch ($image_type)
		    {
		        case IMAGETYPE_GIF: $image = imagecreatefromgif($src); break;
		        case IMAGETYPE_JPEG: $image = imagecreatefromjpeg($src);  break;
		        case IMAGETYPE_PNG: $image = imagecreatefrompng($src); break;
		    }

			// could not open image?
			if ($image == false)
			{
				if ($show_errors)
					trigger_error("Content Optimizer could not open " . $image . "!", E_USER_WARNING);
				return $buffer;
			} 
			
			// Get the missing dimention as resault of the ratio
			if (!isset($width_new)) 
				$width_new = $height_new * $width_new_original / $heigh_original;
			if (!isset($height_new)) 
				$height_new = $width_new * $heigh_original / $width_new_original;
				
			// Allow the choice of down sampling
			$image_upsampling = (bool) $botParams->def( 'image_upsampling', 0 );
			if ($image_upsampling==false)
			{
				if ($width_new_original * $heigh_original < $height_new * $width_new)
				{
					if ($show_errors)
						trigger_error("Content Optimizer is ignoring \"$src\" because \"upsampling\" is set to false.", E_USER_NOTICE);
					
					// Files that are 0bytes, mean that they sould be ignored.
					touch($full_path_filename);
					return $buffer;
				}
			}
				
			// Ignore if the files are the same size
			$image_resample_same_dimensions = (bool) $botParams->def( 'image_resample_same_dimensions', 1 );
			if ($image_resample_same_dimensions==false)
			{
				if ($width_new_original == $width_new && $height_new ==  $heigh_original)
				{
					if ($show_errors)
						trigger_error("Content Optimizer is ignoring \"$src\" because \"resample same dimensions\" is set to false.", E_USER_NOTICE);
					
					// Files that are 0bytes, mean that they sould be ignored.
					touch($full_path_filename);
					return $buffer;
				}
			}
			
			$result = @imagecreatetruecolor($width_new, $height_new);
				
			if ($result == false) 
				return $buffer;
				
			if ($new_ext == 'png')
			{
				imagealphablending($result, false);
				$transparent = imagecolorallocatealpha($result, 0, 0, 0, 127);
				imagefill($result, 0, 0, $transparent);
				imagesavealpha($result,true);
				imagealphablending($result, true); //removing this causes the second layer's transparency to go trough the 1st layer erasing it (the image >is< transparent there ... as is the 2nd layer ... but not the 1st so it should not be transparent)
			}
			
			$sample = @imagecopyresampled($result, $image, 0, 0, 0, 0, $width_new, $height_new, $width_new_original, $heigh_original);
			
			if ($sample == false) 
				return $buffer; 
				
			switch ($new_ext)
			{
				case 'jpeg': 
					$save = @imagejpeg($result, $full_path_filename, $quality); 
					break;		
				case 'png': 
					$save = @imagepng($result, $full_path_filename); 
					break;
			}
			
			if ($save == false) 
			{
				if ($show_errors)
					trigger_error("Content Optimizer could not save file " . $full_path_filename . "!", E_USER_WARNING);
				return $buffer;
			}
		
			@imagedestroy($image);
			@imagedestroy($result);
			
			// Make sure we are really creating a smaller image!
			$image_force_smaller_file = (bool) $botParams->def( 'image_force_smaller_file', 1 );
			if ($image_force_smaller_file && filesize($full_path_filename) > $image_file_size)
			{
				if ($show_errors)
					trigger_error("Content Optimizer is ignoring \"$src\" because \"force smaller file\" is set to true.", E_USER_NOTICE);
				// Files that are 0bytes, mean that they sould be ignored.
				unlink($full_path_filename);
				touch($full_path_filename);
				
				return $buffer;
			}
			
			$url = $cache_path_http."/".$filename;
		}
		
		$buffer = str_replace($orginalsrc, $url, $buffer);
	}
	
	return $buffer;
}

?>
