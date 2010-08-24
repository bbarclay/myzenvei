<?php
/**
 * @version		$Id: flowplayer.php 110 17-11-2009 Daniel Gutierrez $
 * @package		Joomla
 * @subpackage	Content 
 * @license     GNU/GPL
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

// Import Joomla! Plugin library file
jimport('joomla.plugin.plugin');

//Url FlowPlayerPlugin
$url_fpp = 	JURI::base().'plugins/content/';
define( '_URL_FPP_', $url_fpp . 'flowplayer/' );

//Load Language
JPlugin::loadLanguage( 'plg_content_flowplayer' );

//Call swfobject.js
$script = JHTML::script( 'plugins/content/flowplayer/flowplayer-3.1.4.min.js', false, false);
$GLOBALS['mainframe']->addCustomHeadTag($script);

/**
 * Class plgContentFlowplayer 
 * @author Daniel Gutierrez
 */
class plgContentFlowplayer extends JPlugin{
	
	/**
	 * Constructor
	 * For php4 compatability
	 * @since 1.1
	 */
	function plgContentFlowplayer( &$subject, $params )
	{
		parent::__construct( $subject, $params );
	}
	
	/**
	 * Replace the bot and show players in article 
	 * @param array $row A reference to the article that is being rendered by the view
	 * @param array $params A reference to an associative array of relevant parameters
	 * @param integer $page An integer that determines the "page" of the content that is to be generated.
	 */
	public function onPrepareContent( &$row, &$params, $page=0 )
	{
		// simple performance check to determine whether bot should process further	
		if ( JString::strpos( $row->text, '{flowplayer' ) === false ) 
		{
			return true;
		}
		
		// define the regular expression for the bot
		$regex = '/{flowplayer}\s*(.*?){\/flowplayer}/i';
		
		// check whether plugin has been unpublished
		if ( !$this->params->get( 'enabled', 1 ) ) 
		{
		        $row->text = preg_replace( $regex, '', $row->text );
		        return true;
		}
		
		// find all instances of plugin and put in $url_video
		preg_match_all( $regex, $row->text, $matches);
		
		// Number of plugins
		$count = count( $matches[0] );
		
		// Plugin only processes if there are any instances of the plugin in the text
		if ( $count )
		{
			$row->text = preg_replace_callback( $regex, array($this, 'get_video'), $row->text );					
		}
	}
	
	/**
	 * Get the url of video and build the link
	 * @param array $matches A array with regex content.
	 */
	protected function get_video(&$matches)
	{
		$url_video = $matches[1];
		$video = JHTML::link($url_video, '', 'class="flowplayer"');
		$video = '<div align="center">'.$video.'</div>';
		return $video;
	}
	
	/**
	 * Build the script and css for player displayed in bottom 
	 * @param array $row A reference to the article that is being rendered by the view
	 * @param array $params A reference to an associative array of relevant parameters
	 * @param integer $page An integer that determines the "page" of the content that is to be generated.
	 */
	public function onAfterDisplayContent( &$row, &$params, $page=0 )
	{
		//Get Plugin info
	 	$plugin =& JPluginHelper::getPlugin('content', 'flowplayer');
		//Access the parameters	
		$fp_params = new JParameter( $plugin->params );
		
		//Flow player plugin _ params
		$fpp_width		=	$fp_params->get( 'width' );
		$fpp_height		=	$fp_params->get( 'height' );	
		$fpp_autoPlay	=	$fp_params->get( 'autoPlay' );
		$fpp_scaling 	=	$fp_params->get( 'scaling' );
		$fpp_bufferL	=	$fp_params->get( 'bufferL' );
		$fpp_key		=	$fp_params->get( 'key' );
		$fpp_controls 	=	$fp_params->get( 'controls' );
		$fpp_canvas		= 	$fp_params->get( 'canvas' );
		$fpp_screen		= 	$fp_params->get( 'screen' );
		$fpp_play		=	$fp_params->get( 'play' );
		
		//Fix boolean params
		($fpp_autoPlay == 0)? $fpp_autoPlay = 'false' : $fpp_autoPlay = 'true';
				
		//Add for Commercial version
		if($fpp_key == '' )
		{
			$fpp_key = '';
			$swf = '';			
		}
		else
		{
			$fpp_key = 'key: "'.$fpp_key.'",';
			$swf = 'commercial';
		}
		
		//Build css and javascript
		$settings = '
		<style type="text/css">
		a.flowplayer{
			width: '.$fpp_width.'px;
			height: '.$fpp_height.'px;
			display: block;		
		}
		</style>
		<script type="text/javascript">
		flowplayer("a.flowplayer", "' . _URL_FPP_ . 'flowplayer'.$swf.'-3.1.5.swf", {
			'.$fpp_key.'
			clip: {
					autoPlay: '.$fpp_autoPlay.',
					scaling: "'. $fpp_scaling . '", 
					bufferLength: ' . $fpp_bufferL . '
				} ,		 
			plugins: {		
				controls : {
						url : "' . _URL_FPP_ . 'flowplayer.controls-3.1.5.swf",
						' . $fpp_controls . '
					}  		
				} , 
			canvas: {
					' . $fpp_canvas	. '
				} ,
			screen: {
					' . $fpp_screen	 . '
				} ,	
			play: {
					' . $fpp_play . '
				} 
		});
		</script>';
		
		return $settings;	
	}
}