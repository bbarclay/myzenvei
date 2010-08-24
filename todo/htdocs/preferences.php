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
// @(#) $Id: preferences.php 3868 2009-03-30 00:22:35Z glen $

// delay language init if we're saving language
if (!empty($_POST['language'])) {
    define('SKIP_LANGUAGE_INIT', true);
}
require_once dirname(__FILE__) . '/../init.php';

// must do Language::setPreference before template is initialized
if (@$_POST["cat"] == "update_account") {
    if (isset($_POST['language'])) {
        $res = User::setLang(Auth::getUserID(), $_POST['language']);
        Language::setPreference();
    }
}

$tpl = new Template_Helper();
$tpl->setTemplate("preferences.tpl.html");

Auth::checkAuthentication(APP_COOKIE);

if (Auth::isAnonUser()) {
    Auth::redirect("index.php");
}

$usr_id = Auth::getUserID();

if (@$_POST["cat"] == "update_account") {
    $res = Prefs::set($usr_id);
    $tpl->assign('update_account_result', $res);
    User::updateSMS($usr_id, @$_POST['sms_email']);
} elseif (@$_POST["cat"] == "update_name") {
    $res = User::updateFullName($usr_id);
    $tpl->assign('update_name_result', $res);
} elseif (@$_POST["cat"] == "update_email") {
    $res = User::updateEmail($usr_id);
    $tpl->assign('update_email_result', $res);
} elseif (@$_POST["cat"] == "update_password") {
    $res = User::updatePassword($usr_id);
    $tpl->assign('update_password_result', $res);
}

$prefs = Prefs::get($usr_id);
$prefs['sms_email'] = User::getSMS($usr_id);
// if the user has no preferences set yet, get it from the system-wide options
if (empty($prefs)) {
    $prefs = Setup::load();
}
$tpl->assign("user_prefs", $prefs);
$tpl->assign("user_info", User::getDetails($usr_id));
$tpl->assign("assigned_projects", Project::getAssocList($usr_id, false, true));
$tpl->assign("zones", Date_Helper::getTimezoneList());
$tpl->assign('avail_langs', Language::getAvailableLanguages());
$tpl->assign('current_locale', User::getLang(Auth::getUserID(), true));

$tpl->displayTemplate();
