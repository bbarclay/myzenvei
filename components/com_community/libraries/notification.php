<?php
/**
 * @category	Library
 * @package		JomSocial
 * @subpackage	Notification
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 */
defined('_JEXEC') or die('Restricted access');

class CNotificationLibrary{

	function add($cmd, $from, $to, $subject, $body, $template='', $data = null, $sendEmail = true, $favicon = ''){
	
		CFactory::load( 'helpers' , 'emails' );
		
		$userFrom 	= CFactory::getUser($from);

		if(!is_array($to)){
			$toArray = array();
			$toArray[] = $to;
		} else {
			$toArray = $to;
		}
		
		$templateBody = $body;
		
		// If template file is given, we shall extract the email from the template
		// file.
		if(!empty($template)) {				
			$tmpl = new CTemplate();
	    	
	    	$tmpl->set('dummy',  'dummy');
	    	foreach($data as $key=> $val)
				$tmpl->set($key,  $val);
  
			$templateBody =  $tmpl->fetch($template);
		}
		
		$cmdData = explode( '.', $cmd );
		
		// check for privacy setting for each user
		foreach($toArray as $to){
		
			//we process the receipient emails address differently from the receipient id.
			$recipientEmail	= '';
			$recipientName	= '';
			$sendIt			= false;
			
			if(isValidInetAddress($to)) 
			{
				$recipientName	= '';
				$sendIt			= true;
				$recipientEmail	= $to;
			}
			else
			{
			
				$userTo 		= CFactory::getUser($to);
				$params 		=& $userTo->getParams();
				
				$recipientName	= $userTo->getDisplayName();
				$recipientEmail	= $userTo->email;
	
				$body 	= $templateBody;
				$sendIt = false;
				
				switch($cmdData[0]){
					case 'inbox':
						$sendIt = $params->get('notifyEmailSystem');
						break;
					case 'photos':
						$sendIt = $params->get('notifyEmailSystem');
						break;						
					case 'groups':
						$sendIt = $params->get('notifyEmailSystem');
						break;
					case 'friends':
						$sendIt = $params->get('notifyEmailSystem');
						break;
					case 'profile':
						$sendIt	= $params->get('notifyEmailSystem');
						break;
					case 'system':
						$sendIt = true;
						break;
						
				}
			}

			if($sendIt) {
				// Porcess the message and title
				$search 	= array('{actor}', '{target}');
				$replace 	= array($userFrom->getDisplayName(), $recipientName );
				
				$subject 	= JString::str_ireplace($search, $replace, $subject);
				$body 		= JString::str_ireplace($search, $replace, $body);
				
				$mailqModel =& CFactory::getModel( 'mailq' );
				$mailqModel->add( $recipientEmail, $subject, $body );
			}
		}
		
		
	}
	
	/**
	 * Return notification send to the given user
	 */	 	
	function get($id){
		$mailqModel =& CFactory::getModel( 'mailq' );
		$mailers = $mailqModel->get();
	}
}
