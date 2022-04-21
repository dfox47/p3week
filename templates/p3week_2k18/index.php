<?php header('Content-Type: text/html;charset=utf-8'); ?>

<?php defined ('_JEXEC') or die ('resticted aceess');
$doc = JFactory::getDocument(); ?>

<?php $lang         = JFactory::getLanguage();
$languages          = JLanguageHelper::getLanguages('lang_code');
$languageTag        = $lang->getTag();
$languageCode       = $languages[ $lang->getTag() ]->sef;
$languageName       = $lang->getName();


$jinput = JFactory::getApplication()->input;
$page_id = $jinput->get('id'); ?>

<?php $this->setGenerator(null);

unset($doc->_scripts[$this->baseurl . '/media/jui/js/bootstrap.min.js']); // Remove joomla core bootstrap

unset(
	$this->_scripts[$this->baseurl.'/media/system/js/mootools-core.js']
); ?>

<!DOCTYPE html>

<html lang="<?php echo $this->language; ?>" class="lang_<?php echo $languageCode; ?> page_id_<?php echo $page_id; ?>">

<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />

	<meta content="width=device-width, user-scalable=yes, maximum-scale=5" name="viewport" />

	<link rel="icon" href="/images/favicon.ico" type="image/x-icon" />
	<link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon">

	<link rel="icon" type="image/png" href="/images/favicon/16.png" sizes="16x16" />
	<link rel="icon" type="image/png" href="/images/favicon/32.png" sizes="32x32" />
	<link rel="icon" type="image/png" href="/images/favicon/96.png" sizes="96x96" />

	<link rel="apple-touch-icon" sizes="57x57" href="/images/favicon/57.png" />
	<link rel="apple-touch-icon" sizes="60x60" href="/images/favicon/60.png" />
	<link rel="apple-touch-icon" sizes="72x72" href="/images/favicon/72.png" />
	<link rel="apple-touch-icon" sizes="76x76" href="/images/favicon/76.png" />
	<link rel="apple-touch-icon" sizes="114x114" href="/images/favicon/114.png" />
	<link rel="apple-touch-icon" sizes="120x120" href="/images/favicon/120.png" />
	<link rel="apple-touch-icon" sizes="144x144" href="/images/favicon/144.png" />
	<link rel="apple-touch-icon" sizes="152x152" href="/images/favicon/152.png" />
	<link rel="apple-touch-icon" sizes="180x180" href="/images/favicon/180.png" />

	<link rel="stylesheet" href="/templates/p3week_2k18/styles.min.css?v<?php echo(date("YmdHis")); ?>" />

	<script src="/templates/p3week_2k18/jquery.3.2.1.js"></script>

	<script>
		window.EVENTICIOUS_NETWORKING = function() {
			function e() {
				var e = i + "/" + n + "/" + r + "/" + o + "/redirect/safari";
				window.open(e, "Logging in", "width=1,height=1,left=0,top=0"),
					window.addEventListener("message", function(e) {
						-1 !== e.origin.indexOf("eventicious.com") && t()
					})
			}
			function t() {
				var e = i + "/" + n + "/" + r + "/" + o + "/myoffice";
				window.document.getElementById(a).src = e,
					window.document.getElementById(a).style.display = "block"
			}
			var n = 0
				, r = 5399
				, o = void 0
				, i = "https://networking-external.eventicious.com"
				, a = "EVENTICIOUS_NETWORKING_IFRAME";
			return {
				init: function(e) {
					if (!e || !e.eventId)
						throw new Error("Parameter 'eventId' is required");
					r = e.eventId,
						o = e.locale || "";
					var t = window.document.createElement("iframe");
					t.id = a,
						t.style.cssText = "border: 0; background: rgba(0,0,0,0.5); margin: 0 auto; display: none; position: fixed; top: 0; bottom: 0; left: 0; right: 0; width: 100%; height: 100%;",
						window.document.body.appendChild(t)
				},
				open: function() {
					false /*-1 !== navigator.userAgent.indexOf("Safari") && -1 === navigator.userAgent.indexOf("Chrome")*/ ? e() : t()
				}
			}
		}()
	</script>

	<meta property="og:image" content="https://p3week.ru/images/logo2021.svg" />

	<jdoc:include type="head" />
