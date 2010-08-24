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
defined( '_JEXEC' ) or die( 'Restricted access' );

class TableImport extends JTable
{
	/**
	 * Primary Key
	 *
	 * @var int
	 */
	var $id = null;

	/**
	 * @var string
	 */
	var $accountID = null;

	/**
	 * @var string
	 */
	var $accountName = null;

	/**
	 * @var string
	 */
	var $profileID = null;

	/**
	 * @var string
	 */
	var $profileName = null;
	
	/**
	 * @var string
	 */
	var $webPropertyId = null;
	
	
	/**
	 * @var date
	 */
	var $startDate = null;

	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 */
	function TableImport(& $db) {
		parent::__construct('#__ganalytics', 'id', $db);
	}
}