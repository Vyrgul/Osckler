<?php
	error_reporting(0);
	session_start();
	session_destroy();
  header('location: http://'.$_SERVER['HTTP_HOST'].'/login');
?>