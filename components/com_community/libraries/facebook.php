<?php
/**
 * @category	Library
 * @package		JomSocial
 * @subpackage	user 
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 */
defined('_JEXEC') or die('Restricted access');

// Core file is required since we need to use CFactory
require_once( JPATH_ROOT . DS . 'components' . DS . 'com_community' . DS . 'libraries' . DS . 'core.php' );

// Need to include Facebook's PHP API library so we can utilize them.
require_once( JPATH_ROOT . DS . 'components' . DS . 'com_community' . DS . 'libraries' . DS . 'facebook' . DS . 'facebook.php' );

/**
 * Wrapper class for Facebook's API.
 **/ 
class CFacebook
{
	var $client	= null;
	var $userId	= '';
	var $lib	= null;
	
	/**
	 * 	Fields to map from Facebook and the values are the default field codes in Jomsocial.
	 **/	 
	var $_fields	= array( 
								'sex'				=> 'FIELD_GENDER',
								'birthday'			=> 'FIELD_BIRTHDAY',
								'current_location'	=> array( 'state' => 'FIELD_STATE' , 'city' => 'FIELD_CITY' , 'country' => 'FIELD_COUNTRY' ),
								'about_me'			=> 'FIELD_ABOUTME',
								'education_history'	=> array( 'year' => 'FIELD_GRADUATION' )
							);
	/**
	 *	Initial method
	 **/	 	
	function __construct( $requireLogin = true )
	{
		$config			=& CFactory::getConfig();
		
		$key			= $config->get('fbconnectkey');
		$secret			= $config->get('fbconnectsecret');
		
		$this->lib		= new Facebook( $key , $secret );
		
		if( $requireLogin )
		{
			$this->userId	= $this->lib->require_login();
		}

		$this->client	= $this->lib->api_client;
	}

	/**
	 * Deprecated since 1.5
	 **/	 	
	function &getInstance( $requireLogin = true )
	{
		static $wrapperObject	= null;
		
		if( is_null( $wrapperObject ) )
		{
			$wrapperObject	= new CFacebook( $requireLogin );
		}
		
		return $wrapperObject;
	}


	function hasPermission( $identifier )
	{
		if( $this->client->users_hasAppPermission( $identifier ) == 1 )
			return true;
	
		return false;
	}
	
	function setStatus( $text = '' )
	{
		var_dump( $this->client->users_setStatus( $text ) );
		exit;
		$data	= $this->client->users_setStatus( $text );
	}
	
	/**
	 *	Return user's data that is fetched from Facebook
	 *	
	 *	@params $fields	Array of fields available.	 	 
	 **/
	function getUserInfo( $fields )
	{
		$data			= $this->client->users_getInfo( $this->userId , $fields );
		
		$data			= isset( $data[0] ) ? $data[0] : false;
		
		if( isset($data['pic_square']) && empty($data['pic_square'] ) )
		{
			$data['pic_square']	= rtrim( JURI::root() , '/' ) . '/' . DEFAULT_USER_THUMB;
		}
		
		return $data;
	}
	
	function getUserId()
	{
		return $this->userId;
	}

	function mapAvatar( $avatarUrl = '' , $joomlaUserId , $addWaterMark )
	{
		$image	= '';

		if( !empty( $avatarUrl ) )
		{
			// Make sure user is properly added into the database table first
			$user	= CFactory::getUser( $joomlaUserId );
			
			// Load image helper library as it is needed.
			CFactory::load( 'helpers' , 'image' );
			
			// Store image on a temporary folder.
			$tmpPath	= JPATH_ROOT . DS . 'images' . DS . 'originalphotos' . DS . 'facebook_connect_' . $this->userId;
			
			$fp = fsockopen("profile.ak.facebook.com", 80, $errno, $errstr, 30);
			
			$path	= JString::str_ireplace( 'http://profile.ak.facebook.com' , '' , $avatarUrl );
			$source	= '';
			
			if( $fp )
			{
				$out = "GET $path HTTP/1.1\r\n";
				$out .= "Host: profile.ak.facebook.com\r\n";
				$out .= "Connection: Close\r\n\r\n";
			
				fwrite($fp, $out);
				
				$body		= false;
								
				while( !feof( $fp ) )
				{
					$return	= fgets( $fp , 1024 );
					
					if( $body )
					{
						$source	.= $return;
					}
					
					if( $return == "\r\n" )
					{
						$body	= true;
					}
				}
				fclose($fp);
			
			}
			JFile::write( $tmpPath , $source );
 
			// @todo: configurable width?
			$imageMaxWidth	= 160;

			// Get a hash for the file name.
			$fileName		= JUtility::getHash( $this->userId . time() );
			$hashFileName	= JString::substr( $fileName , 0 , 24 );

			$extension			= JString::substr( $avatarUrl , JString::strrpos( $avatarUrl , '.' ) );

			$type				= 'image/jpg';
			
			if( $extension == '.png' )
			{
				$type			= 'image/png';
			}
			
			if( $extension == '.gif' )
			{
				$type	= 'image/gif';
			}

			//@todo: configurable path for avatar storage?
			$storage			= JPATH_ROOT . DS . 'images' . DS . 'avatar';
			$storageImage		= $storage . DS . $hashFileName . $extension;
			$storageThumbnail	= $storage . DS . 'thumb_' . $hashFileName . $extension;
			$image				= 'images/avatar/' . $hashFileName . $extension;
			$thumbnail			= 'images/avatar/' . 'thumb_' . $hashFileName . $extension;
			
			$userModel			=& CFactory::getModel( 'user' );

			// Only resize when the width exceeds the max.
			cImageResizePropotional( $tmpPath , $storageImage , $type , $imageMaxWidth );
			cImageCreateThumb( $tmpPath , $storageThumbnail , $type );
			
			if( $addWaterMark )
			{
				// Get the width and height so we can calculate where to place the watermark.
				list( $watermarkWidth , $watermarkHeight ) = getimagesize( FACEBOOK_FAVICON );
				list( $imageWidth , $imageHeight ) = getimagesize( $storageImage );
				list( $thumbWidth , $thumbHeight ) = getimagesize( $storageThumbnail );
				
				cImageAddWaterMark( $storageImage , $storageImage , $type , FACEBOOK_FAVICON , ( $imageWidth - $watermarkWidth ), ( $imageHeight - $watermarkHeight) );
				
				cImageAddWaterMark( $storageThumbnail , $storageThumbnail , $type , FACEBOOK_FAVICON , ( $thumbWidth - $watermarkWidth ), ( $thumbHeight - $watermarkHeight) );
			}
			
			// Update the CUser object with the correct avatar.
			$user->set('_thumb' , $thumbnail );
			$user->set( '_avatar' , $image );
			
			$userModel->setImage( $joomlaUserId , $image , 'avatar' );
			$userModel->setImage( $joomlaUserId , $thumbnail , 'thumb' );
		}
	}

