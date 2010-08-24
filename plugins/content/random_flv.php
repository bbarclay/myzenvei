<?php
/**
/**
*
* @copyright	Inspiration Web Design
* License commercial
*/


// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.event.plugin');


class plgContentRandom_flv extends JPlugin
{

 function onPrepareContent(&$row, &$contentParams, $page)
 {
 
     if(JPluginHelper::isEnabled('content','random_flv')==false) return;

 	$plugin =& JPluginHelper::getPlugin('content','random_flv');
	$pluginParams = new JParameter( $plugin->params );

 
    $param_defaults = $this->getParamDefaults($pluginParams);
	
	$document =& JFactory::getDocument();
    $baseurl = JURI::base();	
	
    $entry_text = $row->text ;
	$matches = array( );
	$params = array();
	if( preg_match_all( "/{random_flv:(.*?)}/", $entry_text, $matches, PREG_SET_ORDER ) > 0 ) {
	
	$this->addScripts();
	 
	  $i=0;
	  foreach( $matches as $match)
	  {	
	    if(isset($match[1])){
            $params[$i] = $this->get_params($match[1], $param_defaults );
		}
		else
		{
            $params[$i] = $this->get_params('', $param_defaults );
		}
		
		$flvlist = $this->getFLVList( $params[$i] );
		
		  $js = 'var playerMovie = "' . $flvlist->playerMovie . '";' ;
		  $js .= ' var altPlayerContent = "<p>You need the Flash Player to experience this content.</p> <p><a href=\'http://www.adobe.com\' target=\'_blank\'>Get Flash</a></p>";';
		  $js .=  'var path="' . $flvlist->path . '";';
		  $js .=  'var flvs="' . $flvlist->flvString . '";';	  
		  $js .=  'var autoStart="' . $params[$i]['autoStart'] . '";';
		  $js .=  'var autoReplay="' . $params[$i]['autoReplay'] .'";';	  
		  $js .=  'var playerHeight = "' . strval($flvlist->playerHeight) . '";';	
		  $js .=  'var uniq_id = "' . $flvlist->uniq_id . '";';	
		
		  $replace_text = '<script type="text/javascript">'.$js.'</script>';
		  $replace_text .= '<script type="text/javascript" src="'. $baseurl.'modules/mod_random_flv_pro/flashscript/playertags.js'.'"></script>';
		  $replace_text .= '<span id="'. $flvlist->uniq_id .'">';		  
		  $replace_text .= '<script type="text/javascript" src="'. $baseurl.'modules/mod_random_flv_pro/flashscript/embedplayer.js'.'"></script>';
		  $replace_text .= '<script type="text/javascript" src="'. $baseurl.'modules/mod_random_flv_pro/flashscript/embedpopup.js'.'"></script>';
		  $replace_text .= '</span>';
		  
		  $entry_text = preg_replace('#'.$match[0].'#',$replace_text, $entry_text,1);
		  $i++;
	  }
	
	}
     $row->text = $entry_text;
 
  }
 
	 function getParamDefaults(&$params)
	 {
		$param_defaults = array();
		$param_defaults[ 'count'] = $params->get('count',5);
		$param_defaults[ 'playerHeight'] = $params->get('playerHeight','250');
		$param_defaults[ 'folder'] = $params->get('folder','media/flvs');
		$param_defaults[ 'skin'] = $params->get('skin','flvplayer');
		$param_defaults[ 'autoStart'] = $params->get('autoStart','yes');
		$param_defaults[ 'autoReplay'] = $params->get('autoReplay','yes');
		$param_defaults[ 'flvs'] = '';
		
		return $param_defaults;
	 }
 
	 /**
	 *  compare and return parameters.
	 * @author Fiona Coulter
	 * @param string $match
	 * @param array $param_defaults
	 * @return array
	 */
	function get_params( $match, $param_defaults ) {
		$params = explode( ";", $match ) ;
		foreach( $params as $param ) {
			$param = explode( "=", $param ) ;
			if( isset( $param_defaults[$param[0]] ) ) {
				$param_defaults[$param[0]] = $param[1] ;
			}
		}
		return $param_defaults ;
	}

