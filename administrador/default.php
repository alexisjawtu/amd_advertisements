<?PHP session_start();
	if($_SESSION["cookie_1_"] != "Paco" || $_SESSION["cookie_2_"] != "malek") {
		header("Location:index.php");
		exit();
	}
	require ("common.php");
	require ("globals.php");
	echo ("<HEAD><TITLE> Avisos clasificados </TITLE> </HEAD>");
	echo("<body TEXT = \"#000000\" BGCOLOR = \"#EBEEF3\" LINK = \"#0000EE\" VLINK = \"#551A8B\" ALINK = \"#FF0000\"><DIV ALIGN = \"CENTER\"><br>\n");
	echo("<a href = \"http://www.viarural.com.ar\"><img src=\"logo-via-rural.gif\" alt=\"Logo\" border=\"0\"></a><br><br>");
	echo("<font face = \"Arial\">");
	echo("<b> Avisos Clasificados </b><BR><BR>");
	if(isset ($_GET["faltadato"]) && $_GET["faltadato"] == 1) {
		msj_error( "Faltan datos." );
	}
	if(isset ($_GET["mailinv"]) && $_GET["mailinv"] == 1) {
		msj_error( "Dirección de email incorrecta." );
	}
	if(isset ($_GET["indicadoringreso"])) {
		if ($_GET["indicadoringreso"] == 1) {
			encabezado ( "<font color = \"009500\">Ingreso exitoso.</font>" );
		}
		else if ($_GET["indicadoringreso"] == 2) {
			msj_error ( "El usuario ya existe." );
		}
	}
	if (!$_POST["choice"]) {
		encabezado ("Haga click m&aacute;s abajo para acceder a la base " . $databaseName);
		echo "<font face = \"arial\"><a href = \"search.php\" style = \"text-decoration:none;\">Mostrar listado de usuarios</a></font><br>\n";
		echo "<br>\n<font face = \"arial\"><a href = \"avisos.php\" style = \"text-decoration:none;\">Mostrar listado de avisos publicados</a></font><br>\n<br>\n";
		menu_principal();
		if (isset ($_GET['s']) && ctype_digit ("{$_GET['s']}") && $_GET['s'] == 1) echo "<font color = \"00923F\">Modificación de usuario exitosa</font><br>\n";
		else if (isset ($_GET['s']) && ctype_digit ("{$_GET['s']}") && $_GET['s'] == 2) echo "Modificación de precio exitosa<br>\n";
		$connection = mysql_connect ($hostName, $userName, $password);
		mysql_select_db ($databaseName_user, $connection);
		$resultado = mysql_query ('SELECT * FROM precios', $connection);
?>
<table width = "600" cellpadding = "6" cellspacing = "0">
	<tr>
		<td align = "center" valign = "center" colspan = "5"><font face = "arial">Tabla de avisos</font></td>
	</tr>
	<tr>
		<td align = "center"><font face = "arial">id</font></td>
		<td align = "center"><font face = "arial">precio ($)</font></td>
		<td align = "center"><font face = "arial">plazo (días)</font></td>
		<td align = "center"><font face = "arial">detalle</font></td>
		<td>&nbsp;</td>
	</tr>
<?php
		while ($objeto = mysql_fetch_object ($resultado)) {
			$identificador = $objeto -> id;
?>
<form action = "update.php?q=2&identificador=<?php echo $identificador; ?>" method = "post">
	<tr>
		<td><? echo $objeto -> id; ?></td>
		<td><input name = "precio" type = "text" value = "<? echo $objeto -> precio; ?>"></td>
		<td><input name = "plazo" type = "text" value = "<? echo $objeto -> plazo; ?>"></td>
		<td><input name = "detalle" type = "text" value = "<? echo $objeto -> detalle; ?>"></td>
		<td><input type = "submit" value = "Modificar"></td>
	</tr>
</form>
<?
		}
	mysql_free_result ($resultado);
?>
</table>
<?php
	}
	else if ($_POST["choice"] == "Buscar usuario") {
		encabezado ("Busque con los siguientes criterios:");
		formulario_usuario (0, "search.php", "BUSCAR");
	}
	else if ($_POST["choice"] == "Agregar usuario") {
		encabezado ("Especifique lo siguiente:");
		formulario_usuario (0, "add.php", "AGREGAR");
	}
	echo("</DIV></body>");
?>