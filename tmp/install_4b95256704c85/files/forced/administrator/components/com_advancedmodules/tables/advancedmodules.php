<?php
/**
 * Table class: advancedmodules
 *
 * @package     Advanced Module Manager
 * @version     1.7.0
 *
 * @author      Peter van Westen <peter@nonumber.nl>
 * @link        http://www.nonumber.nl
 * @copyright   Copyright (C) 2010 NoNumber! All Rights Reserved
 * @license     http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

class TableAdvancedModules extends JTable
{
  var $id=null;
  var $moduleid=null;
  var $params=null;
  
  function __construct( &$db )
  {
    parent::__construct( '#__advancedmodules', 'id', $db );
  }
}