	function addScripts( )
	{
	      $document =& JFactory::getDocument();
          $baseurl = JURI::base();
		  $document->addScript($baseurl.'modules/mod_random_flv_pro/flashscript/flashvars.js');
		  $document->addScript($baseurl.'modules/mod_random_flv_pro/flashscript/flashver.vbs', 'text/vbscript');
		  $document->addScript($baseurl.'modules/mod_random_flv_pro/flashscript/detectflash.js');
		  $document->addScript($baseurl.'modules/mod_random_flv_pro/flashscript/popupwin.js');		  

	 }
	 
	 function getFLVList( &$params )
	 {
	 	$flvlist = new stdClass();
		$folder	= $this->getFolder($params['folder']);
		$flvString = $params['flvs'];
		if($flvString == '')
		{
		    $flvs	= $this->getFLVs($folder);
		
		    if (!count($flvs)) {
			    //echo JText::_( 'No flvs ');
			    return;
		    }
		    $random_flvs = $this->getRandomFLVs($params, $flvs);
		    $flvlist->flvString = implode(",", $random_flvs);
			
		}
		else
		{
		   $flvlist->flvString = $flvString;
		}
		$flvlist->path = JURI::base().str_replace('\\','/',$folder);
		$flvlist->playerHeight = (int) $params['playerHeight'];
		$flvlist->playerMovie = JURI::base() . 'modules/mod_random_flv_pro/assets/'. $params['skin']. '.swf';
        $flvlist->uniq_id = uniqid('flv-');
		
	     return $flvlist;
	 }
	 
	 
	 function getRandomFLVs(&$params, $flvs)
	{
		$count = (int) $params['count'];
		$c = count($flvs);
		
		$random_flvs = array();
		
		if( $c == 1 )
		{
	       $random_flvs[0] = rawurlencode($flvs[0]->name);	
		   return $random_flvs;			
		}
		
		
		if ( $c > $count )
		{
		  $numFLVs = $count;		
		}
		else
		{
		  $numFLVs = $c;
		}
		
		
		$random_flvs = array();
		$randArray = array();
		
		if ( $numFLVs == 1 )
		{
		   $randArray0 = array_rand( $flvs );
		   $randArray[0] = $randArray0;		
		}		
		else
		{
		   $randArray = array_rand( $flvs, $numFLVs );
		}
		
		
		for ( $i=0; $i<$numFLVs; $i++ )
		{

		     $random = $randArray[ $i ];
             $random_flv = $flvs[$random];
		     $random_flvs[$i] = rawurlencode($random_flv->name);			 
         }

		return $random_flvs;
	}

	function getFLVs($folder)
	{
		$type 		= 'flv';

		$files	= array();
		$flvs	= array();

		$dir = JPATH_BASE.DS.$folder;

		// check if directory exists
		if (is_dir($dir))
		{
			if ($handle = opendir($dir)) {
				while (false !== ($file = readdir($handle))) {
					if ($file != '.' && $file != '..' && $file != 'CVS' && $file != 'index.html' ) {
						$files[] = $file;
					}
				}
			}
			closedir($handle);

			$i = 0;
			foreach ($files as $flv)
			{
				if (!is_dir($dir .DS. $flv))
				{
					if (eregi($type, $flv)) {
						$flvs[$i]->name 	= $flv;
						$flvs[$i]->folder	= $folder;
						++$i;
					}
				}
			}
		}

		return $flvs;
	}

	function getFolder($afolder)
	{
		$folder 	= $afolder;

		$LiveSite 	= JURI::base();

		// if folder includes livesite info, remove
		if ( JString::strpos($folder, $LiveSite) === 0 ) {
			$folder = str_replace( $LiveSite, '', $folder );
		}
		// if folder includes absolute path, remove
		if ( JString::strpos($folder, JPATH_SITE) === 0 ) {
			$folder= str_replace( JPATH_BASE, '', $folder );
		}
		$folder = str_replace('\\',DS,$folder);
		$folder = str_replace('/',DS,$folder);

		return $folder;
	}



}

