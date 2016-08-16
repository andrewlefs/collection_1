<?php
echo '<div class="page-header">
<h1>'.$title.'</h1>
</div>
';
echo '<ul>';
foreach($all As $one => $gia)
{ ?>
	<li style="display: inline-block; margin-right: 10px; width: 100px; height: 40px;"><a href="?the=<?php echo $one;?>"><?php echo ucfirst($one);?></a></li>
<?php }
echo '</ul>';