<?php 
	//info
	$aParamMenu = array(
							'select' 	=> 'name, name_Unsigned',
							'table'		=> 'products_subcategory',
							'order'		=> 'orderCMS asc'
						  );
	$queryMenu = $cms->excuteQuery($aParamMenu);
	
	
?>
	
            <div class="menu">
                  <ul id="topnav">
				  <li><a href=''>Trang Chủ</a></li><li> | </li>
					<?php while($aSM = mysql_fetch_assoc($queryMenu)){?>
						
						<li><a href="san-pham/<?=$aSM['name_Unsigned']?>.html"><?=$aSM['name']?></a></li>
						
						<li> | </li>
					
					<?php } ?>
                  </ul>
                </div><!--/ end.menu -->
         