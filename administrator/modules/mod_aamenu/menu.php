<?php
/**
 * @version		$Id: menu.php 67 2009-05-29 13:02:32Z eddieajau $
 * @copyright	Copyright (C) 2005 - 2008 Open Source Matters. All rights reserved.
 * @copyright	Copyright (C) 2009 New Life in IT Pty Ltd. All rights reserved.
 * @license		GNU General Public License <http://www.gnu.org/copyleft/gpl.html>
 * @link		http://www.theartofjoomla.com
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

jimport('joomla.base.tree');

/**
 * @package		TAOJ.AAMenu
 * @subpackage	mod_aamenu
 */
class JAdminCSSMenu2 extends JTree
{
	/**
	 * CSS string to add to document head
	 * @var string
	 */
	var $_css = null;

	function __construct()
	{
		$this->_root = new JMenuNode2('ROOT');
		$this->_current = & $this->_root;
	}

	function addSeparator()
	{
		$this->addChild(new JMenuNode2(null, null, 'separator', false));
	}

	function renderMenu($id = 'menu', $class = '')
	{
		global $mainframe;

		$depth = 1;

		if(!empty($id)) {
			$id='id="'.$id.'"';
		}

		if(!empty($class)) {
			$class='class="'.$class.'"';
		}

		/*
		 * Recurse through children if they exist
		 */
		while ($this->_current->hasChildren())
		{
			echo "<ul ".$id." ".$class.">\n";
			foreach ($this->_current->getChildren() as $child)
			{
				$this->_current = & $child;
				$this->renderLevel($depth++);
			}
			echo "</ul>\n";
		}

		if ($this->_css) {
			// Add style to document head
			$doc = & JFactory::getDocument();
			$doc->addStyleDeclaration($this->_css);
		}
	}

	function renderLevel($depth)
	{
		/*
		 * Build the CSS class suffix
		 */
		$class = '';
		if ($this->_current->hasChildren()) {
			$class = ' class="node"';
		}

		if($this->_current->class == 'separator') {
			$class = ' class="separator"';
		}

		if($this->_current->class == 'disabled') {
			$class = ' class="disabled"';
		}


		/*
		 * Print the item
		 */
		echo "<li".$class.">";

		/*
		 * Print a link if it exists
		 */
		if ($this->_current->link != null) {
			echo "<a class=\"".$this->getIconClass($this->_current->class)."\" href=\"".$this->_current->link."\">".$this->_current->title."</a>";
		} elseif ($this->_current->title != null) {
			echo "<a>".$this->_current->title."</a>\n";
		} else {
			echo "<span></span>";
		}

		/*
		 * Recurse through children if they exist
		 */
		while ($this->_current->hasChildren())
		{
			if ($this->_current->class) {
				echo '<ul id="menu-'.strtolower($this->_current->id).'"'.
					' class="menu-component">'."\n";
			} else {
				echo '<ul>'."\n";
			}
			foreach ($this->_current->getChildren() as $child)
			{
				$this->_current = & $child;
				$this->renderLevel($depth++);
			}
			echo "</ul>\n";
		}
		echo "</li>\n";
	}

	/**
	 * Method to get the CSS class name for an icon identifier or create one if
	 * a custom image path is passed as the identifier
	 *
	 * @access	public
	 * @param	string	$identifier	Icon identification string
	 * @return	string	CSS class name
	 * @since	1.5
	 */
	function getIconClass($identifier)
	{
		global $mainframe;

		static $classes;

		// Initialize the known classes array if it does not exist
		if (!is_array($classes)) {
			$classes = array();
		}

		/*
		 * If we don't already know about the class... build it and mark it
		 * known so we don't have to build it again
		 */
		if (!isset($classes[$identifier])) {
			if (substr($identifier, 0, 6) == 'class:') {
				// We were passed a class name
				$class = substr($identifier, 6);
				$classes[$identifier] = "icon-16-$class";
			} else {
				// We were passed an image path... is it a themeoffice one?
				if (substr($identifier, 0, 15) == 'js/ThemeOffice/') {
					// Strip the filename without extension and use that for the classname
					$class = preg_replace('#\.[^.]*$#', '', basename($identifier));
					$classes[$identifier] = "icon-16-$class";
				} else {
					if ($identifier == null) {
						return null;
					}
					// Build the CSS class for the icon
					$class = preg_replace('#\.[^.]*$#', '', basename($identifier));
					$class = preg_replace('#\.\.[^A-Za-z0-9\.\_\- ]#', '', $class);

					$this->_css  .= "\n.icon-16-$class {\n" .
							"\tbackground: url($identifier) no-repeat;\n" .
							"}\n";

					$classes[$identifier] = "icon-16-$class";
				}
			}
		}
		return $classes[$identifier];
	}
}

/**
 * @package		TAOJ.AAMenu
 * @subpackage	mod_aamenu
 */
class JMenuNode2 extends JNode
{
	/**
	 * Node Title
	 */
	var $title = null;

	/**
	 * Node Id
	 */
	var $id = null;


	/**
	 * Node Link
	 */
	var $link = null;

	/**
	 * CSS Class for node
	 */
	var $class = null;

	/**
	 * Active Node?
	 */
	var $active = false;


	function __construct($title, $link = null, $class = null, $active = false)
	{
		$this->title	= $title;
		$this->link		= JFilterOutput::ampReplace($link);
		$this->class	= $class;
		$this->active	= $active;
		$this->id		= str_replace(" ","-",$title);

	}
}
