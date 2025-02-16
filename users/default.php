<?php session_start ();
	require ('funciones.php');
	require ("vars.php");
	if(!autenticar_usuario($_SESSION["cookie_1"], $_SESSION["cookie_2"])) {
		header("Location:index.php");
		exit();
	}
?>
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
		                                                  echo $usuarioactual." | "; ?><a href = "action.php?choice=Ver" style = "text-decoration: none;">Inicio</a><?php echo " | "; ?><a href = "cerrarsesion.php" style = "text-decoration: none;">Cerrar sesión</a></font></td>
	   </tr>
</table>
<a target = "_top" href = "../avisos/index.php"><img src="clasificados.gif" alt="Maquinaria Agrícola Usada" border="0"></a><br>
<?php
	encabezado_ ("<br><br>\nElija qué hacer.<br>\n");
	echo "<form action = \"action.php\" method = get>";
	echo "<table border = 1 bordercolor = red><tr><td align = \"right\"><font face = \"arial\">Cargar avisos:</font></td>
				     <td align = \"left\"><input style = \"width: 6em\" type = \"submit\" name = choice value = \"Cargar\"></td></tr>
				 <tr><td align = \"right\"><font face = \"arial\">Ver avisos propios:</font></td>	 
					 <td align = \"left\"><input style = \"width: 6em\" type = \"submit\" name = choice value = \"Ver\"></td></tr></table>
		  </form>";

	if(isset ($_GET["help"]) && $_GET["help"] == 1) {
		encabezado_ ("<br>\nPara solicitar ayuda complete el siguiente formulario:");
		echo "<form action = \"sendmail.php?tipo=1\" method = post>";
		echo "<table border = 1><tr><td align = \"right\"><font face = \"arial\">escriba su consulta:</font></td>
						<td align = \"left\"><textarea name = \"consulta\" rows = \"4\" cols = \"30\" ></textarea></td></tr>
					<tr><td align = \"right\"></td>	 
						<td align = \"left\"><input style = \"width: 6em\" type = \"submit\" name = cons value = \"Enviar\"></td></tr></table>
			</form>";
	}
?>
</div>
</body>