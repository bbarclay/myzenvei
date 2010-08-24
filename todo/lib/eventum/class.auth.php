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
// @(#) $Id: class.auth.php 3868 2009-03-30 00:22:35Z glen $
//


/**
 * Class to handle authentication issues.
 *
 * @version 1.0
 * @author João Prado Maia <jpm@mysql.com>
 */
class Auth
{
    /**
     * Method used to get private key used for hashing session cookies.
     *
     * @access  public
     * @return  string  The private_key hash.
     */
    public static function privateKey() {
        static $private_key = null;
        if (is_null($private_key)) {
            require_once APP_CONFIG_PATH . "/private_key.php";
        }
        return $private_key;
    }

    /**
     * Method used to save the login information into a log file. It will be
     * useful for administrative purposes, so we know which customers were able
     * to login.
     *
     * @access  public
     * @param   string $email The email associated with the user
     * @param   string $type Whether it was a successful login or not
     * @param   string $extra The reason for not being a successful login
     */
    function saveLoginAttempt($email, $type, $extra = false)
    {
        $msg = Date_Helper::getCurrentDateGMT() . " - Login attempt by '$email' was ";
        if ($type == 'success') {
            $msg .= "successful.\n";
        } else {
            $msg .= "not successful because of '$extra'.\n";
        }
        file_put_contents(APP_LOGIN_LOG, $msg, FILE_APPEND);
    }


    /**
     * Method used to check for the appropriate authentication for a specific
     * page. It will check for the cookie name provided and redirect the user
     * to another page if needed.
     *
     * @access  public
     * @param   string $cookie_name The name of the cookie to check for
     * @param   string $failed_url The URL to redirect to if the user is not authenticated
     * @param   boolean $is_popup Flag to tell the function if the current page is a popup window or not
     * @return  void
     */
    function checkAuthentication($cookie_name, $failed_url = NULL, $is_popup = false)
    {
        if ($failed_url == NULL) {
            $failed_url = APP_RELATIVE_URL . "index.php?err=5";
        }
        $failed_url .= "&url=" . urlencode($_SERVER['REQUEST_URI']);
        if (!isset($_COOKIE[$cookie_name])) {
            if (APP_ANON_USER) {
                $anon_usr_id = User::getUserIDByEmail(APP_ANON_USER);
                $prj_id = reset(array_keys(Project::getAssocList($anon_usr_id)));
                self::createFakeCookie($anon_usr_id, $prj_id);
                self::createLoginCookie(APP_COOKIE, APP_ANON_USER);
                self::setCurrentProject($prj_id, true);
                Session::init($anon_usr_id);
            } else {
                self::redirect($failed_url, $is_popup);
            }
        }
        $cookie = $_COOKIE[$cookie_name];
        $cookie = unserialize(base64_decode($cookie));
        if (!self::isValidCookie($cookie)) {
            self::removeCookie($cookie_name);
            self::redirect($failed_url, $is_popup);
        }
        if (self::isPendingUser($cookie["email"])) {
            self::removeCookie($cookie_name);
            self::redirect("index.php?err=9", $is_popup);
        }
        if (!self::isActiveUser($cookie["email"])) {
            self::removeCookie($cookie_name);
            self::redirect("index.php?err=7", $is_popup);
        }

        $usr_id = self::getUserID();

        // check the session
        Session::verify($usr_id);

        if (!defined('SKIP_LANGUAGE_INIT')) {
            Language::setPreference();
        }

        // check whether the project selection is set or not
        $prj_id = self::getCurrentProject();
        if (empty($prj_id)) {
            // redirect to select project page
            self::redirect("select_project.php?url=" . urlencode($_SERVER['REQUEST_URI']), $is_popup);
        }
        // check the expiration date for a 'Customer' type user
        $customer_id = User::getCustomerID($usr_id);
        $contact_id = User::getCustomerContactID($usr_id);
        if ((!empty($customer_id)) && ($customer_id != -1) &&
                (!empty($contact_id)) && (Customer::hasCustomerIntegration($prj_id))) {

            Customer::authenticateCustomer($prj_id, $customer_id, $contact_id);
        }

        // auto switch project
        if (isset($_GET['switch_prj_id'])) {
            self::setCurrentProject($_GET['switch_prj_id'], false);
            self::redirect($_SERVER['PHP_SELF'] . '?' . str_replace("switch_prj_id=" . $_GET['switch_prj_id'], "", $_SERVER['QUERY_STRING']));
        }

        // if the current session is still valid, then renew the expiration
        self::createLoginCookie($cookie_name, $cookie['email']);
        // renew the project cookie as well
        $prj_cookie = self::getCookieInfo(APP_PROJECT_COOKIE);
        self::setCurrentProject($prj_id, $prj_cookie["remember"]);
    }


