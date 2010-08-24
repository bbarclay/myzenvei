<?php
/**
 * @version $Id: eucalib.admin.common.php
 * @package AEC - Account Control Expiration - Membership Manager
 * @subpackage Eucalib Common Admin Files
 * @copyright 2006-2008 Copyright (C) David Deutsch
 * @author David Deutsch <skore@skore.de> & Team AEC - http://www.valanx.org
 * @license GNU/GPL v.2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html or, at your option, any later version
 *
 *                         _ _ _
 *                        | (_) |
 *     ___ _   _  ___ __ _| |_| |__
 *    / _ \ | | |/ __/ _` | | | '_ \
 *   |  __/ |_| | (_| (_| | | | |_) |
 *    \___|\__,_|\___\__,_|_|_|_.__/  v1.0
 *
 * The Extremely Useful Component LIBrary will rock your socks. Seriously. Reuse it!
 */

( defined('_JEXEC') || defined( '_VALID_MOS' ) ) or die( 'Restricted access' );

/**
* Settings Handling
*
* Creates a full Settings array
*/
class eucaSettings
{

	function eucaSettings( $area, $subarea='' )
	{
		$this->area				= $area;
		$this->original_subarea	= $subarea;
		$this->subarea			= $subarea;
	}

	function fullSettingsArray( $params, $params_values, $lists = array(), $settings = array() ) {
		$this->params			= $params;
		$this->params_values	= $params_values;
		$this->lists			= $lists;
		$this->settings			= $settings;

		foreach ( $this->params as $name => $type ) {

			if ( isset( $this->params['euca_collation'] ) && !( strcmp( $name, 'euca_collation' ) === 0 ) ) {
				$cn = explode( "_", $name, 2 );
				if ( isset( $cn[1] ) ) {
					$realname = $cn[1];
				} else {
					$realname = $name;
				}
			} else {
				$realname = $name;
			}

			// Determine the value, first telling whether it is already set
			if ( isset( $this->params_values[$name] ) ) {
				$value = $this->params_values[$name];
			} else {
				$value = $this->params_values[$name] = null;
			}

			// Checking for remap functions
			$remap = 'remap_' . $type;

			if ( method_exists( $this, $remap ) ) {
				$type = $this->$remap( $name, $value );
			} else {
				$type = $type;
			}

			// Delete if DEL trigger was set by rewrite
			if ( strcmp( $type, 'DEL' ) === 0 ) {
				continue;
			}

			// Create constant names
			$constant_generic	= '_' . strtoupper($this->area)
								. '_' . strtoupper( $this->original_subarea )
								. '_' . strtoupper( $realname );
			$constant			= '_' . strtoupper( $this->area )
								. '_' . strtoupper( $this->subarea )
								. '_' . strtoupper( $realname );

			// First try a generic name or insert blank constant for easy copy and paste
			$constantname = $constant . '_NAME';
			if ( defined( $constantname ) ) {
				$info_name = constant( $constantname );
			} else {
				$genericname = $constant_generic . '_NAME';
				if ( defined( $genericname ) ) {
					$info_name = constant( $genericname );
				} else {
					$info_name = $constantname;
				}
			}

			// First try a generic name or insert blank constant for easy copy and paste
			$constantdesc = $constant . '_DESC';
			if ( defined( $constantdesc ) ) {
				$info_desc = constant( $constantdesc );
			} else {
				$genericdesc = $constant_generic . '_DESC';
				if ( defined( $genericname ) ) {
					$info_desc = constant( $genericdesc );
				} else {
					$info_desc = $constantdesc;
				}
			}

			$this->settings[$name] = array( $type, $info_name, $info_desc, $value );
		}
	}

	function remap_subarea_change( $name, $value )
	{
		$this->subarea = $value;
		return 'DEL';
	}

	function remap_list_yesno( $name, $value )
	{
		$this->lists[$name] = mosHTML::yesnoSelectList( $name, '', $value );
		return 'list';
	}

	function remap_list_date( $name, $value )
	{
		$this->lists[$name] = '<input class="text_area" type="text" name="' . $name . '" id="' . $name . '" size="19" maxlength="19" value="' . $value . '"/>'
		.'<input type="reset" name="reset" class="button" onClick="return showCalendar(\'' . $name . '\', \'y-mm-dd\');" value="..." />';
		return 'list';
	}
}

