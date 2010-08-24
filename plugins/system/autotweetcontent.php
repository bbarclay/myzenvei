<?php
/**
 * @version	3.2
 * @author	Ulli Storck
 * @license	GPL 2.1
 */

// Check to ensure this file is included in Joomla!
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.error.error' );

// check for component
if (!JComponentHelper::getComponent('com_autotweet', true)->enabled) {
	JError::raiseWarning('5', 'AutoTweet NG Content-Plugin - AutoTweet NG Component is not installed or not enabled.');
	return;
}

require_once (JPATH_ROOT . DS . 'administrator' . DS . 'components' . DS . 'com_autotweet' . DS . 'helpers' . DS . 'autotweetbase.php');
require_once (JPATH_ROOT . DS . 'components' . DS . 'com_content' . DS . 'helpers' . DS . 'route.php');


/**
 * Plugin inserts new content articles in the twitter timeline of a specified account.
 *
 * needs joomla 1.5.4+ (onAfterContentSave)
 */
class plgSystemAutotweetContent extends plgAutotweetBase
{
	protected $section				= 0;
	protected $category				= 0;
	protected $sections				= '';
	protected $excluded_categories	= '';
	protected $excluded_sections	= '';
	protected $categories			= '';
	protected $post_private			= 0;
	protected $post_modified		= 0;	
	protected $show_catsec			= 0;
	protected $show_hash			= 0;
	protected $use_text				= 0;
	protected $use_text_count		= 100;
	protected $static_text			= '';
	protected $static_text_pos		= 1;
	protected $static_text_source	= 0;
	protected $metakey_count		= 1;
	
	
	function plgSystemAutotweetContent( &$subject, $params )
	{
		parent::__construct( $subject, $params );

		// Get Plugin info
		$plugin			=& JPluginHelper::getPlugin('system', 'autotweetcontent');
		$pluginParams	= new JParameter($plugin->params);
		
		// joomla article specific params
		$this->section				= (int)$pluginParams->get('section', 0);
		$this->category				= (int)$pluginParams->get('category', 0);
		$this->sections				= $pluginParams->get('sections', '');
		$this->categories			= $pluginParams->get('categories', '');
		$this->excluded_sections	= $pluginParams->get('excluded_sections', '');
		$this->excluded_categories	= $pluginParams->get('excluded_categories', '');
		
		$this->post_private			= (int)$pluginParams->get('post_private', 0);
		$this->post_modified		= (int)$pluginParams->get('post_modified', 0);
		$this->show_catsec			= (int)$pluginParams->get('show_catsec', 0);
		$this->show_hash			= (int)$pluginParams->get('show_hash', 0);
		$this->use_text				= (int)$pluginParams->get('use_text', 0);
		$this->use_text_count		= $pluginParams->get('use_text_count', 100);				
		$this->static_text			= strip_tags($pluginParams->get('static_text', ''));
		$this->static_text_pos		= (int)$pluginParams->get('static_text_pos', 1);
		$this->static_text_source	= (int)$pluginParams->get('static_text_source', 0);
		$this->metakey_count		= (int)$pluginParams->get('metakey_count', 1);
		
		// check type and range, and correct if needed
		$this->use_text_count = $this->getTextcount($this->use_text_count);
	}

	/**
	 * after save content method
	 * Article is passed by reference, but after the save, so no changes will be saved.
	 * Method is called right after the content is saved.
	 * Here is triggered the AutoTweet standard function for posting new content articles.
	 *
	 * @param 	object	A JTableContent object
	 * @param 	bool		If the content is just about to be created
	 * @return	void
	 */
	function onAfterContentSave( &$article, $isNew )
	{
		// post only published articles (publish date is not checked at the moment!), check for private articles
		if (($isNew	|| $this->post_modified)
			&& ($this->post_private || (!$this->post_private && (0 == $article->access)))
			&& (1 == $article->state))
		{
			$this->postMessage($article);
		}
		
		return true;
	}

