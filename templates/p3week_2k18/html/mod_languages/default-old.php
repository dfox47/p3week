<?php defined('_JEXEC') or die;

JHtml::_('stylesheet', 'mod_languages/template.css', array(), true);

if ($params->get('dropdown', 1) && !$params->get('dropdownimage', 0)) {
	JHtml::_('formbehavior.chosen');
} ?>

<div class="lang_change <?php echo $moduleclass_sfx; ?>">
	<?php foreach ($list as $language) : ?>
		<?php if ($params->get('show_active', 0) || !$language->active): ?>
				<a class="<?php if ( $language->active ) { ?>active<?php } ?>" href="<?php echo $language->link;?>"><?php if ($params->get('image', 1)):?><?php echo JHtml::_('image', 'mod_languages/' . $language->image . '.gif', $language->title_native, array('title' => $language->title_native), true);?><?php else : ?><?php echo $params->get('full_name', 1) ? $language->title_native : strtoupper($language->sef);?><?php endif; ?></a>
		<?php endif;?>
	<?php endforeach;?>
</div>
