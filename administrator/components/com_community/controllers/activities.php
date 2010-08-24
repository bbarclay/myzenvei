<?php
/**
 * @package		JomSocial
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.azrul.com Copyrighted Commercial Software
 */

// Disallow direct access to this file
defined('_JEXEC') or die('Restricted access');

jimport( 'joomla.application.component.controller' );

require_once( JPATH_ROOT . DS . 'components' . DS . 'com_community' . DS . 'libraries' . DS . 'core.php' );

/**
 * Jom Social Component Controller
 */
class CommunityControllerActivities extends CommunityController
{
	function __construct()
	{
		parent::__construct();
	}
	
	function display()
	{
		$viewName	= JRequest::getCmd( 'view' , 'community' );

		// Set the default layout and view name
		$layout		= JRequest::getCmd( 'layout' , 'default' );

		// Get the document object
		$document	=& JFactory::getDocument();

		// Get the view type
		$viewType	= $document->getType();
		
		// Get the view
		$view		=& $this->getView( $viewName , $viewType );

		$model		=& $this->getModel( $viewName );
		
		if( $model )
		{
			$view->setModel( $model , $viewName );
			
			$users	=& $this->getModel( 'users' );
			$view->setModel( $users  , false );
		}

		// Set the layout
		$view->setLayout( $layout );

		// Display the view
		$view->display();
		
		// Display Toolbar. View must have setToolBar method
		if( method_exists( $view , 'setToolBar') )
		{
			$view->setToolBar();
		}
	}
	
	function delete()
	{
		$mainframe	=& JFactory::getApplication();
		$model		=& $this->getModel( 'activities' );
		$id			= JRequest::getVar( 'cid' , '' , 'post' );
		$errors		= false;
		$message	= JText::_('CC ACTIVITIES DELETED');
		if( empty($id) )
		{
			JError::raiseError( '500' , JText::_('CC INVALID ID') );
		}
		
		for( $i = 0; $i < count($id); $i++ )
		{
			if( !$model->delete( $id[ $i ] ) )
			{
				$errors	= true;
			}
		}

		if( $errors )
		{
			$message	= JText::_('CC THERE WAS AN ERROR WHILE DELETING THE ACTIVITY');
		}
		$mainframe->redirect( 'index.php?option=com_community&view=activities' , $message );
	}
	
	function purge()
	{
		$mainframe	=& JFactory::getApplication();
		$model		=& $this->getModel( 'activities' );
		$message	= JText::_('CC ACTIVITIES PURGED');

		if( !$model->purge() )
		{
			$message	= JText::_('CC THERE WAS AN ERROR WHILE DELETING THE ACTIVITY');
		}
		$mainframe->redirect( 'index.php?option=com_community&view=activities' , $message );
	}
}