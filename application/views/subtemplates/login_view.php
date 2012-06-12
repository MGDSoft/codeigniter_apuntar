<?php 
if (isset($_SESSION['usuario']))
	$this->load->view('peques/logged_view');
else
	$this->load->view('forms/login_Fview');
?>