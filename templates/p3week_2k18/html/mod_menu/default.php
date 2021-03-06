<?php defined('_JEXEC') or die;

if($module->position == 'offcanvas') {
	
} ?>

<ul class="nav menu <?php echo $class_sfx;?>"<?php
	$tag = '';

	if ($params->get('tag_id') != null) {
		$tag = $params->get('tag_id') . '';
		echo ' id="' . $tag . '"';
	} ?>>

	<?php foreach ($list as $i => &$item) {
		// get item params and decode it
		$item_decode = json_decode($item->params);

		$custom_class = (isset($item_decode->class) && $item_decode->class) ? $item_decode->class : '';

		$class = 'item-' . $item->id . ' '. $custom_class;

		if (($item->id == $active_id) OR ($item->type == 'alias' AND $item->params->get('aliasoptions') == $active_id)){
			$class .= ' current';
		}

		if (in_array($item->id, $path)) {
			$class .= ' active';
		}
		elseif ($item->type == 'alias') {
			$aliasToId = $item->params->get('aliasoptions');

			if (count($path) > 0 && $aliasToId == $path[count($path) - 1]) {
				$class .= ' active';
			}
			elseif (in_array($aliasToId, $path)) {
				$class .= ' alias-parent-active';
			}
		}

		if ($item->type == 'separator') {
			$class .= ' divider';
		}

		if ($item->deeper) {
			$class .= ' deeper';
		}

		if ($item->parent) {
			$class .= ' parent';
		}

		if (!empty($class)) {
			$class = ' class="' . trim($class) . '"';
		}

		echo '<li' . $class . '>';

		// Render the menu item.
		switch ($item->type) :
			case 'separator':
			case 'url':
			case 'component':
			case 'heading':
				require JModuleHelper::getLayoutPath('mod_menu', 'default_' . $item->type);
				break;

			default:
				require JModuleHelper::getLayoutPath('mod_menu', 'default_url');
				break;
		endswitch;

		// The next item is deeper.
		if ($item->deeper) {
			if($module->position == 'offcanvas') {
				echo '<ul class="collapse" id="collapse-menu-'. $item->id .'">';
			}
			else {
				echo '<ul>';
			}
		}
		elseif ($item->shallower) {
			// The next item is shallower.
			echo '</li>';
			echo str_repeat('</ul></li>', $item->level_diff);
		}
		else {
			// The next item is on the same level.
			echo '</li>';
		}
	} ?>
</ul>
