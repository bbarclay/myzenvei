<?php
/**
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport( 'joomla.application.component.view');
jimport( 'joomla.utilities.arrayhelper');

class CommunityViewApps extends CommunityView
{
	/**
	 * Show the application edit page
	 */	 	
	function edit()
	{
		if(!$this->accessAllowed('registered')){
			return;
		}
		// Load window library
		CFactory::load( 'libraries' , 'window' );
		
		// Load necessary window css / javascript headers.
		CWindow::load();
		
		$my 	    = CFactory::getUser();
		$appsModel	=& CFactory::getModel('apps');
		
		$this->addPathway( JText::_('CC MY APPS') );

		$coreapps		= $appsModel->getCoreApps();
		$userapps 		= $appsModel->getUserApps($my->id);

		for( $i = 0; $i < count($coreapps); $i++)
		{

			$appInfo	= $appsModel->getAppInfo( $coreapps[$i]->apps );

			// @rule: Try to get proper app id from #__community_users table first.
			$id		= $appsModel->getUserApplicationId( $coreapps[ $i ]->apps , $my->id );

			// @rule: If there aren't any records, we need to get it from #__plugins table.
			if( empty( $id ) )
			{
				$id			= $appsModel->getPluginId( $coreapps[$i]->apps , null , true );
			}
			
			$coreapps[$i]->id			= $id;
			$coreapps[$i]->title		= $appInfo->title;
			$coreapps[$i]->description	= $appInfo->description;
			//$coreapps[$i]->coreapp		= $params->get( 'coreapp' );
			
			//Get application favicon
			if( JFile::exists( JPATH_ROOT . DS . 'plugins' . DS . 'community' . DS . $coreapps[$i]->apps . DS . 'favicon_64.png' ) )
			{
				$coreapps[$i]->appFavicon	= rtrim(JURI::root(),'/') . '/plugins/community/' . $coreapps[$i]->apps . '/favicon_64.png';
			}
			else
			{
				$coreapps[$i]->appFavicon	= rtrim(JURI::root(),'/') . '/components/com_community/assets/app_favicon.png';
			}
		}
		
		//get available apps for comparison
		$appsModel		=& CFactory::getModel('apps');
		$apps			= $appsModel->getAvailableApps(false);		
		$appsname		= array();
		$avalableApps 	= array();
		if(!empty($apps))
		{
			foreach($apps as $data)
			{
				array_push($avalableApps, $data->name);
			}
		}
				
		// Todo: getUserApps should return all this value already
		for( $i = 0; $i < count($userapps); $i++)
		{
			$appInfo	= $appsModel->getAppInfo( $userapps[$i]->apps );
			
			$id			= $appsModel->getPluginId( $userapps[$i]->apps , null , true );
			
			//echo $id;
			$params		= new JParameter( $appsModel->getPluginParams( $id , null ) );
			$userapps[$i]->title		= isset( $appInfo->title ) ? $appInfo->title : '';
			$userapps[$i]->description	= isset( $appInfo->description ) ? $appInfo->description : '';
			$userapps[$i]->coreapp		= $params->get( 'coreapp' );
			
			//Get application favicon
			if( JFile::exists( JPATH_ROOT . DS . 'plugins' . DS . 'community' . DS . $userapps[$i]->apps . DS . 'favicon_64.png' ) )
			{
				$userapps[$i]->appFavicon	= rtrim(JURI::root(),'/') . '/plugins/community/' . $userapps[$i]->apps . '/favicon_64.png';
			}
			else
			{
				$userapps[$i]->appFavicon	= rtrim(JURI::root(),'/') . '/components/com_community/assets/app_favicon.png';
			}
			
			$appsname[$i] = $userapps[$i]->apps;
		}
		
		//check if apps exist, if not delete it.
		$obsoleteApps = array();
		$obsoleteApps = array_diff($appsname, $avalableApps);
		if(!empty($obsoleteApps))
		{
			foreach($obsoleteApps as $key=>$obsoleteApp)
			{				
				$appRecords = $appsModel->checkObsoleteApp($obsoleteApp);			
				
				if(empty($appRecords))
				{
					if($appRecords==NULL)
					{
						$appsModel->removeObsoleteApp($obsoleteApp);
					}
					
					unset($userapps[$key]);
				}
			}		
			$userapps = array_values($userapps);
		}
			
		$mainframe =& JFactory::getApplication();	
		
		$pathway 	=& $mainframe->getPathway();

		$document =& JFactory::getDocument();
		$document->setTitle(JText::_('CC MY APPS'));
		$appModel =& CFactory::getModel('apps');
		$config		=& CFactory::getConfig();
		
		$usePacked	= ( $config->getBool('usepackedjavascript') ) ? '.pack' : '';
		$js  = '<script type="text/javascript" src="'.JURI::root().'components/com_community/assets/jquery.tablednd_0_5' . $usePacked . '.js"></script>';
		echo $js;
		
		$this->showSubMenu();
		
		$tmpl	= new CTemplate();
		
		$tmpl->set('coreApplications'	, $coreapps );
		$tmpl->set('applications'		, $userapps );
		echo $tmpl->fetch( 'applications.edit' ); 
	}
	
	
	/**
	 * Browse all available apps
	 */	 	
	function browse($data)
	{
		$this->addPathway( JText::_('CC BROWSE APPS') );
		
		// Load window library
		CFactory::load( 'libraries' , 'window' );
		
		// Load necessary window css / javascript headers.
		CWindow::load();
		
		$mainframe =& JFactory::getApplication();
		$my		= CFactory::getUser();
		
		
		$pathway 	=& $mainframe->getPathway();

		$document =& JFactory::getDocument();
		$document->setTitle(JText::_('CC BROWSE APPS'));

		// Attach apps-related js
		$this->showSubMenu();
	
		// Get application's favicon
		$addedAppCount	= 0;
		foreach( $data->applications as $appData )
		{	
			if( JFile::exists( JPATH_ROOT . DS . 'plugins' . DS . 'community' . DS . $appData->name . DS . 'favicon_64.png' ) )
			{
				$appData->appFavicon	= rtrim(JURI::root(),'/') . '/plugins/community/' . $appData->name . '/favicon_64.png';
			}
			else
			{
				$appData->appFavicon	= rtrim(JURI::root(),'/') . '/components/com_community/assets/app_favicon.png';
			}
			
			// Get total added applications
			$addedAppCount	= $appData->added == 1 ? $addedAppCount+1 : $addedAppCount;
		}
		
		$tmpl	= new CTemplate();
		$tmpl->set( 'applications' , $data->applications );
		$tmpl->set( 'pagination' , $data->pagination );
		$tmpl->set( 'addedAppCount' , $addedAppCount );
		echo $tmpl->fetch( 'applications.browse' );
	}
	
	function _addSubmenu()
	{
		$this->addSubmenuItem('index.php?option=com_community&view=apps', JText::_('CC MY APPS') );
		$this->addSubmenuItem('index.php?option=com_community&view=apps&task=browse', JText::_('CC BROWSE APPS') );
	}

	function showSubmenu(){
		$this->_addSubmenu();
		parent::showSubmenu();
	}
}
