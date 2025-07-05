<?php
	include "function/function.php";
	
	buat_session();
	hancurkan_session();
	
	header("location: index.php");
?>