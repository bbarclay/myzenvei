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
 * Class to manipulate data from Metacafe
 * 	 	
 * @access	public  	 
 */
class CTableVideoMetacafe extends CVideoProvider
{
	var $xmlContent = null;
	var $url 		= '';
	var $videoId	= '';
	
	/**
	 * Return feedUrl of the video
	 */
	function getFeedUrl()
	{
		$videoId = explode("/", $this->videoId);
		return 'http://www.metacafe.com/api/item/' . $videoId[0].'/';
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
		$xmlContent = cRemoteGetContent($this->getFeedUrl());
		
		if (empty($this->videoId))
		{
			$this->setError	= JText::_('CC INVALID VIDEO ID');
			return false;
		}
		if($xmlContent == FALSE)
		{
			$this->setError	= JText::_('CC ERROR FETCHING VIDEO');
			return false;
		}
		
		$options['rssUrl'] = $this->getFeedUrl();
		$rssDoc	= JFactory::getXMLParser('RSS',$options);

		foreach ($rssDoc->get_items() as $item):
			$enclosures	= $item->get_enclosures();
			$this->duration	= $enclosures[0]->get_duration();
			$this->title = $item->get_title();
			$this->description = $item->get_description();
		endforeach;

		return true;
	}	
	
	/**
	 * Extract MetaCafe video id from the video url submitted by the user
	 * 	 	
	 * @access	public
	 * @param	video url
	 * @return videoid	 
	 */
	function getId()
	{			
		$code	= '';
		
		//check for embed code format
		//$pos_e = strpos($this->url, "youtube.com/v/");
		$pos_u = strpos($this->url, "watch/");

		////TODO: User regular expression instead
		if ($pos_u === false) {
			return null;
		} else if ($pos_u) {
			$pos_u_start = $pos_u + 6;

			$code = substr($this->url, $pos_u_start);
			$code = strip_tags($code );
			$code_tmp = explode("/", $code);
			if(!empty($code_tmp["1"])){
				$code = $code_tmp["0"].'/'.$code_tmp["1"];
			}else{
				$code = $code_tmp["0"].'/';
			}
			//$code = preg_replace("/[^a-zA-Z0-9s_-]/", "", $code);
		}
						
		return $code;
	}
	
	
	/**
	 * Return the video provider's name
	 * 
	 */
	function getType()
	{
		return 'metacafe';
	}
	
	function getTitle()
	{	
		return $this->title;
	}
	
	/**
	 * Get video's description from videoid
	 * 
	 * @access 	public
	 * @param 	videoid
	 * @return desctiption
	 */
	function getDescription()
	{
		$description	= '';
		
		$pattern =  "'<p>(.*?)<br>'s";
		preg_match_all($pattern, $this->description, $matches);
		if($matches)
		{
			$description = trim($matches[1][0]);
		}
		return $description;
	}
	
	/**
	 * Get video duration 
	 * 
	 * @return $duration seconds
	 */
	function getDuration()
	{
		$duration 	= '';
		
		$pattern	=  "'</a> \((.*?)\)<br/>'s";
		preg_match_all($pattern, $this->description, $matches);
		if($matches)
		{
			$duration = trim($matches[1][0]);
			$duration = explode(":",$duration);
			$duration = ($duration[0]*60) + ($duration[1]);
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
		$thumbnail	= '';
		
		$pattern =  "'<img src=\"(.*?)\"'s";
		preg_match_all($pattern, $this->description, $matches);
		if($matches)
		{
			$thumbnail = trim($matches[1][0]);
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
		
		return '<embed src="http://www.metacafe.com/fplayer/'.$videoId.'.swf" width="'.$videoWidth.'" height="'.$videoHeight.'" wmode="transparent" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" allowFullScreen="true" wmode="transparent"> </embed>';
	}	
}