</head>



<body class="lang_<?php echo $this->language; ?> no_js">
<div class="menu_slider">
	<div class="menu_slider__wrap">
		<div class="menu_slider__close_wrap">
			<div class="relative wrap">
				<div class="menu_slider__close">
					<span></span>
					<span></span>
				</div>
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
</div>

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

				<div class="home_video_new__place">SAP Digital Business Space,<br />Moscow, Pokrovka 47</div>
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

<?php if($this->countModules('search')) { ?>
	<div class="search__wrap">
		<div class="wrap">
			<jdoc:include type="modules" name="search" style="none" />
		</div>
	</div>
<?php } ?>

<?php if ($this->countModules('p3transport__link')) { ?>
	<jdoc:include type="modules" name="p3transport__link" style="none" />
<?php } ?>

<?php if ($this->countModules('new_block')) { ?>
	<div class="wrap">
		<jdoc:include type="modules" name="new_block" style="none" />
	</div>
<?php } ?>

<?php if ($this->countModules('breadcrumbs')) { ?>
	<div class="wrap">
		<jdoc:include type="modules" name="breadcrumbs" style="none" />
	</div>
<?php } ?>

<?php if ($this->countModules('menu_top_sub')) { ?>
	<div class="wrap">
		<jdoc:include type="modules" name="menu_top_sub" style="none" />
	</div>
<?php } ?>

<?php if ($this->countModules('before_content')) { ?>
	<jdoc:include type="modules" name="before_content" style="none" />
<?php } ?>

<div class="wrap">
	<div class="content">
		<article>
			<jdoc:include type="message" />
			<jdoc:include type="component" />
			<jdoc:include type="modules" name="content" style="none" />
		</article>
	</div>
</div>

<?php if (strpos($_SERVER['REQUEST_URI'], "/registration-new") !== false) { ?>
	<?php include_once 'registration.php'; ?>
<?php } ?>

<?php if($this->countModules('after_content')) { ?>
	<jdoc:include type="modules" name="after_content" style="none" />
<?php } ?>

<?php if($this->countModules('footer')) { ?>
	<div class="footer">
		<div class="wrap">
			<jdoc:include type="modules" name="footer" style="none" />
		</div>
	</div>
<?php } ?>



<!-- Yandex.Metrika counter -->
<script>
	(function (d, w, c) {
		(w[c] = w[c] || []).push(function() {
			try {
				w.yaCounter48054689 = new Ya.Metrika({
					id:48054689,
					clickmap:true,
					trackLinks:true,
					accurateTrackBounce:true,
					webvisor:true
				});
			} catch(e) { }
		});

		var n = d.getElementsByTagName("script")[0],
			s = d.createElement("script"),
			f = function () { n.parentNode.insertBefore(s, n); };
		s.type = "text/javascript";
		s.async = true;
		s.src = "https://mc.yandex.ru/metrika/watch.js";

		if (w.opera == "[object Opera]") {
			d.addEventListener("DOMContentLoaded", f, false);
		} else { f(); }
	})(document, window, "yandex_metrika_callbacks");
</script>

<noscript><div><img src="https://mc.yandex.ru/watch/48054689" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->



<script>
	EVENTICIOUS_NETWORKING.init({
		eventId: 5399,//id конференции
		locale: "ru"//локаль
	})
</script>

<div class="popup_covid js-popup-covid">
	<div class="popup_covid__bg js-popup-covid-close"></div>

	<div class="popup_covid__content">
		<div class="popup_covid__img_wrap">
			<div class="popup_covid__close js-popup-covid-close"></div>

			<img src="/images/covid.jpg" alt="" />
		</div>
	</div>
</div>

<!-- all scripts in one document -->
<script src="/templates/p3week_2k18/all.min.js?v<?php echo(date("Ymd")); ?>"></script>

</body>
</html>


