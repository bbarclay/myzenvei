<?php
/**
* @version		$Id: view.html.php 1027 2008-07-06 22:46:07Z Fritz Elfert $
* @copyright	Copyright (C) 2008 Fritz Elfert. All rights reserved.
* @license		GNU/GPLv2
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

jimport('joomla.application.component.view');
//jimport('joomla.plugin.plugin');

/**
 * Popup View
 */
class AvReloadedViewPopup extends JView
{
    /**
     * display method of the Popup view
     * @return void
     **/
    function display($tpl = null) {
        $app =& JFactory::getApplication();
        $doc =& JFactory::getDocument();
        $doc->addStyleDeclaration('html, body {background-color:#000;border:0px;padding:0px;margin:0px;width:100%;height:100%;}');
        $video = $this->_getVideo($app, $doc);
        $this->assignRef('video', $video);
        parent::display($tpl);
    }

    function _getVideo(&$app, &$doc) {
        $ret = '';
        $code = '';
        $itemid = JRequest::getInt('Itemid', -1);
        $divid = JRequest::getString('divid', null);
        if (($itemid >= 0) && ($divid != null)) {
            $db =& JFactory::getDBO();
            $query = "SELECT code FROM #__avr_popup WHERE id = ".
                $itemid." AND divid ='".$divid."'";
            $db->setQuery($query);
            $db->query();
            $data =& $db->loadObject();
            // Cleanup record older than 1 day
            // TODO: Investigate caching problem
            // $db->setQuery('DELETE FROM #__avr_popup WHERE wtime < SUBDATE(NOW(), 1)');
            // $db->query();
            if (empty($data) || empty($data->code)) {
                $ret = '<span style="color:red"><b>'.
                    JText::_('AVR_ERR_POPUP_DATABASE').'</b></span>';
            } else {
                $cfg =& JFactory::getConfig();
                $js_swf = 'swfobject.js';
                $js_avr = 'avreloaded.js';
                $js_wmv = 'wmvplayer.js';
                $debug = $cfg->getValue('config.debug');
                $konqcheck = strpos(strtolower($_SERVER['HTTP_USER_AGENT']), "konqueror");
                // If global debugging is enabled or the browser is konqueror,
                // we use uncompressed JavaScript
                if ($debug || $konqcheck) {
                    $js_swf = 'swfobject-uncompressed.js';
                    $js_avr = 'avreloaded-uncompressed.js';
                    $js_wmv = 'wmvplayer-uncompressed.js';
                }
                if (is_int(strpos($data->code, 'swfobject.'))) {
                    JHTML::script($js_swf, 'plugins/content/avreloaded/');
                }
                if (is_int(strpos($data->code, 'jeroenwijering.'))) {
                    JHTML::script('silverlight.js', 'plugins/content/avreloaded/');
                    JHTML::script($js_wmv, 'plugins/content/avreloaded/');
                }
                JHTML::script($js_avr, 'plugins/content/avreloaded/');
                $ret = $data->code;
            }
        }
        return $ret;
    }
}
