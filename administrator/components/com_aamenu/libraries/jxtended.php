<?php
/**
 * @version		$Id: jxtended.php 36 2009-05-19 01:06:55Z eddieajau $
 * @package		JXtended.Libraries
 * @subpackage	plgSystemJXtended
 * @copyright	Copyright (C) 2008 - 2009 JXtended, LLC. All rights reserved.
 * @license		GNU General Public License <http://www.gnu.org/copyleft/gpl.html>
 * @link		http://jxtended.com
 */

defined('JPATH_BASE') or die;

if (!defined('JX_LIBRARIES')) {
	define('JX_LIBRARIES', '1.0.9');
}

/**
 * JXtended intelligent file importer.
 *
 * @param	string	$path	A dot syntax path.
 * @return	boolean	True on success
 * @since	1.0
 */
function jximport($path)
{
	static $base;

	if (!$base) {
		$base = realpath(dirname(__FILE__));
	}

	if (strpos($path, 'jxtended') === 0) {
		return JLoader::import($path, $base, '');
	} else {
		return JLoader::import($path, null, 'libraries.');
	}
}

/**
 * JXtended JavaScript language string support function.
 *
 * @return	void
 * @since	1.0.5
 */
function jxjslanginject()
{
	$app = &JFactory::getApplication();
	$doc = &JFactory::getDocument();

	if ($doc->getType() == 'html') {
		$lang = $app->get('jx.jslang', array());
		if (!empty($lang)) {
			$txt = '{';
			foreach ($lang as $k => $v)
			{
				$txt .= $k.':"'.$v.'",';
			}
			if (strlen($txt) > 1) {
				$txt = substr($txt, 0, strlen($txt) - 1);
			}
			$txt .= '}';
			$doc->addScriptDeclaration('	JXLang='.$txt.';');
		}
	}
}
$dispatcher = &JDispatcher::getInstance();
$dispatcher->register('onAfterDispatch', 'jxjslanginject');