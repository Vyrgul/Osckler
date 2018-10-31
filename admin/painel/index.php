<?php
    session_start();
    if($_SESSION['admin'] == 1){
    }else{
        echo "REDIRECIONE";
    }
?>
<html>
    <head>
        <title>ADMIN</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <link rel="stylesheet" href="arquivos/css/estilo.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
        <link rel="stylesheet" href="https://necolas.github.io/normalize.css/8.0.0/normalize.css">
        <script type="text/javascript" src="arquivos/js/script.js"></script>
    </head>

    <body>

        <header id="header_desktop">
            <div class="topo_int_esquerdo">
                <h1>CENTRAL OSCKLER</h1>
                <i class="fas fa-bars" onclick="menu()"></i>
            </div>

            <div class="topo_int_direito">
                <i class="fas fa-money-check-alt icone_saldo"></i>
                <h6>530</h6>
                <i class="fas fa-power-off icone_configuracao"></i>
            </div>
        </header>

        <!-- CABEÇALHO PARA DISPOSITIVOS MOVEIS-->
        <header id="header_mobile">
            <div class="topo">
                <h1>CENTRAL OSCKLER</h1>
            </div>

            <div class="bottom">
                <i class="fas fa-bars" onclick="menu()"></i>
                <i class="fas fa-power-off icone_configuracao"></i>
            </div>
        </header>

        <section>
            <!--MENU ESQUERDO-->
            <div class="menu_esquerdo">
                <div class="detalhes_esquerdo">
                    <div class="perfil">
                        <img src="arquivos/img/rr.png">
                    </div>
                    <div class="detalhes-perfil">
                        <h1>Vyrgul</h1>
                        <h4>Online</h4>
                    </div>
                </div>

                <!--INICIO CONTEUDO DO MENU (SCROLL)-->
                <div class="conteudo_menu">
                    <div class="menu">
                        <div class="info_menu" onclick="menu_dropdown('usuarios')">
                            <i class="fas fa-user icone_checker"></i>
                            <h3>USUÁRIOS</h1>
                            <i class="fas fa-caret-down icone_dropdown"></i>
                        </div>
    
                        <div class="dropdown" id="usuarios">
                            <a href="#criar_usuario" onclick="exibirFechar('criar_usuario');">CRIAR USUARIO</a>
                            <a href="#editar_usuario" onclick="exibirFechar('editar_usuario');">EDITAR USUARIO</a>
                            <a href="#deletar_usuario" onclick="exibirFechar('deletar_usuario');">DELETAR USUÁRIO</a>
                        </div>
                    </div>
    
                    <div class="menu">
                        <div class="info_menu" onclick="menu_dropdown('checkers')">
                            <i class="fas fa-cubes icone_checker"></i>
                            <h3>CHECKERS</h1>
                            <i class="fas fa-caret-down icone_dropdown"></i>
                        </div>
    
                        <div class="dropdown" id="checkers">
                            <a href="#adicionar_checker" onclick="exibirFechar('adicionar_checker');">ADICIONAR CHECKER</a>
                            <a href="#deletar_checker" onclick="exibirFechar('deletar_checker');">DELETAR CHECKER</a>
                        </div>
                    </div>
    
                    <div class="menu">
                        <div class="info_menu" onclick="menu_dropdown('dumps')">
                            <i class="fas fa-archive icone_checker"></i>
                            <h3>DUMPS</h1>
                            <i class="fas fa-caret-down icone_dropdown"></i>
                        </div>
    
                        <div class="dropdown" id="dumps">
                            <a href="#adicionar_logs" onclick="alert('RECURSO INDISPONIVEL NO MOMENTO!');">ADICIONAR LOGS</a>
                        </div>
                    </div>
                    <!--FIM CONTEUDO DO MENU (SCROLL)-->

                    <div class="minimizar_menu">
                        <i class="fas fa-angle-double-left" onclick="menu()"></i>
                    </div>
                </div>
            </div>

            <div class="menu_direito">
                <!--INICIO CRIAR USUARIO-->
                <div class="criar_usuario" id="criar_usuario">
                    <div class="titulo">
                        <h1>CRIAR USUARIO</h1>
                    </div>

                    <div class="formulario">
                        <div class="formulario_int">
