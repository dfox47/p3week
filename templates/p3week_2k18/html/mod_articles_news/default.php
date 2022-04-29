
<?php defined('_JEXEC') or die; ?>

<div class="wrap">
	<ul class="news_latest <?php echo $moduleclass_sfx; ?> js-news-latest">
		<?php foreach ($list as $item) : ?>
			<?php require JModuleHelper::getLayoutPath('mod_articles_news', '_item'); ?>
		<?php endforeach; ?>
	</ul>
</div>
