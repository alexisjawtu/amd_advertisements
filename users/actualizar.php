<?PHP session_start();
	require ('funciones.php');
	require ("vars.php");
	if(!autenticar_usuario($_SESSION["cookie_1"], $_SESSION["cookie_2"])) {
		header ("Location:index.php");
		exit ();
	}
	$region = trim($_POST["region"]);
	$marca = trim($_POST["marca"]);
	$rubro = trim($_POST["rubro"]);
	if (!($link = mysql_pconnect($_host_, $_user_, $_clave_))) {
		//msj_error_ (sprintf ("Error al conectar al host %s, por el usuario %s", $_host_, $_user_));
		exit();
	}
	$descrip = mysql_real_escape_string(trim($_POST["descrip"]), $link);
	$updateStmt = "Update AVISOS set REGION = '$region', MARCA = '$marca', RUBRO = '$rubro', DESCRIPCION = '$descrip' WHERE ID_AVISO = $aviso";
	if (!mysql_select_db($_sql_dban_, $link)) {
		//msj_error_ (sprintf("Error al seleccionar la base %s", $_sql_dban_));
		//msj_error_ (sprintf("error: %d %s", mysql_errno($link), mysql_error($link)));
		exit();
	}
	if (!mysql_query($updateStmt, $link)) {
		//msj_error_ (sprintf("Error al ejecutar la sentencia %s", $updateStmt));
		//msj_error_ (sprintf("error: %d %s", mysql_errno($link), mysql_error($link)));
		exit();
	}
	header ("Location:action.php?choice=Ver");
?>