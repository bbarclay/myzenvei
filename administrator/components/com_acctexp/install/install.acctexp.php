<?php
/**
 * @version $Id: install.acctexp.php
 * @package AEC - Account Control Expiration - Membership Manager
 * @subpackage Installation
 * @copyright 2006-2008 Copyright (C) David Deutsch
 * @author David Deutsch <skore@skore.de> & Team AEC - http://www.valanx.org
 * @license GNU/GPL v.2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html or, at your option, any later version
 */

// Dont allow direct linking
( defined('_JEXEC') || defined( '_VALID_MOS' ) ) or die( 'Direct Access to this location is not allowed.' );
//error_reporting(E_ALL);

// Trying to buy us some time
@set_time_limit( 240 );

if ( !function_exists( 'aecJoomla15check' ) ) {
	function aecJoomla15check()
	{
		return defined( '_JEXEC' );
	}
}

if ( !defined( '_JEXEC' ) && !defined( 'JPATH_SITE' ) ) {
	global $mosConfig_absolute_path;

	define( 'JPATH_SITE', $mosConfig_absolute_path );
} elseif ( defined( '_JEXEC' ) ) {
	JLoader::register('JTableUser', JPATH_LIBRARIES.DS.'joomla'.DS.'database'.DS.'table'.DS.'user.php');
}

// Make sure we are compatible with php4
include_once( JPATH_SITE . '/components/com_acctexp/lib/php4/php4.php' );

// Make sure we are compatible with joomla1.0
include_once( JPATH_SITE . '/components/com_acctexp/lib/j15/j15.php' );

