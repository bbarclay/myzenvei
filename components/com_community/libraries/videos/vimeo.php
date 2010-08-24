<?php
/**
 * @category	Library
 * @package		JomSocial
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 */
defined('_JEXEC') or die('Restricted access');

require_once (COMMUNITY_COM_PATH.DS.'models'.DS.'videos.php');

/**
 * Class to manipulate data from vimeo video
 * 	 	
 * @access	public  	 
 */
class CTableVideoVimeo extends CVideoProvider
{
	var $xmlContent = null;
	var $url 		= '';
	var $videoId	= '';
	/**
	 * Return feedUrl of the video
	 */
	function getFeedUrl()
	{
		return 'http://www.vimeo.com/moogaloop/load/clip:' .$this->videoId.'/embed';
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
		$xmlContent = cRemoteGetContent($this->getFeedUrl());
		
		if (empty($this->videoId))
		{
			$this->setError	= JText::_('CC INVALID VIDEO ID');
			return false;
		}
		if($xmlContent == false)
		{
			$this->setError	= JText::_('CC ERROR FETCHING VIDEO');
			return false;
		}

		$parser = JFactory::getXMLParser('Simple');
		$parser->loadString($xmlContent);
		$videoElement = $parser->document;
		
		//get Video Title
		$element = $videoElement->getElementByPath('video/caption');
		$this->title = $element->data();
		
		//Get Video duration
		$element = $videoElement->getElementByPath('video/duration');
		$this->duration = $element->data();
		
		//Get Video duration
		$element = $videoElement->getElementByPath('video/thumbnail');
		$this->thumbnail = $element->data();
		
		return true;
	}

	
	/**
	 * Extract Vimeo video id from the video url submitted by the user
	 * 	 	
	 * @access	public
	 * @param	video url
	 * @returns videoid	 
	 */
	function getId()
	{		
		$videoId	= '';
		
		if (($this->url == 'http://www.vimeo.com') || ($this->url == 'http://vimeo.com'))
		{
			$videoId = "";
		}
		else
		{
			$videoId =	JString::str_ireplace( "http://www.vimeo.com/", "", $this->url );
			$videoId =	JString::str_ireplace( "http://vimeo.com/", "", $videoId );			
		}
		
		return $videoId;
	}
	
	/**
	 * Return the video provider's name
	 * 
	 */
	function getType()
	{
		return 'vimeo';
	}
	
	function getTitle()
	{
		return $this->title;
	}
	
	/**
	 * 
	 * @param $videoId
	 * @return unknown_type
	 */
	function getDescription()
	{
		$description	= '';
		
		CFactory::load('helpers', 'remote');
 		$str = cRemoteGetContent($this->url);
        
        //TODO: Replace the code below with a regular expression
        //Return the numeric position of the first occurrence of the needle(<div id = "description">) in the string
        
 		if ( strpos($str, "<div id=\"description\">") != 0)
 		{
	 		$pos 			= strpos($str, "<div id=\"description\">")+22;
			$post			= strpos($str, "</div>", $pos)-$pos;
	        $itemcomment	= substr($str, $pos, $post);
	        $description	= trim($itemcomment);

	        //strip HTML Tag
			$description 	= strip_tags($description);
 		}
 		else
 		{
 			$description 	= JText::_('CC NOT AVAILABLE');
 		}

        return $description;
	}
	
	function getDuration()
	{
		return $this->duration;
	}
	
	/**
	 * 
	 * @param $videoId
	 * @return unknown_type
	 */
	function getThumbnail()
	{ 
		return $this->thumbnail;
	}
	
	/**
	 * 
	 * 
	 * @return $embedCode specific embeded code to play the video
	 */
	function getViewHTML($videoId, $videoWidth, $videoHeight)
	{
		if (!$videoId)
		{
			$videoId	= $this->videoId;
		}
		$embedCode = "<object width=\"".$videoWidth."\" height=\"".$videoHeight."\"><param name=\"allowfullscreen\" value=\"true\" /><param name=\"allowscriptaccess\" value=\"always\" /><param name=\"movie\" value=\"http://vimeo.com/moogaloop.swf?clip_id=".$videoId."&amp;server=vimeo.com&amp;show_title=1&amp;show_byline=0&amp;show_portrait=0&amp;color=ff0179&amp;fullscreen=1\" /><embed src=\"http://vimeo.com/moogaloop.swf?clip_id=" .$videoId. "&amp;server=vimeo.com&amp;show_title=1&amp;show_byline=0&amp;show_portrait=0&amp;color=ff0179&amp;fullscreen=1\" type=\"application/x-shockwave-flash\" allowfullscreen=\"true\" allowscriptaccess=\"always\" width=\"".$videoWidth."\" height=\"".$videoHeight."\" wmode=\"transparent\" ></embed></object>";
		
		return $embedCode;
	}
		
}
