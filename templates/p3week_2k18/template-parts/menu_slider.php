
<div class="menu_slider">
	<div class="menu_slider__wrap">
		<div class="menu_slider__close_wrap">
			<div class="relative wrap">
				<div class="menu_slider__close"></div>
			</div>
		</div>

		<div class="wrap">
			<div class="relative">
				<?php if($this->countModules('menu_top')) { ?>
					<jdoc:include type="modules" name="menu_top" style="none" />
				<?php } ?>

				<div class="menu_slider__wrap2">
					<?php if($this->countModules('menu_top__1')) { ?>
						<div class="menu_top__1">
							<jdoc:include type="modules" name="menu_top__1" style="none" />
						</div>
					<?php } ?>

					<?php if($this->countModules('menu_top__2')) { ?>
						<div class="menu_top__2">
							<jdoc:include type="modules" name="menu_top__2" style="none" />
						</div>
					<?php } ?>

					<?php if($this->countModules('menu_top__3')) { ?>
						<div class="menu_top__3">
							<jdoc:include type="modules" name="menu_top__3" style="none" />
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>

	<div class="menu_slider__line_bottom">
		<div class="wrap">
			<span></span>
		</div>
	</div>
</div>
