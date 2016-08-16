<?php 
	$aParam = array(
					'select'	=> 'url, link',
					'table'		=> 'logo'
					);
	$query = $cms->excuteQuery($aParam);
?>
<marquee align="left">
	<?php while ($aResult = mysql_fetch_assoc($query)){?>
                    	<a href="<?php echo $aResult['link']?>" target="_blank">
                    		<img style="height:84px;width:100px" src="<?php echo $aResult['url']?>" border=0 />&nbsp;&nbsp;
                    	</a>                    	
    <?php }?>
						
</marquee>