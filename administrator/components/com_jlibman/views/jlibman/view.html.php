<?php
/**
 * Document Description
 * 
 * Document Long Description 
 * 
 * PHP4/5
 *  
 * Created on Sep 28, 2007
 * 
 * @package JLibMan
 * @author Sam Moffatt <s.moffatt@toowoomba.qld.gov.au>
 * @author Toowoomba City Council Information Management Branch
 * @license GNU/GPL http://www.gnu.org/licenses/gpl.html
 * @copyright 2007 Toowoomba City Council/Developer Name 
 * @version SVN: $Id:$
 * @see Project Documentation DM Number: #???????
 * @see Gaza Documentation: http://gaza.toowoomba.qld.gov.au
 * @see JoomlaCode Project: http://joomlacode.org/gf/project/
 */
 
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view');

/**
 * HTML View class for the HelloWorld Component
 *
 * @package    JLibMan
 */

class JLibManViewJLibMan extends JView
{
    function display($tpl = null)
    {
    	JToolBarHelper::title( JText::_( 'JLibrary Manager' ), 'install.png' );
        //JToolBarHelper::addNewX(); // Use install manager
    	
        $model =& $this->getModel();
		$libs = $model->listLibraries();
		$this->assignRef( 'items', $libs);
        parent::display($tpl);
    }
}
?>
