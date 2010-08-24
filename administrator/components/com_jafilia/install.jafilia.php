<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' );
/**
 * @version $Id: header.php 789 2009-01-26 15:56:03Z elkuku $
 * @package    Jafilia
 * @subpackage
 * @author     EasyJoomla {@link http://www.easy-joomla.org Easy-Joomla.org}
 * @author     Arkadiusz Maniecki {@link http://www.jafilia.pl}
 * @author     Created on 08-Apr-2009
 */
//--No direct access
/**
 * Main installer
 Update Log

    * Frontend files successfully extracted.
    * Frontend archive file successfully deleted.
    * Backend files successfully extracted.
    * Backend archive file successfully deleted.
    * The sample data was installed successfully.
 */
 /*
 * This part is taken from the Joomla Tags component, courtesy of
 * joomlatags.org (GPL'd)
 */
$status = new JObject();
//$status->modules = array();
$status->plugins = array();
/*********************/
$plugins = &$this->manifest->getElementByPath( 'plugins' );
if( is_a( $plugins, 'JSimpleXMLElement' ) && count( $plugins->children() ) )
{
//Install Component Success
	foreach( $plugins->children() as $plugin )
	{
		$pname = $plugin->attributes( 'plugin' );
		$pgroup = $plugin->attributes( 'group' );
		$porder = $plugin->attributes( 'order' );

		// Set the installation path
		if( !empty( $pname ) && !empty( $pgroup ) ) {
			$this->parent->setPath( 'extension_root', JPATH_ROOT.DS.'plugins'.DS.$pgroup );
		} else {
			$this->parent->abort( JText::_( 'Plugin' ).' '.JText::_( 'Install' ).': '.JText::_( 'No plugin file specified' ) );
			return false;
		}

		/**
		 * ---------------------------------------------------------------------------------------------
		 * Filesystem Processing Section
		 * ---------------------------------------------------------------------------------------------
		 */

		// If the plugin directory does not exist, lets create it
		$created = false;
		if( !file_exists( $this->parent->getPath( 'extension_root' ) ) ) {
			if( !$created = JFolder::create( $this->parent->getPath( 'extension_root' ) ) ) {
				$this->parent->abort( JText::_( 'Plugin' ).' '.JText::_( 'Install' ).': '.JText::_( 'Failed to create directory' ).': "'.$this->parent->getPath( 'extension_root' ).'"' );
				return false;
			}
		}
		/*
		 * If we created the plugin directory and will want to remove it if we
		 * have to roll back the installation, lets add it to the installation
		 * step stack
		 */
		if( $created ) {
			$this->parent->pushStep( array( 'type' => 'folder', 'path' => $this->parent->getPath( 'extension_root' ) ) );
		}

		// Copy all necessary files
		$element = &$plugin->getElementByPath( 'files' );
		if( $this->parent->parseFiles( $element, -1 ) === false ) {
			// Install failed, roll back changes
			$this->parent->abort();
			return false;
		}

		// Copy all necessary files
		$element = &$plugin->getElementByPath( 'languages' );
		if( $this->parent->parseLanguages( $element, 1 ) === false ) {
			// Install failed, roll back changes
			$this->parent->abort();
			return false;
		}

		// Copy media files
		$element = &$plugin->getElementByPath('media');
		if( $this->parent->parseMedia( $element, 1 ) === false ) {
			// Install failed, roll back changes
			$this->parent->abort();
			return false;
		}

		/**
		 * ---------------------------------------------------------------------------------------------
		 * Database Processing Section
		 * ---------------------------------------------------------------------------------------------
		 */
		$db = &JFactory::getDBO();

		// Check to see if a plugin by the same name is already installed
		$query = 'SELECT `id`' .
                ' FROM `#__plugins`' .
                ' WHERE folder = '.$db->Quote( $pgroup ) .
                ' AND element = '.$db->Quote( $pname );
		$db->setQuery( $query );
		if( !$db->Query() ) {
			// Install failed, roll back changes
			$this->parent->abort( JText::_( 'Plugin' ).' '.JText::_( 'Install' ).': '.$db->stderr( true ) );
			return false;
		}
		$id = $db->loadResult();

		// Was there a plugin already installed with the same name?
		if( $id ) {

			if( !$this->parent->getOverwrite() )
			{
				// Install failed, roll back changes
				$this->parent->abort( JText::_( 'Plugin' ).' '.JText::_( 'Install' ).': '.JText::_( 'Plugin' ).' "'.$pname.'" '.JText::_( 'already exists!' ) );
				return false;
			}

		} else {
			$row = &JTable::getInstance( 'plugin' );
			$row->name = JText::_( ucfirst( $pgroup ) ).' - '.JText::_( ucfirst( $pname ) );
			$row->ordering = $porder;
			$row->folder = $pgroup;
			$row->iscore = 0;
			$row->access = 0;
			$row->client_id = 0;
			$row->element = $pname;
			if( $pgroup == 'system' )
			{
				$row->published = 1;//0; keran
			} else {
				$row->published = 1;
			}
			$row->params = '';

			if( !$row->store() ) {
				// Install failed, roll back changes
				$this->parent->abort( JText::_( 'Plugin' ).' '.JText::_( 'Install' ).': '.$db->stderr( true ) );
				return false;
			}
		}

		$status->plugins[] = array( 'name'=>$pname, 'group'=>$pgroup );
	}
} 
/********************/ 
/*
 * end code from joomlatags
 */
