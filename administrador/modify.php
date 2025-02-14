<?PHP session_start();
	if($_SESSION["cookie_1_"] != "Paco" || $_SESSION["cookie_2_"] != "malek") {
		header("Location:index.php");
		exit();
	}
	require ("globals.php");
	require ("common.php");
	echo ("<HEAD><TITLE> Avisos clasificados </TITLE> </HEAD>");
	echo("<body TEXT = \"#000000\" BGCOLOR = \"#EBEEF3\" LINK = \"#0000EE\" VLINK = \"#551A8B\" ALINK = \"#FF0000\"><DIV ALIGN = \"CENTER\"><br>\n");
	echo("<a href = \"http://www.viarural.com.ar\"><img src=\"logo-via-rural.gif\" alt=\"Logo\" border=\"0\"></a><br><br>");
	echo("<font face = \"Arial\">");
	echo("<b> Avisos Clasificados </b><BR><BR>");
	$rowid = $_GET["rowid"];
	$selectStmt = "SELECT * FROM USUARIOS WHERE ROWID = $rowid";
	if (!($link = mysql_pconnect($hostName, $userName, $password)))
	{
		msj_error (sprintf ("Error al conectar al host %s, por el usuario %s", $hostName, $userName));
		exit();
	}
	if (!mysql_select_db($databaseName, $link))
	{
		msj_error (sprintf("Error al seleccionar la base %s", $databaseName));
		msj_error (sprintf("error: %d %s", mysql_errno($link), mysql_error($link)));
		exit();
	}
	if (!($result = mysql_query($selectStmt, $link)))
	{
		msj_error (sprintf("Error al ejecutar la sentencia %s", $selectStmt));
		msj_error (sprintf("error: %d %s", mysql_errno($link), mysql_error($link)));
		exit();
	}
	echo "<div align = \"center\">";
	encabezado("Modifique los datos.");
	if(!($row = mysql_fetch_object($result)))
	{
		msj_error ("Error interno, la entrada no existe");
		exit();
	}
	$resultEntry["nom"] = $row -> NAME;
	$resultEntry["mail"] = $row -> MAIL;
	$resultEntry["user"] = $row -> USER;
	$resultEntry["pass"] = $row -> PASS;
	$resultEntry["class"] = $row -> CLASE;
	$resultEntry["cota"] = $row -> COTA;
	$_SESSION["idfila"] = $rowid; //Saqué ?rowid=$rowid de la url de abajo.
	formulario_usuario($resultEntry, "update.php?q=1", "MODIFICAR");
	mysql_free_result($result);
?>