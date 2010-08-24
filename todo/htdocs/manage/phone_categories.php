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
// @(#) $Id: phone_categories.php 3868 2009-03-30 00:22:35Z glen $

require_once dirname(__FILE__) . '/../../init.php';

$tpl = new Template_Helper();
$tpl->setTemplate("manage/index.tpl.html");

Auth::checkAuthentication(APP_COOKIE);

$tpl->assign("type", "phone_categories");

$role_id = Auth::getCurrentRole();
if (($role_id == User::getRoleID('administrator')) || ($role_id == User::getRoleID('manager'))) {
    if ($role_id == User::getRoleID('administrator')) {
        $tpl->assign("show_setup_links", true);
    }

    @$prj_id = $_POST["prj_id"] ? $_POST["prj_id"] : $_GET["prj_id"];
    $tpl->assign("project", Project::getDetails($prj_id));

    if (@$_POST["cat"] == "new") {
        $tpl->assign("result", Phone_Support::insertCategory());
    } elseif (@$_POST["cat"] == "update") {
        $tpl->assign("result", Phone_Support::updateCategory());
    } elseif (@$_POST["cat"] == "delete") {
        Phone_Support::removeCategory();
    }

    if (@$_GET["cat"] == "edit") {
        $tpl->assign("info", Phone_Support::getCategoryDetails($_GET["id"]));
    }
    $tpl->assign("list", Phone_Support::getCategoryList($prj_id));
} else {
    $tpl->assign("show_not_allowed_msg", true);
}

$tpl->displayTemplate();