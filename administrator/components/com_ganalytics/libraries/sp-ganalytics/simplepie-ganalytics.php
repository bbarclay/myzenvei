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
 * @version $Revision: 0.2.0 $
 */

if (!defined('SIMPLEPIE_NAMESPACE_GOOGLE_ANALYTICS')) {
	define('SIMPLEPIE_NAMESPACE_GOOGLE_ANALYTICS', 'http://schemas.google.com/analytics/2009');
}

/**
 * SimplePie_GAnalytics is a SimplePie extension which provides some
 * helper methods for google analytics data feeds.
 *
 * @see http://code.google.com/apis/analytics/docs/gdata/gdataReferenceAccountFeed.html
 * @see http://code.google.com/apis/analytics/docs/gdata/gdataReferenceDataFeed.html
 */
class SimplePie_GAnalytics extends SimplePie {

	var $user_name = null;
	var $password = null;
	var $profile_id = null;
	var $parameters = null;
	var $start_date = null;
	var $end_date = null;
	var $authorization = null;

	/**
	 * Returns the authorization string. Useful to store
	 * it in a session to prevent multiple authorizations.
	 *
	 * @return authorization
	 */
	function get_authorization() {
		return $this->authorization;
	}

	/**
	 * Sets the authorizaion string. Useful to prevent the
	 * feed to do the authentication process for every request.
	 *
	 * @param $value the authentication string
	 */
	function set_authorization($value = null) {
		if(!empty($value))
		$this->authorization = $value;
	}

	/**
	 * Sets the login information
	 *
	 * @param $uname
	 * @param $passwd
	 */
	function set_login($uname = null, $passwd = null) {
		if(!empty($uname))
		$this->user_name = $uname;
		if(!empty($passwd))
		$this->password = $passwd;
	}

	/**
	 * Returns the start date as unix timestamp.
	 *
	 * @return start date
	 */
	function get_start_date() {
		return $this->start_date;
	}

	/**
	 * Sets the start date from a unix timestamp.
	 *
	 * @param $value the start date as unix timestamp
	 */
	function set_start_date($value = null) {
		if(!empty($value))
		$this->start_date = $value;
	}

	/**
	 * Returns the end date as unix timestamp.
	 *
	 * @return end date
	 */
	function get_end_date() {
		return $this->end_date;
	}

	/**
	 * Sets the end date from a unix timestamp.
	 *
	 * @param $value the end date as unix timestamp
	 */
	function set_end_date($value = null) {
		if(!empty($value))
		$this->end_date = $value;
	}

	/**
	 * Sets the parameters.
	 *
	 * @param $dimensions
	 * @param $metrics
	 * @param $max_results
	 * @param $sort
	 */
	function set_parameters($dimensions, $metrics, $max_results, $sort){
		$parameters = array('dimensions' 	=> $dimensions,
						'metrics'    	=> $metrics,
						'max-results'   => $max_results);
		if(!empty($sort))
		$parameters['sort'] = $sort;
		$this->parameters = $parameters;
	}

	/**
	 * Returns the dimensions.
	 *
	 * @return dimensions
	 */
	function get_dimensions() {
		if($this->parameters != null && isset($this->parameters))
		return $this->parameters['dimensions'];
		return '';
	}

	/**
	 * Returns the metrics.
	 *
	 * @return metrics
	 */
	function get_metrics() {
		if($this->parameters != null && isset($this->parameters))
		return $this->parameters['metrics'];
		return '';
	}

	/**
	 * Returns the sort criteria.
	 *
	 * @return sort criteria
	 */
	function get_sort() {
		if($this->parameters != null && isset($this->parameters))
		return $this->parameters['sort'];
		return '';
	}

	/**
	 * Returns the total returned items.
	 *
	 * @return max items
	 */
	function get_max_results() {
		if($this->parameters != null && isset($this->parameters))
		return $this->parameters['max-results'];
		return '';
	}

