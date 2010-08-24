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
// @(#) $Id: class.user.php 3878 2009-05-14 17:04:26Z glen $
//


/**
 * Class to handle the business logic related to the administration
 * of users and permissions in the system.
 *
 * @version 1.0
 * @author João Prado Maia <jpm@mysql.com>
 */

class User
{

    // definition of roles
    private static $roles = array(
        1 => "Viewer",
        2 => "Reporter",
        3 => "Customer",
        4 => "Standard User",
        5 => "Developer",
        6 => "Manager",
        7 => "Administrator"
    );

    private static $localized_roles;
    private static function getLocalizedRoles()
    {
        if (is_null(self::$localized_roles)) {
            foreach (self::$roles as $id => $role) {
                self::$localized_roles[$id] = ev_gettext($role);
            }
        }
        return self::$localized_roles;
    }

    /**
     * Method to reset localized roles, i.e after changing active language.
     */
    public static function resetLocalizedRoles()
    {
        self::$localized_roles = null;
    }

    /**
     * Method used to get the user ID associated with the given customer
     * contact ID.
     *
     * @access  public
     * @param   integer $customer_contact_id The customer contact ID
     * @return  integer The user ID
     */
    function getUserIDByContactID($customer_contact_id)
    {
        $stmt = "SELECT
                    usr_id
                 FROM
                    " . APP_DEFAULT_DB . "." . APP_TABLE_PREFIX . "user
                 WHERE
                    usr_customer_contact_id=" . Misc::escapeInteger($customer_contact_id);
        $res = DB_Helper::getInstance()->getOne($stmt);
        if (PEAR::isError($res)) {
            Error_Handler::logError(array($res->getMessage(), $res->getDebugInfo()), __FILE__, __LINE__);
            return '';
        } else {
            return $res;
        }
    }


    /**
     * Method used to get the account email address associated with the given
     * customer contact ID.
     *
     * @access  public
     * @param   integer $customer_contact_id The customer contact ID
     * @return  string The user's email address
     */
    function getEmailByContactID($customer_contact_id)
    {
        $stmt = "SELECT
                    usr_email
                 FROM
                    " . APP_DEFAULT_DB . "." . APP_TABLE_PREFIX . "user
                 WHERE
                    usr_customer_contact_id=" . Misc::escapeInteger($customer_contact_id);
        $res = DB_Helper::getInstance()->getOne($stmt);
        if (PEAR::isError($res)) {
            Error_Handler::logError(array($res->getMessage(), $res->getDebugInfo()), __FILE__, __LINE__);
            return '';
        } else {
            return $res;
        }
    }


    /**
     * Method used to get the SMS email address associated with the given
     * user ID.
     *
     * @access  public
     * @param   integer $usr_id The user ID
     * @return  string The user's SMS email address
     */
    function getSMS($usr_id)
    {
        $stmt = "SELECT
                    usr_sms_email
                 FROM
                    " . APP_DEFAULT_DB . "." . APP_TABLE_PREFIX . "user
                 WHERE
                    usr_id=" . Misc::escapeInteger($usr_id);
        $res = DB_Helper::getInstance()->getOne($stmt);
        if (PEAR::isError($res)) {
            Error_Handler::logError(array($res->getMessage(), $res->getDebugInfo()), __FILE__, __LINE__);
            return '';
        } else {
            return $res;
        }
    }


    /**
     * Method used to update the SMS email address associated with the given
     * user ID.
     *
     * @access  public
     * @param   integer $usr_id The user ID
     * @param   string $sms_email The user's SMS email address
     * @return  boolean Whether the update was successfull or not
     */
    function updateSMS($usr_id, $sms_email)
    {
        $stmt = "UPDATE
                    " . APP_DEFAULT_DB . "." . APP_TABLE_PREFIX . "user
                 SET
                    usr_sms_email='" . Misc::escapeString($sms_email) . "'
                 WHERE
                    usr_id=" . Misc::escapeInteger($usr_id);
        $res = DB_Helper::getInstance()->query($stmt);
        if (PEAR::isError($res)) {
            Error_Handler::logError(array($res->getMessage(), $res->getDebugInfo()), __FILE__, __LINE__);
            return false;
        } else {
            return true;
        }
    }


    /**
     * Method used to get the customer contact ID associated with
     * the given user ID.
     *
     * @access  public
     * @param   integer $usr_id The user ID
     * @return  integer The customer contact ID
     */
    function getCustomerContactID($usr_id)
    {
        $stmt = "SELECT
                    usr_customer_contact_id
                 FROM
                    " . APP_DEFAULT_DB . "." . APP_TABLE_PREFIX . "user
                 WHERE
                    usr_id=" . Misc::escapeInteger($usr_id);
        $res = DB_Helper::getInstance()->getOne($stmt);
        if (PEAR::isError($res)) {
            Error_Handler::logError(array($res->getMessage(), $res->getDebugInfo()), __FILE__, __LINE__);
            return -1;
        } else {
            return $res;
        }
    }


    /**
     * Method used to get the customer ID associated with
     * the given user ID.
     *
     * @access  public
     * @param   integer $usr_id The user ID
     * @return  integer The customer ID
     */
    function getCustomerID($usr_id)
    {
        static $returns;

        if (!empty($returns[$usr_id])) {
            return $returns[$usr_id];
        }

        $stmt = "SELECT
                    usr_customer_id
                 FROM
                    " . APP_DEFAULT_DB . "." . APP_TABLE_PREFIX . "user
                 WHERE
                    usr_id=" . Misc::escapeInteger($usr_id);
        $res = DB_Helper::getInstance()->getOne($stmt);
        if (PEAR::isError($res)) {
            Error_Handler::logError(array($res->getMessage(), $res->getDebugInfo()), __FILE__, __LINE__);
            return -1;
        } else {
            $returns[$usr_id] = $res;
            return $res;
        }
    }


