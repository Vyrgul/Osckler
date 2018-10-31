<?php

///////// Saudação ao usuário 
function Saudacao(){
$hr = date(" H ");
if($hr >= 12 && $hr<18) {
$resp = "Boa tarde!";}
else if ($hr >= 0 && $hr <12 ){
$resp = "Bom dia!";}
else {
$resp = "Boa noite!";}
return "$resp";
}

/////////////diminuir texto e coloca 3 .

function limitar($str, $limita = 100, $limpar = true){

       if($limpar = true){
           $str = strip_tags($str);    
       }

       return mb_substr($str, 0, $limita).'...';
}

/////////////descobrir idade com com ano de nacimento 

function descobrirIdade($dataNascimento){
    // formato da data de nascimento
    // yyyy-mm-dd
    $data       = explode("-",$dataNascimento);
    $anoNasc    = $data[0];
    $mesNasc    = $data[1];
    $diaNasc    = $data[2];
 
    $anoAtual   = date("Y");
    $mesAtual   = date("m");
    $diaAtual   = date("d");
 
    $idade      = $anoAtual - $anoNasc;
 
    if ($mesAtual < $mesNasc){
        $idade -= 1;
        return $idade;
    } elseif ( ($mesAtual == $mesNasc) && ($diaAtual <= $diaNasc) ){
        $idade -= 1;
        return $idade;
    }else
        return $idade;
}

///////////////QUAL TIPO Do MODELO do Dispositivo 

function modelo(){
 $mobile = FALSE;
 $user_agents = array("iPhone","iPad","Android","webOS","BlackBerry","iPod","Symbian","IsGeneric");
 
 foreach($user_agents as $user_agent){
   if (strpos($_SERVER['HTTP_USER_AGENT'], $user_agent) !== FALSE) {
      $mobile = TRUE;
	$modelo	= $user_agent;
	break;
   }
 }
 
 if ($mobile){
    return strtolower($modelo);
 }else{
    return "computador";
 }
 
 }
 
 /////////////tirar acentos 
 
 function acentos($string){
 $string = trim(strtolower($string));
 $a = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýýþÿŔŕ?';
 $b = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuuyybyRr-';
 $string = strtr($string, utf8_decode($a), $b);
 $string = str_replace(".","-",$string);
 $string = preg_replace( "/[^0-9a-zA-Z\.]+/",'-',$string);
 return utf8_decode(rtrim($string, "-"));
 }
 
 /////////////// formata dinheiro 
 
 function formatMoney($valor,$cifrao='real'){
 if($cifrao == 'real') return 'R$ '.number_format($valor,2,',','.');
 else return number_format($valor,2,',','.');
 }
 
 ///////////////