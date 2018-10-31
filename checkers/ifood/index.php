<?php
include('../../arquivos/php/verifica_login.php');
?>
<!DOCTYPE html>
<html>
  <head>
    <title>CHECKER <?php $checker = strtoupper(str_replace('/checkers/', '', $_SERVER['REQUEST_URI'])); echo $checker = str_replace('/', '', $checker); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta charset="utf-8">
    <link rel="stylesheet" href="arquivos/css/estilo.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="arquivos/javascript/script.js"></script>
  </head>
  <body onload="exibirmodal('modal-aprovadas'); exibirmodal('modal-reprovadas'); exibirmodal('modal-erros')">

    <header>
      <div class=""></div>
      <h1>CENTRAL OSCKLER</h1>
      <div class="header-int-direito">
        <i class="fas fa-money-check-alt"><name id="saldo">0</name></i>
      </div>
    </header>

    <section>
      <div class="titulo_interior">
        <h1>CHECKER <?php echo $checker ?></h1>
        <span id="status">STATUS: PARADO</span>
      </div>

      <div class="textarea">
        <textarea id="lista" onkeyup="contar();"></textarea>
      </div>

      <div class="informacoes_de_teste">
        <span id="aprovadasC">APROVADAS: 0</span><i class="fas fa-arrow-right"></i>
        <span id="reprovadasC">REPROVADAS: 0</span><i class="fas fa-arrow-right"></i>
        <span id="errosC" style="cursor: pointer;" onclick="exibirmodal('modal-erros')">ERROS: 0</span><i class="fas fa-arrow-right"></i>
        <span id="testadas">TESTADAS: 0</span><i class="fas fa-arrow-right"></i>
        <span id="linhas">LINHAS: 0</span>
      </div>

      <div class="botoes">
        <button onclick="iniciarParar();" id="iniciar">INICIAR</button>
        <button onclick="limpar();" id="limpar">LIMPAR</button>
      </div>

      <div class="areareprovadaseraprovadas">
        <div class="aprovadas" onclick="exibirmodal('modal-aprovadas')">APROVADAS</div>
        <div class="reprovadas" onclick="exibirmodal('modal-reprovadas')">REPROVADAS</div>
      </div>


    <!-- MODAL APROVADAS INICIO -->
      <div id="modal-aprovadas" class="modal">
        <div class="conteudo-modal-aprovadas">

          <div class="modal-aprovadas-header">
            <h1>APROVADAS</h1>
          </div>

          <div class="modal-aprovadas-section">
            <div class="corpo-textarea">
              <textarea id="aprovadas" readonly></textarea>
            </div>
          </div>

          <div class="modal-aprovadas-footer">
            <i onclick="limparC('aprovadas');" class="fas fa-trash-alt"></i>
            <i class="fas fa-window-close" onclick="escondermodal('modal-aprovadas')"></i>
          </div>
        </div>
      </div>
    <!-- MODAL APROVADAS FIM -->

    <!-- MODAL REPROVADAS INICIO -->
      <div id="modal-reprovadas" class="modal">
        <div class="conteudo-modal-aprovadas">

          <div class="modal-aprovadas-header">
            <h1>REPROVADAS</h1>
          </div>

          <div class="modal-aprovadas-section">
            <div class="corpo-textarea">
              <textarea id="reprovadas" readonly></textarea>
            </div>
          </div>

          <div class="modal-aprovadas-footer">
            <i onclick="limparC('reprovadas');" class="fas fa-trash-alt"></i>
            <i class="fas fa-window-close" onclick="escondermodal('modal-reprovadas')"></i>
          </div>
        </div>
      </div>
    <!-- MODAL REPROVADAS FIM -->

    <!-- MODAL ERROS INICIO -->
      <div id="modal-erros" class="modal">
        <div class="conteudo-modal-aprovadas">

          <div class="modal-aprovadas-header">
            <h1>ERROS</h1>
          </div>

          <div class="modal-aprovadas-section">
            <div class="corpo-textarea">
              <textarea id="erros" readonly></textarea>
            </div>
          </div>

          <div class="modal-aprovadas-footer">
            <i onclick="limparC('erros');" class="fas fa-trash-alt"></i>
            <i class="fas fa-window-close" onclick="escondermodal('modal-erros')"></i>
          </div>
        </div>
      </div>
    <!-- MODAL ERROS FIM -->

    </section>

    <footer>

    </footer>

  </body>
</html>
