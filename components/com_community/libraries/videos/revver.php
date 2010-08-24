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
 * Class to manipulate data from Revver
 * 	 	
 * @access	public  	 
 */
class CTableVideoRevver extends CVideoProvider
{
	var $xmlContent = null;
	var $url 		= '';
	var $videoId	= '';
	/**
	 * Return feedUrl of the video
	 */
	function getFeedUrl()
	{
		return 'http://www.revver.com/video/'.$this->videoId;
	}
	
	function init($url)
	{
		$this->url = $url;
		$this->videoId 	= $this->getId();
	}
	
	/*
	 * Return true if successfully connect to remote video provider
	 * and the video is valid
	 */	 
	function isValid()
	{
		// Connect and get the remote video
		CFactory::load('helpers', 'remote');
		$this->xmlContent = cRemoteGetContent($this->getFeedUrl());
		
		if (empty($this->videoId))
		{
			$this->setError	= JText::_('CC INVALID VIDEO ID');
			return false;
		}
		if($this->xmlContent == false)
		{
			$this->setError	= JText::_('CC ERROR FETCHING VIDEO');
			return false;
		}

		return true;
	}	
	
	/**
	 * Extract video id from the video url submitted by the user
	 * 	 	
	 * @access	public
	 * @param	video url
	 * @return videoid	 
	 */
	function getId()
	{			
	
		$code	= '';
		
		//check for embed code format  
		$pos_u = strpos($this->url, "video/");	

		////TODO: User regular expression instead
		if ($pos_u === false) {
			return null;
		} else if ($pos_u) {
			$pos_u_start = $pos_u + 6;

			$code = substr($this->url, $pos_u_start);
			$code = strip_tags($code );
		}								 
		return $code;
	}
	
	
	/**
	 * Return the video provider's name
	 * 
	 */
	function getType()
	{
		return 'revver';
	}
	
	function getTitle()
	{
		$title	= '';
		
		// Get title
		$pattern =  "/<meta name=\"title\" content=\"(.*?)\" \/>/i";
		preg_match_all($pattern, $this->xmlContent, $matches);
		if($matches)
		{
			$title = $matches[1][0];
		}
		
		return $title;
	}
	
	function getDescription()
	{
		$description	= '';
		
		// Get description
		$pattern =  "'<meta name=\"description\" content=\"(.*?)\" \/>'s";
		preg_match_all($pattern, $this->xmlContent, $matches);
		if($matches)
		{
			$description = trim(strip_tags($matches[1][0]));
		}
		
		return $description;
		
	}
	
	function getDuration()
	{
		return false;
	}
	
	/**
	 * 
	 * @param $videoId
	 * @return unknown_type
	 */
	function getThumbnail()
	{
		$thumbnail	= '';
		
		// Get thumbnail
		$pattern =  "'<link rel=\"image_src\" href=\"(.*?)\" \/>'s";
		preg_match_all($pattern, $this->xmlContent, $matches);
		if($matches)
		{
			$thumbnail = rawurldecode($matches[1][0]);
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
		$videoId = explode("/",$videoId);
		$embedCode = '<object width="'.$videoWidth.'" height="'.$videoHeight.'" data="http://flash.revver.com/player/1.0/player.swf?mediaId='.$videoId[0].'" type="application/x-shockwave-flash" id="revvervideo'.$videoId[0].'"><param name="Movie" value="http://flash.revver.com/player/1.0/player.swf?mediaId='.$videoId[0].'"></param><param name="wmode" value="transparent"/></param><param name="AllowFullScreen" value="true"></param><param name="AllowScriptAccess" value="always"></param><embed type="application/x-shockwave-flash" src="http://flash.revver.com/player/1.0/player.swf?mediaId='.$videoId[0].'" pluginspage="http://www.macromedia.com/go/getflashplayer" allowScriptAccess="always" flashvars="allowFullScreen=true" allowfullscreen="true" height="'.$videoHeight.'" width="'.$videoWidth.'" wmode="transparent"></embed></object>';
		
		return $embedCode;
	}

}
