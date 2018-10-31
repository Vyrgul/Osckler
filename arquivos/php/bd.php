<?php
    
	$conecta = mysqli_connect('localhost', 'root', 'BpCgsKWFDw8A', 'osckler'); //Conexão com o banco

	if(mysqli_connect_errno()){//Verifica a conexão
		echo 'Falha ao se conectar: '.mysqli_connect_error();
    	return;
    }