class eucaHTMLbackend
{
	function eucaHTMLbackend( $rows, $lists=null )
	{
		$this->rows		= $rows;
		$this->lists	= $lists;
	}

	function cycleSettingsParticle()
	{
		foreach( $this->rows as $name => $content ) {
			echo $this->createSettingsParticle( $name );
		}
	}

	function createSettingsParticle( $name )
	{
		$row = getRow( $name );

		if ( isset($row[3] ) ) {
			$value = $row[3];
		} else {
			$value = '';
		}

		$return = '<div class="setting_desc">' . $this->ToolTip( $row[2], $row[1]) . $row[1] . '</div>';
		$return .= '<div class="setting_form">';

		$method = 'displaymethod_' . $row[0];

		if ( method_exists( $this, $method ) ) {
			$return = $this->$method( $name, $value, $return );
		} else {
			$return = $this->displaymethod_inputA( $name, $value, $return );
		}

		if ( strpos( $return, '<div class="setting_form">' ) === 0 ) {
			$return .= '</div>';
		}

		return $return;
	}

	function getRow( $name )
	{
		if ( is_array( $name ) ) {

		} else {
			$arr_keys = array_keys( $this->rows[$name] );

			if ( is_array( $this->rows[$name][$arr_keys[0]] ) ) {
				return $this->getRow( array( $name => $arr_keys ) );
			} else {
				return $this->rows[$name];
			}
		}
	}

	function displaymethod_startform( $name, $value, $return )
	{
		return '<form action="' . _EUCA_APP_ADMINACTIONURL . '&amp;task=' . $value . '" method="post" />';
	}

	function displaymethod_formblockstart( $name, $value, $return )
	{
		return '<div class="euca_formblock">';
	}

	function displaymethod_formblockend( $name, $value, $return )
	{
		return '</div>';
	}

	function displaymethod_formblockbranding( $name, $value, $return )
	{
		return '<div class="euca_formblockbranding">' . $value . '</div>';
	}

	function displaymethod_submitform( $name, $value, $return )
	{
		return '<input type="submit" />';
	}

	function displaymethod_endform( $name, $value, $return )
	{
		return '</form>';
	}

	function displaymethod_hidden( $name, $value, $return )
	{
		return '<input name="' . $name . '" type="hidden" value="' . $value . '" />';
	}

	function displaymethod_inputA( $name, $value, $return )
	{
		return $return . '<input name="' . $name . '" type="text" size="4" value="' . $value . '" />';
	}

	function displaymethod_inputB( $name, $value, $return )
	{
		return $return . '<input name="' . $name . '" type="text" size="20" value="' . $value . '" />';
	}

	function displaymethod_inputC( $name, $value, $return )
	{
		return $return . '<input name="' . $name . '" type="text" size="60" value="' . $value . '" />';
	}

	function displaymethod_inputD( $name, $value, $return )
	{
		return $return . '<textarea cols="50" rows="5" name="' . $name . '" />' . $value . '</textarea>';
	}

	function displaymethod_inputE( $name, $value, $return )
	{
		return $return . '<textarea style="width:900px" cols="450" rows="8" name="' . $name . '" />' . $value . '</textarea>';
	}

	function displaymethod_editor( $name, $value, $return )
	{
		$return .= '<div class="setting_form">';
		$return .= editorArea( $name, $value, $name, '100%;', '250', '10', '60' );
		$return .= '</div>';
	}

	function displaymethod_list( $name, $value, $return )
	{
		return $return . $this->lists[$name];
	}

	function displaymethod_fieldset( $name, $value, $return ) {
		return $return . '<fieldset><legend>' . $name . '</legend>' . "\n"
		. '<table cellpadding="1" cellspacing="1" border="0">' . "\n"
		. '<tr align="left" valign="middle" ><td>' . $value . '</td></tr>' . "\n"
		. '</table>' . "\n"
		. '</fieldset>' . "\n"
		;
	}

