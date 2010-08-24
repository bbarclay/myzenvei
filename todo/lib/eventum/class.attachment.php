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



/**
 * Class designed to handle all business logic related to attachments being
 * uploaded to issues in the application.
 *
 * @author  João Prado Maia <jpm@mysql.com>
 */
class Attachment
{
    /**
     * Returns a list of file extensions that should be opened
     * directly in the browser window as PHP source files.
     *
     * @access  private
     * @return  array List of file extensions
     */
    function _getPHPExtensions()
    {
        return array(
            "php",
            "php3",
            "php4",
            "phtml"
        );
    }


    /**
     * Returns a list of file extensions that should be opened
     * directly in the browser window and treated as text/plain
     * files.
     *
     * @access  private
     * @return  array List of file extensions
     */
    function _getTextPlainExtensions()
    {
        return array(
            'err',
            'log',
            'cnf',
            'var',
            'ini',
            'java',
            'txt'
        );
    }


    /**
     * Returns a list of file extensions that should be opened
     * directly in the browser window.
     *
     * @access  private
     * @return  array List of file extensions
     */
    function _getNoDownloadExtensions()
    {
        return array(
            'jpg',
            'jpeg',
            'gif',
            'png',
            'bmp',
            'html',
            'htm',
            'xml',
        );
    }


    /**
     * Method used to output the headers and the binary data for
     * an attachment file.
     *
     * @access  public
     * @param   string $data The binary data of this file download
     * @param   string $filename The filename
     * @param   integer $filesize The size of this file
     * @param   string $filetype The mimetype of this file
     * @return  void
     */
    function outputDownload(&$data, $filename, $filesize, $filetype)
    {
        $filename = self::nameToSafe($filename);
        $parts = pathinfo($filename);
        if (in_array(strtolower(@$parts["extension"]), self::_getPHPExtensions())) {
            // instead of redirecting the user to a PHP script that may contain malicious code, we highlight the code
            highlight_string($data);
        } else {
            if ((empty($filename)) && (!empty($filetype))) {
                // inline images
                header("Content-Type: $filetype");
            } elseif ((in_array(strtolower(@$parts["extension"]), self::_getTextPlainExtensions())) && ($filesize < 5000)) {
                // always force the browser to display the contents of these special files
                header('Content-Type: text/plain');
                header("Content-Disposition: inline; filename=\"" . urlencode($filename) . "\"");
            } else {
                if (empty($filetype)) {
                    header("Content-Type: application/unknown");
                } else {
                    header("Content-Type: " . $filetype);
                }
                if (!in_array(strtolower(@$parts["extension"]), self::_getNoDownloadExtensions())) {
                    header("Content-Disposition: attachment; filename=\"" . urlencode($filename) . "\"");
                } else {
                    header("Content-Disposition: inline; filename=\"" . urlencode($filename) . "\"");
                }
            }
            header("Content-Length: " . $filesize);
            echo $data;
            exit;
        }
    }


    /**
     * Method used to remove a specific file out of an existing attachment.
     *
     * @access  public
     * @param   integer $iaf_id The attachment file ID
     * @return  -1 or -2 if the removal was not successful, 1 otherwise
     */
    function removeIndividualFile($iaf_id)
    {
        $usr_id = Auth::getUserID();
        $iaf_id = Misc::escapeInteger($iaf_id);
        $stmt = "SELECT
                    iat_iss_id
                 FROM
                    " . APP_DEFAULT_DB . "." . APP_TABLE_PREFIX . "issue_attachment,
                    " . APP_DEFAULT_DB . "." . APP_TABLE_PREFIX . "issue_attachment_file
                 WHERE
                    iaf_id=$iaf_id AND
                    iat_id=iaf_iat_id";
        if (Auth::getCurrentRole() < User::getRoleID("Manager")) {
            $stmt .= " AND
                    iat_usr_id=$usr_id";
        }
        $res = DB_Helper::getInstance()->getOne($stmt);
        if (PEAR::isError($res)) {
            Error_Handler::logError(array($res->getMessage(), $res->getDebugInfo()), __FILE__, __LINE__);
            return -1;
        } else {
            if (empty($res)) {
                return -2;
            } else {
                // check if the file is the only one in the attachment
                $stmt = "SELECT
                            iat_id
                         FROM
                            " . APP_DEFAULT_DB . "." . APP_TABLE_PREFIX . "issue_attachment,
                            " . APP_DEFAULT_DB . "." . APP_TABLE_PREFIX . "issue_attachment_file
                         WHERE
                            iaf_id=$iaf_id AND
                            iaf_iat_id=iat_id";
                $attachment_id = DB_Helper::getInstance()->getOne($stmt);

                $res = self::getFileList($attachment_id);
                if (@count($res) > 1) {
                    self::removeFile($iaf_id);
                } else {
                    self::remove($attachment_id);
                }
                return 1;
            }
        }
    }


