<?php
/**
 * @category	Library
 * @package		JomSocial
 * @subpackage	Photos 
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 */
defined('_JEXEC') or die('Restricted access');

class CPhotos
{
	static function getActivityContentHTML($act)
	{
		// Ok, the activity could be an upload OR a wall comment. In the future, the content should
		// indicate which is which
		$html = '';
		$param = new JParameter( $act->params );
		$action = $param->get('action' , false);
		CFactory::load('models', 'photos');
		$url	= $param->get( 'url' , false );
		
		if( $action == 'wall' )
		{
			
			// unfortunately, wall post can also have 'photo' as its $act->apps. If the photo id is availble
			// for (newer activity stream, inside the param), we will show the photo snippet as well. Otherwise
			// just print out the wall content
			
			// Version 1.6 onwards, $params will contain photoid information
			// older version would have #photoid in the $title, since we link it to the photo
			
			$photoid = $param->get('photoid', false);
			if( $photoid )
			{
				$photo = JTable::getInstance( 'Photo' , 'CTable' );
				$photo->load( $act->cid );
				
				$html  = '<ul class ="cDetailList clrfix">';
				$html .= '<li>';
				$html .= '<!-- avatar --><div class="avatarWrap">';
				
				if( $url )
				{
					$html	.= '<a href="' . $param->get('url') . '">';
				}
				
				$html	.= '<img src="'.$photo->getThumbURI().'" class="avatar" />';
				
				if( $url )
				{
					$html	.= '</a>';
				}
				$html	.= '</div><!-- avatar -->';
				$html .= '<!-- details --><div class="detailWrap alpha">'.JString::substr($act->content, 0, STREAM_CONTENT_LENGTH).'</div><!-- details -->';
				$html .= '</li>';
				$html .= '</ul>';
			} 
						
		}
		elseif ( $action == 'upload' )
		{
			// If content has link to image, we could assume it is "upload photo" action
			// since old content add this automatically.
			// The $act->cid will be the album id, Retrive the recent photos uploaded
			$photoModel = CFactory::getModel('photos');
			$album		= JTable::getInstance( 'Album' , 'CTable' );
			$album->load( $act->cid );

			$html  = '<ul class ="cDetailList clrfix">';
			$html .= '<li>';
			$html .= '<!-- avatar --><div class="avatarWrap"><img alt="'.$album->description.'" src="'.$album->getCoverThumbPath().'" class="avatar"/></div><!-- avatar -->';
			$html .= '<!-- details --><div class="detailWrap alpha">'.JString::substr($album->description, 0, STREAM_CONTENT_LENGTH).'</div><!-- details -->';
			$html .= '</li>';
			$html .= '</ul>';
			
		}
		
		return $html;
	}

}