/*
foreach( $status->modules as $mstatus )
{
	JError::raiseNotice( 200, 'com_jcollection::installModules: '.$mstatus['name'].' installed' );
}
*/
foreach( $status->plugins as $pstatus )
{
	//JError::raiseNotice( 200, 'com_jcollection::installPlugins: '.$pstatus['name'].' installed in group '.$pstatus['group'] );
	JError::raiseNotice( 200, JText::_( 'Install' ).' '.JText::_( 'Plugin' ).' Success: '.$pstatus['name'].' installed in group '.$pstatus['group'] );
}

function com_install() {
	$errors = FALSE;
	//global $mosConfig_absolute_path, $mosConfig_dbprefix, $database;
	global $mosConfig_absolute_path, $mosConfig_dbprefix, $database, 
		$JAFVERSION, $myVersion, $shortversion, $version_info;
	include( "helpers/version.php" );
	if( !isset( $shortversion )) {
		$shortversion = $JAFVERSION->PRODUCT . " " . $JAFVERSION->RELEASE . " " . $JAFVERSION->DEV_STATUS. " ";
		$myVersion = $shortversion . " [".$JAFVERSION->CODENAME ."] <br />" . $JAFVERSION->RELDATE . " "
					. $JAFVERSION->RELTIME . " " . $JAFVERSION->RELTZ;
	}
	// Check for old Tables. When they exist, offer an Upgrade
	if( is_null( $database ) && class_exists('jfactory')) {
		$database = JFactory::getDBO();
	}
	$database->setQuery( "SHOW TABLES LIKE 'jos_jafilia_%'" ); //to do
	$pshop_tables = $database->loadObjectList();
	
	if( !empty( $pshop_tables )) {	//istnieja tablice
		//echo 'sa tablice';
		$installation = "wantnewornot";
	}
	else {	//nie ma tablic
		//echo 'nie ma tablic';
		$installation = "newtables";
		//include_once( $admin_dir."/sql/sql.new.jafilia.1.5.0.php" );
		include_once( "sql/sql.new.jafilia.1.5.0.php" );
	}
	?>
	<link rel="stylesheet" href="components/com_jafilia/install.css" type="text/css" />
	<div align="center">
		<table width="100%" border="0">
			<tr>
				<td valign="middle" align="center">
					<div id="ctr" align="center">
						<div class="install">
							<div id="right">
								<div id="step">Welcome to <?php echo $shortversion; ?></div>			
								<div class="clr"></div>
								<pre></pre>
								<h1>The first step of the Installation was <font color="green">SUCCESSFUL</font></h1>
								<table>
								<?php
								if( $installation == "newtables" ) { ?>
									<tr>
										<td colspan="3" class="error">Installation was succesful, but to get Jafilia working, <br>you must complete a couple easy hacks to your Joomla / Virtuemart installation described below.
										You can find the hack instructions also on <a href="index.php?option=com_jafilia&controller=help">Jafilia->Help</a> page.
										</td>
									</tr>
									<tr>
										<td width="40%">You can use Jafilia clicked on a link below.<br/></td>
										<td width="20%">&nbsp;</td>
										<td width="40%">You can install some Sample Data now.
										</td>
									</tr>
									<tr>
										<td width="40%">
											<a title="Go directly to the Jafilia &gt;&gt;" class="button" href="index.php?option=com_jafilia">Go directly to the Jafilia &gt;&gt;</a>
										</td>
										<td width="20%">&nbsp;</td>
										<td width="40%">
											<a class="button" title="Install SAMPLE DATA &gt;&gt;" href="index.php?option=com_jafilia&install_type=3">Install SAMPLE DATA &gt;&gt;</a>
										</td>
									</tr>
									<tr>
										<td align="center" colspan="3"><br /><br /><hr /><br /></td>
									</tr>
									<?php 
								}
								elseif( $installation == 'wantnewornot' ) { 
								?>
										<td colspan="3" class="error">The Installation script has found out that you've already installed Jafilia Tables, so let's decide what to do:</td>
									<tr>
									</tr>
									<tr>
										<td align="left" colspan="3">
											<div align="center">
												<a title="Delete old and create new Tables" onclick="return window.confirm('We suggest to make backup before drop the tables.\nDelete old and create new Tables?');" name="Button2" class="button" href="index.php?option=com_jafilia&install_type=2">Delete old and create new Tables &gt;&gt;</a><br /><br />
												<a title="Delete old and create new Tables with Samples" onclick="return window.confirm('We suggest to make backup before drop the tables.\nDelete old and create new Tables?');" name="Button2" class="button" href="index.php?option=com_jafilia&install_type=1">Delete old and create new Tables with Samples &gt;&gt;</a><br /><br />
												<a title="Finish" class="button" href="index.php?option=com_jafilia">Proceed mantaining actual data tables &gt;&gt;</a><br />
											</div><br />											
										</td>
									</tr>
								<?php
								}
								?>
								</table>
							</div>
							<div class="clr"></div>
					</div>
				</td>
			</tr>
		</table>
	</div>
	
	<?php
	include( "helpers/hackinfo.php" );
	
   if( $errors ) {
      return FALSE;
   }   
   include_once( "sql/sql.menu.jafilia.1.5.0.php" );
   return TRUE;	
}
?>