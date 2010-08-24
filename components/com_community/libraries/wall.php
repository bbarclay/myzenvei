<?php
/**
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

class CWallLibrary
{

	
	function _processWallContent($comment){
		// Convert video link to embedded video
		CFactory::load('helpers' , 'videos');
		$comment = cGetVideoLink($comment);
		
		return $comment;
	}
	
	/**
	 * Method to get the walls HTML form
	 * 
	 * @param	userId
	 * @param	uniqueId
	 * @param	appType
	 * @param	$ajaxFunction	Optional ajax function
	 **/	 	
	function getWallInputForm( $uniqueId , $ajaxAddFunction, $ajaxRemoveFunc, $viewAllLink ='')
	{
		$my = CFactory::getUser();
		
		// Hide the input form completely from visitors
		if($my->id == 0)
			return '';

		$tmpl		= new CTemplate();

		$tmpl->set( 'uniqueId'		, $uniqueId );
		$tmpl->set( 'viewAllLink'	, $viewAllLink );
		$tmpl->set( 'ajaxAddFunction'	, $ajaxAddFunction );
		$tmpl->set( 'ajaxRemoveFunc'	, $ajaxRemoveFunc);
		
		return $tmpl->fetch( 'wall.form' );	
	}

	function saveWall( $uniqueId , $message , $appType , &$creator , $isOwner )
	{
		$my = CFactory::getUser();

		// Add some required parameters, otherwise assert here
		CError::assert( $uniqueId, '' , '!empty' , __FILE__ , __LINE__ );
		CError::assert( $appType, '' , '!empty' , __FILE__ , __LINE__ );
		CError::assert( $message, '' , '!empty' , __FILE__ , __LINE__ );
		CError::assert( $my->id, '', '!empty' , __FILE__ , __LINE__ );

		// Load the models
		CFactory::load( 'models' , 'wall' );
		CFactory::load( 'helpers' , 'url' );
		$wall				=& JTable::getInstance( 'Wall' , 'CTable' );

		// Get current date
		$now				=& JFactory::getDate();
		$now				= $now->toMySQL();
		
		// Set the wall properties
		$wall->type			= $appType;
		$wall->contentid	= $uniqueId;
		$wall->post_by		= $creator->id;
		$wall->comment		= $message;
		$wall->date			= $now;
		$wall->published	= 1;
		
		// @todo: set the ip address
		$wall->ip			= $_SERVER['REMOTE_ADDR'];
		
		// Store the wall message
		$wall->store();

		// Clear unnecessary HTML tags.
		$wall->comment		= htmlspecialchars( $wall->comment , ENT_QUOTES , 'UTF-8' );

		// Convert it to array so that the walls can be processed by plugins
		$args 			= array();
		$args[0]		=& $wall;

		// Trigger the wall comments
		CWallLibrary::triggerWallComments( $args );
		
		// Apply any post processing on the content 
		$wall->comment	= CWallLibrary::_processWallContent($wall->comment);
		
		CFactory::load('libraries', 'comment');
		$comment		= new CComment();

		if( $appType == 'user')
		{
			$wall->comment .= $comment->getHTML( $wall->comment, 'wall-cmt-'.$wall->id);
		}

		$date			= cGetDate( $wall->date );
		$tmpl			= new CTemplate();

		CFactory::load('helpers' , 'user');
		$avatarHTML		= cGetUserThumb( $wall->post_by , 'avatar' );
		
		$tmpl->set( 'id' , 			$wall->id );
		$tmpl->set( 'author' ,		$creator->getDisplayName() );
		$tmpl->set( 'authorLink',	CUrl::build( 'profile' , '' , array( 'userid' => $creator->id ), true ) );
		$tmpl->set( 'avatarHTML', 	$avatarHTML );
		$tmpl->set( 'created' ,		$date->toFormat( JText::_('DATE_FORMAT_LC2') ) );
		$tmpl->set( 'content' , 	$wall->comment );
		$tmpl->set( 'avatar' ,		$creator->getThumbAvatar() );
		$tmpl->set( 'isMine' ,		$isOwner ); 
		
		$wallData	= new stdClass();
		
		$wallData->id		= $wall->id;

		$wallData->content	= $tmpl->fetch( 'wall.content' );
		CFactory::load( 'helpers' , 'string' );
		$wallData->content	= cReplaceThumbnails($wallData->content);
				
		return $wallData;
	}
	
	/**
	 * Fetches the wall content template and returns the wall data in HTML format
	 *
	 * @param	appType			The application type to load the walls from
	 * @param	uniqueId		The unique id for the specific application	 
	 * @param	isOwner			Boolean value if the current browser is owner of the specific app or profile
	 * @param	limit			The limit to display the walls
	 * @param	templateFile	The template file to use.
	 **/	 	
	function getWallContents( $appType , $uniqueId , $isOwner , $limit = 10 , $limitstart = 0, $templateFile = 'wall.content' )
	{
		CError::assert( $appType , '' , '!empty' , __FILE__ , __LINE__ );
		CError::assert( $uniqueId , '' , '!empty' , __FILE__ , __LINE__ );
		//CError::assert( $isOwner , 'bool' , 'istype' , __FILE__ , __LINE__ );
		
		
		$html	= '';

		$model	=& CFactory::getModel( 'wall' );

		$walls	= $model->getPost( $appType , $uniqueId , $limit, $limitstart);

		// @rule: for site super administrators we want to allow them to view the remove link
		CFactory::load( 'helpers' , 'owner' );
		
		if( isSuperAdministrator() )
		{
			$isOwner	= true;
		}
		
		if( $walls )
		{
			CFactory::load('libraries', 'comment');
			
			$wallComments = array();
			
			
			// Apply the comment on wall filter and clear unnecessary HTML tags.
			$comment = new CComment();
			for( $i = 0; $i < count( $walls ); $i++ )
			{
				$wall	=& $walls[$i];
				$wallComments[] = $wall->comment;
				$wall->comment  = $comment->stripCommentData($wall->comment); 
				$wall->comment	= htmlspecialchars( $wall->comment , ENT_QUOTES , 'UTF-8' );
			}
			
			// Trigger the wall applications / plugins
			CWallLibrary::triggerWallComments( $walls );
			
			CFactory::load('helpers' , 'user');
			CFactory::load('helpers' , 'videos');
		
			for( $i = 0; $i < count( $walls ); $i++ )
			{
				$wall	=& $walls[ $i ];
				$user	= CFactory::getUser( $wall->post_by );
				$date	= cGetDate( $wall->date );
				
				// Apply any post processing on the content 
				$wall->comment = CWallLibrary::_processWallContent($wall->comment);
				
				
				// If the wall post is a user wall post (in profile pages), we 
				// add wall comment feature
				if( $appType == 'user' || $appType == 'groups')
				{
					$wall->comment .= $comment->getHTML($wallComments[$i], 'wall-cmt-'.$wall->id);
				}


				$avatarHTML		= cGetUserThumb( $wall->post_by , 'avatar' );
				
				
				
		
				// Create new instance of the template
				$tmpl	= new CTemplate();
				$tmpl->set( 'id'		, $wall->id );
				$tmpl->set( 'author'	, $user->getDisplayName() );
				$tmpl->set( 'avatarHTML', $avatarHTML );
				$tmpl->set( 'authorLink', CUrl::build( 'profile' , '' , array( 'userid' => $user->id ) ) );
				$tmpl->set( 'created'	, $date->toFormat( JText::_('DATE_FORMAT_LC2') ) );
				$tmpl->set( 'content'	, $wall->comment);
				$tmpl->set( 'avatar'	, $user->getThumbAvatar() );
				
				$tmpl->set( 'isMine'	, $isOwner );

				$html	.= $tmpl->fetch( $templateFile );
			}
			
			
		}
		
		return $html;
	}
	
	function addWallComment()
	{
		
	}

	/**
	 * Formats the comment in the rows
	 * 
	 * @param Array	An array of wall objects	 	 
	 **/	 
	function triggerWallComments( &$rows )
	{
		CError::assert( $rows , 'array', 'istype', __FILE__ , __LINE__ );
		
		require_once( COMMUNITY_COM_PATH.DS.'libraries' . DS . 'apps.php' );
		$appsLib	=& CAppPlugins::getInstance();
		$appsLib->loadApplications();
		
		for( $i = 0; $i < count( $rows ); $i++ )
		{
			$args 	= array();
			$args[]	=& $rows[ $i ];

			$appsLib->triggerEvent( 'onWallDisplay' , $args );
		}
		return true;
	}
}