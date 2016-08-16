<?php
 include_once("DataProvider.php");
 class News{
	var $db;
	var $parent_;
	var $table;
	var $path;
	
	function News($db,$path="."){
		$this->db = $db;
		$this->table = "cms_news";
		$this->parent_ = new DataProvider($db);
		$this->path = $path;
	}

	function SelectNews_ByID($id){
		$db = $this->db;
		
		$sql = "SELECT news.*,catalog.LTin_Ten FROM `".$this->table."` news, cms_submenu catalog WHERE TTuc_Id=".$id." AND news.TTuc_LTin_Id = catalog.LTin_Id";
		
		return $this->parent_->selectData($sql);
	}
 }
?>