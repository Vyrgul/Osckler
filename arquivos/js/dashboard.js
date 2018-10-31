//ABRIR E FECHAR O MENU PRINCIPAL DIREITO
var abrir = 0;

function abrirfecharmenu() {

  if (abrir == 0) {

    document.getElementById ("menu-esquerdo").style.display='none';
    document.getElementById ("menu-direito").style.width='100%';
    if(screen.width <= 900){
      document.getElementById("menu-esquerdo").style.display='flex';
      document.getElementById("menu-direito").style.display='none';
    }
    abrir = 1;

  }else {

    document.getElementById ("menu-esquerdo").style.display='flex';
    document.getElementById ("menu-direito").style.width='75%';
    if(screen.width <= 900){
      document.getElementById("menu-esquerdo").style.display='none';
      document.getElementById("menu-direito").style.display='flex';
      document.getElementById("menu-direito").style.width='100%';
    }
    abrir = 0;

  }

}


//FUNÇÃO PARA ABRIR E FECHAR O SUBMENU
function submenu(id) {
  if (document.getElementById (id).style.display == 'none') {

    document.getElementById (id).style.display = 'flex';

  } else {

    document.getElementById (id).style.display = 'none';

  }
}

//MODAL
function abrirmodal() {
  if(document.getElementById ("corpo_modal").style.display == 'none') {
    document.getElementById ("corpo_modal").style.display = 'flex';
  }else {
    document.getElementById ("corpo_modal").style.display = 'none';
  }
}

function fecharmodal() {
  if(document.getElementById ("corpo_modal").style.display == 'flex') {
    document.getElementById ("corpo_modal").style.display = 'none';
  }else {
    document.getElementById ("corpo_modal").style.display = 'flex';
  }
}

