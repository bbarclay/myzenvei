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
 * Class to manipulate data from YouTube
 * 	 	
 * @access	public 
 */
class CTableVideoYoutube extends CVideoProvider
{	
	var $xmlContent = null;
	var $url = '';
	
	/**
	 * Return feedUrl of the video
	 */
	function getFeedUrl()
	{
		return 'http://gdata.youtube.com/feeds/api/videos/' . $this->getId();
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
		if (empty($videoId) || $this->xmlContent == 'Invalid id')
		{
			$this->setError(JText::_('CC INVALID VIDEO ID'));
			return false;
		}
		if($this->xmlContent == false)
		{
			$this->setError(JText::_('CC ERROR FETCHING VIDEO'));
			return false;
		}
		if($this->xmlContent == 'Video not found')
		{
			$this->setError(JText::_('CC YOUTUBE VIDEO NOT FOUND'));
			return false;
		}

		
	
		
		
		return true;
	}
	
	/**
	 * Extract YouTube video id from the video url submitted by the user
	 * 	 	
	 * @access	public
	 * @param	video url
	 * @return videoid	 
	 */
	function getId()
	{
		//check for embed code format
		$pos_e = strpos($this->url, "youtube.com/v/");
		$pos_u = strpos($this->url, "watch?v=");

		////TODO: User regular expression instead
		if ($pos_e === false && $pos_u === false) {
			return null;
		} else if ($pos_e) {
			$pos_e_start = $pos_e + 14;

			$code = substr($this->url, $pos_e_start, 11);
			$code = strip_tags($code );
			$code = preg_replace("/[^a-zA-Z0-9s_-]/", "", $code);
		} else if ($pos_u) {
			$pos_u_start = $pos_u + 8;

			$code = substr($this->url, $pos_u_start, 11);
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
		return 'youtube';
	}
	
	function getTitle()
	{
		$title = '';
		// Store video title
		$pattern =  "/<title type='text'>(.*?)<\/title>/i";
		preg_match_all($pattern, $this->xmlContent, $matches);
		if($matches)
		{
		    $title = $matches[1][0];
		}
		
		return $title;
	}
	
	function getDescription()
	{
		$description = '';
		// Store description
		$pattern =  "/<content type='text'>(.*?)<\/content>/s";
		preg_match_all($pattern, $this->xmlContent, $matches);
		if($matches)
		{
		    $description = $matches[1][0];
		}
		
		return $description;
	}
	
	function getDuration()
	{
		$duration = 0;
		// Store duration
		$pattern =  "/seconds='(.+?)'/i";
		preg_match_all($pattern, $this->xmlContent, $matches);
		if($matches)
		{
			$duration = $matches[1][0];
		}
		
		return $duration;
	}
	
	/**
	 * Get video's thumbnail URL from videoid
	 * 
	 * @access 	public
	 * @param 	videoid
	 * @return url
	 */
	function getThumbnail()
	{
		return 'http://img.youtube.com/vi/' . $this->getId() . '/default.jpg';
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
			$videoId	= $this->getId();
		}
		return "<embed src=\"http://www.youtube.com/v/" .$videoId. "&hl=en&fs=1&hd=1&showinfo=0&rel=0\" type=\"application/x-shockwave-flash\" allowscriptaccess=\"always\" allowfullscreen=\"true\" width=\"".$videoWidth."\" height=\"".$videoHeight. "\" wmode=\"transparent\"></embed>";
	}

}