	/**
	* Utility function to provide ToolTips
	* @param string ToolTip text
	* @param string Box title
	* @returns HTML code for ToolTip
	*/
	function ToolTip( $tooltip, $title='', $width='', $image='help.png', $text='', $href='#', $link=1 )
	{
		if ( $width ) {
			$width = ', WIDTH, \''.$width .'\'';
		}
		if ( $title ) {
			$title = ', CAPTION, \''.$title .'\'';
		}
		if ( !$text ) {
			$image 	= _EUCA_APP_ADMINICONSDIR . '/'. $image;
			$text 	= '<img src="'. $image .'" border="0" alt=""/>';
		}
		$style = 'style="text-decoration: none; color: #586C79;"';
		if ( $href ) {
			$style = '';
		} else{
			$href = '#';
		}

		$mousover = 'return overlib(\''. htmlentities( $tooltip ) .'\''. $title .', BELOW, RIGHT'. $width .');';

		$tip = '';
		if ( $link ) {
			$tip .= '<a href="'. $href .'" onmouseover="'. $mousover .'" onmouseout="return nd();" '. $style .'>'. $text .'</a>';
		} else {
			$tip .= '<span onmouseover="'. $mousover .'" onmouseout="return nd();" '. $style .'>'. $text .'</span>';
		}

		return $tip . '&nbsp;';
	}

}

class eucaList
{
	function setTable( $table )
	{
		$this->table = $table;
	}

	function setHead( $array )
	{
		if ( !isset( $this->head ) ) {
			$this->head = array();
		}

		$this->head = array_merge( $this->head, $array );
	}

	function buildRowsSpecial( $id )
	{
		$this->buildRows();
	}

	function buildRows()
	{
		$database = &JFactory::getDBO();

		global $mainframe;

		$option = 'com_' . _EUCA_APP_SHORTNAME;

		$this->limit		= $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', $mainframe->getCfg( 'list_limit' ) );
		$this->limitstart	= $mainframe->getUserStateFromRequest( "viewconf{$option}limitstart", 'limitstart', 0 );

		$this->orderby		= $mainframe->getUserStateFromRequest( "orderby", 'orderby', 'id ASC' );
		$this->search		= $mainframe->getUserStateFromRequest( "search{$option}", 'search', '' );
		$this->search		= $database->getEscaped( trim( strtolower( $this->search ) ) );

		// Get total amount of records
		$query	= 'SELECT count(*)'
				. ' FROM ' . $this->table
				;
		$database->setQuery( $query );
		$this->totalrows = $database->loadResult();

		if ( $this->limitstart > ( $this->totalrows ) ) {
			$this->limitstart = 0;
		}

		// Get Object List
		$query	= 'SELECT *'
				. ' FROM ' . $this->table
				. ' ORDER BY ' . $this->orderby
				. ' LIMIT ' . $this->limitstart . ',' . $this->limit
				;
		$database->setQuery( $query );
		$this->rows = $database->loadObjectList();
	}

	function display()
	{
		?>
		<form action="index2.php" method="post" name="adminForm">
		<div id="dvs_servers_overview">
		<table>
			<tr>
			<?php
			foreach ( $this->head as $hname => $behavior ) {
			?>
				<th>
				<?php
					if ( $behavior['showname'] ) {
						echo $hname;
					}
					if ( $behavior['order'] ) {
						echo $this->jsImgLink( 'orderby_asc', 'bullet_arrow_up', '/\\', array( 'orderby' => '\'' . $hname . " ASC" . '\'' ) );
						echo $this->jsImgLink( 'var_orderby_desc', 'bullet_arrow_down', '\\/', array( 'orderby' => '\'' . $hname . " DESC" . '\'' ) );
					}
				?>
				</th>
			<?php
			}
			?>
			</tr>
			<input type="hidden" name="orderby" value="<?php echo $this->orderby;?>" />
			<?php
			foreach ( $this->rows as $row ) {
			?>
				<tr>
				<?php
				foreach ( $this->head as $hname => $type ) {
				?>
					<td>
					<?php
						$customdisplay = 'customdisplay_' . $hname;
						if ( method_exists( $this, $customdisplay ) ) {
							echo $this->$customdisplay( $row, $hname );
						} elseif ( isset( $row->$hname ) ) {
							echo $row->$hname;
						}
					?>
					</td>
				<?php
				}
				?>
				</tr>
			<?php
			}
			?>
		</table>
		<div class="euca_pagination">
		<?php
			echo $this->pagination();
		?>
		</div>
		</div>

		<input type="hidden" name="option" value="<?php echo 'com_' . _EUCA_APP_SHORTNAME; ?>" />
		<input type="hidden" name="task" value="<?php echo $this->task;?>" />
		<input type="hidden" name="nexttask" value="<?php echo $this->task;?>" />

		</form>
		<?php
	}

