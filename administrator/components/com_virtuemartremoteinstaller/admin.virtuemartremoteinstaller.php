<?php
/* VirtueMart remote Installer Script */
defined('_JEXEC') or die('Direct access to this location is not allowed.');

$task = jrequest::getVar( 'task' );
$remote_url = jrequest::getVar( 'remote_url' );
$element = jrequest::getVar( 'element' );
$jdatabase = jFactory::getDBO();

switch ($task) {
  case "install":
	if( installVirtueMart( $remote_url ) ) {
	  installFromDir( $element );
	}
	break;
	
  default:
	$component_installed = false;
	$module_installed = false;
	$q = "SELECT id FROM #__components as c WHERE c.option='com_virtuemart'";
	$jdatabase->setQuery( $q );
	$jdatabase->query();
	if( $jdatabase->getNumRows() ) {
	  $component_installed = true;
	}
	$q = "SELECT id FROM #__modules as m WHERE m.module='mod_virtuemart'";
	$jdatabase->setQuery( $q );
	$jdatabase->query();
	if( $jdatabase->getNumRows() ) {
	  $module_installed = true;
	}
	
	echo "<h1><img align=\"center\" hspace=\"3\" src=\"components/com_virtuemartremoteinstaller/cart.gif\" border=\"0\" alt=\"Cart\" />\n";
	echo "VirtueMart Getter / Downloader Script</h1>";
	echo '<br /><br /><div align="left">';
	echo '<strong>This script will help you to transfer the Installation Files for VirtueMart to this Server. It downloads the latest Component or Module Install Package directly ';
	echo 'from the <a href="dev.virtuemart.net" title="VirtueMart Developer Portal" target="_blank">VirtueMart Developer Portal</a> to your server. This is especially helpful when your Joomla! site is located on a remote Server with a fast Internet Connection,';
	echo ' but it will also work for a local Server. Note that a direct Internet Connection is needed anyway! Just click on &quot;Begin Download&quot; and the Script will do the Rest.</strong></div><br />';
	
	echo "<table class=\"adminlist\" align=\"center\"><tr>";
	echo "<th><h3>1. Component Download</h3></th><th><h3>2. Module Download</h3></th></tr><tr>";
	
	if( $component_installed ) {
	 echo '<td><img src="images/tick.png" alt="OK" align="left" />&nbsp;&nbsp;&nbsp;
	 			The VirtueMart Component is already installed on this Server.</span></td>';
	}
	else {
	  echo "<td><form action=\"".$_SERVER['PHP_SELF']."\" method=\"post\">\n";
	  echo "<input type=\"hidden\" name=\"task\" value=\"install\" />\n";
	  echo "<input type=\"hidden\" name=\"element\" value=\"component\" />\n";
	  echo "<input type=\"hidden\" name=\"option\" value=\"com_virtuemartremoteinstaller\" />\n<br /><br />";
	  echo "<img align=\"center\" hspace=\"3\" src=\"components/com_virtuemartremoteinstaller/remote.png\" border=\"0\" alt=\"Remote URL\" />\n";
	  echo "Download from....(Remote URL)<br />\n";
	  echo "<input type=\"text\" class=\"inputbox\" size=\"64\" name=\"remote_url\" value=\"http://virtuemart.net/latestcomponent.php?j=1.5\" />\n<br /><br /><br />";
	  echo "<img align=\"center\" hspace=\"3\" src=\"components/com_virtuemartremoteinstaller/local.png\" border=\"0\" alt=\"Local Directory\" />\n";
	  echo "Download to this directory...<br />\n";
	  echo "<input type=\"text\" class=\"inputbox\" size=\"64\" name=\"downloaddir\" value=\"".JPATH_SITE."/media\" />\n<br /><br /><br />";
	  echo "<input type=\"submit\" class=\"button\" value=\"Download Component\" /><br /><br /><br />\n";
	  echo "</form></td>";
	}
	if( $module_installed ) {
	 echo '<td><img src="images/tick.png" alt="OK" align="left" />&nbsp;&nbsp;&nbsp;
	 			The VirtueMart Main Module is already installed on this Server.</td>';
	}
	else {
	  echo "<td><form action=\"".$_SERVER['PHP_SELF']."\" method=\"post\">\n";
	  echo "<input type=\"hidden\" name=\"task\" value=\"install\" />\n";
	  echo "<input type=\"hidden\" name=\"element\" value=\"module\" />\n";
	  echo "<input type=\"hidden\" name=\"option\" value=\"com_virtuemartremoteinstaller\" />\n<br /><br />";
	  echo "<img align=\"center\" hspace=\"3\" src=\"".JURI::base()."components/com_virtuemartremoteinstaller/remote.png\" border=\"0\" alt=\"Remote URL\" />\n";
	  echo "Download from....(Remote URL)<br />\n";
	  echo "<input type=\"text\" class=\"inputbox\" size=\"64\" name=\"remote_url\" value=\"http://virtuemart.net/latestmodule.php?j=1.5\" />\n<br /><br /><br />";
	  echo "<img align=\"center\" hspace=\"3\" src=\"components/com_virtuemartremoteinstaller/local.png\" border=\"0\" alt=\"Local Directory\" />\n";
	  echo "Download to this directory...<br />\n";
	  echo "<input type=\"text\" class=\"inputbox\" size=\"64\" name=\"downloaddir\" value=\"".JPATH_SITE."/media\" />\n<br /><br /><br />";
  
	  echo "<input type=\"submit\" class=\"button\" value=\"Download Module\" /><br /><br /><br />\n";
	  echo "</form></td>";
	}
	echo "</tr></table>";
	
	if( $module_installed && $component_installed ) {
		$q = "SELECT `id` FROM `#__components` as c WHERE c.option='com_virtuemartremoteinstaller'";
		$jdatabase->setQuery( $q );
		$Item = Array();
		$eid = $jdatabase->loadResult();
		
		echo "<br /><br /><div align=\"center\">";
		echo "<h3>Uninstall the VirtueMart Remote Installer Component</h3>";
		echo "<form action=\"".$_SERVER['PHP_SELF']."\" method=\"post\"><br />";
		echo "<input type=\"hidden\" name=\"task\" value=\"remove\" />";
		echo "<input type=\"hidden\" name=\"eid\" value=\"".$eid."\" />";
		echo "<input type=\"hidden\" name=\"element\" value=\"component\" />";
		echo "<input type=\"hidden\" name=\"option\" value=\"com_installer\" />";
		echo JHTML::_( 'form.token' );
		echo "<input type=\"submit\" value=\"Remove the Installer Component now!\" onclick=\"return confirm('Are you really sure?');\" /><br /><br /><br />";
		echo "</form></div>";
	}
	break;	
}