    /**
     * Method used to update the user account and set the user as a confirmed one.
     *
     * @access  public
     * @param   string $email The email address
     * @return  boolean
     */
    function confirmVisitorAccount($email)
    {
        $stmt = "UPDATE
                    " . APP_DEFAULT_DB . "." . APP_TABLE_PREFIX . "user
                 SET
                    usr_status='active'
                 WHERE
                    usr_email='" . Misc::escapeString($email) . "'";
        $res = DB_Helper::getInstance()->query($stmt);
        if (PEAR::isError($res)) {
            Error_Handler::logError(array($res->getMessage(), $res->getDebugInfo()), __FILE__, __LINE__);
            return false;
        } else {
            return true;
        }
    }


    /**
     * Method used to check whether the hash passed in the confirmation URL is
     * a valid one when comparing against the provided email address.
     *
     * @access  public
     * @param   string $email The email address associated with the user account
     * @param   string $hash The md5 hash string to be checked against
     * @return  integer -1 if there was an error in the query, -2 for users that don't exist,
     *                  -3 if it cannot be authenticated and 1 if it did work
     */
    function checkHash($email, $hash)
    {
        $stmt = "SELECT
                    usr_full_name
                 FROM
                    " . APP_DEFAULT_DB . "." . APP_TABLE_PREFIX . "user
                 WHERE
                    usr_email='" . Misc::escapeString($email) . "'";
        $res = DB_Helper::getInstance()->getOne($stmt);
        if (PEAR::isError($res)) {
            Error_Handler::logError(array($res->getMessage(), $res->getDebugInfo()), __FILE__, __LINE__);
            return -1;
        } else {
            if ($res == NULL) {
                return -2;
            } else {
                $check_hash = md5($res . md5($email) . Auth::privateKey());
                if ($hash != $check_hash) {
                    return -3;
                } else {
                    return 1;
                }
            }
        }
    }


    /**
     * Method used to create a new user account with pending status and send a
     * confirmation email to the prospective user.
     *
     * @access  public
     * @param   string $role The user role
     * @param   array $projects The list of projects that this user will be associated with
     * @return  integer 1 if the creation worked, -1 otherwise
     */
    function createVisitorAccount($role, $projects)
    {
        // check for double submits
        if (Auth::userExists($_POST["email"])) {
            return -2;
        }
        $prefs = serialize(Prefs::getDefaults($projects));
        $stmt = "INSERT INTO
                    " . APP_DEFAULT_DB . "." . APP_TABLE_PREFIX . "user
                 (
                    usr_created_date,
                    usr_password,
                    usr_full_name,
                    usr_email,
                    usr_preferences,
                    usr_status
                 ) VALUES (
                    '" . Date_Helper::getCurrentDateGMT() . "',
                    '" . Auth::hashPassword(Misc::escapeString($_POST["passwd"])) . "',
                    '" . Misc::escapeString($_POST["full_name"]) . "',
                    '" . Misc::escapeString($_POST["email"]) . "',
                    '" . Misc::escapeString($prefs) . "',
                    'pending'
                 )";
        $res = DB_Helper::getInstance()->query($stmt);
        if (PEAR::isError($res)) {
            Error_Handler::logError(array($res->getMessage(), $res->getDebugInfo()), __FILE__, __LINE__);
            return -1;
        } else {
            $new_usr_id = DB_Helper::get_last_insert_id();
            // add the project associations!
            for ($i = 0; $i < count($projects); $i++) {
                Project::associateUser($projects[$i], $new_usr_id, $role);
            }
            // send confirmation email to user
            $hash = md5($_POST["full_name"] . md5($_POST["email"]) . Auth::privateKey());

            $tpl = new Template_Helper();
            $tpl->setTemplate('notifications/visitor_account.tpl.text');
            $tpl->bulkAssign(array(
                "app_title"   => Misc::getToolCaption(),
                "email"     =>  $_POST['email'],
                'hash'      =>  $hash
            ));
            $text_message = $tpl->getTemplateContents();

            $setup = Setup::load();
            $mail = new Mail_Helper;
            // need to make this message MIME based
            $mail->setTextBody($text_message);
            $mail->send($setup["smtp"]["from"], $_POST["email"], APP_SHORT_NAME . ": New Account - Confirmation Required");
            return 1;
        }
    }


    /**
     * Method used to send a confirmation email to the user that is associated
     * to the email address.
     *
     * @access  public
     * @param   string $usr_id The user ID
     * @return  void
     */
    function sendPasswordConfirmationEmail($usr_id)
    {
        $info = self::getDetails($usr_id);
        // send confirmation email to user
        $hash = md5($info["usr_full_name"] . md5($info["usr_email"]) . Auth::privateKey());

        $tpl = new Template_Helper();
        $tpl->setTemplate('notifications/password_confirmation.tpl.text');
        $tpl->bulkAssign(array(
            "app_title" => Misc::getToolCaption(),
            "user"      =>  $info,
            'hash'      =>  $hash
        ));
        $text_message = $tpl->getTemplateContents();

        $setup = Setup::load();
        $mail = new Mail_Helper;
        // need to make this message MIME based
        $mail->setTextBody($text_message);
        $mail->send($setup["smtp"]["from"], $info["usr_email"], APP_SHORT_NAME . ": New Password - Confirmation Required");
    }