	/**
	 * Post articles, when they are later published (not published at save time)
	 *
	 */
	function onAfterRoute()
	{
		if (('com_content' == JRequest::getVar('option')) && ('publish' == JRequest::getVar('task', ''))) {
			$ids	= JRequest::getVar('cid');
			$article =& JTable::getInstance('content');
			
			foreach ($ids as $id) {
				$article->load($id);
				
				// post allowed?
				if (	($this->post_private || (!$this->post_private && (0 == $article->access)))
					&&	(0 == $article->state)	)

				{
					$this->postMessage($article);
				}
			}
		}
	
		return true;
	}

	protected function postMessage($article)
	{
		$doPost = false;
		$sec_filter			= explode(',', str_replace(' ', '', $this->sections));
		$cat_filter			= explode(',', str_replace(' ', '', $this->categories));
		$excl_sec_filter	= explode(',', str_replace(' ', '', $this->excluded_sections));
		$excl_cat_filter	= explode(',', str_replace(' ', '', $this->excluded_categories));
		
		// if id is found in ONE field, article is posted
		if ((('' == $this->excluded_sections) || !in_array($article->sectionid, $excl_sec_filter))
			&& (('' == $this->excluded_categories) || !in_array($article->catid, $excl_cat_filter))
			&& ((($this->section != 0) && ($this->section == $article->sectionid))
				|| (($this->category != 0) && ($this->category == $article->catid))
				|| (('' != $this->sections) && in_array($article->sectionid, $sec_filter))
				|| (('' != $this->categories) && in_array($article->catid, $cat_filter)))	)
		{
			$doPost = true;
		}
		elseif (($this->section == 0) && ($this->category == 0) && ($this->sections == '') && ($this->categories == '')
			&& (('' == $this->excluded_sections) || !in_array($article->sectionid, $excl_sec_filter))
			&& (('' == $this->excluded_categories) || !in_array($article->catid, $excl_cat_filter)))
		{
			$doPost = true;
		}

		if ($doPost)
		{
			$sec =& $this->getSection($article->sectionid);
			$cat =& $this->getCategory($article->catid);
			
			$sec_name	= '';
			$cat_name	= '';
			$sec_slug	= 0;
			$cat_slug	= 0;
			$id_slug	= $article->id . ':' . JFilterOutput::stringURLSafe($article->alias);			

			// post also correct url for article without section/category!
			if ($sec && $cat && (0 < $sec->id) && (0 < $cat->id)) {
				$sec_name = $sec->title;
				$cat_name = $cat->title;
				$sec_slug = $sec->id . ':' . JFilterOutput::stringURLSafe($sec->alias);
				$cat_slug = $cat->id . ':' . JFilterOutput::stringURLSafe($cat->alias);
			}
			
			// create url savely
			$url = ContentHelperRoute::getArticleRoute($id_slug, $cat_slug, $sec_slug);
			$del_pos = JString::strrpos($url, '&amp;Itemid=');
			if (('' ==  $cat_name) && $del_pos) {
				// corrections for uncategorized articles (remove itemid from url)
				$url = substr_replace($url, '', $del_pos);
				$url = urldecode($url);
			}			

			// use article title or text as twitter message
			$text = $this->getMessagetext($this->use_text, $this->use_text_count, $article->title, $article->introtext);
			
			// use metakey or static text or nothing
			$stattext = '';
			if ((2 == $this->static_text_source) || ((1 == $this->static_text_source) && (empty($article->metakey)))) {
				$stattext =	$this->static_text;
			}
			elseif (1 == $this->static_text_source) {
				$stattext = $this->getHashtags($article->metakey, $this->metakey_count);
			}
			
			// add static text / hashtags
			$text = $this->addStatictext($this->static_text_pos, $text, $stattext);
			
			// add section and category
			$text = $this->addCatsec($this->show_catsec, $sec_name, $cat_name, $text, $this->show_hash);
			
			// post the status message to twitter
			$this->postStatusMessage($article->id, $article->publish_up, $text, $url);
		}	
	}
	

	private function getSection($id)
	{
		$row =& JTable::getInstance('section');
		$row->load($id);

		return $row;
	}
	
	private function getCategory($id)
	{
		$row =& JTable::getInstance('category');
		$row->load($id);

		return $row;
	}
	
}

?>
