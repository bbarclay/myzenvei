<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.controller' );

class jposition_detailController extends JController
{
	function __construct( $default = array())
	{
		parent::__construct( $default );
		$this->registerTask( 'add'  , 	'edit' );
		
	}

	function edit()
	{
		parent::display();

	}

}
