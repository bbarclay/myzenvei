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
 * Class to manipulate data from Live Leak
 * 	 	
 * @access	public  	 
 */
class CTableVideoLiveleak extends CVideoProvider
{
	var $xmlContent = null;
	var $url 		= '';
	var $videoId	= '';
	/**
	 * Return feedUrl of the video
	 */
	function getFeedUrl()
	{
		return 'http://www.liveleak.com/view?i=' . $this->videoId;
	}
	
	function init($url)
	{
		$this->url 		= $url;
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
		if($this->xmlContent == FALSE)
		{
			$this->setError	= JText::_('CC ERROR FETCHING VIDEO');
			return false;
		}

		return true;
	}	
	
	/**
	 * Extract LiveLeak video id from the video url submitted by the user
	 * 	 	
	 * @access	public
	 * @param	video url
	 * @return videoid	 
	 */
	function getId()
	{
		$code	= '';
		
		//check for embed code format
		$pos_u = strpos($this->url, "view?i=");

		////TODO: User regular expression instead
		if ($pos_u === false) {
			return null;
		} else if ($pos_u) {
			$pos_u_start = $pos_u + 7;

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
		return 'liveleak';
	}
	
	function getTitle()
	{	
		$title	= '';
		
		$pattern =  "/<h4 id=\"s_hd\">(.*)<\/h4>/i";
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
				
		// get description
		$pattern =  "/<div id=\"connection_contents\"><\/div><\/div>(.*?)<div id=\"vid\">?/s";
		
		preg_match_all($pattern, $this->xmlContent, $matches);

		if($matches)
		{
			
			$description	= JString::trim( strip_tags($matches[1][0],'<br /><br>') );
			$description	= JString::substr( $description, 0, 200 );
		}
		
		return $description;
	}
	
	function getDuration()
	{
		return false;
	}

	function getThumbnail()
	{
		$thumbnail	= '';
		
		// get thumbnail
		$pattern =  "'<link rel=\"videothumbnail\" href=\"(.*?)\" type=\"image/jpeg\" \/>'s";
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
	function getViewHTML( $videoId, $videoWidth, $videoHeight )
	{
		if (!$videoId)
		{
			$videoId	= $this->videoId;
		}
		return "<embed src=\"http://www.liveleak.com/e/".$videoId."\" width=\"".$videoWidth."\" height=\"".$videoHeight."\" wmode=\"transparent\" pluginspage=\"http://www.macromedia.com/go/getflashplayer\" type=\"application/x-shockwave-flash\" allowFullScreen=\"true\"> </embed>";
	}
}
