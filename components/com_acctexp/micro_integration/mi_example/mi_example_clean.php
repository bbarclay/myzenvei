<?php
// Dont allow direct linking
( defined('_JEXEC') || defined( '_VALID_MOS' ) ) or die( 'Direct Access to this location is not allowed.' );

class mi_example
{
	function Info()
	{
		$info = array();
		$info['name'] = '';
		$info['desc'] = '';

		return $info;
	}

	function checkInstallation()
	{
		return true;
	}

	function install()
	{
		return;
	}

	function Settings()
	{
		$settings = array();
		$settings['param1'] = array( 'inputA' );
		$settings['param2'] = array( 'inputD' );

		return $settings;
	}

	function pre_expiration_action( $request )
	{}

	function expiration_action( $request )
	{}

	function action( $request )
	{}

	function on_userchange_action( $row, $post, $trace )
	{}

	function delete()
	{}

	function profile_info( $request )
	{}

	function admin_info( $request )
	{}

	function profile_form( $request )
	{}

	function admin_form( $request )
	{}

	function profile_form_save( $request )
	{}

	function admin_form_save( $request )
	{}

}

?>