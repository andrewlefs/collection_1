<?php
 include_once("DataProvider.php");
 class Player{
	var $db;
	var $parent_;
	var $table;
	var $path;
	var $sql_beginFrom;
	
	
	function Player($db,$path="."){
		$this->db = $db;
		$this->table = "user";
		$this->parent_ = new DataProvider($db);
		$this->path = $path;
	}
	
	function Check_Login($user_name,$password){
		$db = $this->db;
		
		$sql = sprintf("SELECT * FROM user WHERE Name = '%s' AND Password = '%s'",$user_name,$password);
		
		return $this->parent_->selectData($sql);
	}

 }
?>