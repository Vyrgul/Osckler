<?php
	extract($_REQUEST);
	include('../../arquivos/php/bd.php');
	$query = "SELECT * FROM usuarios WHERE usuario LIKE '{$usuario}%'";
	$mysql = mysqli_query($conecta, $query);

	$result = mysqli_fetch_assoc($mysql);
	print_r($result);