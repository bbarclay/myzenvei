<?php
defined( '_JEXEC' ) or die( '=;)' );
jimport('joomla.application.component.controller');
class JafiliaController extends JController {
	function __construct( $default = array() ) {
		$language =& JFactory::getLanguage();
		$language->load('com_jafilia');
		parent::__construct( $default );
	}	 
	function display() {
		if (isset($_REQUEST['install_type'])) {
			//jafilia_is_installed();
			//include( $mosConfig_absolute_path.'/administrator/components/'.$option.'/install.php' );

			/** can be update and newinstall **/
			$install_type = empty($_REQUEST['install_type']) ? 0 : $_REQUEST['install_type'];
			//echo $install_type;
			switch ($install_type) {
				case 0:	
					//include_once( "sql/sql.drop.jafilia.1.5.0.php" );
					//include_once( "sql/sql.new.jafilia.1.5.0.php" );
					//include_once( "sql/sql.samples.jafilia.1.5.0.php" );
				break;			
				case 1:	
					//echo 'dns<br>';
					include_once( "sql/sql.drop.jafilia.1.5.0.php" );
					include_once( "sql/sql.new.jafilia.1.5.0.php" );
					include_once( "sql/sql.samples.jafilia.1.5.0.php" );
				break;
				case 2:
				//echo 'dn<br>';
					include_once( "sql/sql.drop.jafilia.1.5.0.php" );
					include_once( "sql/sql.new.jafilia.1.5.0.php" );				
				break;
				case 3:
				//echo 's<br>';
					include_once( "sql/sql.samples.jafilia.1.5.0.php" );
				break;
			}
			/** true or false **/
			//$install_sample_data = (bool)@$_GET['install_sample_data'];
		}		
		parent::display();
	}	
}
