<?php session_start (); ?>
<HEAD><style><!--a:hover{color: rgb(65,65,255)}--></style>
			<meta http-equiv = "content-type" content = "text/html; charset = iso-8859-1">
			<meta name = "KEYWORDS" content = "MAQUINARIA AGRICOLA USADA">
			<meta name = "DESCRIPTION" content = "MAQUINARIA AGRICOLA USADA">
			<TITLE>MAQUINARIA AGRICOLA USADA</TITLE>
</HEAD>
<body TEXT = "#000000" BGCOLOR = "#EBEEF3" LINK = "#0000C8" VLINK = "#0000C8" ALINK = "#C0C0C0">
<div align = "center">
<table width = "92%">
	   <tr><td align = "left"><font face = "arial"><?php echo date("d/m/y"); ?></font></td>
	       <td align = "right"><font face = "arial"><?php $usuarioactual = $_SESSION["cookie_1"];
		                                                  echo $usuarioactual . " | "; ?>
														  <a href = "action.php?choice=Ver" style = "text-decoration:none;">Inicio</a> | 
														  <a href = cerrarsesion.php style = "text-decoration: none;">Cerrar sesión</a></font>
														  </td>
	   </tr>
</table>
<a target = "_top" href = "../avisos/index.php"><img src="clasificados.gif" alt="Maquinaria Agrícola Usada" border="0"></a><br><br>
<?php
	require ('funciones.php');
	require ("vars.php");
	encabezado_ ("Imagen del aviso");
	if(!($link = mysql_pconnect($_host_, $_user_, $_clave_))) {
		//msj_error_(sprintf ("Error al conectar al host %s, por el usuario %s", $_host_, $_user_));
		exit();
	}
	if (!mysql_select_db($_sql_dban_, $link)) {
		//msj_error_(sprintf("Error al seleccionar la base %s", $_sql_dban_));
		//msj_error_(sprintf("error: %d %s", mysql_errno($link), mysql_error($link)));
		exit();
	}
	if (ctype_digit ("{$_GET['cod']}")) $cod = $_GET["cod"];
	$selectStmt = "SELECT archivo FROM ARCHIVOS where IDAVISO='$cod'";
	if (!($query = mysql_query($selectStmt, $link))) {
		//msj_error_(sprintf("Error al ejecutar la sentencia %s", $selectStmt));
		//msj_error_(sprintf("error: %d %s", mysql_errno($link), mysql_error($link)));
		exit();
	}
	while ($_archivos = mysql_fetch_assoc($query)) {
		echo("<br>\n<img src = \"../images/" . $_archivos['archivo'] . "\">");
		echo "<font face= \"arial\">";
		echo("<br><br>\nNombre Archivo: " . $_archivos['archivo']);
		echo("</font><br><br>");
	}
?>
<font face = "arial"><a href = "action.php?choice=Ver" style = "text-decoration:none;">Volver</a></font>
</br>
</div>
</body>