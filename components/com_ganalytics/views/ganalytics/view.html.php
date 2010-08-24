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

jimport( 'joomla.application.component.view');

class GAnalyticsViewGAnalytics extends JView
{
	function display($tpl = null)
	{
		global $mainframe;
		$params = &$mainframe->getParams();

		$feeds = $this->get( 'SelectedAccounts' );
		$this->assignRef( 'feeds',	$feeds );

		$this->assignRef('titleFormat', $params->get('titleFormat', ''));
		$this->assignRef('dateFormat', $params->get('dateFormat', '%d.%m.%Y'));
		$this->assignRef('params', $params );
		parent::display($tpl);
	}
}
?>