    /**
     * Method for logging out the currently logged in user.
     *
     * @access  public
     * @returns void
     */
    function logout()
    {
        self::removeCookie(APP_COOKIE);
        // if 'remember projects' is true don't remove project cookie
        $project_cookie = self::getCookieInfo(APP_PROJECT_COOKIE);
        if (empty($project_cookie['remember'])) {
            self::removeCookie(APP_PROJECT_COOKIE);
        }
    }


    /**
     * Method to check whether an user is pending its confirmation
     * or not.
     *
     * @access  public
     * @param   string $email The email address to be checked
     * @return  boolean
     */
    function isPendingUser($email)
    {
        $status = User::getStatusByEmail($email);
        if ($status != 'pending') {
            return false;
        } else {
            return true;
        }
    }


    /**
     * Method to check whether an user is active or not.
     *
     * @access  public
     * @param   string $email The email address to be checked
     * @return  boolean
     */
    function isActiveUser($email)
    {
        $status = User::getStatusByEmail($email);
        if ($status != 'active') {
            return false;
        } else {
            return true;
        }
    }


    /**
     * Method to check if the user has cookie support enabled in his browser or
     * not.
     *
     * @access  public
     * @param   string $cookie_name The name of the cookie to check for
     * @return  boolean
     */
    function hasCookieSupport($cookie_name)
    {
        if (@!in_array($cookie_name, array_keys($_COOKIE))) {
            return false;
        } else {
            return true;
        }
    }


    /**
     * Method to check if the user has a valid cookie.
     *
     * @access  public
     * @param   string $cookie_name The name of the cookie to check for
     * @return  boolean
     */
    function hasValidCookie($cookie_name)
    {
        $cookie = @$_COOKIE[$cookie_name];
        $cookie = unserialize(base64_decode($cookie));
        if (!self::isValidCookie($cookie)) {
            return false;
        } else {
            return true;
        }
    }


    /**
     * Method to check if the current user is an anonymous user.
     *
     * @access  public
     * @return  boolean
     */
    function isAnonUser()
    {
        return self::getUserID() == User::getUserIDByEmail(APP_ANON_USER);
    }


    /**
     * Method used to get the unserialized contents of the specified cookie
     * name.
     *
     * @access  public
     * @param   string $cookie_name The name of the cookie to check for
     * @return  array The unserialized contents of the cookie
     */
    function getCookieInfo($cookie_name)
    {
        $cookie = @$_COOKIE[$cookie_name];
        return unserialize(base64_decode($cookie));
    }


    /**
     * Method used to check whether a cookie is valid or not.
     *
     * @access  public
     * @param   array $cookie The unserialized contents of the cookie
     * @return  boolean
     */
    function isValidCookie($cookie)
    {
        if ((empty($cookie["email"])) || (empty($cookie["hash"])) ||
               ($cookie["hash"] != md5(self::privateKey() . md5($cookie["login_time"]) . $cookie["email"]))) {
            return false;
        } else {
            $usr_id = User::getUserIDByEmail(@$cookie["email"]);
            if (empty($usr_id)) {
                return false;
            } else {
                return true;
            }
        }
    }


    /**
     * Method used to create the login cookie in the user's machine.
     *
     * @access  public
     * @param   string $cookie_name The cookie name to be created
     * @param   string $email The email address to be stored in the cookie
     * @return  void
     */
    function createLoginCookie($cookie_name, $email)
    {
        $time = time();
        $cookie = array(
            "email"      => $email,
            "login_time" => $time,
            "hash"       => md5(self::privateKey() . md5($time) . $email),
        );
        $cookie = base64_encode(serialize($cookie));
        self::setCookie($cookie_name, $cookie, APP_COOKIE_EXPIRE);
    }


    /**
     * Method used to redirect people to another URL.
     *
     * @access  public
     * @param   string $url The URL the user should be redirected to
     * @param   boolean $is_popup Whether the current window is a popup or not
     * @return  void
     */
    function redirect($url, $is_popup = false)
    {
        if ($is_popup) {
            $html = '<script type="text/javascript">
                     <!--
                     if (window.opener) {
                         window.opener.location.href = "' . $url . '";
                         window.close();
                     } else {
                        location.href = "' . $url . '";
                     }
                     //-->
                     </script>';
            echo $html;
        } else {
            // IIS 5 has problems with "Location" header so don't use it under IIS
            if (!empty($_SERVER['SERVER_SOFTWARE']) && strstr($_SERVER['SERVER_SOFTWARE'], 'IIS')) {
                // IIS
                header("Refresh: 0; URL=$url");
            } else {
                // all servers that work correctly
                header("Location: $url");
            }
        }
        exit;
    }


    /**
     * Method used to remove a cookie from the user's browser.
     *
     * @access  public
     * @param   string $cookie_name The name of the cookie that needs to be deleted
     * @return  void
     */
    function removeCookie($cookie_name)
    {
        self::setCookie($cookie_name, '', time()-36000);
    }