    /**
     * Method used to confirm the request of a new password and send an email
     * to the user with the new random password.
     *
     * @access  public
     * @param   string $email The email address
     * @return  void
     */
    function confirmNewPassword($email)
    {
        $usr_id = self::getUserIDByEmail($email);
        // create the new password
        $_POST["new_password"] = substr(md5(microtime() . uniqid("")), 0, 12);
        $_POST["confirm_password"] = $_POST["new_password"];
        self::updatePassword($usr_id, true);
    }


    /**
     * Method used to lookup the user ID of a given email address.
     *
     * @access  public
     * @param   string $email The email address associated with the user account
     * @param   boolean $check_aliases If user aliases should be checked as well.
     * @return  integer The user ID
     */
    function getUserIDByEmail($email, $check_aliases = false)
    {
        static $returns;

        if (!is_string($email)) {
            if (PEAR::isError($email)) {
                Error_Handler::logError(array($email->getMessage(), $email->getDebugInfo()), __FILE__, __LINE__);
                return null;
            }

            Error_Handler::logError('$email parameter is not a string: '.gettype($email), __FILE__, __LINE__);
            return null;
        }

        if (!empty($returns[$email])) {
            return $returns[$email];
        }

        $stmt = "SELECT
                    usr_id
                 FROM
                    " . APP_DEFAULT_DB . "." . APP_TABLE_PREFIX . "user
                 WHERE
                    usr_email='" . Misc::escapeString($email) . "'";
        $res = DB_Helper::getInstance()->getOne($stmt);
        if (PEAR::isError($res)) {
            Error_Handler::logError(array($res->getMessage(), $res->getDebugInfo()), __FILE__, __LINE__);
            return "";
        } else {
            if ((empty($res)) && ($check_aliases)) {
                $returns[$email] = self::getUserIDByAlias($email);
            } else {
                $returns[$email] = $res;
            }
            return $returns[$email];
        }
    }


    /**
     * Method used to check whether an user is set to status active
     * or not.
     *
     * @access  public
     * @param   string $status The status of the user
     * @return  boolean
     */
    function isActiveStatus($status)
    {
        if ($status == 'active') {
            return true;
        } else {
            return false;
        }
    }


    /**
     * Method used to check whether an user is set to status pending
     * or not.
     *
     * @access  public
     * @param   string $status The status of the user
     * @return  boolean
     */
    function isPendingStatus($status)
    {
        if ($status == 'pending') {
            return true;
        } else {
            return false;
        }
    }


    /**
     * Method used to get the list of all active users available in the system
     * as an associative array of user IDs => user full names.
     *
     * @access  public
     * @param   integer $prj_id The id of the project to show users from
     * @param   integer $role The role ID of the user
     * @param   boolean $exclude_grouped If users with a group should be excluded
     * @Param   integer $grp_id The ID of the group.
     * @return  array The associative array of users
     */
    function getActiveAssocList($prj_id = false, $role = NULL, $exclude_grouped = false, $grp_id = false)
    {
        $grp_id = Misc::escapeInteger($grp_id);
        $stmt = "SELECT
                    usr_id,
                    usr_full_name
                 FROM
                    " . APP_DEFAULT_DB . "." . APP_TABLE_PREFIX . "user";
        if ($prj_id != false) {
            $stmt .= ",
                    " . APP_DEFAULT_DB . "." . APP_TABLE_PREFIX . "project_user\n";
        }
        $stmt .= "
                 WHERE
                    usr_status='active' AND
                    usr_id != " . APP_SYSTEM_USER_ID;
        if ($prj_id != false) {
            $stmt .= " AND pru_prj_id = " . Misc::escapeInteger($prj_id) . " AND
                       usr_id = pru_usr_id";
            if ($role != NULL) {
                $stmt .= " AND pru_role > $role ";
            }
        }
        if ($grp_id != false) {
            if ($exclude_grouped == false) {
                $stmt .= " AND (usr_grp_id IS NULL OR usr_grp_id = $grp_id)";
            } else {
                $stmt .= " AND usr_grp_id = $grp_id";
            }
        } elseif ($exclude_grouped == true) {
            $stmt .= " AND usr_grp_id IS NULL";
        }
        $stmt .= "
                 ORDER BY
                    usr_full_name ASC";
        $res = DB_Helper::getInstance()->getAssoc($stmt);
        if (PEAR::isError($res)) {
            Error_Handler::logError(array($res->getMessage(), $res->getDebugInfo()), __FILE__, __LINE__);
            return "";
        } else {
            return $res;
        }
    }

    /**
     * Method used to get an associative array of the available roles.
     *
     * @access  public
     * @return  array The list of roles
     */
    function getAssocRoleIDs()
    {
        $assoc_roles = array();
        foreach (self::$roles as $key => $value) {
            $value = str_replace(" ", "_", strtolower($value));
            $assoc_roles[$value] = (integer) $key;
        }
        return $assoc_roles;
    }


    /**
     * Method used to get the full list of roles available in the
     * system.
     *
     * @access  public
     * @param   array $exclude_role The list of roles to ignore
     * @return  array The list of roles
     */
    function getRoles($exclude_role = null)
    {
        if (empty($exclude_role)) {
            return self::getLocalizedRoles();
        }

        $roles = self::getLocalizedRoles();
        if (!is_array($exclude_role)) {
            $exclude_role = array($exclude_role);
        }

        foreach ($exclude_role as $role_title) {
            unset($roles[self::getRoleID($role_title)]);
        }

        return $roles;
    }


