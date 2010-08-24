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
// @(#) $Id: general.php 3868 2009-03-30 00:22:35Z glen $

require_once dirname(__FILE__) . '/../../init.php';

$tpl = new Template_Helper();
$tpl->setTemplate("manage/index.tpl.html");

Auth::checkAuthentication(APP_COOKIE);

$tpl->assign("type", "general");

$role_id = Auth::getCurrentRole();
if ($role_id == User::getRoleID('administrator')) {
    $tpl->assign("show_setup_links", true);

    $tpl->assign("project_list", Project::getAll());

    if (@$_POST["cat"] == "update") {
        $setup = array();
        $setup["tool_caption"] = $_POST["tool_caption"];
        $setup["support_email"] = $_POST["support_email"];
        $setup["daily_tips"] = $_POST["daily_tips"];
        $setup["spell_checker"] = $_POST["spell_checker"];
        $setup["irc_notification"] = $_POST["irc_notification"];
        $setup["allow_unassigned_issues"] = $_POST["allow_unassigned_issues"];
        @$setup["update"] = $_POST["update"];
        @$setup["closed"] = $_POST["closed"];
        @$setup["notes"] = $_POST["notes"];
        @$setup["emails"] = $_POST["emails"];
        @$setup["files"] = $_POST["files"];
        @$setup["smtp"] = $_POST["smtp"];
        @$setup["scm_integration"] = $_POST["scm_integration"];
        @$setup["checkout_url"] = $_POST["checkout_url"];
        @$setup["diff_url"] = $_POST["diff_url"];
        @$setup["scm_log_url"] = $_POST["scm_log_url"];
        @$setup["open_signup"] = $_POST["open_signup"];
        @$setup["accounts_projects"] = $_POST["accounts_projects"];
        @$setup["accounts_role"] = $_POST["accounts_role"];
        @$setup['subject_based_routing'] = $_POST['subject_based_routing'];
        @$setup['email_routing'] = $_POST['email_routing'];
        @$setup['note_routing'] = $_POST['note_routing'];
        @$setup['draft_routing'] = $_POST['draft_routing'];
        @$setup['email_error'] = $_POST['email_error'];
        @$setup['email_reminder'] = $_POST['email_reminder'];
        $options = Setup::load();
        @$setup['downloading_emails'] = $options['downloading_emails'];
        $res = Setup::save($setup);
        $tpl->assign("result", $res);
    }
    $options = Setup::load(true);
    $tpl->assign("setup", $options);
    $tpl->assign("user_roles", User::getRoles(array('Customer')));
} else {
    $tpl->assign("show_not_allowed_msg", true);
}

$tpl->displayTemplate();
