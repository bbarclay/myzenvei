<?php
/**
*
* @copyright	Inspiration Web Design
* License commercial
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );


class modRandomFLVProHelper
{
	function getRandomFLVs(&$params, $flvs)
	{
		$count = (int) $params->get('count', 5);
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

	function getFLVs(&$params, $folder)
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

	function getFolder(&$params)
	{
		$folder 	= $params->get( 'folder' );

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
	
	function addScripts( &$params, $flvlist )
	{
	      $document =& JFactory::getDocument();
          $baseurl = JURI::base();
		  $document->addScript($baseurl.'modules/mod_random_flv_pro/flashscript/flashvars.js');
		  $document->addScript($baseurl.'modules/mod_random_flv_pro/flashscript/flashver.vbs', 'text/vbscript');
		  $document->addScript($baseurl.'modules/mod_random_flv_pro/flashscript/detectflash.js');
		  
		  $js = 'var playerMovie = "' . $flvlist->playerMovie . '";' ;
		  $js .= ' var altPlayerContent = "<p>You need the Flash Player to experience this content.</p> <p><a href=\'http://www.adobe.com\' target=\'_blank\'>Get Flash</a></p>";';
		  $js .=  'var path="' . $flvlist->path . '";';
		  $js .=  'var flvs="' . $flvlist->flvString . '";';	  
		  $js .=  'var autoStart="' . $params->get('autoStart') . '";';
		  $js .=  'var autoReplay="' . $params->get('autoReplay') .'";';	  
		  $js .=  'var playerHeight = "' . strval($flvlist->playerHeight) . '";';	
		  $js .=  'var uniq_id = "' . $flvlist->uniq_id . '";';	
		  
		  
		  //$document->addScriptDeclaration($js);
		  $document->addScript($baseurl.'modules/mod_random_flv_pro/flashscript/playertags.js');
		  $document->addScript($baseurl.'modules/mod_random_flv_pro/flashscript/popupwin.js');

          if ( $params->get('autoPopup','no') == 'yes')
          {
               JHTML::_('behavior.mootools');
	           $domready = "window.addEvent('domready', function() { openFLVWindow() });";
			   $document->addScriptDeclaration($domready);
          }
		  
		  return $js;
	
	}
}

