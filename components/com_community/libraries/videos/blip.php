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
 * Class to manipulate data from Blip
 * 	 	
 * @access	public  	 
 */
class CTableVideoBlip extends CVideoProvider
{
	var $xmlContent = null;
	var $url = '';
	
	/**
	 * Return feedUrl of the video
	 */
	function getFeedUrl()
	{
		return 'http://www.blip.tv/file/'.$this->getId().'?skin=rss';
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
		// Connect and get the remote video
		CFactory::load('helpers', 'remote');
		$this->xmlContent	= cRemoteGetContent($this->getFeedUrl());
		$videoId = $this->getId();
		if (empty($videoId))
		{
			$this->setError	= JText::_('CC INVALID VIDEO ID');
			return false;
		}
		if($this->xmlContent == FALSE)
		{
			$this->setError	= JText::_('CC ERROR FETCHING VIDEO');
			return false;
		}
		
		return true;
	}
	
	/**
	 * Extract Blip video id from the video url submitted by the user
	 * 	 	
	 * @access	public
	 * @param	video url
	 * @return	videoid
	 */
	function getId()
	{
		$code	= '';
				
		//check for embed code format
		//$pos_e = strpos($this->url, "youtube.com/v/");
		$pos_u = strpos($this->url, "file/");

		////TODO: User regular expression instead
		if ($pos_u === false) {
			return null;
		} else if ($pos_u) {
			$pos_u_start = $pos_u + 5;

			$code = substr($this->url, $pos_u_start);
			$code = strip_tags($code );
			$code_tmp = explode("?", $code);
			$code = $code_tmp["0"];
		}
						
		return $code;
	}
	
	/**
	 * Return the video provider's name
	 * 
	 */
	function getType()
	{
		return 'blip';
	}
	
	function getTitle()
	{
		$title = '';		
		// Store video title
		$pattern =  "/<title>(.*)<\/title>/i";
		preg_match_all($pattern, $this->xmlContent, $matches);
		if($matches)
		{
			$title = $matches[1][1];
		}
		
		return $title;
	}
	
	function getDescription()
	{
		$description = '';
		// Store description
		$pattern =  "'<blip\:puredescription>(.*?)<\/blip\:puredescription>'s";
		preg_match_all($pattern, $this->xmlContent, $matches);
		if($matches)
		{
			$description = JString::str_ireplace( '&apos;' , "'" , $matches[1][0] );
			$description = JString::str_ireplace( '<![CDATA[', '', $this->description );
			$description = JString::str_ireplace( ']]>', '', $this->description );
		}
		
		return $description;
	}
	
	function getDuration()
	{
		$duration = '';
		// Store duration
		$pattern =  "'<blip:runtime>(.*?)<\/blip:runtime>'s";
		preg_match_all($pattern, $this->xmlContent, $matches);
		if($matches)
		{
			$duration = $matches[1][0];
		}
			
		return $duration;
	}
	
	/**
	 * Get video's thumbnail
	 * 
	 * @access 	public
	 * @param 	videoid
	 * @return url
	 */
	function getThumbnail()
	{
		$thumbnail = '';
		// Store thumbnail
		$pattern =  "'<blip:smallThumbnail>(.*?)<\/blip:smallThumbnail>'s";			 
		preg_match_all($pattern, $this->xmlContent, $matches);
		if($matches)
		{
			$thumbnail = $matches[1][0];
		}
		
		return $thumbnail;
	}
	
	/**
	 * 
	 * 
	 * @return $embedvideo specific embeded code to play the video
	 */
	function getViewHTML($videoId, $videoWidth, $videoHeight)
	{
		if (!$videoId)
		{
			$videoId	= $this->videoId;
		}
		CFactory::load('helpers', 'remote');
		$remoteFile	= 'http://www.blip.tv/file/'.$videoId.'?skin=rss';
		$xmlContent = cRemoteGetContent($remoteFile);
		// get embedFile
		$pattern	= "'<blip:embedLookup>(.*?)<\/blip:embedLookup>'s";
		$embedFile	= '';
		preg_match_all($pattern, $xmlContent, $matches);
		if($matches)
		{
			$embedFile = $matches[1][0];
		}	
		
		return '<object width="'.$videoWidth.'" height="'.$videoHeight.'"><param name="movie" value="http://blip.tv/play/'.$embedFile.'"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://blip.tv/play/'.$embedFile.'" type="application/x-shockwave-flash" width="'.$videoWidth.'" height="'.$videoHeight.'" allowscriptaccess="always" allowfullscreen="true" wmode="transparent"></embed></object>';
	}
}