    /**
     * Checks whether an user exists or not in the database.
     *
     * @access  public
     * @param   string $email The email address to check for
     * @return  boolean
     */
    function userExists($email)
    {
        if (empty($email)) {
            return false;
        }

        $usr_id = User::getUserIDByEmail($email, true);
        if (empty($usr_id)) {
            return false;
        }

        return true;
    }


    /**
     * Checks whether the provided password match against the email
     * address provided.
     *
     * @access  public
     * @param   string $email The email address to check for
     * @param   string $password The password of the user to check for
     * @return  boolean
     */
    function isCorrectPassword($email, $password)
    {
        $usr_id = User::getUserIDByEmail($email, true);
        $user = User::getDetails($usr_id);
        if ($user['usr_password'] != self::hashPassword($password)) {
            return false;
        } else {
            return true;
        }
    }


    /**
     * Gets the current user ID.
     *
     * @access  public
     * @return  integer The ID of the user
     */
    function getUserID()
    {
        $info = self::getCookieInfo(APP_COOKIE);
        if (empty($info)) {
            return '';
        }

        return User::getUserIDByEmail($info['email']);
    }


    /**
     * Gets the current selected project from the project cookie.
     *
     * @access  public
     * @return  integer The project ID
     */
    function getCurrentProject()
    {
        $cookie = self::getCookieInfo(APP_PROJECT_COOKIE);
        if (empty($cookie)) {
            return '';
        }
        $usr_id = self::getUserID();
        $projects = Project::getAssocList($usr_id);
        if ($usr_id == APP_SYSTEM_USER_ID) {
            return isset($cookie['prj_id']) ? (int )$cookie['prj_id'] : null;
        }
        if (!in_array($cookie["prj_id"], array_keys($projects))) {
            self::redirect("select_project.php");
        }
        return $cookie["prj_id"];
    }


    /**
     * Gets the current project name from the user's project cookie.
     *
     * @access  public
     * @return  string The current project name
     */
    function getCurrentProjectName()
    {
        $proj_id = self::getCurrentProject();
        if (!empty($proj_id)) {
            return Project::getName($proj_id);
        }
    }


    /**
     * Gets the current role in the current project.
     *
     * @access  public
     * @return  integer The current role ID
     */
    function getCurrentRole()
    {
        $prj_id = self::getCurrentProject();
        $usr_id = self::getUserID();
        if ((!empty($prj_id)) && (!empty($usr_id))) {
            return User::getRoleByUser($usr_id, $prj_id);
        } else {
            return 1;
        }
    }


    /**
     * Sets the current selected project for the user session.
     *
     * @access  public
     * @param   integer $prj_id The project ID
     * @param   integer $remember Whether to automatically remember the setting or not
     * @return  void
     */
    function setCurrentProject($prj_id, $remember)
    {
        $cookie = array(
            "prj_id"   => $prj_id,
            "remember" => $remember
        );
        $cookie = base64_encode(serialize($cookie));
        self::setCookie(APP_PROJECT_COOKIE, $cookie, APP_PROJECT_COOKIE_EXPIRE);
        $_COOKIE[APP_PROJECT_COOKIE] = $cookie;
    }


    /**
     * Creates a fake cookie so processes not run from a browser can access current user and project
     *
     * @param   integer $usr_id The ID of the user.
     * @param   integer $prj_id The ID of the project.
     */
    function createFakeCookie($usr_id, $prj_id = false)
    {
        $user_details = User::getDetails($usr_id);

        $time = time();
        $cookie = array(
            "email" => $user_details['usr_email'],
            "login_time"    =>  $time,
            "hash"       => md5(self::privateKey() . md5($time) . $user_details['usr_email']),
        );
        $_COOKIE[APP_COOKIE] = base64_encode(serialize($cookie));
        if ($prj_id) {
            $cookie = array(
                "prj_id"   => $prj_id,
                "remember" => false
            );
        }
        $_COOKIE[APP_PROJECT_COOKIE] = base64_encode(serialize($cookie));
    }


    /**
     * Hashes the password according to APP_HASH_TYPE constant
     *
     * @access  public
     * @param   string $password The plain text password
     * @return  string The hashed password
     */
    function hashPassword($password)
    {
        if (APP_HASH_TYPE == 'MD5-64') {
            return base64_encode(pack('H*',md5($password)));
        } else {
            // default to md5
            return md5($password);
        }
    }


    /**
     * Sets a cookie in the browser
     *
     * @param   string  $name The name of the cookie
     * @param   string  $value The value of the cookie
     * @param   string  $expiration The expiration data of the cookie
     */
    public static function setCookie($name, $value, $expiration)
    {
        if (is_null(APP_COOKIE_DOMAIN)) {

            setcookie($name, $value, $expiration, APP_COOKIE_URL);
        } else {
            setcookie($name, $value, $expiration, APP_COOKIE_URL, APP_COOKIE_DOMAIN);
        }
    }
}
