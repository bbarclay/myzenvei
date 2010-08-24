<?php
/**
 *  helper functions for 1stMover AutoTweet extensions.
 *
 * @version	1.7
 * @author	Ulli Storck
 * @license	GPL 2.0
 *
 */

// Check to ensure this file is included in Joomla!
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.error.error' );

require_once (JPATH_ROOT . DS . 'administrator' . DS . 'components' . DS . 'com_autotweet' . DS . 'helpers' . DS . 'fmhttpcodehelper.php');

// support for PHP < 5.2
include_once 'jsonwrapper/jsonwrapper.php';

JTable::addIncludePath(JPATH_ROOT . DS . 'administrator' . DS . 'components' . DS . 'com_autotweet' . DS . 'tables');


/**
 * Helper for posts form AutoTweet to twitter.
 *
  */
class AutotweetPostHelper
{
	const TWITTER_HOST		= 'api.twitter.com';
	const TWITTER_VERSION	= '1';
	const TWITTER_PORT		= 80;
	const TWITTER_MAX_CHARS	= 140;
	
	const SOCKET_TIMEOUT	= 5;	// seconds
	const RESEND_DELAY		= 2;	// seconds
	const SHORT_URL_TIMEOUT = 5;	// seconds
	
	// states of post and for publish_all
	const POST_SUCCESS		= 'success';
	const POST_PENDING		= 'pending';
	const POST_ERROR		= 'error';
	
	protected $user				= '';
	protected $password			= '';
	protected $show_url			= 2;
	protected $resend_attempts	= 3;
	protected $debug_enabled	= 0;
	protected $shorturl_service = 1;
	protected $shorturl_always	= 0;
	protected $bit_username		= '';
	protected $bit_key			= '';
	protected $cxn_method		= 0;
	
	// last cxn error
	protected $cxn_errnr		= 0;
	protected $cxn_errstr		= '';
	
	private static $instance	= null;
	
	
	//
	// no public access (singleton pattern)
	//
	private function AutotweetPostHelper()
	{
		// get component parameter
		$params =& JComponentHelper::getParams('com_autotweet');
		
		// general twitter and status params
		$this->user				= $params->get('username', '');
		$this->password			= $params->get('password', '');
		$this->show_url			= (int)$params->get('show_url', 2);
		$this->resend_attempts	= (int)$params->get('resend_attempts', 3);
		$this->debug_enabled	= (int)$params->get('debug_enabled', 0);
		$this->shorturl_service	= (int)$params->get('shorturl_service', 1);		
		$this->shorturl_always	= (int)$params->get('shorturl_always', 0);	
		$this->bit_username		= $params->get('bit_username', '');
		$this->bit_key			= $params->get('bit_key', '');
		$this->cxn_method		= (int)$params->get('cxn_method', 0);	
	}

