<?PHP session_start();
	if($_SESSION["cookie_1_"] != "Paco" || $_SESSION["cookie_2_"] != "malek") {
		header("Location:index.php");
		exit();
	}
	require ("globals.php");
	require ("common.php");
	$indice = 0;
	$searchStmt = "SELECT * from USUARIOS where ";
	if($nom = trim($_GET["nom"]))
	{
		$searchStmt .= "NAME like '%$nom%' and ";
		$indice ++;
	}
	if($mail = trim($_GET["mail"]))
	{
		$searchStmt .= "MAIL like '%$mail%' and ";
		$indice ++;
	}
	if($user = trim($_GET["user"]))
	{
		$searchStmt .= "USER like '%$user%' and ";
		$indice ++;
	}
	if($pass = $_GET["pass"])
	{
		$searchStmt .= "PASS like '%$pass%' and ";
		$indice ++;
	}
	if($class = trim($_GET["class"]))
	{
		$searchStmt .= "CLASE like '%$class%' and ";
		$indice ++;
	}
	if($cota = trim($_GET["cota"]))
	{
		$searchStmt .= "COTA like '%$cota%' and ";
		$indice ++;
	}
	if (!$indice)
	{
		$searchStmt = substr($searchStmt, 0, strlen($searchStmt) - 6);
	}
	else
	{
		$searchStmt = substr($searchStmt, 0, strlen($searchStmt) - 4);
	}
	$searchStmt .= " ORDER BY FECHA DESC";
	if (!($link = mysql_pconnect($hostName, $userName, $password)))
	{
		msj_error (sprintf ("Error al conectar al host %s, por el usuario %s", $hostName, $userName));
		exit();
	}
	if (!mysql_select_db($databaseName, $link))
	{
		msj_error (sprintf("error: %d %s", mysql_errno($link), mysql_error($link)));
		msj_error (sprintf("Error al seleccionar la base %s", $databaseName));
		exit();
	}
	if(!($result = mysql_query($searchStmt, $link)))
	{
		msj_error (sprintf("Error al ejecutar la sentencia %s", $searchStmt));
		msj_error (sprintf("error: %d %s", mysql_errno($link), mysql_error($link)));
		exit();
	}
	echo ("<HEAD><TITLE> Avisos clasificados </TITLE> </HEAD>");
	echo("<body TEXT = \"#000000\" BGCOLOR = \"#EBEEF3\" LINK = \"#0000EE\" VLINK = \"#551A8B\" ALINK = \"#FF0000\"><DIV ALIGN = \"CENTER\"><br>\n");
	echo("<a href = \"http://www.viarural.com.ar\"><img src=\"logo-via-rural.gif\" alt=\"Logo\" border=\"0\"></a><br><br>");
	echo("<font face = \"Arial\">");
	echo("<b> Avisos Clasificados </b></font><BR><BR>");
?>
<div align = "center">
<font color = "00923F" face = "arial">Listado de Usuarios</font>
</div>
<?php
	if(isset ($_GET["eb"]) && $_GET["eb"] == 1) {
		encabezado ( "<font face = \"arial\">La entrada fue borrada.</font>" );
	}
	echo("<TABLE cellpadding=\"6\" cellspacing=\"0\" WIDTH = \"80%%\">
			<tr><td align = \"left\"><a href = \"default.php\" style = \"text-decoration:none;\"><font face = \"arial\">Página principal</font>
			</a></td></tr></table>");
	echo("<TABLE BORDER = \"1\" cellpadding=\"6\" cellspacing=\"0\" WIDTH = \"800\" bordercolor = \"#C0C0C0\">");
	printf("<TR>
			<TD><B><font face = \"arial\">Nombre</font></B></TD>
				<TD><B><font face = \"arial\">Email</font></B></TD>
				<TD><B><font face = \"arial\">Usuario</font></B></TD>
				<TD><B><font face = \"arial\">Id</font></B></TD>
				<TD><B><font face = \"arial\">Contraseña</font></B></TD>
				<TD><B><font face = \"arial\">Clase</font></B></TD>
				<TD><B><font face = \"arial\">Cota</font></B></TD>
				<TD><B><font face = \"arial\">Fecha</font></B></TD>
				<TD colspan = \"3\" align = \"center\"><B><font face = \"arial\">Opciones</font></B></TD>
			</TR>\n");
	//$handle = fopen ("mails.txt", w);
	//fwrite ($handle, "\$vector = array(");
	//$vector = array();
	while (($row = mysql_fetch_object($result)))
	{
		printf("<TR>
					<TD><font face = \"arial\">%s</font></TD>
					<TD><font face = \"arial\">%s</font></TD>
					<TD><font face = \"arial\">%s</font></TD>
					<TD><font face = \"arial\">%s</font></TD>
					<TD><font face = \"arial\">%s</font></TD>
					<TD><font face = \"arial\">%s</font></TD>
					<TD><font face = \"arial\">%s</font></TD>
					<TD><font face = \"arial\">%s</font></TD>
					<TD><font face = \"arial\"><A HREF = \"delete.php?rowid=%s&nom=$nom&mail=$mail&user=$user&pass=$pass&class=$class\"
					style = \"text-decoration: none;\" onclick = \"return confirm ('¿Querés borrar la entrada?');\">Borrar</A></font></TD>
					<TD><font face = \"arial\"><A HREF = \"modify.php?rowid=%s\" style = \"text-decoration: none;\">Modificar</A></font></TD>
					<TD><font face = \"arial\"><A HREF = \"listar.php?name=%s&user=%s&clase=%s&id=%s\" style = \"text-decoration: none;\">Avisos</A></font></TD>
				</TR>\n", $row -> NAME, $row -> MAIL, $row -> USER, $row -> ROWID, $row -> PASS, $row -> CLASE, $row -> COTA, $row -> FECHA, $row -> ROWID, $row -> ROWID, $row -> NAME, $row -> USER, $row -> CLASE, $row -> ROWID);
		//if ($row -> ROWID > 161) $vector[] = array ($row -> NAME, $row -> MAIL, $row -> USER, $row -> PASS, $row -> CLASE);
		//fwrite ($handle, "array( \"" . $row -> NAME . "\", \"" . $row -> MAIL . "\", \"" . $row -> USER . "\", \"" . $row -> PASS . "\", \"" . $row -> CLASE  . "\"),\n");		
	}
	//fwrite ($handle, ");");
	echo ("</TABLE></div></BODY>\n");
	mysql_free_result($result);
	to_main();
	//echo "<br>\n";
	//print_r ($vector);
?>