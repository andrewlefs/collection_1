<?php
include_once("processData.php");

 class ExportExcel {
	var $db;
	var $parent_;
	var $table;
	var $sql_beginFrom;

	function ExportExcel($db){
		$this->db = $db;
		$this->table = "lucky_number";
		
		$this->parent_ = new processData($db);
	}
	function listExportData2(){
		$sql = "SELECT `id`,`fullname`,`address`,`phone`,`cmnd`,`numbergif` FROM `lucky_number` WHERE `finished`=2 limit 0,500";
		return $this->parent_->listData($sql);
	}
	function listExportData3(){
		$sql = "SELECT `id`,`fullname`,`address`,`phone`,`cmnd`,`numbergif` FROM `lucky_number` WHERE `finished`=3 limit 0,500";
		return $this->parent_->listData($sql);
	}
	
}
?>