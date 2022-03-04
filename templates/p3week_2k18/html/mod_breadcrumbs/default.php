<?php defined('_JEXEC') or die; ?>

<ul class="breadcrumbs">
	<?php
	if ($params->get('showHere', 1)) {
		echo '<span>' . JText::_('MOD_BREADCRUMBS_HERE') . '&#160;</span>';
	}
	else {
//		echo '<li><i class="fa fa-home"></i></li>';
	}

	// Get rid of duplicated entries on trail including home page when using multilanguage
	for ($i = 0; $i < $count; $i++) {
		if ($i == 1 && !empty($list[$i]->link) && !empty($list[$i - 1]->link) && $list[$i]->link == $list[$i - 1]->link) {
			unset($list[$i]);
		}
	}

	end($list);
	$last_item_key = key($list);
	prev($list);
	$penult_item_key = key($list);

	$show_last = $params->get('showLast', 1);

	foreach ($list as $key => $item) {
		if ($key != $last_item_key) {
			echo '<li>';

			if (!empty($item->link)) {
				echo '<a href="' . $item->link . '">' . $item->name . '</a>';
			}
			else {
				echo $item->name;
			}

			echo '</li>';
		}
		elseif ($show_last) {
			echo '<li class="active"><span>' . $item->name . '</span></li>';
		}
	} ?>
</ul>
