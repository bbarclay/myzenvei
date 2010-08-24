<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

require_once( JApplicationHelper::getPath( 'toolbar_html' ) );

switch ( $task )
{
	case 'add'  :
		TOOLBAR_hello::_NEW();
		break;

	default:
		TOOLBAR_hello::_DEFAULT();
		break;
}
?>