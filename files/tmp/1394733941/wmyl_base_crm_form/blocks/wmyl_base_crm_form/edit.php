<?php  defined('C5_EXECUTE') or die(_("Access Denied.")) ?>
<div class="ccm-ui">
	<div class="alert-message block-message info">
		<?php  echo t("Supply what tag to use when submitting new leads / contacts") ?>
	</div>
	<?php  echo $form->label('tag', t('Tag')) ?>
	<?php  echo $form->text('tag') ?>
</div>