    /**
     * Method used to return the details for a given attachment.
     *
     * @access  public
     * @param   integer $file_id The attachment ID
     * @return  array The details of the attachment
     */
    function getDetails($file_id)
    {
        $file_id = Misc::escapeInteger($file_id);
        $stmt = "SELECT
                    *
                 FROM
                    " . APP_DEFAULT_DB . "." . APP_TABLE_PREFIX . "issue_attachment,
                    " . APP_DEFAULT_DB . "." . APP_TABLE_PREFIX . "issue_attachment_file
                 WHERE
                    iat_id=iaf_iat_id AND
                    iaf_id=$file_id";
        $res = DB_Helper::getInstance()->getRow($stmt, DB_FETCHMODE_ASSOC);
        if (PEAR::isError($res)) {
            Error_Handler::logError(array($res->getMessage(), $res->getDebugInfo()), __FILE__, __LINE__);
            return "";
        } else {
            // don't allow customers to reach internal only files
            if (($res['iat_status'] == 'internal')
                    && (User::getRoleByUser(Auth::getUserID(), Issue::getProjectID($res['iat_iss_id'])) <= User::getRoleID('Customer'))) {
                return '';
            } else {
                return $res;
            }
        }
    }


    /**
     * Removes all attachments (and associated files) related to a set
     * of specific issues.
     *
     * @access  public
     * @param   array $ids The issue IDs that need to be removed
     * @return  boolean Whether the removal worked or not
     */
    function removeByIssues($ids)
    {
        $items = @implode(", ", $ids);
        $stmt = "SELECT
                    iat_id
                 FROM
                    " . APP_DEFAULT_DB . "." . APP_TABLE_PREFIX . "issue_attachment
                 WHERE
                    iat_iss_id IN ($items)";
        $res = DB_Helper::getInstance()->getCol($stmt);
        if (PEAR::isError($res)) {
            Error_Handler::logError(array($res->getMessage(), $res->getDebugInfo()), __FILE__, __LINE__);
            return false;
        } else {
            for ($i = 0; $i < count($res); $i++) {
                self::remove($res[$i]);
            }
            return true;
        }
    }


    /**
     * Method used to remove attachments from the database.
     *
     * @param   integer $iat_id attachment_id.
     * @param   boolean $add_history whether to add history entry.
     * @access  public
     * @return  integer Numeric code used to check for any errors
     */
    function remove($iat_id, $add_history = true)
    {
        $iat_id = Misc::escapeInteger($iat_id);
        $usr_id = Auth::getUserID();
        $stmt = "SELECT
                    iat_iss_id
                 FROM
                    " . APP_DEFAULT_DB . "." . APP_TABLE_PREFIX . "issue_attachment
                 WHERE
                    iat_id=$iat_id";
        if (Auth::getCurrentRole() < User::getRoleID("Manager")) {
            $stmt .= " AND
                    iat_usr_id=$usr_id";
        }
        $res = DB_Helper::getInstance()->getOne($stmt);
        if (PEAR::isError($res)) {
            Error_Handler::logError(array($res->getMessage(), $res->getDebugInfo()), __FILE__, __LINE__);
            return -1;
        } else {
            if (empty($res)) {
                return -2;
            } else {
                $issue_id = $res;
                $files = self::getFileList($iat_id);
                $stmt = "DELETE FROM
                            " . APP_DEFAULT_DB . "." . APP_TABLE_PREFIX . "issue_attachment
                         WHERE
                            iat_id=$iat_id AND
                            iat_iss_id=$issue_id";
                $res = DB_Helper::getInstance()->query($stmt);
                if (PEAR::isError($res)) {
                    Error_Handler::logError(array($res->getMessage(), $res->getDebugInfo()), __FILE__, __LINE__);
                    return -1;
                }
                for ($i = 0; $i < count($files); $i++) {
                    self::removeFile($files[$i]['iaf_id']);
                }
                if ($add_history) {
                    Issue::markAsUpdated($usr_id);
                    // need to save a history entry for this
                    History::add($issue_id, $usr_id, History::getTypeID('attachment_removed'), 'Attachment removed by ' . User::getFullName($usr_id));
                }
                return 1;
            }
        }
    }

