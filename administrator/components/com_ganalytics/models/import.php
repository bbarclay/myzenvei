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
defined('_JEXEC') or die();

jimport('joomla.application.component.model');

class GAnalyticsModelImport extends JModel
{
	/**
	 * Constructor that retrieves the ID from the request
	 *
	 * @access	public
	 * @return	void
	 */
	function __construct()
	{
		parent::__construct();

		$array = JRequest::getVar('cid',  0, '', 'array');
		$this->setId((int)$array[0]);
	}

	function setId($id)
	{
		// Set id and wipe data
		$this->_id		= $id;
		$this->_data	= null;
	}

	function getOnlineData() {
		JTable::addIncludePath(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_ganalytics'.DS.'tables');
		$feed = GAnalyticsUtil::getAnalyticsHandler();
		$feed->init();
		if($feed->error()) {
			JError::raiseWarning( 500, 'An error occured!! Did you set the username and password in the component parameters? '.$feed->error());
			return array();
		}
		$profiles = $feed->get_items();
		$tmp = array();
		foreach($profiles as $profile)
		{
			$table_instance = & $this->getTable('import');
			$table_instance->id = 0;
			$table_instance->accountID = $profile->get_account_id();
			$table_instance->accountName = $profile->get_account_name();
			$table_instance->profileID = $profile->get_profile_id();
			$table_instance->profileName = $profile->get_profile_name();
			$table_instance->webPropertyId = $profile->get_web_property_id();
			$tmp[] = $table_instance;
		}
		return $tmp;
	}

	function store()	{
		$cids = JRequest::getVar( 'cid', array(0), 'post', 'array' );
		if (count($cids)>0) {
			foreach ($cids as $cid) {
				$row = & $this->getTable('import');
				$row->id = 0;
				$row->accountID = strtok($cid, ',');
				$row->profileID = strtok(',');
				$row->webPropertyId = strtok(',');
				$row->accountName = strtok(',');
				$row->profileName = strtok(',');

				$feed = GAnalyticsUtil::getAnalyticsHandler();
				$feed->set_profile_id($row->profileID);
				$feed->set_start_date(mktime(0,0,0,1,1,2005));
				$feed->set_end_date(time());
				$feed->set_parameters('ga:year,ga:month', 'ga:visits', 10000, 'ga:year');
				$feed->init();
				if($feed->error()) {
					JError::raiseWarning( 500, 'An error occured fetching the data!! Here is the output: '.$feed->error());
				}
				$data = $feed->get_items();
				foreach ($data as $item){
					if($item->get_metric('ga:visits') > 0){
						$month = (int)$item->get_dimension('ga:month');
						$year = (int)$item->get_dimension('ga:year');

						$feed = GAnalyticsUtil::getAnalyticsHandler();
						$feed->set_profile_id($row->profileID);
						$feed->set_start_date(mktime(0,0,0,$month,1,$year));
						$feed->set_end_date(mktime(0,0,0,$month,cal_days_in_month(CAL_GREGORIAN, $month, $year),$year));
						$feed->set_parameters('ga:date', 'ga:visits', 10000, 'ga:date');
						$feed->init();
						$data = $feed->get_items();
						break;
					}
				}
				$text = '2005-01-01';
				foreach ($data as $item){
					if($item->get_metric('ga:visits') > 0){
						$text = $item->get_dimension('ga:date');
						$text = substr($text, 0, 4).'-'.substr($text, 4, 2).'-'.substr($text, 6, 2);
						break;
					}
				}
				$row->startDate = $text;
				if (!$row->check()) {
					JError::raiseWarning( 500, $row->getError() );
					return false;
				}

				if (!$row->store()) {
					JError::raiseWarning( 500, $row->getError() );
					return false;
				}
			}
		}
		return true;
	}
}
?>
