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

class GAnalyticsListUtil{

	function getTableCode($feed, $tableID, $params) {
		$data = $feed->get_items();
		if(empty($data))return '';

		$pagination = $params->get('pagination', 'yes') == 'yes';
		$dateFormat = $params->get('dateFormat', '%d.%m.%Y');

		$dimensions = $data[0]->get_available_dimension_names();
		$metrics = $data[0]->get_available_metric_names();
		$colCount = count($dimensions)+count($metrics);
		$colWidth = 100/$colCount.'%';

		$buffer = "<table width=\"".$params->get('width', 200)."\" height=\"".$params->get('height', 200)."\" id=\"".$tableID."\" class=\"table-autosort table-stripeclass:alternate ";
		if($pagination){
			$buffer .= "table-autopage:10 table-page-number:".$tableID."page table-page-count:".$tableID."pages";
		}
		$buffer .= "\"><thead><tr>\n";
		foreach ($dimensions as $dimension) {
			$type = 'alphanumeric';
			if(stripos($dimension, 'ga:date') !== false)
			$type = 'date';
			$buffer .= "<th width=\"".$colWidth."\" class=\"table-sortable:".$type." table-sortable\">".JText::_(substr($dimension, 3))."</th>\n";
		}
		foreach ($metrics as $metric) {
			$buffer .= "<th width=\"".$colWidth."\" class=\"table-sortable:numeric table-sortable\">".JText::_(substr($metric, 3))."</th>\n";
		}
		$buffer .= "</tr></thead><tbody>\n";
		$counter = 0;
		foreach($data as $item){
			if($counter % 2 == 0)
			$buffer .= "<tr>\n";
			else $buffer .= "<tr class=\"alternate\">\n";
			foreach ($dimensions as $dimension) {
				$text = $item->get_dimension($dimension);
				if(stripos($dimension, 'ga:date') !== false)
				$text = strftime($dateFormat, mktime(0,0,0, substr($text, 4, 2), substr($text, 6, 2), substr($text, 0, 4)));
				else if(stripos($dimension, 'ga:country') !== false){
					$flag = GAnalyticsUtil::convertCountryNameToISO($text);
					if(!empty($flag))
					$text = '<img src="'.JURI::base().'administrator/components/com_ganalytics/images/flags/'.strtolower($flag).'.gif" width="16px" height="11"/> '.$text;
				}
				$buffer .= "<td>".JText::_($text)."</td>";
			}
			foreach ($metrics as $metric) {
				$text = $item->get_metric($metric);
				$buffer .= "<td>".$text."</td>";
			}
			$buffer .= "\n</tr>\n";
			$counter++;
		}
		$buffer .= "</tbody>\n";
		if($pagination){
			$buffer .= "<tfoot><tr>\n";
			$buffer .= "<td class=\"table-page:previous\" style=\"cursor: pointer;text-align: left;\">".JText::_('PREVIOUS')."</td>\n";
			if($colCount > 2)
			$buffer .= "<td colspan=\"".($colCount-2)."\"></td>\n";
			$buffer .= "<td class=\"table-page:next\" style=\"cursor: pointer;text-align: right;\">".JText::_('NEXT')."</td>\n";
			$buffer .= "</tr><tr>\n";
			$msg	= JText::_('PAGINATION');
			$text	= sprintf( $msg, '<span id="'.$tableID.'page"></span>', '<span id="'.$tableID.'pages"></span>');
			$buffer .= "<td colspan=\"".$colCount."\" style=\"text-align: center;\">".$text."</td>\n";
			$buffer .= "</tr></tfoot>\n";
		}
		$buffer .= "</table>\n";

		return $buffer;
	}
}
?>