<?php
defined( '_JEXEC' ) or die( '=;)' );
jimport('joomla.application.component.model');
class JafiliaModelConfig extends JModel {
	function __construct() {
		parent::__construct();
	}
	function store() {
	  
		$configfile = JPATH_COMPONENT.DS.'config.jafilia.php';
		@chmod ($configfile, 0777);
		$permission = is_writable($configfile);
	
        if (!$permission) {
		   return false;
        }
		
		$jafversion = JRequest::getVar('jafversion');
		$jafclick = strtr(JRequest::getVar('jafclick'), ',', '.');
		$jafsale = JRequest::getVar('jafsale');
		$jaflead = JRequest::getVar('jaflead');
		$jafpayout = strtr(JRequest::getVar('payout'), ',', '.');
		$jafloginmod = JRequest::getVar('loginmod');
		$jafadminmail = JRequest::getVar('jafadminmail');
		$jaftemplate = JRequest::getVar('jaftemplate', 'default');
		$jafcscheme = JRequest::getVar('colorscheme', 'softgreen.txt');
		$jafshortdesc = $_POST['jafshortdesc'];
		$jafterms = $_POST['jafterms'];
		
        $config .= "<?php defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );\n";
        $config .= "\n";
		
		$config .="\$jafversion			= \"$jafversion\";\n";
		$config .="\$jafclick			= \"$jafclick\";\n";
		$config .="\$jafsale			= \"$jafsale\";\n";
		$config .="\$jaflead			= \"$jaflead\";\n";
		$config .="\$jafpayout			= \"$jafpayout\";\n";
		$config .="\$jafadminmail		= \"$jafadminmail\";\n";
		$config .="\$jafloginmod		= \"$jafloginmod\";\n";
		$config .="\$jafcscheme			= \"$jafcscheme\";\n";
		$config .="\$jaftemplate		= \"$jaftemplate\";\n";
		$config .="\$jafshortdesc		= \"$jafshortdesc\";\n";
		$config .="\$jafterms			= \"$jafterms\";\n";
		
		$config .= "?>";

        if ($fp = fopen("$configfile", "w"))
        {
                fputs($fp, $config, strlen($config));
                fclose ($fp);
        }
		return true;
	} 
	function cancel() {
      $msg = JText::_('JAF_CANCELED');
      $this->setRedirect( 'index.php?option=com_jafilia', $msg );
   }
}
?>