	/**
	 * Returns the profile ID.
	 *
	 * @return profile ID
	 */
	function get_profile_id(){
		return $this->profile_id;
	}

	/**
	 * Sets the profile ID. If this is not set get_items() will return
	 * an array of SimplePie_Item_GAnalytics_Account items.
	 *
	 * @param $value
	 */
	function set_profile_id($value = null){
		if(strpos($value, 'ga:') !== 0)
		$value = 'ga:'.$value;
		$this->profile_id = $value;
	}

	/**
	 * Checks if the feed is authorized to retrieve the
	 * data. If not a ClientLogin call against google is
	 * done to get an authorization token which is accessible
	 * through get_authorization().
	 * This method can be called from autside to retrieve the authorization
	 * token in advance.
	 *
	 * @return the authorization token
	 */
	function authorize() {
		if(empty($this->authorization)){
			$file = new SimplePie_File_GAnalytics(
				'https://www.google.com/accounts/ClientLogin?accountType=HOSTED_OR_GOOGLE&Email='.$this->user_name.'&Passwd='.$this->password.'&service=analytics&source=GAnalytics-com_ganalytics-0.5.1',
			10, 5, null, null, false);
			$content = $file->body;
			if (strpos($content, "\n") !== false){
				$responses = explode("\n", $content);
				foreach ($responses as $response){
					if (substr($response, 0, 4) == 'Auth'){
						$this->authorization = trim(substr($response, 5));
					}
				}
			}
		}
		if(empty($this->authorization)){
			$this->error = 'Error authenticating user '.$this->user_name.'. Erro response was '.$content;
		}
		return $this->authorization;
	}

	/**
	 * Overrides the default ini method and sets automatically
	 * SimplePie_File_GAnalytics as file class.
	 * If the profile id is set the items of this feed are
	 * SimplePie_Item_GAnalytics_Account else they are
	 * SimplePie_Item_GAnalytics.
	 * Authorization is also handled here if $this->authorization
	 * is empty.
	 */
	function init(){
		$this->set_file_class('SimplePie_File_GAnalytics');
		$this->set_cache_name_function(array('SimplePie_GAnalytics', 'ga_md5'));

		$this->authorize();

		$url = '';
		if(empty($this->profile_id)){
			$this->set_item_class('SimplePie_Item_GAnalytics_Account');
			$url = 'https://www.google.com/analytics/feeds/accounts/default';
		}else {
			$this->set_item_class('SimplePie_Item_GAnalytics');
			$params = array();
			foreach($this->parameters as $key => $property){
				$params[] = $key . '=' . urlencode($property);
			}

			$url = 'https://www.google.com/analytics/feeds/data?ids=' . $this->profile_id .
                                                        '&start-date=' . date('Y-m-d', $this->start_date). 
                                                        '&end-date=' . date('Y-m-d', $this->end_date). '&' . 
			implode('&', $params);
		}
		$this->set_feed_url($url.'&auth='.$this->authorization);

		parent::init();
		$this->set_feed_url($url);
	}


	/**
	 * Sets the given value for the given key which is accessible in the get(...) method.
	 * @param $key
	 * @param $value
	 */
	function put($key, $value){
		$this->meta_data[$key] = $value;
	}

	/**
	 * Returns the value for the given key which is set in the set(...) method.
	 * @param $key
	 * @return the value
	 */
	function get($key){
		return $this->meta_data[$key];
	}

	/**
	 * This function strips the auth code from the url to be sure
	 * there is no cache generated for every session.
	 */
	function ga_md5($name){
		$parts = explode('&auth=', $name);
		if(is_array($parts) && count($parts) > 1){
			$name = $parts[0];
		}
		return md5($name);
	}
}

/**
 * Class which handles the authorization requirements from google.
 */
class SimplePie_File_GAnalytics extends SimplePie_File{

