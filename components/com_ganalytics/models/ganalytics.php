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

jimport( 'joomla.application.component.model' );

class GAnalyticsModelGAnalytics extends JModel
{
	function getSelectedAccounts() {
		$params = $this->getState('parameters.menu');
		$accountids = null;
		if($params != null)
		$accountids=$params->get('accountids');

		if(empty($accountids)){
			$accountids = array();
			$tmp = GAnalyticsDBUtil::getAllAccounts();
			foreach ($tmp as $acc) {
				$accountids[] = $acc->id;
			}
		}
		if(!empty($accountids)){
			$accounts = array();
			if(is_array($accountids)) {
				$accounts = $accountids;
			} else {
				$accounts[] = $accountids;
			}
			$data = array();
			$counter = 0;
			foreach ($accounts as $account){
				if($params->get('showVisitors', 'yes') == 'yes'){
					$feed = $this->createFeed($params, $account);
					$feed->set_parameters('ga:date', 'ga:visits', 1000, 'ga:date');
					$feed->init();
					if($feed->error()) {
						JError::raiseWarning( 500, 'An error occured fetching the data!! Here is the output: '.$feed->error());
					}
					$feed->put('isVisitorFeed', true);
					$data[$counter] = $feed;
					$counter++;
				}
				$feed = $this->createFeed($params, $account);
				$feed->init();
				if($feed->error()) {
					JError::raiseWarning( 500, 'An error occured fetching the data!! Here is the output: '.$feed->error());
				}
				$feed->put('isVisitorFeed', false);
				$data[$counter] = $feed;
				$counter++;
			}
			return $data;
		}else {
			JError::raiseWarning( 0, 'Unable to Load Data');
			return array();
		}
	}

	function createFeed($params, $accountID){
		$feed = GAnalyticsUtil::getAnalyticsHandler($accountID);

		$startDate = time();
		$endDate = time();
		if($params->get('daterange', 'month') == 'advanced'){
			$tmp = $params->get('startdate', null);
			if(!empty($tmp)){
				sscanf($tmp,"%u-%u-%u", $year, $month, $day);
				$startDate = mktime(0, 0, 0, $month, $day, $year);
			}
			$tmp = $params->get('enddate', null);
			if(!empty($tmp)){
				sscanf($tmp,"%u-%u-%u", $year, $month, $day);
				$endDate = mktime(0, 0, 0, $month, $day, $year);
			}
		}else{
			$range = '';
			switch ($params->get('daterange', 'month')) {
				case 'day':
					$range = '-1 day';
					break;
				case 'week':
					$range = '-1 week';
					break;
				case 'month':
					$range = '-1 month';
					break;
				case 'year':
					$range = '-1 year';
					break;
			}
			$startDate = strtotime($range);
			$endDate = time();
		}
		$feed->set_start_date($startDate);
		$feed->set_end_date($endDate);

		$dimensions = '';
		$metrics = '';
		$sort = '';
		if($params->get('type', 'visits') == 'advanced'){
			$dimensions = $params->get('dimensions', 'ga:date');
			$metrics = $params->get('metrics', 'ga:visits');
			$sort = $params->get('sort', '');
		}else{
			switch ($params->get('type', 'visits')) {
				case 'visits':
					$dimensions = 'ga:date';
					$metrics = 'ga:visits';
					break;
				case 'visitsbytraffic':
					$dimensions = 'ga:source';
					$metrics = 'ga:visits';
					$sort = '-ga:visits';
					break;
				case 'visitsbybrowser':
					$dimensions = 'ga:browser';
					$metrics = 'ga:visits';
					$sort = '-ga:visits';
					break;
				case 'visitsbycountry':
					$dimensions = 'ga:country';
					$metrics = 'ga:visits';
					$sort = '-ga:visits';
					break;
				case 'timeonsite':
					$dimensions = 'ga:region';
					$metrics = 'ga:timeOnSite';
					$sort = '-ga:timeOnSite';
					break;
				case 'toppages':
					$dimensions = 'ga:pagePath';
					$metrics = 'ga:pageviews';
					$sort = '-ga:pageviews';
					break;
			}
		}
		$max = $params->get('max', 1000);
		$feed->set_parameters($dimensions, $metrics, $max, $sort);

		GAnalyticsUtil::configureCache($feed, $params, 'com_ganalytics');
		return $feed;
	}
}
