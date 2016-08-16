<?php 

	if ($aUrl[0] == 'raovat' || $aUrl[0] == 'dangtinraovat' || $aUrl[0] == 'danganh' || $aUrl[0] == 'dangnhap' || $aUrl[0] == 'thuvien'){
		include_once "photo.php";
	}else{
		include_once "home.php";
	}
?>

	

		