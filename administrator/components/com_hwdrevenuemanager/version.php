<?php
/**
 *    @version [ Cape ]
 *    @package hwdRevenueManager
 *    @copyright (C) 2007 - 2009 Highwood Design
 *    @license Creative Commons Attribution-Non-Commercial-No Derivative Works 3.0 Unported Licence
 *    @license http://creativecommons.org/licenses/by-nc-nd/3.0/
 */
defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

/**
 * Version information
 * @package hwdRevenueManager
 */
class hwdRevenueManagerVersion {
	/** @var string Product */
	var $PRODUCT 	= 'hwdRevenueManager';
	/** @var int Main Release Level */
	var $RELEASE 	= '2.1';
	/** @var string Development Status */
	var $DEV_STATUS = 'Alpha';
	/** @var int Sub Release Level */
	var $DEV_LEVEL 	= '3';
	/** @var int build Number */
	var $BUILD	 	= '177';
	/** @var string Codename */
	var $CODENAME 	= 'Cape';
	/** @var string Date */
	var $RELDATE 	= '2009 12 04';
	/** @var string Time */
	var $RELTIME 	= '16:49:58';
	/** @var string Timezone */
	var $RELTZ 		= 'GMT';
	/** @var string Copyright Text */
	var $COPYRIGHT 	= "Copyright (C) 2007 - 2009 Highwood Design. All rights reserved.";
	/** @var string URL */
	var $URL 		= '<a href="http://hwdmediashare.co.uk">hwdRevenueManager</a>';
	/** @var string Whether site is a production = 1 or demo site = 0: 1 is default */
	var $SITE 		= 1;
	/** @var string Whether site has restricted functionality mostly used for demo sites: 0 is default */
	var $RESTRICT	= 0;
	/** @var string Whether site is still in development phase (disables checks for /installation folder) - should be set to 0 for package release: 0 is default */
	var $SVN		= 0;


	/**
	 * @return string Long format version
	 */
	function getLongVersion() {
		return $this->PRODUCT .' '. $this->RELEASE .'.'. $this->DEV_LEVEL .' Revision '
			. $this->BUILD.' '.$this->DEV_STATUS
			.' [ '.$this->CODENAME .' ] '. $this->RELDATE .' '
			. $this->RELTIME .' '. $this->RELTZ;
	}

	/**
	 * @return string Short version format
	 */
	function getShortVersion() {
		return $this->RELEASE .'.'. $this->DEV_LEVEL;
	}

}
$_VERSION = new hwdRevenueManagerVersion();

$version = $_VERSION->PRODUCT .' '. $_VERSION->RELEASE .'.'. $_VERSION->DEV_LEVEL .' '
. $_VERSION->DEV_STATUS
.' [ '.$_VERSION->CODENAME .' ] '. $_VERSION->RELDATE .' '
. $_VERSION->RELTIME .' '. $_VERSION->RELTZ;
?>
