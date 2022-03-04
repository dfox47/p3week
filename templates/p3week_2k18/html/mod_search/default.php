<?php defined('_JEXEC') or die; ?>

<div class="<?php echo $moduleclass_sfx ?>">
	<form action="<?php echo JRoute::_('index.php');?>" method="post">
		<?php $output = '';
//		$output .= '<input name="searchword" maxlength="' . $maxlength . '"  class="search__input" type="text" placeholder="' . $text . '" />';
		$output .= '<input name="searchword" maxlength="' . $maxlength . '"  class="search__input" type="text" />';
		echo $output; ?>

		<input type="hidden" name="task" value="search" />
		<input type="hidden" name="option" value="com_search" />
		<input type="hidden" name="Itemid" value="<?php echo $mitemid; ?>" />

		<div class="search__submit_wrap">
			<label>
				<?php echo $text; ?>
				<input type="submit" value="<?php echo $text; ?>" />
			</label>

			<div class="search__close">
				<span></span>
				<span></span>
			</div>
		</div>
	</form>
</div>
