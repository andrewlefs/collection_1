<?php
	$this->load->view('admin/layout/header');
	echo '<div class="row"><div class="col-md-2 dark_sidebar clearfix">';
	$this->load->view('admin/layout/sidebar');
	echo '</div>';
	echo '<div class="col-md-10">';
	if(!is_null($this->session->flashdata('message')) AND $this->session->flashdata('message') != '')
	{
		echo '<div class="alert alert-success">'.$this->session->flashdata('message').'</div>';
	}
	$this->load->view($main_template);
	echo '</div></div>';
	$this->load->view('admin/layout/footer');