<?php
    extract($_REQUEST);
    if(isset($email) && $usuario && $senha && $nome && $tipo && $saldo){
        include('../../arquivos/php/bd.php');
        if(isset($_FILES['foto']['name']) || $foto !== '(binary)'){
            $extensao = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
            $extensao = strtolower($extensao);
            if(strstr('.jpg;.jpeg;.gif;.png', $extensao)){

                $destino = '../arquivos/img/'.$usuario.'.'.$extensao;
                $arquivo_tmp = $_FILES['foto']['tmp_name'];
                $foto = move_uploaded_file($arquivo_tmp, '../'.$destino);
                if($foto == 1){
                    $foto = 'Foto adicionada.';
                }else{
                    if($destino == '../arquivos/img/padrao.jpg'){
                        $foto = 'Foto padrão adicionada';
                    }else{
                        $foto = 'Ocorreu um erro ao adicionar a foto.'; 
                    }
                }

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
            echo 'usuário criado. '.$foto;
        }else{
            echo 'Ocorreu um erro na criação do usuário. '.$foto;
        }
        
    }else{
        echo 'Você deve preencher todos os campos, apenas a foto é opcional.';
    }
    ?>
                            <form action="" method="POST" enctype="multipart/form-data">
                                <input type="email" name="email" placeholder="Email@dominio.com">
                                <input type="username" name="usuario" placeholder="Nome de usuário">
                                <input type="password" name="senha" placeholder="Senha">
                                <input type="text" name="nome" placeholder="Nome">
                                <select name="tipo">
                                    <option value="cliente">Cliente</option>
                                    <option value="vendedor">Vendedor</option>
                                    <option value="administrador">Administrador</option>
                                </select>
                                <input type="number" name="saldo" placeholder="Creditos">
                                <label for="inputFile">SELECIONAR FOTO DE PERFIL</label>
                                <input type="file" name="foto" class="type" id="inputFile">
                                <div class="borda-topo"></div>
                                <button type="submit">CRIAR USUARIO</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!--FIM CRIAR USUARIO-->

                <!--INICIO EDITAR USUARIO-->
                <div class="editar_usuario" id="editar_usuario">
                    <div class="titulo">
                        <h1>EDITAR USUARIO</h1>
                    </div>

                    <div class="pesquisar_nome">
                        <i class="fas fa-user-tag"></i>
                        <input type="text" placeholder="Usuário ">
                    </div>

                    <div id="borda"></div>

                    <div class="editar_detalhes">
                        <div class="esquerdo">
                            <div class="nome">
                                <i class="fas fa-user"></i>
                                <input type="text" placeholder="Nome: ">
                            </div>

                            <div class="nome_de_usuario">
                                <i class="fas fa-address-card"></i>
                                <input type="username" placeholder="Nome de usuário">
                            </div>

                            <div class="foto_de_perfil">
                                <i class="fas fa-address-book"></i>
                                <label id="#bb">
                                    Foto de perfil
                                    <input type="file" id="File">
                                </label>
                            </div>
                        </div>
                        <div class="direito">
                            <div class="email">
                                <i class="fas fa-envelope"></i>
                                <input type="email" placeholder="E-mail">
                            </div>

                            <div class="senha">
                                <i class="fas fa-key"></i>
                                <input type="password" placeholder="Senha">
                            </div>

                            <div class="creditos">
                                <i class="fas fa-file-invoice-dollar"></i>
                                <input type="number" placeholder="Créditos">
                            </div>
                        </div>
                    </div>

                    <div class="footer">
                        <button>EDITAR</button>
                    </div>
                </div>
                <!--FIM EDITAR USUARIO-->

                <!--INICIO DELETAR USUARIO-->
                <div class="deletar_usuario" id="deletar_usuario">
                    <div class="deletar_usuario_topo">
                        <h1>DELETAR USUÁRIO</h1>
                    </div>

                    <div class="borda_deletar_usuario"></div>

                    <div class="pesquisar_usuario">
                        <i class="fas fa-user-tag"></i>
                        <input type="text" placeholder="Email ou Usuário">
                    </div>

                    <div class="deletar_usuario_botao">
                        <button>DELETAR</button>
                    </div>
                </div>
                <!--INICIO DELETAR USUARIO-->

                <!--INICIO ADICIONAR CHECKER-->
                <div class="adicionar_checker" id="adicionar_checker">
                    <div class="topo">
                        <h1>ADICIONAR CHECKER</h1>
                    </div>

                    <div class="borda"></div>

                    <div class="formulario">
                        <div class="nome">
                            <i class="fas fa-file-signature"></i>
                            <input type="text" placeholder="NOME: ">
                        </div>

                        <div class="tipo">
                            <i class="fas fa-tags"></i>
                            <input type="text" placeholder="TIPO: ">
                        </div>

                        <div class="selecionar_arquivo">
                            <i class="fas fa-box"></i>
                            <label for="inputFile">SELECIONE O CHECKER</label>
                            <input type="file" class="type" id="inputFile">
                        </div>
                    </div>

                    <div class="confirmar_dados">
                        <button>ADICIONAR</button>
                    </div>
                </div>
                <!--FIM ADICIONAR CHECKER-->

                <!--INICIO DELETAR CHECKER-->
                <div class="deletar_checker" id="deletar_checker">
                    <div class="topo">
                        <h1>DELETAR CHECKER</h1>
                    </div>

                    <div class="meio">
                        <div class="selecionar_checker">
                            <i class="fas fa-cube"></i>
                            <select name="" id="">
                                <option value="">SELECIONE O CHECKER</option>
                            </select>
                        </div>

                        <div class="botão_deletar_checker">
                            <button>DELETAR</button>
                        </div>
                    </div>
                </div>
                <!--FIM DELETAR CHECKER-->

            </div>

        </section>
        
    </body>
</html>