	public static function &getInstance()
	{
		if (!self::$instance) {
			self::$instance = new AutotweetPostHelper();
		}
		
		return self::$instance;
	}

	
	/*
	 * posts a status message to twitter.
	 * api function for usage with extensions.
	 *
	 *
	 * @param	string $articleid		ID of article, forum post etc.
	 * @param	string $publish_up	publish date for article
	 * @param	string $orgtext		text for status message (complete)
	 * @param 	string $orgurl		url for use in status message (complete absolute path with domain name,  not shortened)
	 * @param 	string $source		plugin/comp which will post the message
	 * @param 	string $log			if set to true, the message is writen to the log db
	 * @param 	string $postid		autotweet table id for the post (only needed for reposts...)
	 * @return	bool				true, if message is posted without errors
	 */
	public function postTwitterMessage($articleid, $publish_up, $orgtext, $orgurl = '', $source = null
										, $log = true, $postid = 0, $silent_mode = false)
	{
		global $mainframe;
	
		$has_posted		= false;
		$attempt		= 0;
		$result_status	= array ('no status', 'no status');

		// publish date in the future ?
		$future_date = true;
		if (JFactory::getDate($publish_up) <= JFactory::getDate()) {
			$future_date = false;
		}
		
		if (('' != $this->user) && ('' != $this->password))	{
			if (!$future_date) {
				// get the connection
				$cxn = $this->openCxn();

				if ($cxn) {
					$status_msg		= '';
					
					if ($this->debug_enabled) {
						JError::raiseNotice('1', 'AutoTweet debug mode - original url = ' . $orgurl);
					}

					// route url to get sef url (do not route, when this is allready done in case of messages with state error)
					if (!$this->isRouted($orgurl)) {
						$orgurl = JRoute::_($orgurl);
						$orgurl = $this->createURL($orgurl);
					}

					if ($this->debug_enabled) {
						JError::raiseNotice('1', 'AutoTweet debug mode - routed url = ' . $orgurl);
					}
					
					// construct url and truncate title, if necessary
					$titel_url = $this->getTitleURL($orgtext, $orgurl);
					$url	= $titel_url[0];
					$text	= $titel_url[1];
					
					if ($this->debug_enabled) {
						JError::raiseNotice('1', 'AutoTweet debug mode - posted url = ' . $url);
					}
					
					// construct twitter status message
					switch ($this->show_url) {
						case 0:	// dont show url
							$status_msg = $text;
							break;
						case 1:	// show url at beginning of message
							$status_msg = $url . ' ' . $text;
							break;
						case 2:	// show url at end of message
							$status_msg = $text . ' ' . $url;
							break;
						default:
							$status_msg = $text;
					}
									
					// handle the twitter 408 problem a little bit better: in case of 408, 503 do additional attempts 
					do {
						$resend = false;
						$attempt++;
						
						$result_buffer = $this->sendMessage($cxn, $status_msg);
						if (!empty($result_buffer)) {
							$result_status = $this->getTwitterStatus($result_buffer, $cxn);
						}
					
						if (($attempt < $this->resend_attempts) && ('200' !=  $result_status[0])) {
							$resend = true;
							if ($this->debug_enabled) {
								JError::raiseWarning('2', 'AutoTweet debug mode - twitter service unavailable or timeout, return code = '
									. $result_status[0] . ' (' . $result_status[1] . ')' . ' - sending message again in '
									. self::RESEND_DELAY . ' seconds');
							}
							sleep(self::RESEND_DELAY);
						} 
					} while ($resend);
						
					if ('200' ==  $result_status[0]) {
							if (!$silent_mode || $this->debug_enabled) {
								$mainframe->enqueueMessage('AutoTweet - twitter status has been updated, article id = '
									. $articleid . '  (attempts: ' . $attempt . ')');
							}
							$has_posted = true;
					}
					elseif (!$silent_mode || $this->debug_enabled) {
						JError::raiseWarning('3', 'AutoTweet - error when sending message to twitter, article id = ' . $articleid . ', return code = '
								. $result_status[0] . ' (' . $result_status[1] . ')');
					}

					// close the connection
					$this->closeCxn($cxn);
				}
				else {
					if (!$silent_mode  || $this->debug_enabled) {
						JError::raiseWarning('3', 'AutoTweet - no connection to twitter, err = ' . $this->cxn_errnr . ' (' . $this->cxn_errstr . ')' );
					}
					$result_status = array ($this->cxn_errnr, $this->cxn_errstr);
				}
			}
			else {
				$result_status = array ('future date', 'later publish possible');
				if (!$silent_mode  || $this->debug_enabled) {
					$mainframe->enqueueMessage('AutoTweet - twitter status NOT updated, publish date is in the future (pending), article id = ' . $articleid);
				}
			}
		}
		else {
			$result_status = array ('account data wrong', 'enter account data in preferences');
			if (!$silent_mode  || $this->debug_enabled) {
				JError::raiseWarning('1', 'AutoTweet - you have not entered the account data (user, password) in the component preferences');
			}
		}

		// store message in log
		if ($log) {
			$result = null;
			$published = 0;
			$pubstate = self::POST_ERROR;
	
			if ($has_posted) {
				// normal publish
				$published = 1;
				$pubstate = self::POST_SUCCESS;
			}
			elseif ($future_date) {
				// publish date in the future
				$pubstate = self::POST_PENDING;
			}
			
			if (null != $result_status) {
				$result = $result_status[0] . ' (' . $result_status[1] . ')';
			}

			// returns null if successful otherwise returns and error message
			$storeResult = $this->storeMessage($publish_up, $orgtext, $orgurl, $articleid, $attempt, $published, $pubstate, $result, $source, $postid);
			
			if (!$storeResult) {
				if (!$silent_mode) {
					JError::raiseWarning('3', 'AutoTweet - error storing message log to database, article id = ' . $articleid . ', error message = ' . $storeResult);
				}
			}
			elseif ($this->debug_enabled) {
				JError::raiseNotice('1', 'AutoTweet debug mode - message log stored to database, article id = ' . $articleid);
			}

		}
		
		return $has_posted;
	}