    /**
     * Method used to remove a specific file from an attachment, since every
     * attachment can have several files associated with it.
     *
     * @access  public
     * @param   integer $iaf_id The attachment file ID
     * @return  void
     */
    function removeFile($iaf_id)
    {
        $iaf_id = Misc::escapeInteger($iaf_id);
        $stmt = "DELETE FROM
                    " . APP_DEFAULT_DB . "." . APP_TABLE_PREFIX . "issue_attachment_file
                 WHERE
                    iaf_id=" . $iaf_id;
        $res = DB_Helper::getInstance()->query($stmt);
        if (PEAR::isError($res)) {
            Error_Handler::logError(array($res->getMessage(), $res->getDebugInfo()), __FILE__, __LINE__);
            return -1;
        }
    }


    /**
     * Method used to get the full listing of files for a specific attachment.
     *
     * @access  public
     * @param   integer $attachment_id The attachment ID
     * @return  array The full list of files
     */
    function getFileList($attachment_id)
    {
        $attachment_id = Misc::escapeInteger($attachment_id);
        $stmt = "SELECT
                    iaf_id,
                    iaf_filename,
                    iaf_filesize
                 FROM
                    " . APP_DEFAULT_DB . "." . APP_TABLE_PREFIX . "issue_attachment_file
                 WHERE
                    iaf_iat_id=$attachment_id";
        $res = DB_Helper::getInstance()->getAll($stmt, DB_FETCHMODE_ASSOC);
        if (PEAR::isError($res)) {
            Error_Handler::logError(array($res->getMessage(), $res->getDebugInfo()), __FILE__, __LINE__);
            return "";
        } else {
            for ($i = 0; $i < count($res); $i++) {
                $res[$i]["iaf_filesize"] = Misc::formatFileSize($res[$i]["iaf_filesize"]);
            }
            return $res;
        }
    }


    /**
     * Method used to return the full list of attachments related to a specific
     * issue in the database.
     *
     * @access  public
     * @param   integer $issue_id The issue ID
     * @return  array The full list of attachments
     */
    function getList($issue_id)
    {
        $issue_id = Misc::escapeInteger($issue_id);
        $usr_id = Auth::getUserID();
        $prj_id = Issue::getProjectID($issue_id);

        $stmt = "SELECT
                    iat_id,
                    iat_usr_id,
                    usr_full_name,
                    iat_created_date,
                    iat_description,
                    iat_unknown_user,
                    iat_status
                 FROM
                    " . APP_DEFAULT_DB . "." . APP_TABLE_PREFIX . "issue_attachment,
                    " . APP_DEFAULT_DB . "." . APP_TABLE_PREFIX . "user
                 WHERE
                    iat_iss_id=$issue_id AND
                    iat_usr_id=usr_id";
        if (User::getRoleByUser($usr_id, $prj_id) <= User::getRoleID('Customer')) {
            $stmt .= " AND iat_status='public' ";
        }
        $stmt .= "
                 ORDER BY
                    iat_created_date ASC";
        $res = DB_Helper::getInstance()->getAll($stmt, DB_FETCHMODE_ASSOC);
        if (PEAR::isError($res)) {
            Error_Handler::logError(array($res->getMessage(), $res->getDebugInfo()), __FILE__, __LINE__);
            return "";
        } else {
            for ($i = 0; $i < count($res); $i++) {
                $res[$i]["iat_description"] = Link_Filter::processText(Issue::getProjectID($issue_id), nl2br(htmlspecialchars($res[$i]["iat_description"])));
                $res[$i]["files"] = self::getFileList($res[$i]["iat_id"]);
                $res[$i]["iat_created_date"] = Date_Helper::getFormattedDate($res[$i]["iat_created_date"]);

                // if there is an unknown user, user that instead of the user_full_name
                if (!empty($res[$i]["iat_unknown_user"])) {
                    $res[$i]["usr_full_name"] = $res[$i]["iat_unknown_user"];
                }
            }
            return $res;
        }
    }