    /**
     * Method used to get the role title for a specific role ID.
     *
     * @access  public
     * @param   integer $role_id The role ID
     * @return  string The role title
     */
    function getRole($role_id)
    {
        $roles = self::getLocalizedRoles();
        // XXX manage/custom_fields.php uses role_id = 9 as "Never Display", which is hack
        return isset($roles[$role_id]) ? $roles[$role_id] : null;
    }


    /**
     * Method used to get the role ID for a specific role title.
     *
     * @access  public
     * @param   string $role_title The role title
     * @return  integer The role ID
     */
    function getRoleID($role_title)
    {
        foreach (self::$roles as $role_id => $role) {
            if (strtolower($role) == strtolower($role_title)) {
                return $role_id;
            }
        }
    }


    /**
     * Method used to get the role for a specific user and project.
     *
     * @access  public
     * @param   integer $usr_id The user ID
     * @param   integer $prj_id The project ID
     * @return  integer The role ID
     */
    function getRoleByUser($usr_id, $prj_id)
    {
        static $returns;

        if ($usr_id == APP_SYSTEM_USER_ID) {
            return self::getRoleID("Administrator");
        }

        if (!empty($returns[$usr_id][$prj_id])) {
            return $returns[$usr_id][$prj_id];
        }

        $stmt = "SELECT
                    pru_role
                 FROM
                    " . APP_DEFAULT_DB . "." . APP_TABLE_PREFIX . "project_user
                 WHERE
                    pru_usr_id=" . Misc::escapeInteger($usr_id) . " AND
                    pru_prj_id = " . Misc::escapeInteger($prj_id);
        $res = DB_Helper::getInstance()->getOne($stmt);
        if (PEAR::isError($res)) {
            return "";
        } else {
            $returns[$usr_id][$prj_id] = $res;
            return $res;
        }
    }


    /**
     * Method used to get the account details of a specific user.
     *
     * @access  public
     * @param   integer $usr_id The user ID
     * @return  array The account details
     */
    function getDetails($usr_id)
    {
        static $returns;

        if (!empty($returns[$usr_id])) {
            return $returns[$usr_id];
        }

        $stmt = "SELECT
                    *
                 FROM
                    " . APP_DEFAULT_DB . "." . APP_TABLE_PREFIX . "user
                 WHERE
                    usr_id=" . Misc::escapeInteger($usr_id);
        $res = DB_Helper::getInstance()->getRow($stmt, DB_FETCHMODE_ASSOC);
        if (PEAR::isError($res)) {
            Error_Handler::logError(array($res->getMessage(), $res->getDebugInfo()), __FILE__, __LINE__);
            return null;
        }

        // do not fill empty projects, roles, groups for inexistent users
        if (!empty($res)) {
            $roles =  Project::getAssocList($usr_id, false, true);
            $res['projects'] = @array_keys($roles);
            $res['roles'] = $roles;
            $res['group'] = Group::getName($res['usr_grp_id']);
        }

        $returns[$usr_id] = $res;
        return $res;
    }


    /**
     * Method used to get the full name of the specified user.
     *
     * @access  public
     * @param   integer $usr_id The user ID
     * @return  string The user' full name
     */
    function getFullName($usr_id)
    {
        static $returns;

        if (!is_array($usr_id)) {
            $items = array($usr_id);
        } else {
            $items = $usr_id;
        }

        $key = md5(serialize($usr_id));
        if (!empty($returns[$key])) {
            return $returns[$key];
        }

        if (count($items) < 1) {
            if (!is_array($usr_id)) {
                return '';
            } else {
                return array();
            }
        }

        $stmt = "SELECT
                    usr_full_name
                 FROM
                    " . APP_DEFAULT_DB . "." . APP_TABLE_PREFIX . "user
                 WHERE
                    usr_id IN (" . implode(', ', Misc::escapeInteger($items)) . ")";
        if (!is_array($usr_id)) {
            $res = DB_Helper::getInstance()->getOne($stmt);
        } else {
            $res = DB_Helper::getInstance()->getCol($stmt);
        }
        if (PEAR::isError($res)) {
            Error_Handler::logError(array($res->getMessage(), $res->getDebugInfo()), __FILE__, __LINE__);
            return "";
        } else {
            $returns[$key] = $res;
            return $res;
        }
    }


    /**
     * Method used to get the email address of the specified user.
     *
     * @access  public
     * @param   integer $usr_id The user ID or user ids
     * @return  string The user' full name
     */
    function getEmail($usr_id)
    {
        static $returns;

        if (!is_array($usr_id)) {
            $items = array($usr_id);
        } else {
            $items = $usr_id;
        }

        $key = md5(serialize($usr_id));
        if (!empty($returns[$key])) {
            return $returns[$key];
        }

        if (count($items) < 1) {
            if (!is_array($usr_id)) {
                return '';
            } else {
                return array();
            }
        }

        $stmt = "SELECT
                    usr_email
                 FROM
                    " . APP_DEFAULT_DB . "." . APP_TABLE_PREFIX . "user
                 WHERE
                    usr_id IN (" . implode(', ', Misc::escapeInteger($items)) . ")";
        if (!is_array($usr_id)) {
            $res = DB_Helper::getInstance()->getOne($stmt);
        } else {
            $res = DB_Helper::getInstance()->getCol($stmt);
        }
        if (PEAR::isError($res)) {
            Error_Handler::logError(array($res->getMessage(), $res->getDebugInfo()), __FILE__, __LINE__);
            if (!is_array($usr_id)) {
                return '';
            } else {
                return array();
            }
        } else {
            $returns[$key] = $res;
            return $res;
        }
    }


