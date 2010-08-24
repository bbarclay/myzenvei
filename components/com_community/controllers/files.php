<?php
/**
 * @package	JomSocial
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.azrul.com Copyrighted Commercial Software
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

class CommunityFilesController extends CommunityBaseController
{
	function display()
	{
		$document 	=& JFactory::getDocument();
		$viewType	= $document->getType();	
 		$viewName	= JRequest::getCmd( 'view', $this->getName() );
 		$view		=& $this->getView( $viewName , $viewType );
 		$data		= new stdClass();
 		$my			=& JFactory::getUser();
 		$user		=& CFactory::getActiveProfile();
 		$model		=& $this->getModel('files');
 		$data->files	= $model->getFiles( $user->id );
 		echo $view->get( __FUNCTION__ , $data );
	}
// 	
// 	function download()
// 	{
// 		//@todo: permission checking if user is allowed to download this file?
// 		
// 		$document 	=& JFactory::getDocument();
// 		$viewType	= $document->getType();	
//  		$viewName	= JRequest::getCmd( 'view', $this->getName() );
//  		$view		=& $this->getView( $viewName , $viewType );
//  		
// 		$model 		=& $this->getModel('files');
// 		$data		= new stdClass();
// 		
// 		$id			= JRequest::getVar('fileid' , '' , 'GET');
// 		
// 		$data->file	= $model->get( $id );
// 		
// 		echo $view->get( __FUNCTION__ , $data );	
// 	}
// 
// 	function log($content)
// 	{
//  		$filename = JPATH_BASE . '/community_debug.txt';
// 		$handle	= fopen($filename, 'w');
// 		ob_start();
// 		var_dump($content);
// 		$contents	= ob_get_contents();
// 		ob_end_clean();
// 	
// 		fwrite($handle, $contents);
// 		fclose($handle);
// 
// 	}
	
// 	function multiupload()
// 	{
// 		$my			=& JFactory::getUser();
// 		$document 	=& JFactory::getDocument();
// 		$viewType	= $document->getType();	
//  		$viewName	= JRequest::getCmd( 'view', $this->getName() );
//  		$view		=& $this->getView( $viewName , $viewType );
//  		$data		= new stdClass();
// 
//  		
//  		if( JRequest::getMethod() == 'POST' )
//  		{
//  			$storage	= JPATH_BASE . DS . 'images' . DS . 'files' . DS . $my->id;
// 			require_once ( JPATH_COMPONENT . DS . 'libraries' . DS . 'files.php' );
// 
// 			$file	= new CFilesLibrary( $storage , true );
// 
//  			$filedata	= JRequest::getVar('Filedata' , '' , 'FILES' , 'array');
//  			//$this->log(pathinfo($filedata['tmp_name']));
//  			$file		= $file->upload( $filedata );
//  			
//  			$data				= new stdClass();
// 
//  			$data->creator		= $my->id;
//  			$data->name			= $filedata['name'];
// 			$data->caption		= $filedata['name'];
//  			$data->source		= 'images' . DS . 'files' . DS . $my->id . DS . $file->source;
//  			$data->thumbnail	= $file->thumbnail;
//  			$data->published	= '1';
//  			$data->permissions	= 'all';
// 			$data->type			= $filedata['type'];
// 			 			
//  			$model	=& $this->getModel('files');
//  			$data	= $model->create( $data );
// 		}
// 		else
// 		{
//  			echo $view->get( __FUNCTION__ , $data );
//  		}
// 	}
// 	
// 	function upload()
// 	{
// 		$document 	=& JFactory::getDocument();
// 		$viewType	= $document->getType();	
//  		$viewName	= JRequest::getCmd( 'view', $this->getName() );
//  		$view		=& $this->getView( $viewName , $viewType );
//  		$data		= new stdClass();
//  		$user		=& CFactory::getActiveProfile();
//  		$my			=& JFactory::getUser();
//  		
//  		if(JRequest::getMethod() == 'POST')
//  		{
//  			$storage	= JPATH_BASE . DS . 'images' . DS . 'files' . DS . $my->id;
// 			require_once ( JPATH_COMPONENT . DS . 'libraries' . DS . 'files.php' );
// 
// 			$file	= new CFilesLibrary( $storage , true );
// 
//  			$filedata	= JRequest::getVar('filedata' , '' , 'FILES' , 'array');
//  			$status		= true;
//  			
//  			if(!($file = $file->upload( $filedata )))
//  			{
//  				echo 'File not supported.';
// 			}
// 			else
// 			{
// 	 			$data				= new stdClass();
// 	
// 	 			$data->creator		= $my->id;
// 	 			$data->name			= $filedata['name'];
// 				$data->caption		= $filedata['name'];
// 	 			$data->source		= 'images' . DS . 'files' . DS . $my->id . DS . $file->source;
// 	 			$data->thumbnail	= $file->thumbnail;
// 	 			$data->published	= '1';
// 	 			$data->permissions	= 'all';
// 				$data->type			= $filedata['type'];
// 				 			
// 	 			$model	=& $this->getModel('files');
// 	 			$data	= $model->create( $data );
// 	
// 				$mainframe =& JFactory::getApplication();
// 				
// 				//@todo: allow uploads again?
// 				$mainframe->redirect('index.php?option=com_community&view=files&id=' . $user->id , JText::_('File Uploaded'));
// 				exit;
// 			}
// 		}
// 		else
// 		{
// 			echo $view->get( __FUNCTION__ , $data );
// 		} 		
// 	}
}