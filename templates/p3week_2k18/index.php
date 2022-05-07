<?php header('Content-Type: text/html;charset=utf-8');

defined ('_JEXEC') or die ('resticted aceess');
$doc = JFactory::getDocument();

$lang               = JFactory::getLanguage();
$languages          = JLanguageHelper::getLanguages('lang_code');
$languageTag        = $lang->getTag();
$languageCode       = $languages[ $lang->getTag() ]->sef;
$languageName       = $lang->getName();

$jinput             = JFactory::getApplication()->input;
$page_id            = $jinput->get('id'); ?>

<?php $this->setGenerator(null);
unset($doc->_scripts[$this->baseurl . '/media/jui/js/bootstrap.min.js']); // Remove joomla core bootstrap
unset($this->_scripts[$this->baseurl.'/media/system/js/mootools-core.js']); ?>

<!DOCTYPE html>

<html lang="<?php echo $this->language; ?>" class="lang_<?php echo $languageCode; ?> page_id_<?php echo $page_id; ?>">

<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />

	<meta content="width=device-width, user-scalable=yes, maximum-scale=5" name="viewport" />

	<?php include "template-parts/favicon.php"; ?>

	<link rel="stylesheet" href="/templates/p3week_2k18/styles.min.css?v<?php echo(date("YmdHis")); ?>" />

	<script src="/templates/p3week_2k18/jquery.3.2.1.js"></script>

	<meta property="og:image" content="https://p3week.ru/images/logo2021.svg" />

	<jdoc:include type="head" />
</head>

<body class="lang_<?php echo $this->language; ?> no_js">

<?php // menu slider
include_once 'template-parts/menu_slider.php'; ?>

<?php // menu top
include_once 'template-parts/menu_top.php'; ?>

<?php // menu top
include_once 'template-parts/home_video.php'; ?>

<?php if ($this->countModules('p3transport__link')) { ?>
	<jdoc:include type="modules" name="p3transport__link" style="none" />
<?php } ?>

<?php if ($this->countModules('new_block')) { ?>
	<div class="wrap">
		<jdoc:include type="modules" name="new_block" style="none" />
	</div>
<?php } ?>

<?php if ($this->countModules('breadcrumbs')) { ?>
	<div class="submenu_wrap">
		<div class="wrap">
			<jdoc:include type="modules" name="breadcrumbs" style="none" />
		</div>
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

<?php if ($this->countModules('after_content')) { ?>
	<jdoc:include type="modules" name="after_content" style="none" />
<?php } ?>

<?php if ($this->countModules('footer')) { ?>
	<div class="footer">
		<div class="wrap">
			<jdoc:include type="modules" name="footer" style="none" />
		</div>
	</div>
<?php } ?>

<?php // counters
include_once 'template-parts/counters.php'; ?>

<?php // popups
include_once 'template-parts/popups.php'; ?>

<?php // All scripts in one document with GULP ?>
<script src="/templates/p3week_2k18/all.min.js?v<?php echo(date("Ymd")); ?>"></script>

</body>
</html>
