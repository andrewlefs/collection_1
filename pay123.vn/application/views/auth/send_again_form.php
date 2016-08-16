<div class="col-md-9" role="main">
<?php
$email = array(
	'name'	=> 'email',
	'id'	=> 'email',
	'value'	=> set_value('email'),
	'maxlength'	=> 80,
	'size'	=> 30,
	'required' => 'required',
);
?>
<?php echo form_open(''.$this->config->base_url().'auth/send_again'); ?>

	<div class="form-group">
		<?php echo form_label('Số điện thoại', $email['id']); ?>
		<?php echo form_input($email); ?>
		<span class="help-block"><?php echo form_error($email['name']); ?><?php echo isset($errors[$email['name']])?$errors[$email['name']]:''; ?>
	</div>

<?php echo form_submit('send', 'Send'); ?>
<?php echo form_close(); ?>
</div>