function installVirtueMart( $remote_file ) {
	global $mainframe, $extract_dir;
	
	////////////////////////////////////////////////////////////////////////////
	// Step 1: Download the file com_virtuemart_x.x.tar.gz
	//        from dev.virtuemart.net
	//
	if( empty($_POST['downloaddir']))
	  $downloaddir = JPATH_SITE.DS."media";
	else
	  $downloaddir = $_POST['downloaddir'];
	if( !is_writable( $downloaddir ) ) {
	  return false;
	}
	$element = jrequest::getVar('element') == 'component' ? 'component' : 'module';
	$local_file = $downloaddir.DS.'virtuemart_'.$element .'.zip';
	require_once( dirname( __FILE__ ) . DS."downloader.php");
	$downloadMethods = array(
			new CurlDownloader(),
			new WgetDownloader(),
			new FopenDownloader(),
			new FsockopenDownloader()
		);
	
	foreach( $downloadMethods as $method ) {
		if( $method->isSupported() ) {
			$downloader = $method;
		}
	}
	if( !$downloader->download( $remote_file, $local_file ) ) {
		$mainframe->redirect( 'index.php?option=com_virtuemartremoteinstaller', 'Failed to download the Package File!' );
	}
	////////////////////////////////////////////////////////////////////////////
	// Step 2: Extract the file com_virtuemart_x.x.tar.gz
	//        to downloaddir/XXXXXXXX/
	//	
	jimport('joomla.filesystem.archive');
	
	$uniqueid = uniqid( "vm_" );
	if( @mkdir( $downloaddir.DS.$uniqueid ) )
	  $extract_dir = $downloaddir.DS.$uniqueid;
	else
	  $extract_dir = $downloaddir;
	  
	if( JArchive::extract($local_file, $extract_dir ) !== false ) {
	  echo "<br /><br />Extraction successful!<br />";
	  unlink( $local_file );
	  return true;
	}
	else {
	  $mainframe->redirect( 'index.php?option=com_virtuemartremoteinstaller');
	}
}


function installFromDir( $element ) {
  global $extract_dir;
  ?>
  <span class="sectionname">Success</span>
  <br /><br /><div align="center">
  <hr />The script has successfully downloaded and extracted the VirtueMart <?php echo ucfirst($element ) ?> on your Server.<hr />
  <form enctype="multipart/form-data" action="index.php" method="post" name="adminForm">
		<input type="hidden" name="task" value="doInstall" />
		<input type="hidden" name="option" value="com_installer" />
		<input type="hidden" name="installtype" value="folder">
		<?php echo JHTML::_( 'form.token' ); ?>
	<table class="adminform">
	<tr>
		<th colspan="2"><?php echo JText::_( 'Install from directory' ); ?></th>
	</tr>
	<tr>
		<td width="120">
			<label for="install_directory"><?php echo JText::_( 'Install directory' ); ?>:</label>
		</td>
		<td>
			<input type="text" id="install_directory" name="install_directory" class="input_box" size="70" value="<?php echo $extract_dir ?>" />
			<input type="submit" class="button" value="<?php echo JText::_( 'Install' ); ?>" />
		</td>
	</tr>
	</table>
		</form></div>
	<h2>Just click on 'Install' to Install the VirtueMart <?php echo ucfirst($element ) ?> now.</h2><br /><hr /><br /><br />
	<?php
}
?>