	public function postAll($mode = '', $silent_mode = false, $limit = 10)
	{
	    $table = '#__autotweet';
		$has_posted = true;
		$state = '';
		
		$db = &JFactory::getDBO();		

		// select state for that should be posted
		if ('' != $mode) {
			$state = $db->Quote($mode);
		}
		else {
			$state = $db->Quote(self::POST_PENDING) . ', ' . $db->Quote(self::POST_ERROR);
		}
		
		// get ids to post for
		$query = 'SELECT '	. $db->NameQuote('id') . ', ' . $db->NameQuote('articleid') . ', ' . $db->NameQuote('publish_up')
				. ', ' . $db->NameQuote('message') . ', ' . $db->NameQuote('url')
			. ' FROM ' . $db->NameQuote($table)
			. ' WHERE ' . '(' . $db->NameQuote('published') . ' =  0)'
				. ' AND ' . '(' . $db->NameQuote('pubstate') . ' IN (' . $state . ')' . ')'
				. ' AND ' . '(' . 'Date(' . $db->NameQuote('publish_up') . ')' . ' <= Date(' . $db->Quote(JFactory::getDate()->toFormat()) . ')'
				. ')'
			. ' LIMIT '. (int)$limit;
		
		$db->setQuery($query);
		$rows = $db->loadAssocList();
		
		// post messages
		foreach($rows as $row) {
			$result = $this->postTwitterMessage($row['articleid'], $row['publish_up'], $row['message'], $row['url'], null, true, $row['id'], $silent_mode);
			if (!$result) { $has_posted = false; }
	    }
		
	    return $has_posted;
	}	
	
	
	protected function openCxn()
	{
		$cxn				= null;
		$this->cxn_errnr	= 0;
		$this->cxn_errstr	= '';
		$attempt			= 0;
		
		do {
			$resend = false;
			$attempt++;		
		
			switch ($this->cxn_method) {
				case 0: // sockets
					$cxn = fsockopen(self::TWITTER_HOST, self::TWITTER_PORT, $this->cxn_errnr, $this->cxn_errstr, self::SOCKET_TIMEOUT);
					break;
				case 1: // curl
					$cxn = curl_init();
					if (!$cxn) {
						$this->cxn_errnr	= 99;
						$this->cxn_errstr	= 'can not initialize CURL';
					}
					break;
			}
	
			if (!$cxn && ($attempt < $this->resend_attempts)) {
				$resend = true;
				if ($this->debug_enabled) {
					JError::raiseWarning('3', 'AutoTweet debug mode - error when connecting to twitter, err = '
						. $this->cxn_errnr . ' (' . $this->cxn_errstr . ')' . ' - connecting again in '	. self::RESEND_DELAY . ' seconds');
				}
				sleep(self::RESEND_DELAY);
			}
		} while ($resend);

			
		if (!$cxn && !silent_mode) {
			JError::raiseWarning('3', 'AutoTweet - error when connecting to twitter, err = ' . $this->cxn_errnr
				. ' (' . $this->cxn_errstr . ')' );		
		}
	
		return $cxn;
	}
	
