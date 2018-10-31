<?php
	error_reporting(0);
	session_start();
	if(empty($_SESSION['senha'])){
		header('location: http://'.$_SERVER['HTTP_HOST'].'/login');
	}
	include('bd.php');
	$query = "SELECT senha FROM usuarios WHERE `usuario`='".$_SESSION['usuario']."'";
	$resultado = $conecta->query($query)->fetch_assoc();
	
	
	if($_SESSION['senha'] !== $resultado['senha']){
		session_destroy();
		header('location: http://'.$_SERVER['HTTP_HOST'].'/login');
	}