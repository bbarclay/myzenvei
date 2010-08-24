<?php
/**
 * @package		JomSocial
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.azrul.com Copyrighted Commercial Software
 */

// Disallow direct access to this file
defined('_JEXEC') or die('Restricted access');

// @todo: Do some check if user is really allowed to access this section of the back end.
// Just in case we need to impose ACL on the component

// During ajax calls, the following constant might not be called
if( !defined('JPATH_COMPONENT') )
{
	define( 'JPATH_COMPONENT' , dirname( __FILE__ ) );
}

// Load necessary language file since we dont store it in the language folder
$lang =& JFactory::getLanguage();
$lang->load( 'com_community', JPATH_ROOT . DS . 'administrator' );

//check php version
$installedPhpVersion	= floatval(phpversion());
$supportedPhpVersion	= 5;

$install 				= JRequest::getVar('install', '', 'REQUEST');
$view 	 				= JRequest::getVar('view', '', 'GET');
$task	 				= JRequest::getVar('task' , '' , 'REQUEST');

if($task == 'reinstall')
{
	jimport( 'joomla.filesystem.file' );
	$destination = JPATH_ROOT . DS . 'administrator' . DS . 'components' . DS . 'com_community' . DS;
	$buffer = "installing";	
	JFile::write($destination.'installer.dummy.ini', $buffer);
}

//install
if(((file_exists(JPATH_ROOT . DS . 'administrator' . DS . 'components' . DS . 'com_community' . DS . 'installer.dummy.ini') || $install) && $view!='maintenance' && $task != 'azrul_ajax') || ($installedPhpVersion < $supportedPhpVersion))
{
	require_once(JPATH_ROOT . DS . 'administrator' . DS . 'components' . DS . 'com_community' . DS . 'installer.helper.php');
	
	$step 		= JRequest::getVar('step', '', 'post');
	$helper 	= new communityInstallerHelper;
	$display 	= new communityInstallerDisplay();	
	
	if($installedPhpVersion < $supportedPhpVersion)
	{
		
		$html 		= communityInstallerHelper::getErrorMessage(101, $installedPhpVersion);
		$status		= false;
		$nextstep 	= 0;
		$title 		= JText::_('CC JOMSOCIAL INSTALLER');
		$install 	= 1;
	}
	else
	{
		if(!empty($step))
		{
			$progress 	= $helper->install($step);
			$html 		= $progress->message;
			$status		= $progress->status;
			$nextstep 	= $progress->step;
			$title 		= $progress->title;
			$install 	= $progress->install;
		}
		else
		{
			$nextstep = 1;
			$verifier = new communityInstallerVerifier();
			$imageTest = $verifier->testImage();
			
			ob_start();
			
			?>
			<style type="text/css">
			.button1-left {
				background: transparent url(<?php echo JURI::root(); ?>administrator/templates/khepri/images/j_button1_left.png) no-repeat scroll 0 0;
				float: left;
				margin-left: 5px;
				cursor: pointer;
			}
			.button1-left .next {
				background: transparent url(<?php echo JURI::root(); ?>administrator/templates/khepri/images/j_button1_next.png) no-repeat scroll 100% 0;
				float: left;
				cursor: pointer;
			}
			.button-next {
				border: 0;
				background: none;
				font-size: 11px;
				height: 26px;
				line-height: 24px;
				padding-right: 30px;
				cursor: pointer;
			}
			#toolbar-box,
			#submenu-box,
			#header-box {
				display: none;
			}
			</style>		
	
			<script type="text/javascript">
			var dom = document.getElementById('stepLast');
			dom.removeAttribute('class');
			dom.setAttribute('class', 'steps');	
			dom = document.getElementById('stepFirst');
			dom.setAttribute('class', 'steps on');		
			</script>
						<table width="100%" border="0">
							<tr>
								<td>				
									<div style="font-weight:700;">
										<h2>Another great component brought to you by Azrul.com</h2>
									</div>
									<p>
										If you require professional support just head on to the forums at 
										<a href="http://www.jomsocial.com/forum/" target="_blank">
										http://www.jomsocial.com/forum
										</a>
										For developers, you can browse through the documentations at 
										<a href="http://www.jomsocial.com/docs.html" target="_blank">http://www.jomsocial.com/docs.html</a>
									</p>
									<p>
										If you found any bugs, just drop us an email at bugs@azrul.com
									</p>					
								</td>
							</tr>
							<tr>
								<td>				
									<div style="font-weight:700; margin-bottom:2px;">
										Testing Image.
									</div>
									<div>
										<?php echo $imageTest; ?>
									</div>					
								</td>
							</tr>
						</table>
						<style type="text/css">
						#timer {
							display: none;
						}
						</style>
		
	
			<?php
			$html = ob_get_contents();			
			@ob_end_clean();
			
			$status 	= true;			
			$title 		= 'JomSocial Installer';
			$install 	= 1;			
		}
	}
		
	$display->cInstallDraw($html, $nextstep, $title, $status, $install);
	
	return;	
}

