var executar = 0;
var testadas = 0,lives = 0,dies = 0,erros = 0;
var linhas;
var total;
  i = 0;
  function iniciarParar(){
    if(i == 0){
    document.getElementById('limpar').style.display='none';
    $("#status").text("STATUS: TESTANDO..");
    $("#iniciar").text("PARAR");
    i = 1;
    removerr();
    $("#lista").attr("readonly", true);
    linhas = $("#lista").val().split("\n");
    total = linhas.length;
    $("#linhas").text("LINHAS: "+total);
    executar = 1;
    start();
  }else{
    executar = 2;
    $("#iniciar").text("AGUARDE..");
    $("#status").text("STATUS: PARANDO..");
    $("#lista").attr("readonly", false);
    i = 0;
  }
}
  function limpar(){
    $("#status").text("STATUS: LISTA LIMPA!");
    $("#linhas").text("LINHAS: "+0);
    $("#lista").val("");
}
  function removerr() {
    var array = $("#lista").val().split("\n");
    array = unique(array);
    for(i=0;i<array.length;i++){
    array[i] = clean(array[i]);
    }
    array = array.filter(function(n){return n!=0});
    $("#lista").val(array.join("\n"));
  }
    function unique(array){
    return array.filter(function (el, index, arr){
    return index == arr.indexOf(el);
    });
  }
    function clean(str){
    while (str.indexOf("\t") > -1){str = str.replace("\t", "");}
    while (str.indexOf(" ") > -1){str = str.replace(" ", "");}
    return str;
}
  function start(){
    if(!executar)return false;
    if((linhas[0]!==undefined)&&(linhas[0]!=="")&&(executar==1)){
      testar(linhas[0]);
      linhas.shift();
    }else{
      executar = false;
      $("#status").text("STATUS: TESTE FINALIZADO");
      $("#iniciar").text("INICIAR");
      i = 0;
      $("#lista").attr("readonly", false);
      document.getElementById('limpar').style.display='block';
    }
}
  function testar(value){
    $.ajax({
      method: "POST",
      url: "arquivos/php/api.php",
      data: { linha: value },
      async: true,
      success: function(data){
        ++testadas;
        $("#testadas").text("TESTADAS: "+testadas);
        if(JSON.parse(data).status == 0){
          ++dies;
          $("#reprovadasC").text("REPROVADAS: "+dies);
          $("#reprovadas").prepend(JSON.parse(data).str+"\r\n");
        }else if(JSON.parse(data).status == 1){
          $("#saldo").text(JSON.parse(data).nsaldo);
          ++lives;
          $("#aprovadasC").text("APROVADAS: "+lives);
          $("#aprovadas").prepend(JSON.parse(data).str+"\r\n");
        }else{
          ++erros;
          $("#errosC").text("ERROS: "+erros);
          $("#erros").prepend(JSON.parse(data).str+"\r\n");
        }
      start();
      remover();
      }
    });
  }
  function remover() {
    var linhas = $("#lista").val().split('\n');
    linhas.splice(0, 1);
    $("#lista").val(linhas.join("\n"));
  }
  function contar(){
    linhas = $("#lista").val().split("\n");
    total = linhas.length;
    $("#linhas").text("LINHAS: "+total);
  }
  function limparC(campo){
    document.getElementById(campo).innerHTML = '';
  }
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
    $.ajax({
      method: "GET",
      url: "../../arquivos/php/getsaldo.php",
      async: true,
      success: function(data){
          $("#saldo").text(JSON.parse(data).str);
      }
    });
  setInterval(function () {
    if(executar == false || executar == 2){
    $.ajax({
      method: "GET",
      url: "../../arquivos/php/getsaldo.php",
      async: true,
      success: function(data){
          $("#saldo").text(JSON.parse(data).str);
      }
    });
  }
  }, 1000);