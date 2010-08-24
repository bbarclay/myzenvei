<?php
/**
 * @package		JomSocial
 * @subpackage	Core 
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

class CMailqLibrary{
	
	/**
	 * Do a batch send
	 */	 	
	function send( $total = 100 )
	{
		$mailqModel =& CFactory::getModel( 'mailq' );
		$mails		= $mailqModel->get( $total );
		$mailer		=& JFactory::getMailer();
		$config		=& CFactory::getConfig();

		if(!empty($mails))
		{
			foreach( $mails as $row )
			{
				// @rule: only send emails that is valid.
				if(!JString::stristr( $row->recipient , 'foo.bar') )
				{
					$mailer->addRecipient($row->recipient);
					$mailer->setSubject($row->subject);
					

					if( $config->get('htmlemail') )
					{
						$mailer->IsHTML( true );
						$tmpl	= new CTemplate();
						$row->body	= JString::str_ireplace(array("\r\n", "\r", "\n"), '<br />', $row->body );
						$tmpl->set( 'content' , $row->body );
						$tmpl->set( 'template', rtrim( JURI::root() , '/' ) . '/components/com_community/templates/' . $config->get('template') );
						$tmpl->set( 'sitename' , $config->get('sitename') );
						$row->body	= $tmpl->fetch( $config->get('htmlemailtemplate') );
						unset($tmpl);
					}
					$mailer->setBody($row->body);					
					$mailer->send();
					$mailqModel->markSent($row->id);
					$mailer->ClearAllRecipients();
				}
			}
		}
	}
	
}