<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 encoding=utf-8: */
// +----------------------------------------------------------------------+
// | Eventum - Issue Tracking System                                      |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 - 2008 MySQL AB                                   |
// | Copyright (c) 2008 - 2010 Sun Microsystem Inc.                       |
// |                                                                      |
// | This program is free software; you can redistribute it and/or modify |
// | it under the terms of the GNU General Public License as published by |
// | the Free Software Foundation; either version 2 of the License, or    |
// | (at your option) any later version.                                  |
// |                                                                      |
// | This program is distributed in the hope that it will be useful,      |
// | but WITHOUT ANY WARRANTY; without even the implied warranty of       |
// | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the        |
// | GNU General Public License for more details.                         |
// |                                                                      |
// | You should have received a copy of the GNU General Public License    |
// | along with this program; if not, write to:                           |
// |                                                                      |
// | Free Software Foundation, Inc.                                       |
// | 59 Temple Place - Suite 330                                          |
// | Boston, MA 02111-1307, USA.                                          |
// +----------------------------------------------------------------------+
// | Authors: João Prado Maia <jpm@mysql.com>                             |
// +----------------------------------------------------------------------+
//
// @(#) $Id: faq.php 3868 2009-03-30 00:22:35Z glen $

require_once dirname(__FILE__) . '/../init.php';

$tpl = new Template_Helper();
$tpl->setTemplate("faq.tpl.html");

Auth::checkAuthentication(APP_COOKIE, 'index.php?err=5', true);

$usr_id = Auth::getUserID();
$prj_id = Auth::getCurrentProject();

if (!Customer::hasCustomerIntegration($prj_id)) {
    // show all FAQ entries
    $support_level_id = -1;
} else {
    if (!Customer::doesBackendUseSupportLevels($prj_id)) {
        // show all FAQ entries
        $support_level_id = -1;
    } else {
        if (Auth::getCurrentRole() != User::getRoleID('Customer')) {
            // show all FAQ entries
            $support_level_id = -1;
        } else {
            $customer_id = User::getCustomerID(Auth::getUserID());
            $support_level_id = Customer::getSupportLevelID($prj_id, $customer_id);
        }
    }
}
$tpl->assign("faqs", FAQ::getListBySupportLevel($support_level_id));

if (!empty($_GET["id"])) {
    $t = FAQ::getDetails($_GET['id']);
    // check if this customer should have access to this FAQ entry or not
    if (($support_level_id != -1) && (!in_array($support_level_id, $t['support_levels']))) {
        $tpl->assign('faq', -1);
    } else {
        $t['faq_created_date'] = Date_Helper::getFormattedDate($t["faq_created_date"]);
        $tpl->assign("faq", $t);
    }
}

$tpl->displayTemplate();
