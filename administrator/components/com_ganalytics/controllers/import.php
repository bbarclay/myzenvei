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

class GAnalyticsControllerImport extends GAnalyticsController
{
	function __construct()
	{
		parent::__construct();
	}

	function add()
	{
		$model = $this->getModel('Import');

		if ($model->store($post)) {
			$msg = JText::_( 'Accounts saved!' );
		} else {
			$msg = JText::_( 'Error saving accounts' );
		}

		$link = 'index.php?option=com_ganalytics';
		$this->setRedirect($link, $msg);
	}
	function cancel()
	{
		$msg = JText::_( 'Operation cancelled' );
		$this->setRedirect( 'index.php?option=com_ganalytics', $msg );
	}
}
?>
