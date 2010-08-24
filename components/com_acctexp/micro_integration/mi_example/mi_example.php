<?php
// Dont allow direct linking
( defined('_JEXEC') || defined( '_VALID_MOS' ) ) or die( 'Direct Access to this location is not allowed.' );

class mi_example
{

	function Info()
	{
		$info = array();
		$info['name'] = 'Long Name';
		$info['desc'] = 'Full Description';

		return $info;
	}

	function checkInstallation()
	{
		// THIS FUNCTION IS NOT OBLIGATORY - IF YOU DON'T NEED IT, DON'T USE IT

		// As explained below this checks whether the installation of this
		// feature has already taken place. If that is not the case, we call install below
		// Also check out the below example for a db check for the table that is created
		// within the install function.

		$database = &JFactory::getDBO();

		global $mainframe;

		$tables	= array();
		$tables	= $database->getTableList();

		return in_array($mainframe->getCfg( 'dbprefix' )."_acctexp_mi_sampletable", $tables);
	}

	function install()
	{
		// THIS FUNCTION IS NOT OBLIGATORY - IF YOU DON'T NEED IT, DON'T USE IT

		// In this function, you can specify what has to be done before you
		// can use this Integration. Common applications could be the creation
		// of a database table (please prefix with "acctexp_mi_" if you care
		// for readability of databases) or the installation of other files.
		// Below is an example how a sample db table creation could look like:

		$database = &JFactory::getDBO();

		$query =	"CREATE TABLE IF NOT EXISTS `#__acctexp_mi_sampletable` (" . "\n" .
					"`id` int(11) NOT NULL auto_increment," . "\n" .
					"`userid` int(11) NOT NULL," . "\n" .
					"`active` int(4) NOT NULL default '1'," . "\n" .
					"`params` text NULL," . "\n" .
					"PRIMARY KEY  (`id`)" . "\n" .
					")";
		$database->setQuery( $query );
		$database->query();
		return;
	}

	function Settings()
	{
		// Here you create an array of standard variables for your integration.
		// I didn't want to go through the trouble to have you create your own
		// settings tab here, so this is a standardized one-size-fits-all
		// automatically built thing. Refer to the admin.acctexp.html.php function
		// HTML_myCommon::createSettingsParticle to see what types of entries are possible.
		// Be sure to give them unique variable names or you they won't save correctly
		// in the best, or create an error in the worst case.

		// remember to link the params array correctly to the settings - call on the same name

		// Syntax: ['name'] => Field Type || Field Name || Field Description
		$settings = array();
		$settings['param_name1'] = array("inputA", "Name", "description");
		$settings['param_name2'] = array("inputD", "Name2", "description2");

		return $settings;
	}

	function pre_expiration_action( $request )
	{
		// THIS FUNCTION IS NOT OBLIGATORY - IF YOU DON'T NEED IT, DON'T USE IT

		// Here you can specify whatever you want to happen when the plan runs out.
	}

	function expiration_action( $request )
	{
		// THIS FUNCTION IS NOT OBLIGATORY - IF YOU DON'T NEED IT, DON'T USE IT

		// Here you can specify whatever you want to happen before the plan runs out.
	}

	function action( $request )
	{
		// And here what should happen when the plan is applied.
		// Note that both functions always receive the full parameter array
		// as well as the current user ID. So parameters are accessed by
		// $param['var_name'] and of course have the same variable name
		// that you applied to them in the Settings function.
	}

	function on_userchange_action( $request )
	{
		// THIS FUNCTION IS NOT OBLIGATORY - IF YOU DON'T NEED IT, DON'T USE IT

		// If your integration relies on knowing the username and password,
		// you can change what you saved with this function when the user is changed
		// trace can be either 'registration' for a account creation on registration.
		// 'user' for a change by a user in his/her profile
		// 'adminuser' for a change by the admin in the backend
	}

	function delete()
	{
		// THIS FUNCTION IS NOT OBLIGATORY - IF YOU DON'T NEED IT, DON'T USE IT

		// Trigger an action here in case the MI is deleted.
	}

	function profile_info( $request )
	{
		// THIS FUNCTION IS NOT OBLIGATORY - IF YOU DON'T NEED IT, DON'T USE IT

		// Return Info to the MySubscription page of this user
	}

	function profile_form( $request )
	{
		// THIS FUNCTION IS NOT OBLIGATORY - IF YOU DON'T NEED IT, DON'T USE IT

		// Return a Form to the MySubscription page of this user
	}

	function profile_form_save( $request )
	{
		// THIS FUNCTION IS NOT OBLIGATORY - IF YOU DON'T NEED IT, DON'T USE IT

		// Save a Form from the MySubscription page of this user
	}

	function admin_info( $request )
	{
		// THIS FUNCTION IS NOT OBLIGATORY - IF YOU DON'T NEED IT, DON'T USE IT

		// Return Info to the Backend User Form
	}

	function admin_form( $request )
	{
		// THIS FUNCTION IS NOT OBLIGATORY - IF YOU DON'T NEED IT, DON'T USE IT

		// Return a Form to the Backend User Form
	}

	function admin_form_save( $request )
	{
		// THIS FUNCTION IS NOT OBLIGATORY - IF YOU DON'T NEED IT, DON'T USE IT

		// Save a Form from the Backend User Form
	}

}

// And here you can of course include your own code. If you need to include whole php files,
// please do so within subfolders that are named like your php micro integration file.

?>