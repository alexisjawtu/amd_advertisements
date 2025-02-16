<?PHP session_start ();
	require ('funciones.php');
	require ("vars.php");
	if(!autenticar_usuario ($_SESSION["cookie_1"], $_SESSION["cookie_2"])) {
		header ("Location:index.php");
		exit();
	}
	if (ctype_digit ("{$_GET['idusuario']}")) $idusuario = $_GET["idusuario"];
	if (ctype_digit ("{$_GET['rowid']}")) $rowid = $_GET["rowid"];
	if(!($link_borrar = mysql_pconnect($_host_, $_user_, $_clave_))) {
		//echo (sprintf("Error al conectar al host %s, por el usuario %s", $_host_, $_user_));
		exit();
	}
	if(!mysql_select_db($_sql_dban_, $link_borrar)) {
		//echo (sprintf("Error al seleccionar la base %s", $_sql_dban_));
		//echo (sprintf("error: %d %s", mysql_errno($link_borrar), mysql_error($link_borrar)));
		exit();
	}
	if ($_GET["pic"] == 1) {
		$consulta = mysql_query("SELECT archivo FROM ARCHIVOS WHERE IDAVISO = $rowid", $link_borrar);
		$datos = mysql_fetch_object ($consulta);
		$archivo = $datos -> archivo;
		unlink ("../images/$archivo");
		unlink ("../images/miniaturas/$archivo");
		$stmtBorrarfoto = "DELETE from ARCHIVOS where IDAVISO = $rowid";
		if(!(mysql_query($stmtBorrarfoto, $link_borrar))) {
			//echo (sprintf("Error al ejecutar la sentencia %s", $stmtBorrar));
			//echo (sprintf("error: %d %s", mysql_errno($link_borrar), mysql_error($link_borrar)));
			exit();
		}
	}
	$stmtBorrar = "DELETE from AVISOS where ID_AVISO = $rowid";
	if(!(mysql_query($stmtBorrar, $link_borrar))) {
		//echo (sprintf("Error al ejecutar la sentencia %s", $stmtBorrar));
		//echo (sprintf("error: %d %s", mysql_errno($link_borrar), mysql_error($link_borrar)));
		exit();
	}
	//actualizo la cota: incrementa en 1
	$_base_ = mysql_select_db ($_sql_dbcl_, $link_borrar);
	if (!$_base_) {
		msj_error_ ("No seleccioné la base $_sql_dbcl_.");
		exit;
	}
	$actualizar_cota = "UPDATE USUARIOS SET COTA = (COTA + 1) WHERE ROWID='$idusuario'";
	mysql_query($actualizar_cota, $link_borrar) or die 
		(sprintf("Error al ejecutar la sentencia %s. Error: %d %s", $actualizar_cota, mysql_errno($link_borrar), mysql_error($link_borrar)));
	header ("Location:action.php?choice=Ver");
?>