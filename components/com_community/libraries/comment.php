<?php
/**
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 * 
 * Comment allow any additional comment to be appended to any content  
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

if( !class_exists('Services_JSON') )
{
	require_once (JPATH_ROOT.DS.'plugins'.DS.'system'.DS.'pc_includes'.DS.'JSON.php');
}

class CComment
{
	/**
	 * Return an array of comment data within the content
	 */
	function getCommentsData($content)
	{
		$json = new Services_JSON();
		$comments = array();
		
		// See if the content already has commment. 
		// If not, create it and add to it
		$regex = '/\<comment\>(.*?)\<\/comment\>/i'; 

		if (preg_match($regex, $content, $matches)) { 
			$comments = $json->decode($matches[1]);	
		}
		
		return $comments;
	}
	
	/**
	 * Append the given comment to the particular content.
	 * 
	 * @return, full-text of the content	 	 
	 */	 
	function add($actor, $comment, $content)
	{
		$commentJson = '';
		$json = new Services_JSON();
		
		
		$comments = $this->getCommentsData($content);
		
		// Once we retrive the comment, we can remove them
		$content = preg_replace('/\<comment\>(.*?)\<\/comment\>/i', '', $content);
		
		$newComment = new stdClass();
		$date		= new JDate();
		
		$newComment->creator = $actor;
		$newComment->text 	 = $comment;
		$newComment->date 	 = $date->toUnix();
		$comments[] = $newComment;
		
		$commentJson = $json->encode($comments);
		
		$content .= '<comment>'. $commentJson .'</comment>';
		return $content;
	}
	
	/**
	 * Remove the given indexed comment from the content	
	 */	
	function remove($content, $index) 
	{
		$comments = $this->getCommentsData($content);
		array_splice($comments, $index, 1);
		
		// Once we retrive the comment, we can remove them
		$content = preg_replace('/\<comment\>(.*?)\<\/comment\>/i', '', $content);
		
		$json = new Services_JSON();
		$commentJson = $json->encode($comments);
		
		$content .= '<comment>'. $commentJson .'</comment>';
		return $content;
	}
	
	/**
	 * Return html formatted comments given the content
	 */	 	
	function getHTML($content, $id)
	{
		$my = CFactory::getUser();
		$comments = $this->getCommentsData($content);
		$html = '';
		
		if(!empty($comments)) 
		{
			foreach($comments as $row )
			{
				$html .= $this->renderComment($row);
				
			}
		}
		
		// Add the comment box
		if( $my->id != 0 ) 
		{
			$html .= '<form class="wall-coc-form" action=""><textarea name="comment" style="height:40px;" rows="" cols=""></textarea>';
			$html .= '<div class="wall-coc-form-actions">';
			$html .= '<button class="wall-coc-form-action add button" onclick="joms.comments.add(\''.$id.'\'); return false;" type="submit">' . JText::_('CC COC ADD') . '</button>';
			$html .= '<button class="wall-coc-form-action cancel button" onclick="joms.comments.cancel(\''.$id.'\'); return false;" type="submit">' . JText::_('CC BUTTON CANCEL') . '</button>';
			$html .= '<span class="wall-coc-errors" style="margin-left: 5px;"></span>';
			$html .= '</div></form>';
			$html .= '<span class="show-cmt"><a href="javascript:void(0)" onclick="joms.comments.show(\''. $id .'\');">' . JText::_('CC COMMENT') . '</a></span>';
		}
		
		// We need to hide the unnecessary 'remove' link
		$js = '<script type=\'text/javascript\'>';
		$js .= '/*<![CDATA[*/';
		$js .= 'if(js_viewerId  == js_profileId) {
				jQuery("a.coc-remove").show();
			}
			
			if(js_viewerId !=0 ){
				jQuery("a.coc-" + js_viewerId).show();
			
		} ';
		$js .= '/*]]>*/';
		$js .= '</script>';
		$html .= $js;
		
		if(!empty($html))
			$html = '<div id="'.$id.'" class="wall-cocs">'.$html . '</div>';
		return $html;
	}
	
	function renderComment( $cmtObj )
	{
		$my = CFactory::getUser();
		$user = CFactory::getUser($cmtObj->creator);
		
		// Process the text
		$cmtObj->text = nl2br(strip_tags($cmtObj->text));
		
		//format the date
		$dateObject = cGetDate($cmtObj->date);
		$date = $dateObject->toFormat(JText::_('DATE_FORMAT_LC2'));

		$html = '';
		$html .= '<div class="wallcmt">';
		
		CFactory::load( 'helpers' , 'user' );
		$html .= cGetUserThumb( $user->id , 'wall-coc-avatar' );

		CFactory::load( 'helpers' , 'string' );
		$html	= cReplaceThumbnails($html);

		$html .= '<a class="wall-coc-author" href="' . CRoute::_('index.php?option=com_community&view=profile&userid='.$user->id) . '">' . $user->getDisplayName() . '</a> ';
		$html .= JText::sprintf('CC COMMENT POSTED ON', '<span class="wall-coc-date">' . $date  . '</span>' );
	
		if ($my->id==$user->id)
		$html .= ' | <a class="coc-remove coc-'.$cmtObj->creator.'" onclick="joms.comments.remove(this);" href="javascript:void(0)">' . JText::_('CC REMOVE') . '</a>';
		
		$html .= '<p>' . $cmtObj->text . '</p>';		
		$html .= '</div>';
		return $html;
	}
	
	// remove the comment data from the given content
	function stripCommentData($content)
	{
		// Once we retrive the comment, we can remove them
		$content = preg_replace('/\<comment\>(.*?)\<\/comment\>/i', '', $content);
		return $content;
	}
}