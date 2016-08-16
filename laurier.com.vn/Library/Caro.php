<?php
 include_once("DataProvider.php");
 class Caro{
	var $db;
	var $parent_;
	var $table;
	var $path;
	
	function Caro($db,$path="."){
		$this->db = $db;
		$this->table = "score_chienbinh";
		$this->path = $path;
		$this->parent_ = new DataProvider($db);
	}
	
	function Delete($id){
		$db = $this->db;
		
		$sql = "DELETE FROM score_chienbinh WHERE id=".$id;
		
		$this->parent_->deleteData($sql);
	}
 }
?>