
<div class="menu_top">
	<div class="wrap">
		<div class="menu_top__wrap">
			<?php if($this->countModules('menu_top__left')) { ?>
				<div class="menu_top__left">
					<jdoc:include type="modules" name="menu_top__left" style="none" />
				</div>
			<?php } ?>

			<?php if($this->countModules('menu_top__right')) { ?>
				<div class="menu_top__right">
					<jdoc:include type="modules" name="menu_top__right" style="none" />
				</div>
			<?php } ?>

			<div class="clear"></div>
		</div>
	</div>

	<?php if ($this->countModules('search')) { ?>
		<div class="search__wrap">
			<div class="wrap">
				<jdoc:include type="modules" name="search" style="none" />
			</div>
		</div>
	<?php } ?>
</div>