    /**
     * Method used to get the group id of the specified user.
     *
     * @access  public
     * @param   integer $usr_id The user ID
     * @return  string The user' full name
     */
    function getGroupID($usr_id)
    {
        static $returns;

        if (!is_array($usr_id)) {
            $items = array($usr_id);
        } else {
            $items = $usr_id;
        }

        $key = md5(serialize($usr_id));
        if (!empty($returns[$key])) {
            return $returns[$key];
        }

        $stmt = "SELECT
                    usr_grp_id
                 FROM
                    " . APP_DEFAULT_DB . "." . APP_TABLE_PREFIX . "user
                 WHERE
                    usr_id IN (" . implode(', ', Misc::escapeInteger($items)) . ")";
        if (!is_array($usr_id)) {
            $res = DB_Helper::getInstance()->getOne($stmt);
        } else {
            $res = DB_Helper::getInstance()->getCol($stmt);
        }
        if (PEAR::isError($res)) {
            Error_Handler::logError(array($res->getMessage(), $res->getDebugInfo()), __FILE__, __LINE__);
            return "";
        } else {
            $returns[$key] = $res;
            return $res;
        }
    }


    /**
     * Returns the status of the user associated with the given email address.
     *
     * @access  public
     * @param   string $email The email address
     * @return  string The user status
     */
    function getStatusByEmail($email)
    {
        static $returns;

        if (isset($returns[$email])) {
            return $returns[$email];
        }

        $stmt = "SELECT
                    usr_status
                 FROM
                    " . APP_DEFAULT_DB . "." . APP_TABLE_PREFIX . "user
                 WHERE
                    usr_email='" . Misc::escapeString($email) . "'";
        $res = DB_Helper::getInstance()->getOne($stmt);
        if (PEAR::isError($res)) {
            Error_Handler::logError(array($res->getMessage(), $res->getDebugInfo()), __FILE__, __LINE__);
            return '';
        } else {
            $returns[$email] = $res;
            return $res;
        }
    }


    /**
     * Method used to change the status of users, making them inactive
     * or active.
     *
     * @access  public
     * @return  boolean
     */
    function changeStatus()
    {
        // check if the user being inactivated is the last one
        $stmt = "SELECT
                    COUNT(*)
                 FROM
                    " . APP_DEFAULT_DB . "." . APP_TABLE_PREFIX . "user
                 WHERE
                    usr_status='active'";
        $total_active = DB_Helper::getInstance()->getOne($stmt);
        if (($total_active < 2) && ($_POST["status"] == "inactive")) {
            return false;
        }

        $items = @implode(", ", Misc::escapeInteger($_POST["items"]));
        $stmt = "UPDATE
                    " . APP_DEFAULT_DB . "." . APP_TABLE_PREFIX . "user
                 SET
                    usr_status='" . $_POST["status"] . "'
                 WHERE
                    usr_id IN ($items)";
        $res = DB_Helper::getInstance()->query($stmt);
        if (PEAR::isError($res)) {
            Error_Handler::logError(array($res->getMessage(), $res->getDebugInfo()), __FILE__, __LINE__);
            return false;
        } else {
            return true;
        }
    }


    /**
     * Method used to update the account password for a specific user.
     *
     * @access  public
     * @param   integer $usr_id The user ID
     * @param   boolean $send_notification Whether to send the notification email or not
     * @return  integer 1 if the update worked, -1 otherwise
     */
    function updatePassword($usr_id, $send_notification = FALSE)
    {
        if ($_POST['new_password'] != $_POST['confirm_password']) {
            return -2;
        }
        $stmt = "UPDATE
                    " . APP_DEFAULT_DB . "." . APP_TABLE_PREFIX . "user
                 SET
                    usr_password='" . Auth::hashPassword($_POST["new_password"]) . "'
                 WHERE
                    usr_id=" . Misc::escapeInteger($usr_id);
        $res = DB_Helper::getInstance()->query($stmt);
        if (PEAR::isError($res)) {
            Error_Handler::logError(array($res->getMessage(), $res->getDebugInfo()), __FILE__, __LINE__);
            return -1;
        } else {
            if ($send_notification) {
                Notification::notifyUserPassword($usr_id, $_POST["new_password"]);
            }
            return 1;
        }
    }


    /**
     * Method used to update the account full name for a specific user.
     *
     * @access  public
     * @param   integer $usr_id The user ID
     * @return  integer 1 if the update worked, -1 otherwise
     */
    function updateFullName($usr_id)
    {
        $stmt = "UPDATE
                    " . APP_DEFAULT_DB . "." . APP_TABLE_PREFIX . "user
                 SET
                    usr_full_name='" . Misc::escapeString($_POST["full_name"]) . "'
                 WHERE
                    usr_id=" . Misc::escapeInteger($usr_id);
        $res = DB_Helper::getInstance()->query($stmt);
        if (PEAR::isError($res)) {
            Error_Handler::logError(array($res->getMessage(), $res->getDebugInfo()), __FILE__, __LINE__);
            return -1;
        } else {
            Notification::notifyUserAccount($usr_id);
            return 1;
        }
    }


    /**
     * Method used to update the account email for a specific user.
     *
     * @access  public
     * @param   integer $usr_id The user ID
     * @return  integer 1 if the update worked, -1 otherwise
     */
    function updateEmail($usr_id)
    {
        $stmt = "UPDATE
                    " . APP_DEFAULT_DB . "." . APP_TABLE_PREFIX . "user
                 SET
                    usr_email='" . Misc::escapeString($_POST["email"]) . "'
                 WHERE
                    usr_id=" . Misc::escapeInteger($usr_id);
        $res = DB_Helper::getInstance()->query($stmt);
        if (PEAR::isError($res)) {
            Error_Handler::logError(array($res->getMessage(), $res->getDebugInfo()), __FILE__, __LINE__);
            return -1;
        } else {
            Notification::notifyUserAccount($usr_id);
            return 1;
        }
    }


