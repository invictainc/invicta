<?php

//simples check session [by: Masterz];

//session_start();

if($_SESSION['logado'] !== "ok"){
 	exit(header("Location: error.php"));
}

?>