<?php
$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
	'size'	=> 30,
);
?>
<?php echo form_open(''.$this->config->base_url().'auth/unregister'); ?>

	<div class="form-group">
		<?php echo form_label('Password', $password['id']); ?>
		<?php echo form_password($password); ?>
		<span class="help-block"><?php echo form_error($password['name']); ?><?php echo isset($errors[$password['name']])?$errors[$password['name']]:''; ?>
	</div>

<?php echo form_submit('cancel', 'Delete account'); ?>
<?php echo form_close(); ?>