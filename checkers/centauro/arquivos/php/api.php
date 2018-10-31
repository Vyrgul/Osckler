<?php
	//error_reporting(0);
	set_time_limit(0);
	session_start();
	include('../../../../arquivos/php/bd.php');
	list($email, $senha) = explode("|", $_REQUEST['linha']);

	$Th = curl_init('https://api.centauro.appsbnet.com.br/v2.1/clientes/login');
	curl_setopt($Th, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($Th, CURLOPT_HTTPHEADER, array('User-Agent: Centauro/1.8.1 (Sony D2403; 4.4.4 API 19)','x-client-UserAgent: android','x-cv-id: 14','Authorization: Basic TW9iaWxlQXBwTTpjN2I1OTJhNg==','Content-Type: application/json; charset=UTF-8','Host: api.centauro.appsbnet.com.br','Connection: Keep-Alive','Accept-Encoding: gzip'));
	curl_setopt($Th, CURLOPT_ENCODING, 'gzip');
	curl_setopt($Th, CURLOPT_POSTFIELDS, '{"usuario":"'.$email.'","senha":"'.$senha.'","ManterLogado":true}');
	$dados = curl_exec($Th);
	//echo $dados;

	if(stristr($dados,'Usuário ou Senha inválido!')){

		echo json_encode(array('status'=>0,'str'=>'Reprovado => '.$_REQUEST['linha']));

	}elseif(stristr($dados,$token = json_decode($dados)->token)){

	$query = "SELECT saldo FROM usuarios WHERE `usuario`='".$_SESSION['usuario']."'";
	$resultado = $conecta->query($query)->fetch_assoc();
	$saldo = $resultado['saldo']-1;

	mysqli_query($conecta,"UPDATE usuarios SET saldo = '$saldo' WHERE `usuario` = '".$_SESSION['usuario']."'");

	$Th = curl_init('https://api.centauro.appsbnet.com.br/v2.2/clientes/valetrocas');
	curl_setopt($Th, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($Th, CURLOPT_HTTPHEADER, array('User-Agent: Centauro/1.8.1 (Sony D2403; 4.4.4 API 19)','x-client-UserAgent: android','x-cv-id: 14','Authorization: Basic TW9iaWxlQXBwTTpjN2I1OTJhNg==','x-client-token: '.$token.'','Host: api.centauro.appsbnet.com.br','Connection: Keep-Alive','Accept-Encoding: gzip'));
	curl_setopt($Th, CURLOPT_ENCODING, 'gzip');
	$dados = curl_exec($Th);
	//echo $dados;

	$json = json_decode($dados, true);

	//print_r($json);

$total = count($json['listaValeTroca']);
$vales = array();
$ii = 1;
 for($i=0; $i<$total; $i++){
 $podeutiliza  = $json['listaValeTroca'][$i]['podeUtilizar'];
 $saldo = $json['listaValeTroca'][$i]['saldo'];
 $valor = $json['listaValeTroca'][$i]['valor'];
 $criado = $json['listaValeTroca'][$i]['criadoEm'];
 $tipo = $json['listaValeTroca'][$i]['tipo'];

 if(empty($podeutiliza)){
 	$podeutiliza = "Não";
 }

 	$vales[] = "$ii ºDisponivel: $podeutiliza | Saldo: $saldo | Valor: $valor | Data: $criado | Tipo: $tipo";
 	$ii++;
 }
 if($total == 0){
 	echo json_encode(array('status'=>1,'str'=>'Aprovado => '.$_REQUEST['linha'].' | Vales => 0','nsaldo'=>$saldo)); 
 }elseif($total == 1){
 	echo json_encode(array('status'=>1,'str'=>'Aprovado => '.$_REQUEST['linha'].' | Vales => '.$total.'('.$vales[0].')','nsaldo'=>$saldo)); 
 }elseif($total == 2){
 	echo json_encode(array('status'=>1,'str'=>'Aprovado => '.$_REQUEST['linha'].' | Vales => '.$total.'('.$vales[0].' | '.$vales[1].')','nsaldo'=>$saldo)); 
 }else{
 	echo json_encode(array('status'=>1,'str'=>'Aprovado => '.$_REQUEST['linha'].' | Vales => '.$total.'('.$vales[0].' | '.$vales[1].' | '.$vales[2].')','nsaldo'=>$saldo)); 
 }

	}else{

		echo json_encode(array('status'=>2,'str'=>'Erro => '.$_REQUEST['linha']));

	}