	function SimplePie_File_GAnalytics($url, $timeout = 10, $redirects = 5, $headers = null, $useragent = null, $force_fsockopen = false){
		$parts = explode('&auth=', $url);
		$auth = '';
		if(is_array($parts) && count($parts) > 1){
			$url = $parts[0];
			$auth = $parts[1];
		}
		parent::SimplePie_File($url, $timeout = 10, $redirects = 5, array('Authorization' => 'GoogleLogin auth=' . $auth), $useragent = null, $force_fsockopen = false);
	}
}

/**
 * Account items.
 */
class SimplePie_Item_GAnalytics_Account extends SimplePie_Item {

	function SimplePie_Item_GAnalytics_Account($feed, $data){
		parent::SimplePie_Item($feed, $data);
		$this->init();
	}

	// internal cache variables
	var $account_id = null;
	var $account_name = null;
	var $profile_id = null;
	var $web_property_id = null;

	/**
	 * Returns the account ID.
	 *
	 * @return account ID
	 */
	function get_account_id(){
		return $this->account_id;
	}

	/**
	 * Returns the account name.
	 *
	 * @return account name
	 */
	function get_account_name(){
		return $this->account_name;
	}

	/**
	 * Returns the profile ID.
	 *
	 * @return profile ID
	 */
	function get_profile_id(){
		return $this->profile_id;
	}

	/**
	 * Returns the profile name.
	 *
	 * @return profile name
	 */
	function get_profile_name() {
		return $this->get_title();
	}

	/**
	 * Returns the web property ID.
	 *
	 * @return web property ID
	 */
	function get_web_property_id(){
		return $this->web_property_id;
	}

	/**
	 * Initializes the variables. Do not call this method directly it
	 * is used internal.
	 */
	function init(){
		$data = $this->get_item_tags(SIMPLEPIE_NAMESPACE_GOOGLE_ANALYTICS, 'property');
		foreach ($data as $variable) {
			$attr = $variable['attribs'][''];
			if($attr['name'] == 'ga:accountId')
			$this->account_id = $attr['value'];
			if($attr['name'] == 'ga:accountName')
			$this->account_name = $attr['value'];
			if($attr['name'] == 'ga:profileId')
			$this->profile_id = $attr['value'];
			if($attr['name'] == 'ga:webPropertyId')
			$this->web_property_id = $attr['value'];
		}
	}
}

/**
 * Data items.
 */
class SimplePie_Item_GAnalytics extends SimplePie_Item {

	function SimplePie_Item_GAnalytics($feed, $data){
		parent::SimplePie_Item($feed, $data);
		$this->init();
	}

	//internal cache variables
	var $dimensions;
	var $metrics;

	/**
	 * Returns all available dimension identifiers as array.
	 *
	 * @return the dimensions
	 */
	function get_available_dimension_names(){
		return array_keys($this->dimensions);
	}

	/**
	 * Returns the dimension value for the given dimension.
	 *
	 * @param $dimension_name
	 * @return the dimension
	 */
	function get_dimension($dimension_name){
		return $this->dimensions[$dimension_name];
	}

	/**
	 * Returns all available metric identifiers as array.
	 *
	 * @return the metrics
	 */
	function get_available_metric_names(){
		return array_keys($this->metrics);
	}

	/**
	 * Returns the metric value for the given metric.
	 *
	 * @param $metric_name
	 * @return the metric
	 */
	function get_metric($metric_name){
		return $this->metrics[$metric_name];
	}

	/**
	 * Initializes the variables. Do not call this method directly it
	 * is used internal.
	 */
	function init(){
		$data = $this->get_item_tags(SIMPLEPIE_NAMESPACE_GOOGLE_ANALYTICS, 'dimension');
		foreach ($data as $variable) {
			$attr = $variable['attribs'][''];
			$this->dimensions[$attr['name']] = $attr['value'];
		}

		$data = $this->get_item_tags(SIMPLEPIE_NAMESPACE_GOOGLE_ANALYTICS, 'metric');
		foreach ($data as $variable) {
			$attr = $variable['attribs'][''];
			$this->metrics[$attr['name']] = $attr['value'];
		}
	}
}
?>