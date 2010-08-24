<?php
class hwd_rm_lt_Config{ 

  // Stores the only allowable instance of this class.
  var $instanceConfig = null;

  // Member variables
  var $enable_longtail = '0';
  var $longtail_channel_default = '';
  var $longtail_d = '';
  var $longtail_s = '';

/**
  * get_instance
  *	Description:
  *		This function is used to instantiate the object
  * 		and ensure only one of this type exists at any
  *		time. It returns a reference to the only Config
  *		instance.
  *	Parameters:
  *		none
  *	Returns:
  *		Config
  **/

  function get_instance(){
    $instanceConfig = new hwd_rm_lt_Config;
    return $instanceConfig;
  }

}
?>