function com_install()
{
	$database = &JFactory::getDBO();

	$user = &JFactory::getUser();

	global $mainframe;

	$mainframe->addCustomHeadTag( '<link rel="stylesheet" type="text/css" media="all" href="' . JURI::root() . '/media/com_acctexp/css/admin.css" />' );

	// Tracking arrays
	$queri		= array();
	$errors		= array();

	// Overall Variables
	$newinstall = false;
	$tables		= $database->getTableList();

	$pathLang = JPATH_SITE . '/administrator/components/com_acctexp/lang/';
	if ( file_exists( $pathLang . $mainframe->getCfg( 'lang' ) . '.php' ) ) {
		include_once( $pathLang . $mainframe->getCfg( 'lang' ) . '.php' );
	} else {
		include_once( $pathLang . 'english.php' );
	}

	// Make sure we are compatible with php4
	include_once( JPATH_SITE . '/components/com_acctexp/lib/php4/php4.php' );

	// Make sure we are compatible with joomla1.0
	include_once( JPATH_SITE . '/components/com_acctexp/lib/j15/j15.php' );

	require_once( JPATH_SITE . '/components/com_acctexp/lib/eucalib/eucalib.php' );
	require_once( JPATH_SITE . '/components/com_acctexp/lib/eucalib/eucalib.install.php' );

	// Load root install and database object
	$eucaInstall	= new eucaInstall();
	$eucaInstalldb	= new eucaInstallDB();
	$eucaInstallef	= new eucaInstalleditfile();

	include_once( $pathLang . 'general.php' );

	// in any case, delete an already existing menu entry
	$query = 'DELETE FROM #__menu WHERE `link` LIKE \'index.php?option=com_acctexp%\'';
	$database->setQuery( $query );
	$database->query();

	// Slot in DB tables that do not exist yet
	$incpath = JPATH_SITE . '/administrator/components/com_acctexp/install/inc';

	require_once( $incpath . '/dbtables.inc.php' );

	$eucaInstalldb->multiQueryExec( $queri );

	// Upgrade ancient settings
	include_once( $incpath . '/settings_oldupgrade.inc.php' );

	// Upgrade Settings to 0.12.6 status
	include_once( $incpath . '/settings_0_12_6_upgrade.inc.php' );

	// Load Class (and thus aecConfig)
	require_once( $mainframe->getPath( 'class', 'com_acctexp' ) );

	global $aecConfig;

	if ( isset( $aecConfig->cfg['aec_version'] ) ) {
		$oldversion = $aecConfig->cfg['aec_version'];
	} else {
		$oldversion = false;
	}

	if ( !$newinstall ) {
		// Check if we are upgrading from before 0.12.6RC2j - then we need to check everything before that
		if ( empty( $oldversion ) || ( version_compare( $oldversion, '0.12.6RC2j' ) === 0 ) ) {
			if ( version_compare( $oldversion, '0.12.6RC2j' ) === 0 ) {
				$oldupdates = array( '0_12_6RC2j' );
			} else {
				$oldupdates = array( '0_6_0', '0_8_0', '0_10_0', '0_12_0', '0_12_6RC2j' );
			}

			foreach ( $oldupdates as $upd ) {
				require_once( $incpath . '/upgrade_' . $upd . '.inc.php' );
			}
		}

		$incfiles = AECToolbox::getFileArray( $incpath, 'inc.php', false, true );

		$versions = array();
		foreach ( $incfiles as $filename ) {
			if ( strpos( $filename, 'upgrade_' ) === false ) {
				continue;
			} else {
				$versions[] = str_replace( array( 'upgrade_', '.inc.php' ), array( '', '' ), $filename );
			}
		}

		$incf = AECToolbox::versionSort( $versions );

		$versions = array();
		foreach ( $incf as $version ) {
			if ( version_compare( AECToolbox::normVersionName( $version ), AECToolbox::normVersionName( $oldversion ), '>=' ) ) {
				require_once( $incpath . '/upgrade_' . $version . '.inc.php' );
			}
		}

		$updates = array();


	}

	// Set Version
	//$aecConfig->cfg['aec_version'] = _AEC_VERSION;

	// --- [ END OF DATABASE UPGRADE ACTIONS ] ---

	// Make sure settings & info = updated
	$pplist = PaymentProcessorHandler::getInstalledNameList();

	foreach ( $pplist as $ppname ) {
		$pp = new PaymentProcessor();

		if ( $pp->loadName( $ppname ) ) {
			$pp->fullInit();

			// Infos often change, so we protect the name and description and so on, but replace everything else
			$original	= $pp->processor->info();

			$protect = array( 'name', 'longname', 'statement', 'description' );

			foreach ( $original as $name => $var ) {
				if ( !in_array( $name, $protect ) ) {
					$pp->info[$name] = $var;
				}
			}

			$pp->processor->storeload();
		}

		$pp = null;
	}

	// Force Init Params
	$aecConfig = new Config_General( $database );
	$aecConfig->initParams();

	// --- [ END OF STANDARD UPGRADE ACTIONS ] ---

	// Create the Joomla Backend Menu
	require_once( $incpath . '/menusetup.inc.php' );

	// Create root group
	require_once( $incpath . '/create_rootgroup.inc.php' );

	// Make all Superadmins excluded by default
	$database->setQuery("SELECT id FROM #__users WHERE gid='25'");
	$administrators = $database->loadResultArray();

	foreach ( $administrators as $adminid ) {
		$metaUser = new metaUser( $adminid );

		if ( !$metaUser->hasSubscription ) {
			$metaUser->objSubscription = new Subscription( $database );
			$metaUser->objSubscription->createNew( $adminid, 'free', 0 );
			$metaUser->objSubscription->setStatus( 'Excluded' );
		}
	}

	// icons
	$files = array(
					array( 'icons/backend_icons.tar.gz',	'icons',			1, 1 ),
					array( 'icons/silk_icons.tar.gz',		'icons',			0, 1 ),
					array( 'gfx/gfx.tar.gz',				'gfx',				1, 1 ),
					array( 'cc_icons/cc_icons.tar.gz',		'cc_icons',			0, 1 ),
					array( 'gateway_buttons.tar.gz',		'',					0, 1 ),
					array( 'gateway_logos.tar.gz',			'',					0, 1 ),
					array( 'lib/krumo/krumo.tar.gz',		'lib/krumo/',		0 ),
					array( 'lib/mootools/mootools.tar.gz',	'lib/mootools/',	0 ),
					array( 'jquery/css/smoothness/images/jquery_ui_smoothness_img.tar.gz',	'jquery/css/smoothness/images/',				1, 2 ),
					array( 'processors/ideal_advanced/ideal_advanced.tar.gz',					'processors/ideal_advanced/',	0 )
					);

	// check if joomfish (joomla) or nokkaew (mambo) exists)
	$translation = false;
	if ( file_exists( JPATH_SITE . '/administrator/components/com_joomfish/admin.joomfish.php' ) ) {
		$translation = 'joomfish';
	} elseif ( file_exists( JPATH_SITE . '/administrator/components/com_joomfish/joomfish.php' ) ) {
		$translation = 'joomfish';
	} elseif ( file_exists( JPATH_SITE . '/administrator/components/com_nokkaew/admin.nokkaew.php' ) ) {
		$translation = 'nokkaew';
	}

	if ( $translation ) {
		if ( file_exists( JPATH_SITE . '/administrator/components/com_acctexp/install/jf_content_elements_aec.' . _AEC_LANGUAGE . '.tar.gz' ) ) {
			$xmlInst = 'install/jf_content_elements_aec.' . _AEC_LANGUAGE . '.tar.gz';
		} else {
			$xmlInst = 'install/jf_content_elements_aec.en.tar.gz';
		}
		$files[] = array( $xmlInst, '../com_' . $translation . '/contentelements/', 1 );
	}

	$eucaInstall->unpackFileArray( $files );

	$krumoabspath = JPATH_SITE . '/components/com_acctexp/lib/krumo/';
	$krumourlpath = JURI::root() . '/components/com_acctexp/lib/krumo/';

	$eucaInstallef->fileEdit( $krumoabspath . 'krumo.ini', 'http://www.example.com/Krumo/', $krumourlpath, "Krumor Debug Lib did not receive a proper url path, due to writing permission problems" );

	// log installation
	$short		= _AEC_LOG_SH_INST;
	$event		= sprintf( _AEC_LOG_LO_INST, _AEC_VERSION );
	$tags		= 'install,system';

	$eventlog	= new eventLog( $database );
	$params		= array( 'userid' => $user->id );
	$eventlog->issue( $short, $tags, $event, 2, $params, 1 );

	$errors = array_merge( $errors, $eucaInstall->getErrors(), $eucaInstalldb->getErrors(), $eucaInstallef->getErrors() );

	if ( !empty( $errors ) ) {
		foreach ( $errors as $error ) {
			$eventlog	= new eventLog( $database );
			$eventlog->issue( '', $tags, $error );
		}
	}

	?>

	<style type="text/css">
		.usernote {
			position: relative;
			float: left;
			width: 98%;
			background: url(<?php echo JURI::root(); ?>media/com_acctexp/images/admin/gfx/note_lowerright.png) no-repeat bottom right;
			padding: 6px 18px;
			color: #000;
		}
	</style>
	<table border="0">
		<tr>
			<td width="60%" valign="top" style="background-color: #eee;">
				<div style="background-color: #949494; margin: 2px; padding: 6px;">
					<div style="width: 100%; background-color: #000;">
						<center><img src="<?php echo JURI::root(); ?>media/com_acctexp/images/admin/icons/aec_dist_gfx.png" border="0" alt="" /></center>
					</div>
				</div>
				<?php
				if ( $errors ) {
					echo '<div style="color: #FF0000; text-align: left; border: 1px solid #FF0000;">' . "\n"
					. _AEC_INST_ERRORS
					. '<ul>' . "\n";
					foreach ( $errors AS $error ) {
						if ( is_array( $error ) ) {
							echo '<li>' . $error[0] . ' - ' . $error[1] . '</li>';
						} else {
							echo '<li>' . $error . '</li>';
						}

					}
					echo '</ul>' . "\n"
					. '</div>' . "\n";
				} ?>
				<div class="usernote" style="width:350px;margin:8px;">
					<h1><?php echo _AEC_INST_HINTS; ?></h1>
					<p><?php echo sprintf( _AEC_INST_HINT1, 'http://valanx.org' ); ?></p>
					<p><?php echo _AEC_INST_HINT2; ?></p>
				</div>
				<div class="usernote" style="width:350px;margin:8px;">
					<h1><?php echo _AEC_INST_NOTE_IMPORTANT; ?>:</h1>
					<img src="<?php echo JURI::root(); ?>media/com_acctexp/images/admin/gfx/help_scribble.png" border="0" alt="" style="position:relative;float:left;padding:4px;" />
					<p><?php printf( _AEC_INST_NOTE_HELP, AECToolbox::backendTaskLink( 'help', _AEC_INST_NOTE_HELP_LTEXT ) ); ?></p>
				</div>
				<div class="usernote" style="width:350px;margin:8px;">
					<h1><?php echo _AEC_INST_NOTE_IMPORTANT; ?>:</h1>
					<img src="<?php echo JURI::root(); ?>media/com_acctexp/images/admin/gfx/hacks_scribble.png" border="0" alt="" style="position:relative;float:left;padding:4px;" />
					<p><?php echo _AEC_INST_NOTE_SECURITY; ?></p>
					<p><?php printf( _AEC_INST_APPLY_HACKS, AECToolbox::backendTaskLink( 'hacks', _AEC_INST_APPLY_HACKS_LTEXT ) ); ?></p>
					<p><?php echo _AEC_INST_NOTE_UPGRADE; ?></p>
				</div>
			</td>
			<td width="30%" valign="top">
				<br />
				<center><img src="<?php echo JURI::root(); ?>media/com_acctexp/images/admin/icons/aec_logo_big.png" border="0" alt="" /></center>
				<br />
				<div style="margin-left:auto;margin-right:auto;width:400px;text-align:center;">
					<p><strong>Account Expiration Control</strong> Component - Version <?php echo _AEC_VERSION; ?></p>
					<p><?php echo _AEC_FOOT_TX_CHOOSING; ?></p>
					<div style="margin: 0 auto;text-align:center;">
						<a href="https://www.valanx.org" target="_blank"><img src="<?php echo JURI::root(); ?>media/com_acctexp/images/admin/icons/valanx_logo.png" border="0" alt="valanx.org" /></a>
						<p><?php echo _AEC_FOOT_TX_GPL; ?></p>
						<p><?php echo _AEC_FOOT_TX_SUBSCRIBE; ?></p>
						<p><?php printf( _AEC_FOOT_CREDIT, AECToolbox::backendTaskLink( 'credits', _AEC_FOOT_CREDIT_LTEXT ) ); ?></p>
				</div>
			</td>
		</tr>
	</table>
	<?php
} ?>