	protected function closeCxn($cxn) {
		if ($cxn) {
			switch ($this->cxn_method) {
				case 0: // sockets
					fclose($cxn);
					break;
				case 1: // curl
					curl_close($cxn);
					break;
			}
		}
		$this->cxn_errnr	= 0;
		$this->cxn_errstr	= '';
	}

	
	//
	// internal functions
	//
	protected function getTitleURL($title, $long_url)
	{
		$url = '';
		
		// is short url needed?
		if ((0 != $this->show_url) && ('' != $long_url)) {
			$long_url = htmlspecialchars_decode($long_url);
			$longmsg_len = strlen($title) + strlen($long_url) + 1;
			
			if (($this->shorturl_always && (0 != $this->shorturl_service)) || ((0 != $this->shorturl_service) && ($longmsg_len > self::TWITTER_MAX_CHARS))) {
				$url = $this->getShortUrl($long_url);
			}
			else {
				$url = $long_url;
			}
		}

		// truncate the arcticle title for message, if necessary
		$msg_len = strlen($title) + strlen($url) + 1;
		if (($url != $long_url) && ($msg_len > self::TWITTER_MAX_CHARS)) {
			$cnt_del_chars = $msg_len - self::TWITTER_MAX_CHARS + 3;	// needs min 3 chars for replacement with 3 dots
			$cnt_del_chars *= -1;	// position for replace is count from the end
			$title = substr_replace($title, '...', $cnt_del_chars);
		}
		
		return array($url, $title);
	}

	protected function getShortUrl($url)
	{
		$timeout = self::SHORT_URL_TIMEOUT; 
	
		$enc_url = urlencode($url);
		
		if ($this->debug_enabled) {
				JError::raiseNotice('1', 'AutoTweet debug mode - encoded url = ' . $enc_url);
		}
		
		// select service (if service is disabled, method is not called)
		$tmp_short_mode = $this->shorturl_service;
		
		do {
			$retry = false;
			
			if (2 == $tmp_short_mode) {
				$service_call = 'http://api.bit.ly/shorten?version=2.0.1&format=json&longUrl='
								. $enc_url . '&login=' . $this->bit_username . '&apiKey=' . $this->bit_key . '&history=1';
			}
			else {
				$service_call = 'http://is.gd/api.php?longurl=' . $enc_url;
			}		

			$c = curl_init();		
			curl_setopt($c, CURLOPT_URL, $service_call); 
			curl_setopt($c, CURLOPT_RETURNTRANSFER, 1); 
			curl_setopt($c, CURLOPT_CONNECTTIMEOUT, $timeout); 
			$result			= curl_exec($c);
			$tmp_code		= curl_getinfo($c);
			$result_code	= $tmp_code['http_code'];
			curl_close($c);
			
			// correct result, if bit.ly is used
			if (2 == $tmp_short_mode) {
				//$js = json_decode($result, true);
				//$result = $js['results'][$url]['shortUrl'];
				$js = json_decode($result);
				$errorCode = $js->errorCode;

				if ((0 != $errorCode) || (200 != $result_code)) {
					JError::raiseWarning('2', 'AutoTweet - short url service bit.ly failed, try to use is.gd - http_code = '
						. $result_code . ' (' . curl_errno($c) . ' ' . curl_error($c) . '), result = '
						. $js->errorCode . ' (' . $js->errorMessage . ')' );
					$retry = true;
					$tmp_short_mode = 1;
					$result = null;
				}
				else {
					$result = $js->results->$url->shortUrl;
				}
			}
		} while ($retry);
		
		if (empty($result) || (200 != $result_code)) {
			JError::raiseWarning('2', 'AutoTweet - short url service is.gd failed, normal url used - http_code = '
				. $result_code . ', err = ' . curl_errno($c) . ' (' . curl_error($c) . ')' );

			$result = $url;
		}
	
		return $result;  
	}

	protected function sendMessage($cxn, $status_msg)
	{
		$result = '';
		$url		= '/' . self::TWITTER_VERSION . '/statuses/update.xml';
		$status_msg =  'status=' . urlencode($status_msg);
		
		switch ($this->cxn_method) {
			case 0: // sockets
				$result = self::sendSocket($cxn, $status_msg, $url);
				break;
			case 1: // curl
				$result = self::sendCURL($cxn, $status_msg, $url);
				break;
		}
		
		return $result;
	}	
	
