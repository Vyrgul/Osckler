<html>
    <head>
        <title>CHECKER FULL</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no">
        <link rel="stylesheet" href="arquivos/css/estilo.css">
        <link rel="stylesheet" href="arquivos/css/normalize.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
        <script type="text/javascript" src="arquivos/js/script.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    </head>

    <body>
        <div class="modal-erros" id="modal-erros">
            <div class="conteudo-modal-erros">
                <div class="inicio">
                    <h1>ERROS</h1>
                    <div class="direita">
                        <i class="fas fa-copy"></i>
                        <i class="fas fa-window-minimize" id='erros' onclick="abrirFechar('erros');" style="cursor: pointer;"></i>
                    </div>
                </div>

                <div class="meio" id="meio" style="display: block;">
                    <table>
                        
                        <tr>
                            <th>CARTÃO</th>
                            <th>MÊS</th>
                            <th>ANO</th>
                            <th>CVV</th>
                            <th>RECUSOU</th>
                        </tr>

                        <tbody id="reprovadas">

   
                        </tbody>
                    
                    </table>
                </div>
            </div>
        </div>

        <header>
            <div class="logo">
                <i class="fab fa-d-and-d"></i>
            </div>
            <div class="titulo">
                <h1>CHECKER FULL</h1>
            </div>
            <div class="informações">
                <div class="saldo">
                    <i class="fas fa-money-check-alt"></i>
                    <h1>891</h1>
                </div>
                <div class="testando">
                    <div class="verde" id="verde"></div>
                    <div class="amarelo" id="amarelo"></div>
                    <div class="vermelho" id="vermelho"></div>
                </div>
            </div>
        </header>

        <section>
            <textarea id="lista" onkeyup="contar();"></textarea>

            <div class="status">
                <span id="aprovadasC">APROVADAS: 0</span>
                <span id="reprovadasC">REPROVADAS: 0</span>
                <span id="errosC" style="cursor: pointer;">ERROS: 0</span>
                <span id="testadasC">TESTADAS: 0</span>
                <span id="linhasC">LINHAS: 0</span>
            </div>

            <div class="barra_de_progresso">
                <div class="barra" id="barra"></div>
            </div>

            <div class="botões">
                <button id="iniciar" onclick="iniciar();" style="cursor: pointer;"><i class="fas fa-play"></i>INICIAR</button>
                <button id="parar" onclick="parar(); apertarbotaoparar();" style="cursor: pointer;"><i class="fas fa-stop"></i>PARAR</button>
                <button id="limpar" onclick="limpar();" style="cursor: pointer;"><i class="fas fa-trash"></i>LIMPAR</button>
            </div>
        </section>

        <footer>
            <div class="aprovadas">
                <div class="inicio">
                    <h1>APROVADAS</h1>
                    <div class="direita">
                        <i class="fas fa-copy"></i>
                        <i class="fas fa-window-minimize" id='meio_aprovadasi' onclick="abrirFechar('meio_aprovadas');" style="cursor: pointer;"></i>
                    </div>
                </div>

                <div class="meio" id="meio_aprovadas" style="display: block;">

                    <table>
                    
                        <tr>
                            <th>CARTÃO</th>
                            <th>MÊS</th>
                            <th>ANO</th>
                            <th>CVV</th>
                            <th>DEBITOU</th>
                            <th>PAIS</th>
                            <th>MOEDA</th>
                            <th>BANCO</th>
                            <th>BANDEIRA</th>
                            <th>NIVEL</th>
                            <th>TIPO</th>
                        </tr>

                        <tbody id="aprovadas">

                        </tbody>
                    
                    </table>
                </div>

                <div class="fim"></div>
            </div>

            <div class="reprovadas">
                <div class="inicio">
                    <h1>REPROVADAS</h1>
                    <div class="direita">
                        <i class="fas fa-copy copiar"></i>
                        <i class="fas fa-window-minimize" id='meioi' onclick="abrirFechar('meio');" style="cursor: pointer;"></i>
                    </div>
                </div>

                <div class="meio" id="meio" style="display: block;">
                    <table>
                        
                        <tr>
                            <th>CARTÃO</th>
                            <th>MÊS</th>
                            <th>ANO</th>
                            <th>CVV</th>
                            <th>RECUSOU</th>
                        </tr>

                        <tbody id="reprovadas">

   
                        </tbody>
                    
                    </table>
                </div>
            </div>
        </footer>
    </body>
</html>