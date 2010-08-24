<?php
/**
 *    @version [ Cape ]
 *    @package hwdRevenueManager
 *    @copyright (C) 2007 - 2009 Highwood Design
 *    @license Creative Commons Attribution-Non-Commercial-No Derivative Works 3.0 Unported Licence
 *    @license http://creativecommons.org/licenses/by-nc-nd/3.0/
 */
defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

class menuhwdam {

	function INFO_MENU()
	{
        JToolBarHelper::title( _HWDRM_01, 'logo' );
		JToolBarHelper::custom('homepage', 'help.png', 'help_f2.png', _HWDRM_02, false);
	}

	function SETTINGS_VS_MENU()
	{
        JToolBarHelper::title( _HWDRM_01, 'logo' );
		JToolBarHelper::save('savevssettings');
		JToolBarHelper::spacer();
		JToolBarHelper::custom('homepage', 'help.png', 'help_f2.png', _HWDRM_02, false);
	}

	function SETTINGS_PS_MENU()
	{
        JToolBarHelper::title( _HWDRM_01, 'logo' );
		JToolBarHelper::save('savepssettings');
		JToolBarHelper::spacer();
		JToolBarHelper::custom('homepage', 'help.png', 'help_f2.png', _HWDRM_02, false);
	}

	function SETTINGS_VA_MENU()
	{
        JToolBarHelper::title( _HWDRM_01, 'logo' );
		JToolBarHelper::addNewX('newvad');
		JToolBarHelper::spacer();
		JToolBarHelper::publishList();
		JToolBarHelper::spacer();
		JToolBarHelper::unpublishList();
		JToolBarHelper::spacer();
		JToolBarHelper::editListX('editvad');
		JToolBarHelper::spacer();
		JToolBarHelper::deleteList('Are you sure you want to delete this video advert? ', 'deletevads');
		JToolBarHelper::spacer();
		JToolBarHelper::custom('homepage', 'help.png', 'help_f2.png', _HWDRM_02, false);
	}

	function SETTINGS_EVA_MENU()
	{
        JToolBarHelper::title( _HWDRM_01, 'logo' );
		JToolBarHelper::save('savevad');
		JToolBarHelper::spacer();
		JToolBarHelper::custom('homepage', 'help.png', 'help_f2.png', _HWDRM_02, false);
	}

	function SETTINGS_LT_MENU()
	{
        JToolBarHelper::title( _HWDRM_01, 'logo' );
		JToolBarHelper::save('saveltsettings');
		JToolBarHelper::spacer();
		JToolBarHelper::custom('homepage', 'help.png', 'help_f2.png', _HWDRM_02, false);
	}

}

?>