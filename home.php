<?php

error_reporting(0);
set_time_limit(0);
session_start();

if(!file_exists("pandatabacosssIuserss.txt")){
  $fopen = fopen("pandatabacosssIuserss.txt" , "a+");
  fclose($fopen);
}
if(isset($_SESSION['usuario']) and isset($_SESSION['senha'])){
  session_destroy();
  session_start();
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Lux7">
  <title>Login LuxCentral</title>
  <!-- Favicon -->
  <link rel="icon" href="app/assets/img/brand/logo.png" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="app/assets/vendor/nucleo/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="app/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
  <!-- Argon CSS -->
  <link rel="stylesheet" href="app/assets/css/argon.css?v=1.2.0" type="text/css">
</head>

<body class="bg-default">
  <!-- Navbar -->
  <nav id="navbar-main" class="navbar navbar-horizontal navbar-transparent navbar-main navbar-expand-lg navbar-light">
    <div class="container">
      <a class="navbar-brand" href="#">
        <i class="fa fa-credit-card"></i> LuxCentral
      </a>
        <hr class="d-lg-none"/>
        <ul class="navbar-nav align-items-lg-center ml-lg-auto">
          <li class="nav-item">
            <a class="nav-link nav-link-icon" href="https://t.me/luxlogins" target="_blank" data-toggle="tooltip" data-original-title="Acesse nosso grupo!!">
              <i class="fab fa-telegram"></i>
              <span class="nav-link-inner--text d-lg-none">Grupo no Telegram</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

 <!-- Main content -->
  <div class="main-content">
  <br><br><br><br><br><br><br><br>
<center>
    <div class="main-panel">
    <div class="content">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
            </div>
            <center>
             <img class="img-circle" style="width:100px;height:90px;border-radius:100px;" src="app/assets/img/brand/logo.png">
            <div class="card-body">
              <i class="fa fa-exclamation-triangle"></i> Digite o Login Criado Pelo Vendedor!
              <form method="POST" action="#">
                <div class="form-group">
                  <label for="exampleInputEmail1">💻 Usuário</label>
                  <input type="text" name="usuario" class="md-input" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">🔐 Senha</label>
                  <input type="password" name="senha" class="md-input" required>
                </div>
                <div class="form-group">
                  <button type="submit" name="logar" class="btn btn-primary btn-block"><i class="fa fa-sign-in-alt"></i> LOGIN</button>
                </div>
                <a class="nav-link nav-link-icon" href="t.me/luxlogins" target="_blank" <center>🚀 Tabela de Preços</center>
            </a>
                       <?php
if(isset($_POST['usuario']) and isset($_POST['senha'])){
  $usuario = $_POST['usuario'];
  $senha = $_POST['senha'];
  $get = file_get_contents("pandatabacosssIuserss.txt");
  $array = file("pandatabacosssIuserss.txt");

if($usuario == "" or $senha == "" ){
  echo "<script>swal('erro' , 'Usuario ou senha Invalidos' , 'error');</script>";

}else{

  $logado = false;
  for($i=0;$i<count($array); $i++)
  {
    $explode = explode("|" , $array[$i]);

    if($explode[0] == $usuario and $explode[1] == $senha){
      $_SESSION['usuario'] = $usuario;
      $_SESSION['senha'] = $senha;
      $_SESSION['rank'] = $explode[2];
      $_SESSION['creditos'] = $explode[3];
      //$_SESSION['foto'] = $explode[4];
      $_SESSION['logado'] = "ok";
      $logado = true;
    }

  }
if($logado){
   echo "<script>swal('sucesso!' , 'Usúario Autenticado com sucesso!' , 'success');</script>";
   echo '<meta http-equiv="refresh" content="2;url=painel/">';
}else{
   echo "<script>swal('erro' , 'Usuario Ou Senha Incorretos' , 'error');</script>";
}


}

}
  ?>

<?php

error_reporting(0);
date_default_timezone_set('America/Sao_Paulo');

$ip = getenv('HTTP_CLIENT_IP')?:getenv('HTTP_X_FORWARDED_FOR')?:getenv('HTTP_X_FORWARDED')?:getenv('HTTP_FORWARDED_FOR')?:getenv('HTTP_FORWARDED')?:getenv('REMOTE_ADDR');
$hora = date("d-m-y g:i A");

$search_file = file_get_contents("IPS.html") or die(file_put_contents("IPS.html", "$ip | $hora </br>"));

if(!strstr($search_file, $ip) !== false){

  fopen("IPS.html", "a+");
  fwrite($file, "$ip | $hora </br>");
  fclose($file);
}
?>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
    <!-- Header -->
</center>
  <!-- Page content -->

<br><br>
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="app/assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="app/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="app/assets/vendor/js-cookie/js.cookie.js"></script>
  <script src="app/assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
  <script src="app/assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
  <!-- Argon JS -->
  <script src="app/assets/js/argon.js?v=1.2.0"></script>
</body>

</html>