<form action="" method="POST"><br>
Seri:<br>
<input type="text" name="seri" /><br>
Code:<br>
<input type="text" name="code" /><br><br>
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name()?>" value="<?php echo $this->security->get_csrf_hash()?>" />
<input type="submit" name="sumit" />
<?php
if(isset($mathe['seri']))
{
	echo '<br>Seri: '.$mathe['seri'].' <br>';
	echo '<br>Code: '.$mathe['code'].' <br>';
}