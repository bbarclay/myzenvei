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

defined('_JEXEC') or die('Restricted access');

$params = $this->params;

$document =& JFactory::getDocument();
$document->addScript(JURI::base().'administrator/components/com_ganalytics/libraries/sorttable/table.js');
$document->addStyleSheet(JURI::base().'components/com_ganalytics/views/ganalytics/tmpl/list.css');

for ($i = 0; $i < count($this->feeds); $i++) {
	$feed = $this->feeds[$i];
	if($i == 0){
		$title = $this->titleFormat;
		$title = str_replace("{accountname}", $feed->get('ga_accountName'), $title);
		$title = str_replace("{profilename}", $feed->get('ga_profileName'), $title);
		$title = str_replace("{startdate}", strftime($this->dateFormat, $feed->get_start_date()), $title);
		$title = str_replace("{dateseparator}", '-', $title);
		$title = str_replace("{endate}", strftime($this->dateFormat, $feed->get_end_date()), $title);
		echo $title;
	}

	if($feed->get('isVisitorFeed')){
		$msg	= JText::_('VISITORS');
		$text	= sprintf( $msg, floor(($feed->get_end_date()-$feed->get_start_date())/60/60/24));
		echo '<p>'.$text."</p>\n";
		echo GAnalyticsListUtil::getTableCode($feed, 'com_ganalytics_visitor_table', $params);
		echo '<hr/>'; //<p>'.JText::_('DIMENSION'). ': '.substr($this->dimensions, 3).'<br/>'.JText::_('METRICS'). ': '.substr($this->metrics, 3)."</p>\n";
	}else{
		echo GAnalyticsListUtil::getTableCode($feed, 'com_ganalytics_data_table', $params);
	}
}
?>