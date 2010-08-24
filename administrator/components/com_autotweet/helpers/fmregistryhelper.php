<?php
/**
 *  This Registry class works around the problem that JRegistry does not parse sections.
 *
 * @version	1.2
 * @author	Ulli Storck
 * @license	GPL 2.0
 *
 */

// Check to ensure this file is included in Joomla!
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.filesystem.file');


class FmRegistryHelper
{
	protected $jreg = null;
	
	private function FmRegistryHelper()
    {
        // static class, no instance
    }
	

	function loadIniFile($reg_obj, $data, $namespace = null)
    {
        // Load a file into the given namespace [or default namespace if not given]
        $handler =& JRegistryFormat::getInstance('INI');

        // If namespace is not set, get the default namespace
        if ($namespace == null) {
            $namespace = $reg_obj->_defaultNameSpace;
        }

        if (!isset($reg_obj->_registry[$namespace])) {
            // If namespace does not exist, make it and load the data
            $reg_obj->makeNameSpace($namespace);
            $reg_obj->_registry[$namespace]['data'] = $handler->stringToObject($data, true);
        }
        else {
            // Get the data in object format
            $ns = $handler->stringToObject($data, true);

            foreach (get_object_vars($ns) as $k => $v) {
                $reg_obj->_registry[$namespace]['data']->$k = $v;
            }
        }

        return true;
    }
	
	function getFileContent($url)
	{
		$cxn = curl_init();
	    curl_setopt ($cxn, CURLOPT_URL, $url);
	    curl_setopt ($cxn, CURLOPT_HEADER, 0);

	    ob_start();

	    curl_exec ($cxn);
		curl_close ($cxn);
		
		$string = ob_get_contents();		

	    ob_end_clean();
	   
	    return $string;    
	}

}
	
?>
