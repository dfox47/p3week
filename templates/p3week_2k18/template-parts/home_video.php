
<?php if (!isset($_SERVER['REQUEST_URI']) || ltrim($_SERVER['REQUEST_URI'],'/') === '') { ?>
	<div class="home_video_new">
		<video class="home_video_new__item" autoplay loop muted>
			<source src="/images/2022/home.mp4" type="video/mp4" />
		</video>

		<div class="home_video_new__content">
			<a href="/" class="logo"><img class="js-svg" src="/images/icons/logo_2022.svg" alt=""></a>
		</div>

		<div class="home_video_new__bottom">
			<div class="home_video_new__info">
				<div class="home_video_new__date">12-15 СЕНТЯБРЯ 2022 г.</div>

				<div class="home_video_new__place">Цифровое Деловое Пространство,<br />г. Москва, ул. Покровка, 47</div>

				<button class="btn btn_submit js-popup-show" data-popup="registration">Регистрация</button>
			</div>
		</div>
	</div>
<?php }
else if ( $_SERVER['REQUEST_URI'] === '/en/') { ?>
	<div class="home_video_new">
		<video class="home_video_new__item" autoplay loop muted>
			<source src="/images/2022/home.mp4" type="video/mp4" />
		</video>

		<div class="home_video_new__content">
			<a href="/" class="logo"><img class="js-svg" src="/images/icons/logo_2022_en.svg" alt=""></a>
		</div>

		<div class="home_video_new__bottom">
			<div class="home_video_new__info">
				<div class="home_video_new__date">12-15 SEPTEMBER 2022</div>

				<div class="home_video_new__place">Digital Business Space,<br />Moscow, Pokrovka 47</div>

				<button class="btn btn_submit js-popup-show" data-popup="registration">Registration</button>
			</div>
		</div>
	</div>
<?php }
else { ?>
	<?php if ($this->countModules('header')) { ?>
		<div class="header">
			<div class="wrap">
				<jdoc:include type="modules" name="header" style="none" />
			</div>
		</div>
	<?php } ?>
<?php } ?>

