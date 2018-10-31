<!DOCTYPE html>
<html>
  <head>
    <title>CHECKER</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta charset="utf-8">
    <link rel="stylesheet" href="estilo.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <script type="text/javascript" src="script.js"></script>
  </head>
  <body onload="exibirmodal('modal-aprovadas'); exibirmodal('modal-reprovadas'); exibirmodal('modal-erros')">

    <header>
      <h1 id="titulo_invisivel"></h1>
      <h1>CENTRAL OSCKLER</h1>
      <div class="header-int-direito">
        <i class="fas fa-money-check-alt"></i>
        <name>562,87</name>
      </div>
    </header>

    <section>
      <div class="titulo_interior">
        <h1>CHECKER TESTE</h1>
        <span>STATUS: PARADO</span>
      </div>

      <div class="textarea">
        <textarea></textarea>
      </div>

      <div class="informacoes_de_teste">
        <span>APROVADAS: 0</span><i class="fas fa-arrow-right"></i>
        <span>REPROVADAS: 0</span><i class="fas fa-arrow-right"></i>
        <span style="cursor: pointer;" onclick="exibirmodal('modal-erros')">ERROS: 0</span><i class="fas fa-arrow-right"></i>
        <span>TESTADAS: 0</span><i class="fas fa-arrow-right"></i>
        <span>LINHAS: 0</span>
      </div>

      <div class="botoes">
        <button>INICIAR</button>
        <button>LIMPAR</button>
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
              <textarea></textarea>
            </div>
          </div>

          <div class="modal-aprovadas-footer">
            <i class="fas fa-trash-alt"></i>
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
              <textarea></textarea>
            </div>
          </div>

          <div class="modal-aprovadas-footer">
            <i class="fas fa-trash-alt"></i>
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
              <textarea></textarea>
            </div>
          </div>

          <div class="modal-aprovadas-footer">
            <i class="fas fa-trash-alt"></i>
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
