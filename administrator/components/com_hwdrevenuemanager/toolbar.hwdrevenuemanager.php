<?php
/**
 *    @version [ Cape ]
 *    @package hwdRevenueManager
 *    @copyright (C) 2007 - 2009 Highwood Design
 *    @license Creative Commons Attribution-Non-Commercial-No Derivative Works 3.0 Unported Licence
 *    @license http://creativecommons.org/licenses/by-nc-nd/3.0/
 */
defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

require_once( $mainframe->getPath( 'toolbar_html' ) );

switch ( $task ) {

		case "homepage":
		menuhwdam::INFO_MENU();
		break;

		case "hwdvideoshare":
    	menuhwdam::SETTINGS_VS_MENU();
    	break;

		case "hwdphotoshare":
    	menuhwdam::SETTINGS_PS_MENU();
    	break;

		case "videoads":
    	menuhwdam::SETTINGS_VA_MENU();
    	break;

		case "newvad":
		case "editvad":
    	menuhwdam::SETTINGS_EVA_MENU();
    	break;

		case "longtail":
    	menuhwdam::SETTINGS_LT_MENU();
    	break;

		default:
		menuhwdam::INFO_MENU();
		break;

	}

?>