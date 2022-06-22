<?php 
defined('_JEXEC') or die;
JHtml::_('behavior.keepalive');
JHtml::_('bootstrap.tooltip');
JHtml::_('formbehavior.chosen');
?>
<form action="<?php echo JRoute::_('index.php'); ?>" method="post" id="form-import-user" class="form-inline" enctype="multipart/form-data">
	<fieldset class="loginform">	
		<div class="control-group">			
			<label for="InputFile">Выберите файл импорта</label>
			<input type="file" id="InputFile" name="import" accept="application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" required />
			<p class="help-block">Файл в формате xls или xlsx.</p>
		</div>
		<button type="submit" class="btn btn-default">Загрузить</button>
	</fieldset>
</form>