<?php
// No direct access
defined( '_JEXEC' ) or die;
JHtml::_( 'jquery.framework' ); //подключаем jQuery
?>
<div class="module<?php echo $moduleclass_sfx; ?>">
	<div class="btn-group">
		<input type="text" name="id" class="ajax-test-id" placeholder="Введите id материала" /><input type="button" value="Найти" class="btn ajax-test-search" />
	</div>
</div>
<script type="text/javascript">
	jQuery(document).ready(function ($) {
		$('.ajax-test-search').on('click', function () {
			$.get('index.php?option=com_ajax&module=ajax_checklkform&format=raw&id=' + $('.ajax-test-id').val(), function (data) {
				alert(data);
			})
		})
	})
</script>