    /**
     * Method used to update the account details for a specific user.
     *
     * @access  public
     * @return  integer 1 if the update worked, -1 otherwise
     */
    function update()
    {
        // system account should not be updateable
        if ($_POST["id"] == APP_SYSTEM_USER_ID) {
            return 1;
        }
        $group_id = ($_POST["grp_id"]) ? Misc::escapeInteger($_POST["grp_id"]) : 'NULL';
        $stmt = "UPDATE
                    " . APP_DEFAULT_DB . "." . APP_TABLE_PREFIX . "user
                 SET
                    usr_full_name='" . Misc::escapeString($_POST["full_name"]) . "',
                    usr_email='"     . Misc::escapeString($_POST["email"])     . "',
                    usr_grp_id="     . $group_id;
        if (!empty($_POST["password"])) {
            $stmt .= ",
                    usr_password='" . Auth::hashPassword($_POST["password"]) . "'";
        }
        $stmt .= "
                 WHERE
                    usr_id=" . Misc::escapeInteger($_POST["id"]);
        $res = DB_Helper::getInstance()->query($stmt);
        if (PEAR::isError($res)) {
            Error_Handler::logError(array($res->getMessage(), $res->getDebugInfo()), __FILE__, __LINE__);
            return -1;
        } else {
            // update the project associations now
            $stmt = "DELETE FROM
                        " . APP_DEFAULT_DB . "." . APP_TABLE_PREFIX . "project_user
                     WHERE
                        pru_usr_id=" . Misc::escapeInteger($_POST["id"]);
            $res = DB_Helper::getInstance()->query($stmt);
            if (PEAR::isError($res)) {
                Error_Handler::logError(array($res->getMessage(), $res->getDebugInfo()), __FILE__, __LINE__);
                return -1;
            } else {
                foreach ($_POST["role"] as $prj_id => $role) {
                    if ($role < 1) {
                        continue;
                    }
                    $stmt = "INSERT INTO
                                " . APP_DEFAULT_DB . "." . APP_TABLE_PREFIX . "project_user
                             (
                                pru_prj_id,
                                pru_usr_id,
                                pru_role
                             ) VALUES (
                                " . $prj_id . ",
                                " . Misc::escapeInteger($_POST["id"]) . ",
                                " . $role . "
                             )";
                    $res = DB_Helper::getInstance()->query($stmt);
                    if (PEAR::isError($res)) {
                        Error_Handler::logError(array($res->getMessage(), $res->getDebugInfo()), __FILE__, __LINE__);
                        return -1;
                    }
                }
            }
            if (!empty($_POST["password"])) {
                Notification::notifyUserPassword($_POST["id"], $_POST["password"]);
            } else {
                Notification::notifyUserAccount($_POST["id"]);
            }
            return 1;
        }
    }


    /**
     * Method used to add a new user to the system.
     *
     * @access  public
     * @return  integer 1 if the update worked, -1 otherwise
     */
    function insert()
    {
        $projects = array();
        foreach ($_POST["role"] as $prj_id => $role) {
            if ($role < 1) {
                continue;
            }
            $projects[] = $prj_id;
        }
        $prefs = serialize(Prefs::getDefaults($projects));
        $stmt = "INSERT INTO
                    " . APP_DEFAULT_DB . "." . APP_TABLE_PREFIX . "user
                 (
                    usr_customer_id,
                    usr_customer_contact_id,
                    usr_created_date,
                    usr_password,
                    usr_full_name,
                    usr_email,
                    usr_preferences
                 ) VALUES (
                    NULL,
                    NULL,
                    '" . Date_Helper::getCurrentDateGMT() . "',
                    '" . Auth::hashPassword(Misc::escapeString($_POST["password"])) . "',
                    '" . Misc::escapeString($_POST["full_name"]) . "',
                    '" . Misc::escapeString($_POST["email"]) . "',
                    '" . Misc::escapeString($prefs) . "'
                 )";
        $res = DB_Helper::getInstance()->query($stmt);
        if (PEAR::isError($res)) {
            Error_Handler::logError(array($res->getMessage(), $res->getDebugInfo()), __FILE__, __LINE__);
            return -1;
        } else {
            $new_usr_id = DB_Helper::get_last_insert_id();
            // add the project associations!
            foreach ($_POST["role"] as $prj_id => $role) {
                if ($role < 1) {
                    continue;
                }
                Project::associateUser($prj_id, $new_usr_id, $role);
            }
            // send email to user
            Notification::notifyNewUser($new_usr_id, $_POST["password"]);
            return 1;
        }
    }


    /**
     * Method used to get the list of users available in the system.
     *
     * @access  public
     * @param   boolean $show_customers Whether to return customers or not
     * @return  array The list of users
     */
    function getList($show_customers)
    {
        $stmt = "SELECT
                    *
                 FROM
                    " . APP_DEFAULT_DB . "." . APP_TABLE_PREFIX . "user
                 WHERE
                    usr_id != " . APP_SYSTEM_USER_ID . "
                 ORDER BY
                    usr_status ASC,
                    usr_full_name ASC";
        $res = DB_Helper::getInstance()->getAll($stmt, DB_FETCHMODE_ASSOC);
        if (PEAR::isError($res)) {
            Error_Handler::logError(array($res->getMessage(), $res->getDebugInfo()), __FILE__, __LINE__);
            return "";
        } else {
            $data = array();
            $count = count($res);
            for ($i = 0; $i < $count; $i++) {
                $roles = Project::getAssocList($res[$i]['usr_id'], false, true);
                $role = current($roles);
                $role = $role['pru_role'];
                if (($show_customers == false) && (
                    ((@$roles[Auth::getCurrentProject()]['pru_role']) == self::getRoleID("Customer")) ||
                    ((count($roles) == 1) && ($role == self::getRoleID("Customer"))))) {
                    continue;
                }
                $row = $res[$i];
                $row["roles"] = $roles;
                if (!empty($res[$i]["usr_grp_id"])) {
                    $row["group_name"] = Group::getName($res[$i]["usr_grp_id"]);
                }
                $data[] = $row;
            }
            return $data;
        }
    }


