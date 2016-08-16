
<?php	
	switch($aUrl[0]){
		
		
		case 'telecharger':
			include "include/telecharger/index.php";
			break;
			
		default:
			include "include/middle/index.php";
			break;
	}	
?>