<?php 
defined('C5_EXECUTE') or die('Access Denied.');
?>

<div class="row">
	<?php  if(!$success) { ?>
		<form enctype="multipart/form-data" id="baseCrmFormView<?php  echo intval($bID)?>" class="form baseCrmFormView" method="post"
			  action="<?php  echo $this->action('submit')?>" xmlns="http://www.w3.org/1999/html">
			<fieldset>
				<div class="controls controls-row">
					<input type="text" class="input-small span6" name="first_name" value="<?php  echo $fields['first_name'];?>" placeholder="<?php  echo t('First name'); ?>">
					<input type="text" class="input-small span6" name="last_name" value="<?php  echo $fields['last_name'];?>" placeholder="<?php  echo t('Last name'); ?>">
				</div>
				<div class="controls controls-row">
					<input type="email" class="span12" name="email" value="<?php  echo $fields['email'];?>" placeholder="<?php  echo t('E-mail'); ?>">
				</div>
				<div class="controls controls-row">
					<input type="tel" class="span12" name="mobile" value="<?php  echo $fields['mobile'];?>" placeholder="<?php  echo t('Mobile number'); ?>">
				</div>
				<div class="controls controls-row">
					<textarea name="message" value="<?php  echo $fields['message'];?>" placeholder="<?php  echo t('Message'); ?>"></textarea>
				</div>
				<input type="submit" name="Submit" class="btn btn-success" value="<?php  echo t('Submit'); ?>" >
			</fieldset>
		</form>
	<?php  } ?>
	<?php  if($success) { ?>
		<div class="alert alert-success">
			<?php  echo t('Thank you for your message!'); ?>
		</div>
	<?php  } ?>
	<?php  if($error) { ?>
		<div class="alert alert-error">
			<ul>
				<?php  foreach($error->getList() as $errorMessage) {
					print '<li>' . $errorMessage . '</li>';
				} ?>
			</ul>
		</div>
	<?php  } ?>
</div>
