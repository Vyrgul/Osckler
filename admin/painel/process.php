<?php
	extract($_REQUEST);
	if(isset($email) && $usuario && $senha && $nome && $tipo && $saldo){
		include('../../arquivos/php/bd.php');
		if(isset($_FILES['foto']['name']) || $foto !== '(binary)'){
			$extensao = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
			$extensao = strtolower($extensao);
			if(strstr('.jpg;.jpeg;.gif;.png', $extensao)){
				$destino = '../arquivos/img/'.$usuario.'.'.$extensao;
			}else{
				echo 'Tipo de arquivo não aceito.';
				return;
			}
		}else{
			$destino = '../arquivos/img/padrao.jpg';
		}
		if($tipo == 'administrador'){
			$admin = 1;
		}else{
			$admin = 0;
		}
		$query = "INSERT INTO usuarios (email, usuario, senha, nome, tipo, saldo, ultimo_acesso, foto, logado, admin) VALUES ('{$email}', '{$usuario}', '{$senha}', '{$nome}', '{$tipo}', '{$saldo}', 'NUNCA', '{$destino}', '0', '{$admin}')";

		$mysqli = mysqli_query($conecta, $query);

		if($mysqli == 1){
			echo 'usuário criado. ';
		}else{
			echo 'Ocorreu um erro na criação do usuário. ';
		}
		
		$arquivo_tmp = $_FILES['foto']['tmp_name'];
		$foto = move_uploaded_file($arquivo_tmp, $destino);
		if($foto == 1){
			echo 'Foto adicionada.';
		}else{
			if($destino == '../arquivos/img/padrao.jpg'){
				echo 'Foto padrão adicionada';
			}else{
				echo 'Ocorreu um erro ao adicionar a foto.';	
			}
		}
	}else{
		echo 'Você deve preencher todos os campos, apenas a foto é opnional.';
	}