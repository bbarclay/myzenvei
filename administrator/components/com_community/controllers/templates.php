<?php
/**
 * @package		JomSocial
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.azrul.com Copyrighted Commercial Software
 */

// Disallow direct access to this file
defined('_JEXEC') or die('Restricted access');

jimport( 'joomla.application.component.controller' );

/**
 * Jom Social Component Controller
 */
class CommunityControllerTemplates extends CommunityController
{
	function __construct()
	{
		parent::__construct();
	}
	
	function ajaxChangeTemplate( $templateName )
	{
		$response	= new JAXResponse();
		
		if( $templateName == 'none' )
		{
			// Previously user might already selected a template, hide the files
			$response->addScriptCall( 'azcommunity.resetTemplateFiles();' );
			
			// Close all files if it is already editing
			$response->addScriptCall( 'azcommunity.resetTemplateForm();' );
		}
		else
		{
			$html	= '<div id="template-files">';
			$html	.= '<h3>' . JText::_('CC SELECT FILE') . '</h3>';
			

			$templatePath	= COMMUNITY_BASE_PATH . DS . 'templates' . DS . JString::strtolower( $templateName );
			
			$files			= array();
	
			if( $handle = @opendir($templatePath) )
			{
				while( false !== ( $file = readdir( $handle ) ) )
				{
					$filePath	= $templatePath . DS . $file;
					
					// Do not get '.' or '..' or '.svn' since we only want folders.
					if( $file != '.' && $file != '..' && $file != '.svn' && !(JString::stristr( $file , '.js')) && !is_dir($filePath) )
					{
						$files[]	= $file;
					}
				}
			}

			$html	.= '<select name="file" onchange="azcommunity.editTemplate(\'' . $templateName . '\',this.value);">';
			$html	.= '<option value="none" selected="true">' . JText::_('CC SELECT A FILE') . '</option>';
			for( $i = 0; $i < count( $files ); $i++ )
			{
				$html .= '<option value="' . $files[$i] . '">' . $files[$i] . '</option>';
			}
			$html	.= '</select>';
			
			$html	.= '</div>';
			$response->addAssign( 'templates-files-container' , 'innerHTML' , $html );
		}

		return $response->sendResponse();
	}
	
	/**
	 * Ajax method to load a template file
	 *
	 * @param	$templateName	The template name
	 * @param	$fileName	The file name
	 **/	 
	function ajaxLoadTemplateFile( $templateName , $fileName )
	{
		$response	= new JAXResponse();

		if( $fileName == 'none')
		{
			$response->addScriptCall( 'azcommunity.resetTemplateForm();' );
		}
		else
		{
			$filePath	= COMMUNITY_BASE_PATH . DS . 'templates' . DS . JString::strtolower( $templateName ) . DS . JString::strtolower( $fileName );
			
			jimport('joomla.filesystem.file');
			
			$contents	= JFile::read( $filePath );
	
			$response->addAssign( 'data' , 'value' , $contents );
			$response->addAssign( 'fileName' , 'value' , $fileName );
			$response->addAssign( 'templateName' , 'value' , $templateName );
			$response->addAssign( 'filePath' , 'innerHTML' , $filePath );
		}

		return $response->sendResponse();
	}
	
	function ajaxSaveTemplateFile( $templateName , $fileName , $fileData )
	{
		$response	= new JAXResponse();
		
		$filePath	= COMMUNITY_BASE_PATH . DS . 'templates' . DS . JString::strtolower( $templateName ) . DS . JString::strtolower( $fileName );

		jimport( 'joomla.filesystem.file' );
		
		if( JFile::write( $filePath , $fileData ) )
		{
			$response->addScriptCall('jQuery("#status").html("' . JText::sprintf('%1$s saved successfully.' , $fileName ) . '");');
			$response->addScriptCall('jQuery("#status").attr("class","info");');
		}
		else
		{
			$response->addScriptCall( 'alert' , JText::_('CC ERROR WHILE SAVING FILE PLEASE CHECK PERMISSIONS OF FILE') );
		}

		return $response->sendResponse();
	}
}