<?php
/**
 * @category	Helper
 * @package		JomSocial
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 */
defined('_JEXEC') or die('Restricted access');

require_once (COMMUNITY_COM_PATH.DS.'models'.DS.'videos.php');

/**
 * Class to manipulate data from Daily Motion
 * 	 	
 * @access	public  	 
 */
class CTableVideoFile extends CVideoProvider
{
	var $xmlContent = null;
	var $url = '';
	
	/**
	 * Return feedUrl of the video
	 */
	function getFeedUrl()
	{
		return true;
	}
	
	function init($url)
	{
		$this->url = $url;
	}
	
	/*
	 * Return true if successfully connect to remote video provider
	 * and the video is valid
	 */	 
	function isValid()
	{
		return true;
	}	
	
	/**
	 * Extract DailyMotion video id from the video url submitted by the user
	 * 	 	
	 * @access	public
	 * @param	video url
	 * @return videoid	 
	 */
	function getId()
	{			
		//check for embed code format
		//$pos_e = strpos($this->url, "youtube.com/v/");
		$pos_u = strpos($this->url, "video/");

		////TODO: User regular expression instead
		if ($pos_u === false) {
			return null;
		} else if ($pos_u) {
			$pos_u_start = $pos_u + 6;

			$code = substr($this->url, $pos_u_start);
			$code = strip_tags($code );
			$code = preg_replace("/[^a-zA-Z0-9s_-]/", "", $code);
		}
						
		return $code;
	}
	
	
	/**
	 * Return the video provider's name
	 * 
	 */
	function getType()
	{
		return 'file';
	}
	
	function getTitle()
	{		
		return true;
	}
	
	function getDescription()
	{
		return true;
	}
	
	function getDuration()
	{			
		return true;
	}
	
	function getThumbnail()
	{
		return true;
	}
	
	/**
	 * 
	 * 
	 * @return $embedvideo specific embeded code to play the video
	 */
	function getViewHTML($videoId, $videoWidth, $videoHeight)
	{
		$video	=& JTable::getInstance( 'Video' , 'CTable' );
		$video->load( $videoId );

		$params	= array();
		
		// Load flowplayer if video is uploaded
		CAssets::attach('/assets/flowplayer/flowplayer-3.1.0.min.js', 'js');			
		$params['swf']		= JURI::root() . 'components/com_community/assets/flowplayer/flowplayer.jomsocial-3.1.0.swf';

		// Insert data into javascript parameter for flash player
		$config				=& CFactory::getConfig();
		$params['key']		= $config->get('videoskey');

		$params['plugin']	= JURI::root() . 'components/com_community/assets/flowplayer/';
		$params['plugin']	.= 'flowplayer.pseudostreaming-3.1.2.swf';

		$config				= CFactory::getConfig();
		if ($config->get('enablevideopseudostream') && ($video->storage == 'file'))
		{
			//$params['flv']	= 'index.php?option=com_community&view=videos&task=streamer&vid='.$video->id;
			$params['flv']		= JURI::root() . 'components/com_community/libraries/streamer.php/'.base64_encode($video->path);
		}
		else
		{
			CFactory::load('libraries', 'storage');
			$storage	= CStorage::getStorage($video->storage);
			//$params['flv']	= JURI::root() . $video->path;
			$params['flv']		= $storage->getURI($video->path);
		}
		$params['flv']		= urlencode($params['flv']);

		$tmpl	= new CTemplate();
		$tmpl->set( 'video'		, $video );
		$tmpl->set( 'params'	, $params );
		$embedCode	= $tmpl->fetch( 'videos.flowplayer' );
		
		return $embedCode;
	}
}