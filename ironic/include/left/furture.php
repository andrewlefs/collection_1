<?php 
		
	$aParamDetail = array(
						'select'	=> 'name,name_Unsigned',
						'table'		=> 'tuvan_subcategory',
						'order'		=> 'id desc'
						);
	$queryDetail = $cms->excuteQuery($aParamDetail);
	
?>
<div class="block margin_bottom10">
                	<h6 class="title_leftnav"><img src="images/ico9.png" />&nbsp;&nbsp;<span class="text_style1">TƯ VẤN</span></h6>
                    <ul class="left_nav">
						<?php 
						
							while($aDetail = mysql_fetch_assoc($queryDetail)){
						?>
							<li><img src="images/ico.jpg" /><a href="tinh-nang/<?=$aDetail['name_Unsigned']?>.html"><?=$aDetail['name']?></a></li>
						<?php } ?>
                    </ul>
</div>	

					
