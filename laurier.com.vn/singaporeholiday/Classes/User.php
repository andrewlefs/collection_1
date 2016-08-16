<?php
 include_once("DataProvider.php");
 class User{
	var $db;
	var $parent_;
	var $table;
	var $path;
	var $sql_beginFrom;
	
	
	function User($db,$path="."){
		$this->db = $db;
		$this->table = "cms_admin";
		$this->parent_ = new DataProvider($db);
		$this->path = $path;
	}
	
	function Check_Login($user_name,$password){
		$db = $this->db;
		
		$sql = sprintf("SELECT * FROM cms_admin WHERE username = '%s' AND password = '%s'",$user_name,$password);
		
		return $this->parent_->selectData($sql);
	}
 }
?>