    /**
     * Method used to get an associative array of the user's email address and
     * user ID.
     *
     * @access  public
     * @return  array The list of users
     */
    function getAssocEmailList()
    {
        static $emails;

        if (!empty($emails)) {
            return $emails;
        }

        $stmt = "SELECT
                    LOWER(usr_email),
                    usr_id
                 FROM
                    " . APP_DEFAULT_DB . "." . APP_TABLE_PREFIX . "user";
        $res = DB_Helper::getInstance()->getAssoc($stmt);
        if (PEAR::isError($res)) {
            Error_Handler::logError(array($res->getMessage(), $res->getDebugInfo()), __FILE__, __LINE__);
            return "";
        } else {
            $emails = $res;
            return $res;
        }
    }


    /**
     * Method used to get an associative array of the user ID and
     * full name of the users available in the system.
     *
     * @access  public
     * @return  array The list of users
     */
    function getAssocList()
    {
        $stmt = "SELECT
                    usr_id,
                    usr_full_name
                 FROM
                    " . APP_DEFAULT_DB . "." . APP_TABLE_PREFIX . "user
                 ORDER BY
                    usr_full_name ASC";
        $res = DB_Helper::getInstance()->getAssoc($stmt);
        if (PEAR::isError($res)) {
            Error_Handler::logError(array($res->getMessage(), $res->getDebugInfo()), __FILE__, __LINE__);
            return "";
        } else {
            return $res;
        }
    }


    /**
     * Method used to get the full name and email for the specified
     * user.
     *
     * @access  public
     * @param   integer $usr_id The user ID
     * @return  array The email and full name
     */
    function getNameEmail($usr_id)
    {
        static $returns;

        if (!empty($returns[$usr_id])) {
            return $returns[$usr_id];
        }

        $stmt = "SELECT
                    usr_full_name,
                    usr_email
                 FROM
                    " . APP_DEFAULT_DB . "." . APP_TABLE_PREFIX . "user
                 WHERE
                    usr_id=" . Misc::escapeInteger($usr_id);
        $res = DB_Helper::getInstance()->getRow($stmt, DB_FETCHMODE_ASSOC);
        if (PEAR::isError($res)) {
            Error_Handler::logError(array($res->getMessage(), $res->getDebugInfo()), __FILE__, __LINE__);
            return "";
        } else {
            $returns[$usr_id] = $res;
            return $res;
        }
    }


    /**
     * Method used to get the appropriate 'From' header for a
     * specified user.
     *
     * @access  public
     * @param   integer $usr_id The user ID
     * @return  string The formatted 'From' header
     */
    function getFromHeader($usr_id)
    {
        $info = self::getNameEmail($usr_id);
        return $info["usr_full_name"] . " <" . $info["usr_email"] . ">";
    }


    /**
     * Returns the list of all users who are currently marked as
     * clocked-in.
     *
     * @access  public
     * @return  array The list of clocked-in users
     */
    function getClockedInList()
    {
        $stmt = "SELECT
                    usr_full_name,
                    usr_email
                 FROM
                    " . APP_DEFAULT_DB . "." . APP_TABLE_PREFIX . "user
                 WHERE
                    usr_clocked_in=1";
        $res = DB_Helper::getInstance()->getAssoc($stmt);
        if (PEAR::isError($res)) {
            Error_Handler::logError(array($res->getMessage(), $res->getDebugInfo()), __FILE__, __LINE__);
            return array();
        } else {
            return $res;
        }
    }


    /**
     * Marks a user as clocked in.
     *
     * @access  public
     * @param   int $usr_id The id of the user to clock out.
     */
    function clockIn($usr_id)
    {
        $stmt = "UPDATE
                    " . APP_DEFAULT_DB . "." . APP_TABLE_PREFIX . "user
                 SET
                    usr_clocked_in = 1
                 WHERE
                    usr_id = " . Misc::escapeInteger($usr_id);
        $res = DB_Helper::getInstance()->query($stmt);
        if (PEAR::isError($res)) {
            Error_Handler::logError(array($res->getMessage(), $res->getDebugInfo()), __FILE__, __LINE__);
            return -1;
        }
        return 1;
    }


    /**
     * Marks a user as clocked out.
     *
     * @access  public
     * @param   integer $usr_id The id of the user to clock out.
     */
    function clockOut($usr_id)
    {
        $stmt = "UPDATE
                    " . APP_DEFAULT_DB . "." . APP_TABLE_PREFIX . "user
                 SET
                    usr_clocked_in = 0
                 WHERE
                    usr_id = " . Misc::escapeInteger($usr_id);
        $res = DB_Helper::getInstance()->query($stmt);
        if (PEAR::isError($res)) {
            Error_Handler::logError(array($res->getMessage(), $res->getDebugInfo()), __FILE__, __LINE__);
            return -1;
        }
        return 1;
    }


