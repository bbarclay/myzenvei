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

jimport( 'joomla.application.component.view' );

class GAnalyticsViewImport extends JView
{
	function display($tpl = null)
	{
		JToolBarHelper::title(   JText::_( 'GAnalytics Manager' ), 'generic.png' );
		JToolBarHelper::custom('add', 'new.png', 'new.png', 'add', false);
		JToolBarHelper::cancel();

		$items = $this->get( 'OnlineData');
		$this->assignRef('online_items', $items);
		parent::display($tpl);
	}
}