	function pagination()
	{
		$remaining = $this->totalrows - ( $this->limitstart + $this->limit );
		$previouslimit = $this->limitstart - $this->limit;
		$nextlimit = $this->limitstart + $this->limit;
		$lastlimit = $this->totalrows - $this->limit;

		$pages = array();

		// Add a maximum of 30 previous pages to the list
		if ( $this->limitstart > 0 ) {
			for ( $i=$previouslimit, $k=0; $i>=0 && $k<30; $i-=$this->limit, $k++ ) {
				// The first and previous page get a special icon, the rest is displayed normally
				if ( $i === 0 ) {
					$page = $this->jsImgLink( 'limitstart_start', 'resultset_first', '&lArr;', array( 'limitstart' => 0 ) );
				} elseif( $i === $previouslimit ) {
					$page = $this->jsImgLink( 'limitstart_previous', 'resultset_previous', '&larr;', array( 'limitstart' => $i ) );
				} else {
					$page_number = (int) ( $i / $this->limit );
					$sizing = max( 0, ( 10 - $k ) );
					$page = $this->jsLink( $page_number, '', $page_number, $vars=array( 'limitstart' => $i ), 'euca_plink_' . $sizing . ' euca_plink' );
				}

				$pages[$i] = $page;
			}

			// Add Starting mark if it is out of range
			if ( !isset( $pages[0] ) ) {
				$pages[0] = $this->jsImgLink( 'limitstart_start', 'resultset_first', '&lArr;', array( 'limitstart' => 0 ) );
			}
		}

		// Add the current page
		$pages[$this->limitstart] = (int) ( $this->limitstart / $this->limit );

		// Add a maximum of 30 following pages to the list
		if ( $remaining > 0 ) {
			for ( $i=$nextlimit, $k=0; $i<=$lastlimit && $k<30; $i+=$this->limit, $k++ ) {
				// The last and next page get a special icon, the rest is displayed normally
				if ( $i >= $lastlimit ) {
					$page = $this->jsImgLink( 'limitstart_end', 'resultset_last', '&rArr;', array( 'limitstart' => $lastlimit ) );
				} elseif( $i === $nextlimit ) {
					$page = $this->jsImgLink( 'limitstart_next', 'resultset_next', '&rarr;', array( 'limitstart' => $i ) );
				} else {
					$page_number = (int) ( $i / $this->limit );
					$sizing = max( 0, ( 10 - $k ) );
					$page = $this->jsLink( $page_number, '', $page_number, $vars=array( 'limitstart' => $i ), 'euca_plink_' . $sizing . ' euca_plink' );
				}

				$pages[$i] = $page;
			}

			// Add Ending mark if it is out of range
			if ( !isset( $pages[$lastlimit] ) ) {
				$pages[$lastlimit] = $this->jsImgLink( 'limitstart_end', 'resultset_last', '&lArr;', array( 'limitstart' => $lastlimit ) );
			}
		}

		ksort($pages);

		$pagination = "";
		//$pagination .= "&nbsp;";
		$pagination .= implode( "&nbsp;", $pages );
		//$pagination .= "&nbsp;";

		$pagination .= '<input type="hidden" name="limitstart" value="' . $this->limitstart . '" />';
		return $pagination;
	}

	function jsImgLink( $name, $icon, $alt='', $vars=array(), $class='euca_icon' )
	{
		$iconhtml = eucaToolbox::makeIcon( $icon, $alt );
		return $this->jsLink( $name, $iconhtml, $alt, $vars, $class );
	}

	function jsLink( $name, $content, $alt, $vars=array(), $class='euca_icon' )
	{
		$js = '<a href="#' . $name . '" class="' . $class . '" title="' . $name . '"';
		$js .= ' onclick="';
		if ( !empty( $vars ) ) {
			$js .= 'javascript:';
			foreach ( $vars as $vname => $value ) {
				$js .= ' document.adminForm.' . $vname . '.value=' . $value . ';';
			}
			$js .= ' ';
		}
		$js .= 'document.adminForm.submit();';
		if ( !empty( $vars ) ) {
			$js .= 'return false;';
		}
		$js .= '"';
		$js .= ' >';
		$js .= $content;
		$js .= '</a>';

		return $js;
	}