    /**
     * Returns true if a user is clocked in.
     *
     * @access  public
     * @param   integer $usr_id The id of the user to clock out.
     * @return  boolean True if the user is logged in, false otherwise
     */
    function isClockedIn($usr_id)
    {
        $stmt = "SELECT
                    usr_clocked_in
                 FROM
                    " . APP_DEFAULT_DB . "." . APP_TABLE_PREFIX . "user
                 WHERE
                    usr_id = " . Misc::escapeInteger($usr_id);
        $res = DB_Helper::getInstance()->getOne($stmt);
        if (PEAR::isError($res)) {
            Error_Handler::logError(array($res->getMessage(), $res->getDebugInfo()), __FILE__, __LINE__);
            return -1;
        }
        if ($res == 1) {
            return true;
        } else {
            return false;
        }
    }


    /**
     * Sets the group ID
     *
     * @access  public
     * @param   integer $usr_id The id of the user.
     * @param   integer $grp_id The id of the group.
     */
    function setGroupID($usr_id, $grp_id)
    {
        if ($grp_id == false) {
            $grp_id = 'null';
        } else {
            $grp_id = Misc::escapeInteger($grp_id);
        }

        $stmt = "UPDATE
                    " . APP_DEFAULT_DB . "." . APP_TABLE_PREFIX . "user
                 SET
                    usr_grp_id = $grp_id
                 WHERE
                    usr_id = " . Misc::escapeInteger($usr_id);
        $res = DB_Helper::getInstance()->query($stmt);
        if (PEAR::isError($res)) {
            Error_Handler::logError(array($res->getMessage(), $res->getDebugInfo()), __FILE__, __LINE__);
            return -1;
        }
        return 1;
    }


    function getLang($usr_id, $force_refresh = false)
    {
        static $returns;

        $usr_id = Misc::escapeInteger($usr_id);
        if ((empty($returns[$usr_id])) || ($force_refresh == true)) {
            $sql = "SELECT
                        usr_lang
                    FROM
                        " . APP_DEFAULT_DB . "." . APP_TABLE_PREFIX . "user
                    WHERE
                        usr_id = $usr_id";
            $res = DB_Helper::getInstance()->getOne($sql);
            if (PEAR::isError($res)) {
                Error_Handler::logError(array($res->getMessage(), $res->getDebugInfo()), __FILE__, __LINE__);
                return APP_DEFAULT_LOCALE;
            } else {
                if (empty($res)) {
                    $res = APP_DEFAULT_LOCALE;
                }
                $returns[$usr_id] = $res;
            }
        }
        return $returns[$usr_id];
    }


    function setLang($usr_id, $language)
    {
        $sql = "UPDATE
                    " . APP_DEFAULT_DB . "." . APP_TABLE_PREFIX . "user
                SET
                    usr_lang = '" . Misc::escapeString($language) . "'
                WHERE
                    usr_id = " . Misc::escapeInteger($usr_id);
        $res = DB_Helper::getInstance()->query($sql);
        if (PEAR::isError($res)) {
            Error_Handler::logError(array($res->getMessage(), $res->getDebugInfo()), __FILE__, __LINE__);
            return false;
        }
        return true;
    }


    function getAliases($usr_id)
    {
        $sql = "SELECT
                    ual_email
                FROM
                    " . APP_DEFAULT_DB . "." . APP_TABLE_PREFIX . "user_alias
                WHERE
                    ual_usr_id = " . Misc::escapeInteger($usr_id);
        $res = DB_Helper::getInstance()->getCol($sql);
        if (PEAR::isError($res)) {
            Error_Handler::logError(array($res->getMessage(), $res->getDebugInfo()), __FILE__, __LINE__);
            return array();
        }
        return $res;
    }

    function addAlias($usr_id, $email)
    {
        // see if alias belongs to a user right now
        $email_usr_id = self::getUserIDByEmail($email);
        if (!empty($email_usr_id)) {
            return false;
        }

        $existing_alias_usr_id = self::getUserIDByAlias($email);
        if (!empty($existing_alias_usr_id)) {
            return false;
        }

        $sql = "INSERT INTO
                    " . APP_DEFAULT_DB . "." . APP_TABLE_PREFIX . "user_alias
                SET
                    ual_usr_id = " . Misc::escapeInteger($usr_id) . ",
                    ual_email = '" . Misc::escapeString($email) . "'";
        $res = DB_Helper::getInstance()->query($sql);
        if (PEAR::isError($res)) {
            Error_Handler::logError(array($res->getMessage(), $res->getDebugInfo()), __FILE__, __LINE__);
            return false;
        }
        return true;
    }


    function removeAlias($usr_id, $email)
    {
        $sql = "DELETE FROM
                    " . APP_DEFAULT_DB . "." . APP_TABLE_PREFIX . "user_alias
                WHERE
                    ual_usr_id = " . Misc::escapeInteger($usr_id) . " AND
                    ual_email = '" . Misc::escapeString($email) . "'";
        $res = DB_Helper::getInstance()->query($sql);
        if (PEAR::isError($res)) {
            Error_Handler::logError(array($res->getMessage(), $res->getDebugInfo()), __FILE__, __LINE__);
            return false;
        }
        return true;
    }


    function getUserIDByAlias($email)
    {
        $sql = "SELECT
                    ual_usr_id
                FROM
                    " . APP_DEFAULT_DB . "." . APP_TABLE_PREFIX . "user_alias
                WHERE
                    ual_email = '" . Misc::escapeString($email) . "'";
        $res = DB_Helper::getInstance()->getOne($sql);
        if (PEAR::isError($res)) {
            Error_Handler::logError(array($res->getMessage(), $res->getDebugInfo()), __FILE__, __LINE__);
            return '';
        }
        return $res;
    }
}
