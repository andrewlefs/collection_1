<?php
 include_once("DataProvider.php");
 class Admin{
	var $db;
	var $parent_;
	var $table;
	var $path;
	var $sql_beginFrom;
	
	
	function Admin($db,$path="."){
		$this->db = $db;
		$this->table = "admin_womenday";
		$this->parent_ = new DataProvider($db);
		$this->path = $path;
	}
	
	function CheckLogin($user_name,$password){
		$db = $this->db;
		
		$sql = sprintf("SELECT * FROM admin_womenday WHERE user_name = '%s' AND password = '%s'",$user_name,$password);
		
		return $this->parent_->selectData($sql);
	}
 }
?>