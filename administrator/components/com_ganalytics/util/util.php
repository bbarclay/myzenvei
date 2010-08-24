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

class GAnalyticsUtil{

	function getAnalyticsHandler($id = null) {
		$feed = new SimplePie_GAnalytics();
		$feed->enable_order_by_date(false);
		$feed->set_stupidly_fast(true);
		$feed->set_login(trim(GAnalyticsUtil::getComponentParameter('username')), trim(GAnalyticsUtil::getComponentParameter('password')));
		$session = & JFactory::getSession();
		$token = $session->get('com_ganalytics_auth_token');
		if(empty($token)){
			$token = $feed->authorize();
			if(empty($token))
			JError::raiseWarning(500, $feed->error());
			$session->set('com_ganalytics_auth_token', $token);
		}
		$feed->set_authorization($token);

		if(!empty($id)){
			$feeds = GAnalyticsDBUtil::getAccounts($id);
			$feed->set_profile_id($feeds[0]->profileID);
			$feed->put('ga_accountID', $feeds[0]->accountID);
			$feed->put('ga_accountName', $feeds[0]->accountName);
			$feed->put('ga_profileID', $feeds[0]->profileID);
			$feed->put('ga_profileName', $feeds[0]->profileName);
			$feed->put('ga_webPropertyId', $feeds[0]->webPropertyId);
			$feed->put('ga_startDate', strtotime($feeds[0]->startDate));
		}
		return $feed;
	}

	function getComponentParameter($key){
		$params   = JComponentHelper::getParams('com_ganalytics');
		return $params->get($key, null);
	}

	function convertCountryNameToISO($countryName) {
		static $countrys;
		if($countrys == null){
			$countrys = parse_ini_file(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_ganalytics'.DS.'util'.DS.'countrys.txt');
		}
		$upperName = strtoupper($countryName);
		if(isset($countrys[$upperName])){
			return $countrys[$upperName];
		}
		return '';
	}

	function configureCache($feed, $params, $cacheDir){
		if(class_exists('GAnalyticsProUtil')){
			GAnalyticsProUtil::configureCache($feed, $params, $cacheDir);
		} else {
			$feed->enable_cache(false);
		}
	}
}
?>