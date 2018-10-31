<?php
	error_reporting(0);
	session_start();
	include('bd.php');
	$query = "SELECT saldo FROM usuarios WHERE `usuario`='".$_SESSION['usuario']."'";
	$resultado = $conecta->query($query)->fetch_assoc();

	echo json_encode(array('status'=>1,'str'=>$resultado['saldo']));