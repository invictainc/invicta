<?php 
//error_reporting(0);
set_time_limit(0);
session_start();

require 'check.php';

if(!isset($_SESSION['usuario']) and !isset($_SESSION['senha'])){
  echo '<script language= "JavaScript">location.href="/painel/error.php"</script><br>';
  die();
}

$array_usuarios = file("../pandatabacosssIuserss.txt");
$total_usuarios_registrados = count($array_usuarios);

$continuar = false;
for($i=0;$i<count($array_usuarios);$i++){
  $explode = explode("|" , $array_usuarios[$i]);
  if($_SESSION['usuario'] == $explode[0]){


$usuario = $_SESSION['usuario'];
$creditos = $_SESSION['creditos'];
$rank = $_SESSION['rank'];
    $continuar = true;
  }
}

if(!$continuar){
echo '<script language= "JavaScript">location.href="error.php"</script><br>';
die();
}

?>
<!DOCTYPE html>
<html class="loading">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">    
    <title>LuxCentral</title>
    <link rel="apple-touch-icon" href="logo.png">
    <link rel="shortcut icon" type="image/x-icon" href="logo.png">
    <link href="https://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,600,600i,700,700i%7CComfortaa:300,400,700" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="theme-assets/css/vendors.css">
    <link rel="stylesheet" type="text/css" href="theme-assets/css/app-lite.css">
    <link rel="stylesheet" type="text/css" href="theme-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="theme-assets/css/core/colors/palette-gradient.css">
    	 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  </head>
  <body class="vertical-layout" data-color="bg-gradient-x-purple-blue">   
    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-wrapper-before mb-3">        	
        </div>        
  <div class="content-body">
  	<div class="mt-2"></div>
	<div class="row">
		<div class="col-md-8">
			<div class="card">
				<div class="card-body text-center">
					<img class="img-circle" style="width:100px;height:90px;border-radius:100px;" src="logo.png">
					<h4 class="mb-2"><strong>LUX CENTRAL</strong></h4>
					<textarea rows="6" class="form-control text-center form-checker mb-2" placeholder="Insira sua Lista"></textarea>												
					<button class="btn btn-success btn-play text-white" style="width: 49%; float: left;"><i class="fa fa-play"></i> INICIAR</button>
					<button class="btn btn-danger btn-stop text-white" style="width: 49%; float: right;" disabled><i class="fa fa-stop"></i> PARAR</button>
				</div>
			</div>
		</div>
<div class="col-md-4">
  <div class="card mb-2">
  	<div class="card-body">
<h5>Aprovadas:<span class="badge badge-success float-right aprovadas">0</span></h5><hr>

<h5>Reprovadas:<span class="badge badge-danger float-right reprovadas">0</span></h5><hr>

<h5>Testadas:<span class="badge badge-info float-right testadas">0</span></h5><hr>

<h5>Carregadas:<span class="badge badge-primary float-right carregadas">0</span></h5><hr>

<h5>Creditos:<span class="badge badge-dark float-right saldo"><?=$creditos ?></span></h5>
                        <div class="iq-card-body">
                            <select class="form-control" style="width:100%;" style="width:100%;" name="SelectOptions" id="SelectOptions" required>
                           <option selected="" disabled="">CHECKERS</option>
                              <option value="bb1">CHECKER BB VBV (ON)</option>
                              <option value="bb2">CHECKER BB SEM VBV (ON)</option>
                           </optgroup>
                        </select>
                      </div>
                  </div> 
                </div>
              </div>
            
		<div class="col-xl-12">
			<div class="card">
				<div class="card-body">
					<div class="float-right">
						<button type="show" class="btn btn-primary btn-sm show-lives"><i class="fa fa-eye-slash"></i></button>
					<button class="btn btn-success btn-sm btn-copy"><i class="fa fa-copy"></i></button>					
					</div>
					<h4 class="card-title mb-1"><i class="fa fa-check text-success"></i> Aprovadas</h4>					
			<div id='lista_aprovadas'></div>
				</div>				
			</div>
		</div>
		<div class="col-xl-12">
			<div class="card">
				<div class="card-body">
					<div class="float-right">
						<button type='hidden' class="btn btn-primary btn-sm show-dies"><i class="fa fa-eye"></i></button>
					<button class="btn btn-danger btn-sm btn-trash"><i class="fa fa-trash"></i></button>					
					</div>
					<h4 class="card-title mb-1"><i class="fa fa-times text-danger"></i> Reprovadas</h4>		
						<div style='display: none;' id='lista_reprovadas'></div>
				</div>				
			</div>
		</div>
</section>
        </div>
      </div>
    </div>
 
    <script src="theme-assets/js/core/libraries/jquery.min.js" type="text/javascript"></script>

