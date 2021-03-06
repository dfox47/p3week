<?php
/**
 * Plugin Helper File
 *
 * @package         Tabs
 * @version         4.1.0
 *
 * @author          Peter van Westen <peter@nonumber.nl>
 * @link            http://www.nonumber.nl
 * @copyright       Copyright © 2015 NoNumber All Rights Reserved
 * @license         http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

defined('_JEXEC') or die;

// Load common functions
require_once JPATH_PLUGINS . '/system/nnframework/helpers/functions.php';
require_once JPATH_PLUGINS . '/system/nnframework/helpers/text.php';
require_once JPATH_PLUGINS . '/system/nnframework/helpers/tags.php';
require_once JPATH_PLUGINS . '/system/nnframework/helpers/protect.php';

nnFrameworkFunctions::loadLanguage('plg_system_tabs');

/**
 * Plugin that replaces stuff
 */
class plgSystemTabsHelper
{
	var $helpers = array();

	public function __construct(&$params)
	{
		$this->params = $params;

		$this->params->comment_start = '<!-- START: Tabs -->';
		$this->params->comment_end = '<!-- END: Tabs -->';

		$this->params->tag_open = preg_replace('#[^a-z0-9-_]#si', '', $this->params->tag_open);
		$this->params->tag_close = preg_replace('#[^a-z0-9-_]#si', '', $this->params->tag_close);
		$this->params->tag_link = preg_replace('#[^a-z0-9-_]#si', '', $this->params->tag_link);

		$this->params->disabled_components = array('com_acymailing');

		

		require_once __DIR__ . '/helpers/helpers.php';
		$this->helpers = plgSystemTabsHelpers::getInstance($this->params);
	}

	public function onContentPrepare(&$article, &$context)
	{
		nnFrameworkHelper::processArticle($article, $context, $this, 'replaceTags');
	}

	public function onAfterDispatch()
	{
		// only in html
		if (JFactory::getDocument()->getType() !== 'html' && JFactory::getDocument()->getType() !== 'feed')
		{
			return;
		}

		$buffer = JFactory::getDocument()->getBuffer('component');

		if (empty($buffer) || is_array($buffer))
		{
			return;
		}

		$this->helpers->get('head')->addHeadStuff();

		$this->replaceTags($buffer, 'component');

		JFactory::getDocument()->setBuffer($buffer, 'component');
	}

	public function onAfterRender()
	{
		// only in html and feeds
		if (JFactory::getDocument()->getType() !== 'html' && JFactory::getDocument()->getType() !== 'feed')
		{
			return;
		}

		$html = JResponse::getBody();

		if ($html == '')
		{
			return;
		}

		if (
			strpos($html, '{' . $this->params->tag_open) === false
			&& strpos($html, 'nn_tabs-scrollto') === false
		)
		{
			$this->helpers->get('head')->removeHeadStuff($html);

			$this->helpers->get('clean')->cleanLeftoverJunk($html);

			JResponse::setBody($html);

			return;
		}

		// only do stuff in body
		list($pre, $body, $post) = nnText::getBody($html);
		$this->replaceTags($body, 'body');
		$html = $pre . $body . $post;

		$this->helpers->get('clean')->cleanLeftoverJunk($html);

		JResponse::setBody($html);
	}

	public function replaceTags(&$string, $area = 'article')
	{
		$this->helpers->get('replace')->replaceTags($string, $area);
	}
}
