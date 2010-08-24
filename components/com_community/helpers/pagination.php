<?php
/**
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

class CPaginationLibrary
{
	function getLinks( &$pagination , $ajaxLink = '' , $uniqueId = '' , $limit = 5 )
	{
		$data	= $pagination->getData();
		$output	= '<div id="photo-pagination"><div>'. $pagination->getPagesCounter() . '</div>';

// 			echo '<pre>';
// 			print_r( $pagination->getData() );
// 			echo '</pre>';
			
		// Display pages links
		for( $i = 1 ; $i <= count( $data->pages ); $i++ )
		{

			
			if( $data->pages[$i]->link == null )
			{
				$output	.= '<span class="selected" style="font-weight: 700; padding: 3px;">' . $data->pages[$i]->text . '</span>';
			}
			else
			{
				// Format the limitstart properly so that
				$start	= ceil( $data->pages[$i]->base );
				
				$output	.= '<span style="padding: 3px;"><a onclick="jax.call(\'community\',\'' . $ajaxLink . '\', \'' . $uniqueId . '\',\'' . $start . '\',\'' .$limit .'\');"  href="javascript:void(0);" >' 
						. $data->pages[$i]->text 
						. '</a></span>';
			}
 			
		}
		
		$output	.= '</div>';
		
		return $output;
	}
}