<?php 
/**
 * @version		$Id: com_k2.php 303 2010-01-07 02:56:33Z joomlaworks $
 * @package		K2
 * @author    JoomlaWorks http://www.joomlaworks.gr
 * @copyright	Copyright (c) 2006 - 2010 JoomlaWorks Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

if (!function_exists('getCategoryPath')) {

  function getCategoryPath($catid, $begin = false) {
    static $array = array();
    if ($begin) {
      $array = array();
    }
    
    $user = &JFactory::getUser();
    $aid = $user->get('aid');
    $db = &JFactory::getDBO();
    $query = "SELECT * FROM #__k2_categories WHERE id={$catid} AND published=1 AND trash=0 AND access<={$aid}";
    
    $db->setQuery($query);
    $rows = $db->loadObjectList();
    if ($db->getErrorNum()) {
      echo $db->stderr();
      return false;
    }
    
    foreach ($rows as $row) {
      array_push($array, $row->name);
      getCategoryPath($row->parent, false);
    }
    
    return array_reverse($array);
  }
  
}

// ------------------  standard plugin initialize function - don't change ---------------------------
global $sh_LANG,$sefConfig;
$shLangName = '';
$shLangIso = '';
$title = array();
$shItemidString = '';
$dosef = shInitializePlugin($lang, $shLangName, $shLangIso, $option);
if ($dosef == false)
  return;
  
$shHomePageFlag = false;
$shHomePageFlag = !$shHomePageFlag ? shIsHomepage($string) : $shHomePageFlag;

// remove common URL from GET vars list, so that they don't show up as query string in the URL
shRemoveFromGETVarsList('option');
shRemoveFromGETVarsList('lang');
if (! empty($Itemid))
  shRemoveFromGETVarsList('Itemid');
if (! empty($limit))
  shRemoveFromGETVarsList('limit');
if (isset($limitstart))
  shRemoveFromGETVarsList('limitstart'); // limitstart can be zero
  
// start by inserting the menu element title (just an idea, this is not required at all)
$task = isset($task) ? @$task : null;
$view = isset($view) ? @$view : null;
$Itemid = isset($Itemid) ? @$Itemid : null;

// K2 params
$params = &JComponentHelper::getParams('com_k2');
$authorPrefix = $params->get('sh404SefLabelUser', 'blog');
$itemlistPrefix = $params->get('sh404SefLabelCat', '');

$menu = &JSite::getMenu();
$menuparams = NULL;
$menuparams = $menu->getParams($Itemid);

if (isset($task) && (
$task == 'calendar' || $task == 'edit' || $task == 'add' || $task == 'save' || $task == 'deleteAttachment' || $task == 'extraFields' || $task == 'checkin' || $task == 'vote' || $task == 'getVotesNum' || $task == 'getVotesPercentage' || $task == 'comment' || $task == 'download'))
  $dosef = false;
  
if ($view == 'item' && $task == 'tag')
  $dosef = false;
  
switch ($view) {

  case 'item':
    if (isset($id) && $id > 0) {
      $query = 'SELECT title, catid FROM #__k2_items WHERE id = '.$id;
      $database->setQuery($query);
      if (shTranslateUrl($option, $shLangName))
        $row = $database->loadObject();
      else
        $row = $database->loadObject(false);
      $fullPath = getCategoryPath($row->catid, true);
      foreach ($fullPath as $path) {
        $title[] = $path;
      }
      $title[] = $row->title;
    }
    break;
    
  case 'itemlist':
  
    switch ($task) {
    
      case 'category':
      
        if (! empty($itemlistPrefix)) {
          $title[] = $itemlistPrefix;
        }
        $fullPath = getCategoryPath($id, true);
        foreach ($fullPath as $path) {
          $title[] = $path;
        }
        
        break;
        
      case 'user':
        $user = &JFactory::getUser($id);
        if (! empty($authorPrefix)) {
          $title[] = $authorPrefix;
        }
        $title[] = $user->name;
        break;
        
      case 'tag':
        $title[] = 'tag';
        $title[] = str_replace('%20','-',$tag);
        break;
        
      case 'search':
        $title[] = 'search';
        if (! empty($searchword))
          $title[] = $searchword;
        break;
        
      case 'date':
        $title[] = 'date';
        if (! empty($year))
          $title[] = $year;
          
        if (! empty($month))
          $title[] = $month;
          
        if (! empty($day))
          $title[] = $day;
        break;
        
      default:
        if (isset($Itemid))
          $title[] = $menu->getItem($Itemid)->alias;
        break;
        
    }
    
    break;
    
}
shRemoveFromGETVarsList('layout');
shRemoveFromGETVarsList('task');
shRemoveFromGETVarsList('tag');
shRemoveFromGETVarsList('searchword');
shRemoveFromGETVarsList('view');
shRemoveFromGETVarsList('Itemid');
shRemoveFromGETVarsList('year');
shRemoveFromGETVarsList('month');
shRemoveFromGETVarsList('day');
shRemoveFromGETVarsList('id');

// ------------------  standard plugin finalize function - don't change ---------------------------
if ($dosef) {
  $string = shFinalizePlugin($string, $title, $shAppendString, $shItemidString, (isset($limit) ? @$limit : null), (isset($limitstart) ? @$limitstart : null), (isset($shLangName) ? @$shLangName : null));
}
// ------------------  standard plugin finalize function - don't change ---------------------------
