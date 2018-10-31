function exibirmodal(x) {
  if (document.getElementById (x).style.display =='none') {
    document.getElementById (x).style.display='flex';
  }else {
    document.getElementById (x).style.display='none';
  }
}

function escondermodal(x) {
  if (document.getElementById (x).style.display == 'flex') {
    document.getElementById (x).style.display = 'none';
  }else {
    document.getElementById (x).style.display = 'flex';
  }
}