if(file_exists(JPATH_ROOT . DS . 'administrator' . DS . 'components' . DS . 'com_jsupdater' . DS . 'jsupdater.dummy.ini'))
{
	$mainframe	=& JFactory::getApplication();
	$mainframe->redirect( 'index.php?option=com_jsupdater' );
}

// Load JomSocial core file
require_once( JPATH_ROOT . DS . 'components' . DS . 'com_community' . DS . 'libraries' . DS . 'core.php' );

// Load any helpers
require_once( JPATH_COMPONENT . DS . 'helpers' . DS . 'community.php' );

// Load any defined properties
require_once( JPATH_COMPONENT . DS . 'defines.php' );

// Require the base controller
require_once( JPATH_COMPONENT . DS . 'controllers' . DS . 'controller.php' );

// Set the tables path
JTable::addIncludePath( JPATH_COMPONENT . DS . 'tables' );

// Get the task
$task	= JRequest::getCmd( 'task' , 'display' );

// Load the required libraries
if( !class_exists( 'AzrulJXCachedTemplate' ) )
{
	require_once( JPATH_PLUGINS . DS . 'system' . DS . 'pc_includes' . DS . 'template.php' );
}

// Load the required libraries
if( !defined( 'JAX_SITE_ROOT' ) )
{
	require_once( JPATH_PLUGINS . DS . 'system' . DS . 'pc_includes' . DS . 'ajax.php' );
}

// Let's test if the task is azrul_ajax , we skip the controller part at all.
if( isset( $task ) && ( $task == 'azrul_ajax' ) )
{
	require_once( JPATH_COMPONENT . DS . 'ajax.community.php' );
}
else
{

	// Load AJAX library for the back end.
	$jax	= new JAX( rtrim( JURI::root() , '/') . '/plugins/system/pc_includes' );
	$jax->setReqURI( rtrim( JURI::root() , '/' ). '/administrator/index.php' );
	
	// Override previously declared jax_live_site stuffs
	if( !$jax->process() )
	{
		echo $jax->getScript();
	}

	// We treat the view as the controller. Load other controller if there is any.
	$controller	= JRequest::getWord( 'view' , 'community' );

	if( !empty( $controller ) )
	{
		$controller	= JString::strtolower( $controller );
		$path		= COMMUNITY_CONTROLLERS . DS . $controller . '.php';
	
		// Test if the controller really exists
		if( file_exists( $path ) )
		{
			require_once( $path );
		}
		else
		{
			JError::raiseError( 500 , JText::_('CC INVALID CONTROLLER FILE DOES NOT EXISTS IN THIS CONTEXT') );
		}
	}
	
	$class	= 'CommunityController' . JString::ucfirst( $controller );
	
	// Test if the object really exists in the current context
	if( class_exists( $class ) )
	{
		$controller	= new $class();
	}
	else
	{
		// Throw some errors if the system is unable to locate the object's existance
		JError::raiseError( 500 , 'Invalid Controller Object. Class definition does not exists in this context.' );
	}
	
	// Task's are methods of the controller. Perform the Request task
	$controller->execute( $task );
	
	// Redirect if set by the controller
	$controller->redirect();
}


