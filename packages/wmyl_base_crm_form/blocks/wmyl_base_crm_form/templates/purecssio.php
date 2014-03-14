<?php 
defined('C5_EXECUTE') or die('Access Denied.');
?>

<?php  if(!$success) { ?>
	<form enctype="multipart/form-data" id="baseCrmFormView<?php  echo intval($bID)?>" class="baseCrmFormView pure-form pure-form-aligned" method="post"
		  action="<?php  echo $this->action('submit')?>" xmlns="http://www.w3.org/1999/html">

		<fieldset>
			<div class="pure-control-group">
				<label for="first_name"><?php  echo t('Last name'); ?></label>
				<input type="text" name="first_name" value="<?php  echo $fields['first_name'];?>" placeholder="<?php  echo t('First name'); ?>">
			</div>

			<div class="pure-control-group">
				<label for="last_name"><?php  echo t('Last name'); ?></label>
				<input type="text" name="last_name" value="<?php  echo $fields['last_name'];?>" placeholder="<?php  echo t('Last name'); ?>">
			</div>

			<div class="pure-control-group">
				<label for="email"><?php  echo t('E-mail'); ?></label>
				<input type="email" name="email" value="<?php  echo $fields['email'];?>" placeholder="<?php  echo t('E-mail'); ?>">
			</div>

			<div class="pure-control-group">
				<label for="mobile"><?php  echo t('Mobile number'); ?></label>
				<input type="tel" name="mobile" value="<?php  echo $fields['mobile'];?>" placeholder="<?php  echo t('Mobile number'); ?>">
			</div>

			<div class="pure-control-group">
				<label for="message"><?php  echo t('Message'); ?></label>
				<textarea name="message" value="<?php  echo $fields['message'];?>" placeholder="<?php  echo t('Message'); ?>"></textarea>
			</div>

			<div class="pure-controls">
				<input type="submit" name="Submit" class="pure-button pure-button-primary" value="<?php  echo t('Send'); ?>" >
			</div>
		</fieldset>
	</form>
<?php  } ?>
<?php  if($success) { ?>
	<div class="alert-success">
		<?php  echo t('Thank you for your message! We will get back to you as quick as possible'); ?>
	</div>
<?php  } ?>
<?php  if($error) { ?>
	<div class="alert-error">
		<?php  $error->output(); ?>
	</div>
<?php  } ?>