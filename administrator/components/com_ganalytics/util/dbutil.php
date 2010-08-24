<?php
/**
 * GAnalytics is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * GAnalytics is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with GAnalytics.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @author Allon Moritz
 * @copyright 2007-2010 Allon Moritz
 * @version $Revision: 0.6.1 $
 */

class GAnalyticsDBUtil{

	/**
	 * Returns the database entries as objects with the column fields as
	 * variable (according to the joomla table framework).
	 *
	 * @param $calendarIDs the calendar ID's to find
	 */
	function getAccounts($accountIDs) {
		$condition = '';
		if(!empty($accountIDs)){
			if(is_array($accountIDs)) {
				$condition = 'id IN ( ' . implode( ',', $accountIDs ) . ')';
			} else {
				$condition = 'id = '.(int)$accountIDs;
			}
		}else
		return GAnalyticsDBUtil::getAllAccounts();

		$db =& JFactory::getDBO();

		$query = 'select id, accountID, accountName, profileID, profileName, webPropertyId, startDate FROM #__ganalytics where '.$condition;
		$db->setQuery( $query );
		return $db->loadObjectList();
	}

	/**
	 * Returns all database entries as objects with the column fields as
	 * variable (according to the joomla table framework).
	 *
	 */
	function getAllAccounts() {
		$db =& JFactory::getDBO();
		$query = "select id, accountID, accountName, profileID, profileName, webPropertyId, startDate FROM #__ganalytics";
		$db->setQuery( $query );
		return $db->loadObjectList();
	}
}

?>