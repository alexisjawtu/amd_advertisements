<?php session_start();
	$id = $_POST["id"];	
	$contr = $_POST["contr"];	
	if ($id == "Paco" && $contr == "malek") {
		$_SESSION["cookie_1_"] = $id;
		$_SESSION["cookie_2_"] = $contr;
		header("Location:default.php");
		exit();
	}
	else {
		header("Location:error1.php");
		exit();
	}
?>