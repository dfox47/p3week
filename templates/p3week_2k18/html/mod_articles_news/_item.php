<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_news
 *
 * @copyright   Copyright (C) 2005 - 2020 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die; ?>

<li class="news_latest__item">
	<?php if ($item->link !== '' && $params->get('link_titles')) : ?>
		<a class="news_latest__link js-news-latest-link" href="<?php echo $item->link; ?>">
			<span class="news_latest__img js-news-latest-img"></span>
			<span class="news_latest__date"><?php echo JHTML::_('date', $item->publish_up, JText::_('DATE_FORMAT_LC3')); ?></span>
			<span class="news_latest__title"><?php echo $item->title; ?></span>
			<span class="hidden js-news-latest-response"></span>
		</a>
	<?php else : ?>
		<?php echo $item->title; ?>
	<?php endif; ?>
</li>
