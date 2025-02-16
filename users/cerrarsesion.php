<?php session_start ();
 require ('funciones.php');
 require ("vars.php");
 if(!autenticar_usuario($_SESSION["cookie_1"], $_SESSION["cookie_2"])) {
	header("Location:index.php");
	exit();
 }
 $_SESSION["cookie_1"] = "";
 $_SESSION["cookie_2"] = "";
 header("Location:index.php");
 exit();
?>