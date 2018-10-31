<?php
error_reporting(0);
session_start();
if(isset($_SESSION['senha'])){
	header('location: http://'.$_SERVER['HTTP_HOST'].'/dashboard');
}
date_default_timezone_set('America/Sao_Paulo');
$dataHora = date("d/m/Y H:i:s");
?>
<!DOCTYPE html>
<html lang="PT-BR">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../arquivos/css/login.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <title>LOGIN</title>
  </head>
  <body>
    <header>
      <h1>CENTRAL OSCKLER</h1>
    </header>

    <section>
      <div class="corpo-login">
        <i class="fab fa-wolf-pack-battalion logo-corpo-login"></i>
        	<?php
			extract($_REQUEST);
			if(isset($usuario) AND isset($senha)){
			include('../arquivos/php/bd.php');

			$usuario = mysqli_real_escape_string($conecta, $usuario);
			if(strpos($usuario,'@')){
				$query = "SELECT email, usuario, senha, nome, tipo, saldo, ultimo_acesso, foto, logado, admin FROM usuarios WHERE `email`='$usuario'";
			}else{
				$query = "SELECT email, usuario, senha, nome, tipo, saldo, ultimo_acesso, foto, logado, admin FROM usuarios WHERE `usuario`='$usuario'";
			}

			$resultado = $conecta->query($query)->fetch_assoc();
		        /*if($resultado['logado'] == 1){
		          echo '<h1 class="msg">Usuário já está logado</h1>';
		          }else{*/
			if(count($resultado) == 0){
				echo '<h1 class="msg">Usuário inexistente</h1>';
			}elseif(count($resultado) > 0){
			if($senha !== $resultado['senha']){
				echo '<h1 class="msg">Senha incorreta</h1>';
			}elseif($senha == $resultado['senha']){

				//echo 'Logado com sucesso';
				mysqli_query($conecta,"UPDATE usuarios SET ultimo_acesso = '$dataHora' WHERE `usuario` = '".$resultado['usuario']."'");
				//mysqli_query($conecta,"UPDATE usuarios SET logado = '1' WHERE `usuario` = '".$resultado['usuario']."'");
				$_SESSION['email'] = $resultado['email'];
				$_SESSION['usuario'] = $resultado['usuario'];
				$_SESSION['senha'] = $resultado['senha'];
				$_SESSION['nome'] = $resultado['nome'].$resultado['tipo'];
				$_SESSION['tipo'] = $resultado['tipo'];
				$_SESSION['admin'] = $resultado['admin'];
				$_SESSION['saldo'] = $resultado['saldo'];
				$_SESSION['ultimo_acesso'] = $resultado['ultimo_acesso'];
      		    $_SESSION['foto'] = $resultado['foto'];
				
				header('location: http://'.$_SERVER['HTTP_HOST'].'/dashboard');
			}else{
				echo '<h1 class="msg">Ocorreu um erro! Contate um administrador</h1>';
			}
			}else{
				echo '<h1 class="msg">Ocorreu um erro! Contate um administrador</h1>';
			}
			//}
		}
			?>
        <form class="" action="" method="post">
          <div class="formulario"><i class="fas fa-user"></i><input type="text" name="usuario" placeholder="Usuário ou Email" required></div>
          <div class="formulario"><i class="fas fa-lock"></i><input type="password" name="senha" placeholder="*********" required></div>
          <input type="submit" name="button">
        </form>
      </div>
    </section>
  </body>
</html>