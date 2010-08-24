<?php
/**
 *    @version [ Accetto ]
 *    @package hwdPhotoShare
 *    @copyright (C) 2007 - 2009 Highwood Design
 *    @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 ***
 *    This program is free software: you can redistribute it and/or modify
 *    it under the terms of the GNU General Public License as published by
 *    the Free Software Foundation, either version 3 of the License, or
 *    (at your option) any later version.
 *
 *    This program is distributed in the hope that it will be useful,
 *    but WITHOUT ANY WARRANTY; without even the implied warranty of
 *    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *    GNU General Public License for more details.
 *
 *    You should have received a copy of the GNU General Public License
 *    along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

/**
 * ACL functions: original code from com_comprofiler
 *
 * @package    hwdphotoshare
 * @author     Dave Horsfall <info@highwooddesign.co.uk>
 * @copyright  2008 Highwood Design
 * @license    http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version    1.1.4 Alpha RC2.13
 */
class hwd_ps_access
{
    /**
     * Grants or prevents access based on group id
     *
     * @param int    $accessgroupid  the group id to check against
     * @param string $recurse  the switch for recursive access check
     * @param int    $usersgroupid  the user's group id
     * @return       True or false
     */
	function allowAccess( $accessgroupid, $recurse, $usersgroupid)
	{
		$c = hwd_ps_Config::get_instance();
		$db = & JFactory::getDBO();
		$my = & JFactory::getUser();
		$acl= & JFactory::getACL();

		if ($accessgroupid == -2 || ($accessgroupid == -1 && $usersgroupid > 0)) {
			//grant public access or access to all registered users
			return true;
		}
		else {
			//need to do more checking based on more restrictions
			if( $usersgroupid == $accessgroupid ) {
				//direct match
				return true;
			}
			else {
				if ($recurse=='RECURSE') {
					//check if there are children groups

					//$groupchildren=$acl->get_group_children( $usersgroupid, 'ARO', $recurse );
					//print_r($groupchildren);
					$groupchildren=array();
					$groupchildren=hwd_ps_access::getParentGIDS($accessgroupid);

					if ( is_array( $groupchildren ) && count( $groupchildren ) > 0) {
						if ( in_array($usersgroupid, $groupchildren) ) {
							//match
							return true;
						}
					}
				}
			}
			//deny access
			return false;
		}
	}
    /**
     * Grants or prevents access based on JACL level
     *
     * @param int    $accessgroupid  the group id to check against
     * @param string $recurse  the switch for recursive access check
     * @param int    $usersgroupid  the user's group id
     * @return       True or false
     */
	function allowLevelAccess( $accessgroupid, $usersgroupid )
	{
		$c = hwd_ps_Config::get_instance();
		$db = & JFactory::getDBO();
		$my = & JFactory::getUser();
		$acl= & JFactory::getACL();

		if ($usersgroupid == 0) {
			$allowArry = 0;
		} else {
			// get allowed levels for users gid
			$query			=	"SELECT jaclplus FROM #__core_acl_aro_groups WHERE group_id = ".(int) $usersgroupid;
			$db->setQuery( $query );
			$allowArry	=	$db->loadResult();
		}

		$allowArry = @explode(",", $allowArry);
		$checkArry = @explode(",", $accessgroupid);

		$result = array_intersect($allowArry, $checkArry);

		if (count($result) > 0) {
			return true;
		} else {
			return false;
		}
	}
	/**
	 * Gives ACL group id of userid $oID
	 *
	 * @param int $oID   user id
	 * @return int       ACL group id
	 */
	function userGID( $oID )
	{
		$c = hwd_ps_Config::get_instance();
		$db = & JFactory::getDBO();
		$my = & JFactory::getUser();
		$acl= & JFactory::getACL();

		static $uidArry			=	array();	// cache

		$oID					=	(int) $oID;
		if ( ! isset( $uidArry[$oID] ) ) {
		  	if( $oID > 0 ) {
				$query			=	"SELECT gid FROM #__users WHERE id = ".(int) $oID;
				$db->setQuery( $query );
				$uidArry[$oID]	=	$db->loadResult();
			}
			else {
				$uidArry[$oID]	=	0;
			}
		}
		return $uidArry[$oID];
	}
	/**
	 * Gives ACL group name of groupid $gID
	 *
	 * @param int $gID   group id
	 * @return string    ACL group name
	 */
	function groupName( $gID )
	{
		$c = hwd_ps_Config::get_instance();
		$db = & JFactory::getDBO();
		$my = & JFactory::getUser();
		$acl= & JFactory::getACL();
		static $gidArry			=	array();	// cache

		$gID					=	(int) $gID;
		if ( ! isset( $uidArry[$gID] ) ) {
		  	if( $gID > 0 ) {
				$query			=	"SELECT name FROM #__core_acl_aro_groups WHERE id = ".(int) $gID;
				$db->setQuery( $query );
				$uidArry[$gID]	=	$db->loadResult();
			}
			else {
				$uidArry[$gID]	=	_HWDVIDS_UNKNOWN;
			}
		}
		return $uidArry[$gID];
	}
	/**
	 * getParentGIDS
	 */
	function getParentGIDS( $gid )
	{
		$c = hwd_ps_Config::get_instance();
		$db = & JFactory::getDBO();
		$my = & JFactory::getUser();
		$acl= & JFactory::getACL();

		static $gidsArry			=	array();	// cache

		$gid		=	(int) $gid;

		if ( ! isset( $gidsArry[$gid] ) ) {

			$query	=	"SELECT g1.id AS group_id, g1.name"
			."\n FROM #__core_acl_aro_groups g1"
			."\n LEFT JOIN #__core_acl_aro_groups g2 ON g2.lft <= g1.lft"
			."\n WHERE g2.id =" . (int) $gid
			."\n ORDER BY g1.name";

	       	$db->setQuery( $query );
			$gidsArry[$gid]		=	$db->loadResultArray();
	      	if ( ! is_array( $gidsArry[$gid] ) ) {
	       		$gidsArry[$gid]	=	array();
	       	}
		}
		return $gidsArry[$gid];
	}
	/**
	 * getParentGIDS
	 */
	function getRecursiveGIDS( $gid )
	{
		$c = hwd_ps_Config::get_instance();
		$db = & JFactory::getDBO();
		$my = & JFactory::getUser();
		$acl= & JFactory::getACL();

		static $gidsArry			=	array();	// cache

		$gid		=	(int) $gid;

		if ( ! isset( $gidsArry[$gid] ) ) {

			$query	=	"SELECT g1.id AS group_id, g1.name"
			."\n FROM #__core_acl_aro_groups g1"
			."\n LEFT JOIN #__core_acl_aro_groups g2 ON g2.lft >= g1.lft"
			."\n WHERE g2.id =" . (int) $gid
			."\n ORDER BY g1.name";

	       	$db->setQuery( $query );
			$gidsArry[$gid]		=	$db->loadResultArray();
	      	if ( ! is_array( $gidsArry[$gid] ) ) {
	       		$gidsArry[$gid]	=	array();
	       	}
		}
		return $gidsArry[$gid];
	}
	/**
	 * Check Joomla/Mambo version for API
	 *
	 * @return int API version: =0 = mambo 4.5.0-4.5.3+Joomla 1.0.x, =1 = Joomla! 1.1, >1 newever ones: maybe compatible, <0: -1: Mambo 4.6
	 */
	function checkJversion()
	{
		return;
	}
	/**
	 *
	 *
	 *
	 */
	function checkAccess($gtree, $gtree_child, $nav, $usernav, $title, $message_register, $message_denied, $icon, $backlink) {

		global $mainframe;
        $c = hwd_ps_Config::get_instance();
		$my = & JFactory::getUser();
		$acl= & JFactory::getACL();
		$usersConfig = & JComponentHelper::getParams( 'com_users' );

		if ($c->access_method == 0) {
			if (!hwd_ps_access::allowAccess( $gtree, $gtree_child, hwd_ps_access::userGID( $my->id ))) {
				if ( ($my->id < 1) && (!$usersConfig->get( 'allowUserRegistration' ) == '0' && hwd_ps_access::allowAccess( $c->gtree_upld, 'RECURSE', $acl->get_group_id('Registered','ARO') ) ) ) {
					hwd_ps_tools::infomessage($nav, $usernav, $title, $message_register, $icon, $backlink);
					return false;
				} else {
					hwd_ps_tools::infomessage($nav, $usernav, $title, $message_denied, $icon, $backlink);
					return false;
				}
			}
		} else if ($c->access_method == 1) {
			if (!hwd_ps_access::allowLevelAccess( $c->accesslevel_upld, hwd_ps_access::userGID( $my->id ))) {
				hwd_ps_tools::infomessage($nav, $usernav,  $title, $message_denied, $icon, $backlink);
				return false;
			}
		}

		return true;

	}
}
?>