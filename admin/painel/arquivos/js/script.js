var abrir = 0;
function menu() {
    if (abrir == 0) {
        document.querySelector ("section .menu_esquerdo").style.display = 'none';
        document.querySelector ("section .menu_direito").style.width = '100%';
        if (screen.width <= 900) {
            document.querySelector ("section .menu_esquerdo").style.display = 'flex';
            document.querySelector ("section .menu_direito").style.width = '100%';
        }
        abrir = 1;
    } else {
        document.querySelector ("section .menu_esquerdo").style.display = 'flex';
        document.querySelector ("section .menu_direito").style.width = '75%';
        if (screen.width <= 900) {
            document.querySelector ("section .menu_direito").style.width = '100%';
            document.querySelector ("section .menu_esquerdo").style.display = 'none';
        }
        abrir = 0;
    }
}

function menu_dropdown(id) {
    if (document.getElementById (id).style.display == "flex") {
        document.getElementById (id).style.display = "none";
    }else {
        document.getElementById (id).style.display = "flex";
    }
}

    var idAnt = 'criar_usuario';
    function exibirFechar(idNew){
        if(idAnt !== idNew){
            document.getElementById(idAnt).style.display = "none";
            if(idNew == 'editar_usuario' || idNew == 'adicionar_checker'){
                document.getElementById(idNew).style.display = "block";
            }else{
                document.getElementById(idNew).style.display = "flex";
            }
            idAnt = idNew;
        }
    }