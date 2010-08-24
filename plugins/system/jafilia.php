<?php
/**
 * @version 1.5.14
 * @package    jafilia
 * @author     Arkadiusz Maniecki {@link http://www.webwizard.pl/en/}
 * @author     Created on 26-Sep-2009
 */

//-- No direct access
defined('_JEXEC') or die('=;)');
//error_reporting(E_ALL);
jimport('joomla.plugin.plugin');

/**
 * Example System Plugin
 *
 * @package		jafilia
 * @subpackage	Plugin
 */
class plgSystemjafilia extends JPlugin
{
	/**
	 * Constructor
	 *
	 * For php4 compatability we must not use the __constructor as a constructor for plugins
	 * because func_get_args ( void ) returns a copy of all passed arguments NOT references.
	 * This causes problems with cross-referencing necessary for the observer design pattern.
	 *
	 * @access      protected
	 * @param       object  $subject The object to observe
	 * @param       array   $config  An array that holds the plugin configuration
	 * @since       1.0
	 */
	function plgSystemjafilia( &$subject, $config )
	{
		parent::__construct( $subject, $config );

		// Do some extra initialisation in this constructor if required
	}

	/**
	 * Do something onAfterInitialise
	 */
	function onAfterInitialise()
	{
		/*
		 * Get the site object
		 */
		$app =& JFactory::getApplication();

		/*
		 * Don't fire in the backend
		 */
		if ($app->isAdmin()) return;
		###### Jafilia 1.5 Hack ######
		include('components'.DS.'com_jafilia'.DS.'jafilia.inc.php');
		###### End Jafilia 1.5 Hack ######				
	}

	/**
	 * Do something onAfterRoute
	
	function onAfterRoute()
	{

	}
 */
	/**
	 * Do something onAfterDispatch
 */	
	function onAfterDispatch()
	{
		global $vars;
		if ($vars['page']=="checkout.thankyou") {
		$order_subtotal=$vars['order_subtotal_withtax']-$vars['order_tax'];
		//echo"<hr>onAfterDispatch | ".$vars['order_total']." | ".$order_subtotal." | ".$vars['page']."<hr>";
			###### Jafilia 1.5 Hack ######			
			$dbj = new ps_DB; //$dbj = &JFactory::getDbo();
			$path = JPATH_ADMINISTRATOR.DS.'components'.DS.'com_jafilia'.DS.'config.jafilia.php';
			include($path); 

			if(isset($_COOKIE['cook_jaffiliate']) && $jafversion == 'sale' || $jafversion == 'lead') {
			$aff = $_COOKIE['cook_jaffiliate'];

			if($jafversion == 'sale') $sale = round(($order_subtotal/100)*$jafsale,2);
			if($jafversion == 'lead') $sale = $jaflead;

			$date = date('Y-m-d H:i:s');
			$order_id = $vars['order_id'];
			$affiliate = array(
			'uid' => $aff,
			'version' => $jafversion,
			'order' => $order_id,
			'sale' => $sale,
			'status' => 'open',
			'date' => $date
			);

			$dbj->buildQuery( 'INSERT', '#__jafilia_sales', $affiliate );
			$affisale = $dbj->query();

			if(!$affisale) echo "
			ERROR Saving _jafilia_sales!
			";
			}			
			###### End Jafilia 1.5 Hack ######		
		}	
	}

	/**
	 * Do something onAfterRender
	
	function onAfterRender()
	{
	}
	 */
}