    /**
     * Method used to associate an attachment to an issue, and all of its
     * related files. It also notifies any subscribers of this new attachment.
     *
     * Error codes:
     * -1 - An error occurred while trying to process the uploaded file.
     * -2 - The uploaded file is already attached to the current issue.
     *  1 - The uploaded file was associated with the issue.
     *
     * @access  public
     * @param   integer $usr_id The user ID
     * @param   string $status The attachment status
     * @return  integer Numeric code used to check for any errors
     */
    function attach($usr_id, $status = 'public')
    {
        $files = array();
        for ($i = 0; $i < count($_FILES["attachment"]["name"]); $i++) {
            $filename = @$_FILES["attachment"]["name"][$i];
            if (empty($filename)) {
                continue;
            }
            $blob = file_get_contents($_FILES["attachment"]["tmp_name"][$i]);
            if (empty($blob)) {
                return -1;
            }
            $files[] = array(
                "filename"  =>  $filename,
                "type"      =>  $_FILES['attachment']['type'][$i],
                "blob"      =>  $blob
            );
        }
        if (count($files) < 1) {
            return -1;
        }
        if ($status == 'internal') {
            $internal_only = true;
        } else {
            $internal_only = false;
        }
        $attachment_id = self::add($_POST["issue_id"], $usr_id, @$_POST["file_description"], $internal_only);
        foreach ($files as $file) {
            $res = self::addFile($attachment_id, $file["filename"], $file["type"], $file["blob"]);
            if ($res !== true) {
                // we must rollback whole attachment (all files)
                self::remove($attachment_id, false);
                return -1;
            }
        }

        Issue::markAsUpdated($_POST["issue_id"], "file uploaded");
        // need to save a history entry for this
        History::add($_POST["issue_id"], $usr_id, History::getTypeID('attachment_added'), 'Attachment uploaded by ' . User::getFullName($usr_id));

        // if there is customer integration, mark last customer action
        if ((Customer::hasCustomerIntegration(Issue::getProjectID($_POST["issue_id"]))) && (User::getRoleByUser($usr_id, Issue::getProjectID($_POST["issue_id"])) == User::getRoleID('Customer'))) {
            Issue::recordLastCustomerAction($_POST["issue_id"]);
        }

        Workflow::handleAttachment(Issue::getProjectID($_POST["issue_id"]), $_POST["issue_id"], $usr_id);

        // send notifications for the issue being updated
        // XXX: eventually need to restrict the list of people who receive a notification about this in a better fashion
        if ($status == 'public') {
            Notification::notify($_POST["issue_id"], 'files', $attachment_id);
        }
        return 1;
    }


    /**
     * Method used to add files to a specific attachment in the database.
     *
     * @access  public
     * @param   integer $attachment_id The attachment ID
     * @param   string $filename The filename to be added
     * @return  boolean
     */
    function addFile($attachment_id, $filename, $filetype, &$blob)
    {
        $filesize = strlen($blob);
        $stmt = "INSERT INTO
                    " . APP_DEFAULT_DB . "." . APP_TABLE_PREFIX . "issue_attachment_file
                 (
                    iaf_iat_id,
                    iaf_filename,
                    iaf_filesize,
                    iaf_filetype,
                    iaf_file
                 ) VALUES (
                    $attachment_id,
                    '" . Misc::escapeString($filename) . "',
                    '" . $filesize . "',
                    '" . Misc::escapeString($filetype) . "',
                    '" . Misc::escapeString($blob) . "'
                 )";
        $res = DB_Helper::getInstance()->query($stmt);
        if (PEAR::isError($res)) {
            Error_Handler::logError(array($res->getMessage(), $res->getDebugInfo()), __FILE__, __LINE__);
            return false;
        } else {
            return true;
        }
    }