	private function sendSocket($cxn, $status_msg, $url)
	{
		$twHost  = self::TWITTER_HOST;
		$account = base64_encode($this->user . ':' .$this->password);
		$msg_len = strlen($status_msg);
		
		fputs($cxn, "POST $url HTTP/1.1\n");
		fputs($cxn, "Authorization: Basic $account\n");
		fputs($cxn, "Host: $twHost\n");
		fputs($cxn, "Content-type: application/x-www-form-urlencoded, charset=utf-8\n");
		fputs($cxn, "Content-length: $msg_len\n");
		fputs($cxn, "Connection: close\n\n");
		fputs($cxn, $status_msg);

		$result_buffer = '';
		while(!feof($cxn)) { $result_buffer .= fgets($cxn, 128); }
		
		return $result_buffer;
	}

	private function sendCURL($cxn, $status_msg, $url)
	{
		$url = 'http://' . self::TWITTER_HOST . $url;
		$account = $this->user . ':' .$this->password;		
	
		curl_setopt($cxn, CURLOPT_URL, "$url");
		curl_setopt($cxn, CURLOPT_CONNECTTIMEOUT, self::SOCKET_TIMEOUT);
		curl_setopt($cxn, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($cxn, CURLOPT_POST, 1);
		curl_setopt($cxn, CURLOPT_POSTFIELDS, "$status_msg");
		curl_setopt($cxn, CURLOPT_USERPWD, "$account");
		$result_buffer = curl_exec($cxn);
		
		return $result_buffer;
	}
	
	protected function getTwitterStatus($resultmsg, $cxn)
	{
		switch ($this->cxn_method) {
			case 0: // sockets
				// get main status from result msg
				$start_pos = strpos($resultmsg, 'Status:');
				$start_pos += 8;
				$code = trim(substr($resultmsg, $start_pos, 3));
				break;
			case 1: // curl
				$tmp_code = curl_getinfo($cxn);
				$code = trim($tmp_code['http_code']);
				break;
		}

		$msg = FmHttpcodeHelper::getMessage($code);
		
		if ((200 != $code) && (1 == $this->cxn_method)) {
			$errno = curl_errno($cxn);
			$errmsg = curl_error($cxn); 
			
			if (!empty($errno) || !empty($errmsg)) {
				$msg = $msg . ' - ' . $errno . ': ' . $errmsg;
			}
		}
		
		return array ($code, $msg);
	}
	
	protected function storeMessage($publish_up, $message, $url, $articleid, $attempt, $published, $pubstate, $resultmsg, $source, $postid)
	{
		$entry = array (
			'id'				=> $postid,
			'postdate'			=> JFactory::getDate()->toFormat(),
			'publish_up'		=> $publish_up,
			'message'			=> $message,
			'url'				=> $url,
			'articleid'			=> $articleid,
			'attempts'			=> $attempt,
			'published'			=> $published,
			'pubstate'			=> $pubstate,
			'resultmsg'			=> $resultmsg,
			'source'			=> $source
		);
		
		$row =& JTable::getInstance('Autotweet', 'Table');
		$row->bind($entry);
		return $row->store();		
	}
	
	//
	// Helps with the Joomla url hell and creates corect url saveley.
	// Different cases for routing: frontend, backend, joomla not installed in route
	//
	protected function createURL($site_url)
	{
		// remove administrator string from path, if post is from backend (this is hell, why is joomla 1.5 routing and basepath different in front- and backend?)
		$base_uri = JURI::base();
		$del_pos = JString::strrpos($base_uri, '/administrator/');
		if (FALSE === $del_pos) {
			// if access is form front end get only domain by this function, because routing returns roor foolder
			// [TODO]	make this more failsave for later joomla version (if they correct this, i will have trouble here!	
			$baseurl = JURI::getInstance()->toString(array ('scheme', 'host', 'port'));
		}
		else {
			$baseurl = substr_replace($base_uri, '', $del_pos);
		}

		// Joomla bug: different value for backend and frontend post (one with slash): correct this safely
		if ('/' != substr($site_url, 0, 1)) {
			// remove slash at the beginning                   
			$site_url = '/' . $site_url;
		}

		$url = $baseurl . $site_url;
		
		return $url;
	}
	
	//
	// Checks if the URL is allready routed to avoid duplictae routing when post is done for messages with error state.
	//
	protected function isRouted($url)
	{
		$result = false;
		
		// check for string 'http' in url
		if ('http' == JString::substr($url, 0, 4)) {
			$result = true;
		}
	
		return $result;
	}	

	
}
	
?>
