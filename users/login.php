<?php session_start ();
	require ('funciones.php');
	require ("vars.php");
	$id = $_POST["id"];
	$contr = $_POST["contr"];
	if (autenticar_usuario ($id, $contr)) {
		$_SESSION["cookie_1"] = $id;
		$_SESSION["cookie_2"] = $contr;
		header("Location:action.php?choice=Ver");
		exit();
	}
	else {
		header("Location:error1.php");
		exit();
	}
?>