	/**
	 * Maps a user profile with JomSocial's default custom values
	 *
	 *	@param	Array	User values
	 **/	 
	function mapProfile( $values , $userId )
	{
		$profileModel	=& CFactory::getModel( 'Profile' );

		foreach( $this->_fields as $field => $fieldCodes )
		{
			// Test if value really exists and it isn't empty.
			if( isset( $values[ $field ] ) && !empty( $values[ $field ] ) )
			{
				switch( $field )
				{
					case 'birthday':
						//@rule: Test if the year exists
						$pattern	= '/([A-Z]*) ([0-9]*)(,)?( )?([0-9]*)?/i';
						
						preg_match( $pattern , $values[ $field ] , $matches );
						
						$day		= !empty( $matches[ 2 ] ) ? $matches[ 2 ] : 1;
						$month		= !empty( $matches[ 1 ] ) ? $matches[ 1 ] : 1;
						$year		= !empty( $matches[ 5 ] ) ? $matches[ 5 ] : 1970;

						$value		= $year . '-' . $month . '-' . $day . ' 00:00:00';
						$date 		=& JFactory::getDate( $value );
						$profileModel->updateUserData( $fieldCodes , $userId , $date->toMySQL() );
					break;
					case 'sex':
					    $gender = ucfirst( $values[$field] );
					    
					    if( !empty($gender) )
					    {
							$profileModel->updateUserData( $fieldCodes , $userId , $gender );
	  					}
					break;
					default:
						if( is_array( $fieldCodes ) )
						{
							// Facebook library returns an array of values for certain fields so we need to manipulate them differently.
							foreach( $fieldCodes as $fieldData => $fieldCode )
							{
								if( isset( $values[ $field ][ $fieldData ] ) )
								{
									$profileModel->updateUserData( $fieldCode , $userId , $values[ $field ][ $fieldData ] );
								}
							}
						}
						else
						{
						    if( !empty($values[$field]) )
						    {
						        $profileModel->updateUserData( $fieldCodes , $userId , $values[ $field ] );
							}
						}
					break;
				}
			}
		}
		return false;
	}

	/**
	 * Maps a user status with JomSocial's user status
	 *
	 *	@param	Array	User values
	 **/
	function mapStatus( $message , $userId )
	{
		CFactory::load( 'helpers' , 'linkgenerator' );

		$connectModel   =& CFactory::getModel( 'Connect' );
		// @rule: Autolink hyperlinks
		$message		= cGenerateURILinks( $message );
		
		// @rule: Autolink to users profile when message contains @username
		$message		= cGenerateUserAliasLinks( $message );

		// Reload $my from CUser so we can use some of the methods there.
		$my		= CFactory::getUser( $userId );
		$params	= $my->getParams();
					
		// @rule: For existing statuses, do not set them.
		if( $connectModel->statusExists( $message , $userId ) )
		{
		    return;
		}
		
		$act = new stdClass();
		$act->cmd 		= 'profile.status.update';
		$act->actor 	= $userId;
		$act->target 	= $userId;
		$act->title		= '{actor} '. $message;
		$act->content	= '';
		$act->app		= 'profile';
		$act->cid		= $userId;
		$act->access	= $params->get('privacyProfileView');
		
		CFactory::load('libraries', 'activities');
		CActivityStream::add($act);
		
		//add user points
		CFactory::load( 'libraries' , 'userpoints' );		
		CUserPoints::assignPoint('profile.status.update');
		
	
		
		// Update status from facebook.
		$my->setStatus( $message );
	}
	
	function getButtonHTML()
	{
		JPlugin::loadLanguage( 'com_community', JPATH_ROOT );
		CAssets::attach( '' , 'css' , FACEBOOK_BUTTON_CSS );
		
		$config	= CFactory::getConfig();
		$tmpl	= new CTemplate();
		$tmpl->set('config' , $config );

		return $tmpl->fetch('facebook.button');
	}
}