	function customdisplay_active( $row, $name )
	{
		return eucaToolbox::makeIcon( ( $row->active ? 'tick' : 'exclamation' ) );
	}

}

class eucaObjectHandler
{
	function overview( $id=null )
	{
		$list = new $this->listclass();
		if ( !is_null( $id ) ) {
			$list->buildRowsSpecial( $id );
		} else {
			$list->buildRows();
		}

		$dvsHTML = new $this->htmlclass();
		$dvsHTML->overview();
		$list->display();
		$dvsHTML->footer();
	}

	function create()
	{
		$this->edit( 0 );
	}

	function edit( $id )
	{
		$database = &JFactory::getDBO();

		$params_values = array();
		$params_values['startform'] = $this->area . '_' . $this->focus . '_save';

		$params = array();
		$params['startform']	= 'startform';

		if ( is_array( $id ) ) {
			$params['euca_collation'] = 'hidden';
			$params_values['euca_collation'] = 1;

			foreach ( $id as $i ) {
				if ( !empty( $i ) ) {
					$params['formblockstart_' . $i] = 'formblockstart';
					$params_values['formblockstart_' . $i] = 1;

					$params['formblockbranding_' . $i] = 'formblockbranding';
					$params_values['formblockbranding_' . $i] = "#" . $i;

					$object = new $this->rootclass( $database );
					$object->load( $i );

					foreach ( $object->fullparamsValuesArray() as $name => $value ) {
						$params_values[$i  . '_' . $name] = $value;
					}

					foreach ( $object->paramTypeList() as $name => $value ) {
						$params[$i  . '_' . $name] = $value;
					}

					$params['formblockend_' . $i] = 'formblockend';
					$params_values['formblockend_' . $i] = 1;
				}
			}
		} else {
			$params['formblockstart_' . $id] = 'formblockstart';
			$params_values['formblockstart_' . $id] = 1;

			$object = new $this->rootclass( $database );
			$object->load( $id );

			foreach ( $object->fullparamsValuesArray() as $name => $value ) {
				if ( is_array( $value ) ) {
					foreach( $value as $n => $v ) {
						$params_values[$name . '_' . $n] = $v;
					}
				} else {
					$params_values[$name] = $value;
				}
			}

			foreach ( $object->paramTypeList() as $name => $value ) {
				if ( is_array( $value ) ) {
					foreach( $value as $n => $v ) {
						$params[$name . '_' . $n] = $v;
					}
				} else {
					$params[$name] = $value;
				}
			}


			$params['formblockend_' . $id] = 'formblockend';
			$params_values['formblockend_' . $id] = 1;
		}

		$params['submitform']	= 'submitform';
		$params['endform']	= 'endform';

		if ( method_exists( $this, 'getLists' ) ) {
			$lists = $this->getLists();
		} else {
			$lists = array();
		}

		$Settings = new $this->settingsclass( $this->focus, 'edit' );
		$Settings->fullSettingsArray( $params, $params_values, $lists );

		$fullSettings = new $this->settingshtmlclass( $Settings->settings, $Settings->lists );

		$HTML = new $this->htmlclass();
		$HTML->edit( $fullSettings );
		$HTML->footer();
	}

	function save()
	{
		$database = &JFactory::getDBO();

		if ( isset( $_POST['euca_collation'] ) ) {

			$superpost = array();
			foreach ( $_POST as $name => $value ) {
				$cn = explode( "_", $name, 2 );

				$superpost[$cn[0]][$cn[1]] = $value;
			}

			foreach ( $superpost as $name => $post ) {
				// Save Object
				if ( !( ( strcmp( $name, 'euca' ) === 0 ) || ( strcmp( $name, 'mce' ) === 0 ) ) ) {
					$object = new $this->rootclass( $database );
					$object->fullSave( $post );
				}
			}
		} else {
			$object = new $this->rootclass( $database );
			$object->fullSave( $_POST );
		}

		$this->overview();
	}

	function delete( $id )
	{
		$database = &JFactory::getDBO();

		$object = new $this->rootclass( $database );
		$object->load( $id );
		$object->delete();

		$this->overview();
	}
}

?>