<script>

$(document).ready(function(){

Swal.fire({ title: "AVISO", text: "Use Matrix Boa. Não Use Matrix Vazada/Queimada.", icon: "warning", confirmButtonText: "OK", buttonsStyling: false, confirmButtonClass: 'btn btn-primary'});

getSaldo();

$('.show-lives').click(function(){
var type = $('.show-lives').attr('type');
$('#lista_aprovadas').slideToggle();
if(type == 'show'){
$('.show-lives').html('<i class="fa fa-eye"></i>');
$('.show-lives').attr('type', 'hidden');
}else{
$('.show-lives').html('<i class="fa fa-eye-slash"></i>');
$('.show-lives').attr('type', 'show');
}});

$('.show-dies').click(function(){
var type = $('.show-dies').attr('type');
$('#lista_reprovadas').slideToggle();
if(type == 'show'){
$('.show-dies').html('<i class="fa fa-eye"></i>');
$('.show-dies').attr('type', 'hidden');
}else{
$('.show-dies').html('<i class="fa fa-eye-slash"></i>');
$('.show-dies').attr('type', 'show');
}});

$('.btn-trash').click(function(){
	Swal.fire({title: 'Lista de Reprovadas Limpa!', icon: 'success', showConfirmButton: false, toast: true, position: 'top-end', timer: 3000});
$('#lista_reprovadas').text('');
});

$('.btn-copy').click(function(){
	Swal.fire({title: 'Lista de Aprovadas Copiada!', icon: 'success', showConfirmButton: false, toast: true, position: 'top-end', timer: 3000});
var lista_lives = document.getElementById('lista_aprovadas').innerText;
var textarea = document.createElement("textarea");
textarea.value = lista_lives;
document.body.appendChild(textarea); 
textarea.select(); 
document.execCommand('copy');           document.body.removeChild(textarea); 
});


$('.btn-play').click(function(){

var lista = $('.form-checker').val().trim();
var array = lista.split('\n');
var lives = 0, dies = 0, testadas = 0, txt = '';

if(!lista){
	Swal.fire({title: 'Erro: Lista Vazia!', icon: 'error', showConfirmButton: false, toast: true, position: 'top-end', timer: 3000});
	return false;
}

Swal.fire({title: 'Teste Iniciado!', icon: 'success', showConfirmButton: false, toast: true, position: 'top-end', timer: 3000});

var line = array.filter(function(value){
if(value.trim() !== ""){
	txt += value.trim() + '\n';
	return value.trim();
}
});

/*
var line = array.filter(function(value){
return(value.trim() !== "");
});
*/

var total = line.length;

/*
line.forEach(function(value){
txt += value + '\n';
});
*/

$('.form-checker').val(txt.trim());

if(total > 1000){
	Swal.fire({title: 'Limite de Linhas Exedido!', icon: 'warning', showConfirmButton: false, toast: true, position: 'top-end', timer: 3000});
	return false;
}

$('.carregadas').text(total);
$('.btn-play').attr('disabled', true);
$('.btn-stop').attr('disabled', false);

line.forEach(function(data){
var callBack = $.ajax({
	//url: 'api.php?lista=' + data,
	success: function(retorno){
		if(retorno.indexOf("Aprovada") >= 0){
			Swal.fire({title: '+1 Aprovada!', icon: 'success', showConfirmButton: false, toast: true, position: 'top-end', timer: 3000});
			$('#lista_aprovadas').append(retorno);
			removelinha();
			getSaldo();
			lives = lives +1;
		}else{
			$('#lista_reprovadas').append(retorno);
			removelinha();
			dies = dies +1;
		}
		testadas = lives + dies;
		$('.aprovadas').text(lives);
		$('.reprovadas').text(dies);
		$('.testadas').text(testadas);
		
		if(testadas == total){
			Swal.fire({title: 'Teste Finalizado!', icon: 'success', showConfirmButton: false, toast: true, position: 'top-end', timer: 3000});
			$('.btn-play').attr('disabled', false);
			$('.btn-stop').attr('disabled', true);
		}
        }
      });
      $('.btn-stop').click(function(){
      Swal.fire({title: 'Teste Parado!', icon: 'warning', showConfirmButton: false, toast: true, position: 'top-end', timer: 3000});
      $('.btn-play').attr('disabled', false);
      $('.btn-stop').attr('disabled', true);      
      	callBack.abort();
      	return false;
      });
    });
  });
});

function removelinha() {
var lines = $('.form-checker').val().split('\n');
lines.splice(0, 1);
$('.form-checker').val(lines.join("\n"));
}

function getSaldo(){
$.get('../getSaldo.php', function(saldo){
	$('.saldo').text(saldo);
});
}
   
  
	
</script>
  </body>
</html>