    /**
     * Method used to add an attachment to the database.
     *
     * @access  public
     * @param   integer $issue_id The issue ID
     * @param   integer $usr_id The user ID
     * @param   string $description The description for this new attachment
     * @param   boolean $internal_only Whether this attachment is supposed to be internal only or not
     * @param   string $unknown_user The email of the user who originally sent this email, who doesn't have an account.
     * @param   integer $associated_note_id The note ID that these attachments should be associated with
     * @return  integer The new attachment ID
     */
    function add($issue_id, $usr_id, $description, $internal_only = FALSE, $unknown_user = FALSE, $associated_note_id = FALSE)
    {
        if ($internal_only) {
            $attachment_status = 'internal';
        } else {
            $attachment_status = 'public';
        }

        $stmt = "INSERT INTO
                    " . APP_DEFAULT_DB . "." . APP_TABLE_PREFIX . "issue_attachment
                 (
                    iat_iss_id,
                    iat_usr_id,
                    iat_created_date,
                    iat_description,
                    iat_status";
        if ($unknown_user != false) {
            $stmt .= ", iat_unknown_user ";
        }
        if ($associated_note_id != false) {
            $stmt .= ", iat_not_id ";
        }
        $stmt .=") VALUES (
                    $issue_id,
                    $usr_id,
                    '" . Date_Helper::getCurrentDateGMT() . "',
                    '" . Misc::escapeString($description) . "',
                    '" . Misc::escapeString($attachment_status) . "'";
        if ($unknown_user != false) {
            $stmt .= ", '" . Misc::escapeString($unknown_user) . "'";
        }
        if ($associated_note_id != false) {
            $stmt .= ", " . Misc::escapeInteger($associated_note_id);
        }
        $stmt .= " )";
        $res = DB_Helper::getInstance()->query($stmt);
        if (PEAR::isError($res)) {
            Error_Handler::logError(array($res->getMessage(), $res->getDebugInfo()), __FILE__, __LINE__);
            return false;
        } else {
            return DB_Helper::get_last_insert_id();
        }
    }


    /**
     * Method used to replace unsafe characters by safe characters.
     *
     * Side-effects: if $name is not in ISO8859-1 encoding, not very logical
     * replacements are done. Eventually the non-ASCII characters are stripped.
     *
     * @access  public
     * @param   string $name The name of the file to be checked. In ISO8859-1 encoding.
     * @param   integer $maxlen The maximum length of the filename
     * @return  string The 'safe' version of the filename. Always in US-ASCII encoding.
     */
    function nameToSafe($name, $maxlen = 250)
    {
        // using hex bytes as these need to be *bytes*, not dependant on sourcefile encoding.
        $noalpha = "\xe1\xe9\xed\xf3\xfa\xe0\xe8\xec\xf2\xf9\xe4\xeb\xef\xf6\xfc\xc1\xc9\xcd\xd3\xda\xc0\xc8\xcc\xd2\xd9\xc4\xcb\xcf\xd6\xdc\xe2\xea\xee\xf4\xfb\xc2\xca\xce\xd4\xdb\xf1\xe7\xc7\x40";
        $alpha = 'aeiouaeiouaeiouAEIOUAEIOUAEIOUaeiouAEIOUncCa';
        $name = substr($name, 0, $maxlen);
        $name = strtr($name, $noalpha, $alpha);
        // not permitted chars are replaced with "_"
        return ereg_replace('[^a-zA-Z0-9,._\+\()\-]', '_', $name);
    }


    /**
     * Returns the current maximum file upload size.
     *
     * @access  public
     * @return  string A string containing the formatted max file size.
     */
    function getMaxAttachmentSize()
    {
        $size = ini_get('upload_max_filesize');
        // check if this directive uses the string version (e.g. 256M)
        if (strstr($size, 'M')) {
            $size = str_replace('M', '', $size);
            return Misc::formatFileSize($size * 1024 * 1024);
        } else {
            return Misc::formatFileSize($size);
        }
    }
}
