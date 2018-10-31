<?php
error_reporting(0);
session_start();
include('../arquivos/php/bd.php');
include('../arquivos/php/functions.php');
include('../arquivos/php/verifica_login.php');
$query = "SELECT * FROM usuarios WHERE 1";
$resultado = $conecta->query($query);
$total_de_user = mysqli_num_rows($resultado);

$arquivos = glob('../checkers/{*}', GLOB_BRACE);


?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../arquivos/css/dashboard.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <script type="text/javascript" src="../arquivos/js/dashboard.js"></script>
    <title>Painel de Controle</title>
  </head>
  <body onload="submenu('hospedagem'); submenu('delivery'); abrirmodal();">

    <!-- INICIO DO MODAL -->
    <div class="corpo_modal" id="corpo_modal">
        <div class="conteudo_modal">

          <div class="conteudo_modal_header">
            <i></i>
            <h1>CONFIGURAÇÕES</h1>
            <i class="fas fa-window-close" onclick="fecharmodal()"></i>
          </div>

          <div class="conteudo_modal_section">
            <h1>NOME: <?php echo $_SESSION['nome'] ?></h1>
            <h1>SALDO: <?php echo $_SESSION['saldo'] ?></h1>
            <h1>TIPO: <?php echo $_SESSION['tipo'] ?></h1>
            <h1>ULTIMO ACESSO: <?php echo $_SESSION['ultimo_acesso'] ?></h1>
            <h1>DISPOSITIVO: <?php echo modelo() ?></h1>
          </div>

          <div class="conteudo_modal_footer">
            <i class="fas fa-power-off"></i>
          </div>

        </div>
    </div>  
      <!-- FIM DO MODAL -->

    <header>
      <div class="topo-int-esquerdo">
        <h1></h1>
        <h1>CENTRAL OSCKLER</h1>
        <i class="fas fa-bars" onclick="abrirfecharmenu()"></i>
      </div>

      <div class="topo-int-direito">
        <i class="fas fa-money-check-alt"><name><?php echo $_SESSION['saldo'] ?></name></i>
        <i class="fas fa-cogs" id="icone-de-configuraçao" onclick="abrirmodal()"></i>
      </div>
    </header>

    <header id="header_mobile">

      <div class="header_mobile_esquerdo">
        <i class="fas fa-bars" onclick="abrirfecharmenu()"></i>
      </div>

      <div class="header_mobile_direito">
        <i class="fas fa-cogs" onclick="abrirmodal()"></i>
      </div>

    </header>

    <section>

      <div class="section-menu-esquerdo" id="menu-esquerdo">
        <div class="section-menu-esquerdo-usuario">
          <img src="https://st3.depositphotos.com/1007566/12596/v/950/depositphotos_125969722-stock-illustration-avatar-criminal-hacker.jpg">
          <div class="section-menu-esquerdo-usuario-detalhes">
            <h1><?php echo $_SESSION['nome']; ?></h1>
            <h6>Online</h6>
          </div>
        </div>

        <div class="checkers">

          <div class="checker">
            <div class="dropdown">
              <button onclick="submenu('hospedagem')"><i class="fas fa-cloud"></i>HOSPEDAGEM<i class="fas fa-chevron-right"></i></button>
            </div>
            <div class="conteudo-dropdown" id="hospedagem">
              <?php
                $query = "SELECT checker, link FROM checkers WHERE `tipo`='hospedagem'";
                $resultado = $conecta->query($query);
                while($linha = $resultado->fetch_assoc()): ?>
                  <a href="<?php echo $linha['link']; ?>"><?php echo $linha['checker']; ?></a>
                <?php endwhile ?>
            </div>
          </div>

          <div class="checker">
            <div class="dropdown">
              <button onclick="submenu('delivery')"><i class="fas fa-cloud"></i>DELIVERY<i class="fas fa-chevron-right"></i></button>
            </div>
            <div class="conteudo-dropdown" id="delivery">
              <?php
                $query = "SELECT checker, link FROM checkers WHERE `tipo`='delivery'";
                $resultado = $conecta->query($query);
                while($linha = $resultado->fetch_assoc()): ?>
                  <a href="<?php echo $linha['link']; ?>"><?php echo $linha['checker']; ?></a>
                <?php endwhile ?>
            </div>
          </div>

        </div>

      </div>

      <div class="section-menu-direito" id="menu-direito">
        <div class="section-menu-direito-int">

          <div class="section-menu-direito-int-box">
            <i class="fas fa-users"></i>
            <h1>USUARIOS CADASTRADOS</h1>
            <h2><? echo $total_de_user;?></h2>
          </div>

          <div class="section-menu-direito-int-box">
            <i class="fas fa-truck-loading"></i>
            <h1>CHECKERS ONLINE</h1>
            <h2><? echo count($arquivos);?></h2>
          </div>

          <div class="section-menu-direito-int-box">
            <i class="fas fa-id-card"></i>
            <h1>CONSULTAS DISPONIVEIS</h1>
            <h2>755</h2>
          </div>

        </div>

        <div class="section-menu-direito-int">

          <div class="section-menu-direito-int-box">
            <i class="fas fa-hockey-puck"></i>
            <h1>LOGINS DISPONIVEIS</h1>
            <h2>2945</h2>
          </div>

          <div class="section-menu-direito-int-box">
            <i class="far fa-credit-card"></i>
            <h1>INFO CC's DISPONIVEIS</h1>
            <h2>930</h2>
          </div>

          <div class="section-menu-direito-int-box">
            <i class="fas fa-check-square"></i>
            <h1>CONSULTAS REALIZADAS</h1>
            <h2>755</h2>
          </div>

        </div>

      </div>
    </section>
  </body>
</html>
