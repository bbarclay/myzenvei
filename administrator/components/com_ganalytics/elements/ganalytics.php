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

defined('_JEXEC') or die( 'Restricted access' );

require_once (JPATH_ADMINISTRATOR.DS.'components'.DS.'com_ganalytics'.DS.'util'.DS.'dbutil.php');

class JElementGAnalytics extends JElement
{
	var	$_name = 'GAnalytics';

	function fetchElement($name, $value, &$node, $control_name)
	{
		$section	= $node->attributes('section');
		$class		= $node->attributes('class');
		if (!$class) {
			$class = "inputbox";
		}
		
		$type = $node->attributes('type') == 'single' ? '' : 'multiple="multiple"';

		if (!isset ($section)) {
			// alias for section
			$section = $node->attributes('scope');
			if (!isset ($section)) {
				$section = 'content';
			}
		}

		$options = GAnalyticsDBUtil::getAllAccounts();
		$result = '<select name="'.$control_name.'['.$name.'][]" id="'.$name.'" class="'.$class.' '.$type.'>';
		
		foreach( $options as $option ) {
			$display_name = $option->accountName.' ['.$option->profileName.']';
			if(is_array( $value) ) {
				if( in_array( $option->id, $value ) ) {
					$result .= '<option selected="true" value="'.$option->id.'" >'.$display_name.'</option>';
				} else {
					$result .= '<option value="'.$option->id.'" >'.$display_name.'</option>';
				}
			} elseif ( $value ) {
				if( $value == $option->id ) {
					$result .= '<option selected="true" value="'.$option->id.'" >'.$display_name.'</option>';
				} else {
					$result .= '<option value="'.$option->id.'" >'.$display_name.'</option>';
				}
			} elseif ( !( $value ) ) {
				$result .= '<option value="'.$option->id.'" >'.$display_name.'</option>';
			}
		}
		$result .= '</select>';
		return $result;
		
	}
}
