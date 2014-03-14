<?php  defined("C5_EXECUTE") or die('Access Denied.');

$dh = Loader::helper('concrete/dashboard'); /* @var $dh ConcreteDashboardHelper */
$v = View::getInstance(); /* @var $v View */

$form = Loader::helper('form');
$psh = Loader::helper('form/page_selector');
$vth = Loader::helper('validation/token');
?>

<style type="text/css">
	.ccm-ui fieldset {
		margin-bottom: 8px;
	}

	label.control-label {
		padding-right: 20px;
	}

	.ccm-ui .form-horizontal .control-group {
		margin-bottom: 8px;
	}

	.ccm-ui legend {
		margin-bottom: .2em;
	}

	.ccm-ui legend + .control-group {
		margin-top: 8px;
	}

	.ccm-ui input {
		width: 80%;
	}

	div.ccm-summary-selected-item {
		margin: 0;
		border: 0;
		padding: 10px 10px 0 0;
	}
</style>

<?php  echo $dh->getDashboardPaneHeaderWrapper(t('Base CRM Configuration'), '', 'span10 offset1'); ?>

<form id="form-config" method="post" action="<?php  echo $this->action('save') ?>" class="form-horizontal">
	<?php  echo $vth->output('form-config', true) ?>

	<fieldset>
		<legend><?php  echo t('Base CRM Settings') ?></legend>

		<p><em><?php  echo t('The username and password that you use for Base CRM') ?></em></p>

		<div class="control-group">
	 		<?php  echo $form->label('username', t('Username')) ?>
	 		<div class="controls">
	 			<?php  echo $form->text('username', $config->get('username')) ?>
			</div>
		</div>

		<div class="control-group">
	 		<?php  echo $form->label('password', t('Password')) ?>
	 		<div class="controls">
				<?php  echo $form->password('password', $config->get('password')) ?>
			</div>
		</div>

	</fieldset>

	<div class="controls">
		<?php  echo $form->submit('save', t('Save')) ?>
	</div>
</form>

<?php  $dh->getDashboardPaneFooterWrapper(); ?>