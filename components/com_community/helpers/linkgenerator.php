<?php
/**
 * @category	Helper
 * @package		JomSocial
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 */
defined('_JEXEC') or die('Restricted access');

function cValidateURL($url) 
{
	//$regex = '/^(http|https|ftp):\/\/([A-Z0-9][A-Z0-9_-]*(?:\.[A-Z0-9][A-Z0-9_-]*)+):?(\d+)?\/?/i';
	$regex = '/^(([\w]+:)?\/\/)?(([\d\w]|%[a-fA-f\d]{2,2})+(:([\d\w]|%[a-fA-f\d]{2,2})+)?@)?([\d\w][-\d\w]{0,253}[\d\w]\.)+[\w]{2,6}(:[\d]+)?(\/([-+_~.\d\w]|%[a-fA-f\d]{2,2})*)*(\?(&amp;?([-+_~.\d\w]|%[a-fA-f\d]{2,2})=?)*)?(#([-+_~.\d\w]|%[a-fA-f\d]{2,2})*)?$/';
	
	if (preg_match($regex, JString::trim($url), $matches)) { 
		return array($matches[1], $matches[2]); 
	} else { 
		return false;
	}
}

function cValidateEmails($email)
{
	CFactory::load( 'helpers' , 'emails' );
	return isValidInetAddress($email);
}


function cGenerateUrlLink($urllink)
{		
	$url		= JString::trim($urllink);
	$schemeRegex	= "/^(https?|ftp)\:\/\/?(.*)?/i";		
 	if( preg_match($schemeRegex, $url)) 
	{
		$url	= '<a href="'.$url.'" target="_BLANK" rel="nofollow">'.$url.'</a>';
	}
	else
	{
		// if not found then just include an 'http://'
		$url	= '<a href="http://'.$url.'" target="_BLANK" rel="nofollow">'.$url.'</a>';
	}
	return $url;
}

function cGenerateEmailLink($emailadd)
{
	$email		= JString::trim($emailadd);
	$emailLink	= JHTML::_( 'email.cloak', $email );
	if(empty($emailLink)){
		$emailLink	= '<a href="mailto:'.$email.'">'.$email.'</a>'; 	
	}//end if
		
	return $emailLink;

}

function cGenerateHyperLink($hyperlink)
{
	$link = JString::trim($hyperlink);

	if(cValidateEmails($link)){
		return cGenerateEmailLink($link);
	} else if(cValidateURL($link)) {
		return cGenerateUrlLink($link);
	} else {
		//do nothing, just return original string.
		return $link;
	}
}

/**
 * Automatically hyperlink a user's link
 * 
 * @param	$userId		User's id.
 * @param	$userName	Username of user.
 *
 * return	$urlLink	HTML codes that hyperlink to users profile.
 **/
function cGenerateUserLink( $userId , $userName )
{
	$url		= CRoute::_('index.php?option=com_community&view=profile&userid=' . $userId );

	$urlLink	= '<a href="'.$url.'" rel="nofollow">'. $userName .'</a>';
	
	return $urlLink;	
}

/**
 * Automatically link urls in the provided message
 * 
 * @param	$message	A string of message that may or may not contain a url.
 *
 * return	$message	A modified copy of the message with the proper hyperlinks.
 **/
function cGenerateURILinks( $message )
{
	$message = preg_replace('@(https?://([-\w\.]+)+(:\d+)?(/([\w/_\.\-]*(\?\S+)?)?)?)@', '<a href="$1">$1</a>', $message );
	
	return $message;
}

/**
 * Automatically link username in the provided message when message contains @username
 * 
 * @param	$message	A string of message that may or may not contain @username
 *
 * return	$message	A modified copy of the message with the proper hyperlinks.
 **/
function cGenerateUserAliasLinks( $message )
{
	$pattern	= '/@(("(.*)")|([A-Z0-9][A-Z0-9_-]+)([A-Z0-9][A-Z0-9_-]+))/i';
	
	preg_match_all( $pattern , $message , $matches );

	if( isset($matches[0]) && !empty($matches[0]) )
	{
		CFactory::load( 'helpers' , 'user' );
			
		$usernames	= $matches[ 0 ];

		for( $i = 0 ; $i < count( $usernames ); $i++ )
		{
			$username	= $usernames[ $i ];
			$username	= JString::str_ireplace( '"' , '' , $username );
			$username	= explode( '@' , $username );
			$username	= $username[1];

			$id			= cGetUserId( $username );

			if( $id != 0 )
			{
				$message	= JString::str_ireplace( $username , cGenerateUserLink($id,$username) , $message );
			}
		}
	}
	
	return $message;
}