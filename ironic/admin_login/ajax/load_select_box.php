<?php
	include ('../../config/config.php');
	require_once "../../library/classCMS.php";
	$cms = new CMS;		
	$iParent = $_GET['parent']; 
	$iChild = $_GET['child'];
	$sTable = $_GET['table'];
	$sId = $_GET['id'];
	$aParam = array(
					'table' => $sTable,
					'where' => $sId . '=' . $iParent,					
					);	
	$query = $cms->excuteQuery($aParam);		
?>
<?php while ($aRow = mysql_fetch_assoc($query)) { ?>	
	<option <?php if ($iChild == $aRow['id']) echo "selected=selected"; ?> value="<?php echo $aRow['id'];?>">  
       	<?php echo $aRow['name'];?> 
	</option>	
<?php } ?>
