<HEAD><style><!--a:hover{color: rgb(65,65,255)}--></style>
			<meta http-equiv = "content-type" content = "text/html; charset = iso-8859-1">
			<meta name = "KEYWORDS" content = "MAQUINARIA AGRICOLA USADA">
			<meta name = "DESCRIPTION" content = "MAQUINARIA AGRICOLA USADA">
			<TITLE>MAQUINARIA AGRICOLA USADA</TITLE>
</HEAD>
<body TEXT = "#000000" BGCOLOR = "#EBEEF3" LINK = "#0000C8" VLINK = "#0000C8" ALINK = "#C0C0C0">
<DIV ALIGN = "CENTER">
<table width = "92%">
	   <tr><td> </td>
	       <td align = "right"><font face = "arial">
								Nuevo usuario
							   </font>
		   </td>
	   </tr>
</table>
<?php
    echo("<a target = \"_top\" href = \"../avisos/index.php\"><img src=\"clasificados.gif\" alt=\"Maquinaria Agrícola Usada\" border=\"0\"></a><br>");
	require ('funciones.php');
	require ("vars.php");
	if (isset ($_GET["ie"]) && $_GET["ie"] == 101) { // ingreso exitoso
		$encabezado = "<table border = \"0\" bordercolor = \"#EBEEF3\" cellpadding = \"6\" cellspacing = \"0\">
					   <tr><td align = \"left\">Gracias por registrarse en Viarural.com<br><BR>
		               Si quiere hacernos alguna consulta escr&iacute;banos a anuncios@viarural.com<br>
					   incluyendo su nombre de usuario en el mensaje.<br><br>
					   Para cargar sus avisos puede ingresar a $miweb/usuarios,<br>
					   o bien a $webusuarios/avisos  y hacer click en <i>acceder</i>.<br><br>
					   <a href = \"http://$webusuarios/usuarios\" style = \"text-decoration:none;\">Ingrese sus avisos ahora.</a>
					   </td></tr>
					   </table>";
		encabezado_ ("<br>\n$encabezado<br>\n");
	}
	else {
		if(isset ($_GET["fd"])) $encabezado = "<i><font color=\"#d61018\">Faltan datos.</font></i>";
		else if (isset ($_GET["cd"])) $encabezado = "<i><font color=\"#d61018\">La contraseña reingresada fue distinta.</font></i>";
		else if (isset ($_GET["mi"])) $encabezado = "<i><font color=\"#d61018\">Ingrese una dirección de email válida por favor.</font></i>";
		else if (isset ($_GET["ii"])) $encabezado = "<i><font color=\"#d61018\">El usuario ya existe.</font></i>";
		else $encabezado = "Ingrese sus datos.";
		encabezado_ ("<br>\n$encabezado<br>\n");
		if(isset ($_GET["nom"])) $v1 = htmlspecialchars($_GET["nom"]);
		if(isset ($_GET["mail"])) $v2 = htmlspecialchars($_GET["mail"]);
		if(isset ($_GET["user"])) $v3 = htmlspecialchars($_GET["user"]);
?>
		<FORM METHOD = "get" ACTION = "addnug.php">
		<table>
			<tr><td align = "right"><font face = "arial">Nombre:</font></td>
				<td><INPUT TYPE = text SIZE = 35 NAME = nom value="<?php echo $v1; ?>"></td>
			</tr>
			<tr><td align = "right"><font face = "arial">Email:</font></td>
				<td><INPUT TYPE = text SIZE = 35 NAME = mail value="<?php echo $v2; ?>"></td>
			</tr>
			<tr><td align = "right"><font face = "arial">Usuario:</font></td>
				<td><INPUT TYPE = text SIZE = 35 NAME = user value="<?php echo $v3; ?>"></td>
			</tr>
			<tr><td align = "right"><font face = "arial">Contraseña:</font></td>
				<td><INPUT TYPE = password SIZE = 35 NAME = pass MAXLENGTH = 10></td>
			</tr>
			<tr><td align = "right"><font face = "arial">Reingrese la contraseña:</font></td>
				<td><INPUT TYPE = password SIZE = 35 NAME = pass2 MAXLENGTH = 10></td>
			</tr>
			<tr><td> </td><td align = "left"><INPUT TYPE = submit value="Enviar"></td></tr>
		</table>
		</FORM>
<?php
	}
	echo "<br>\n<a target = \"_top\" href = \"http://$miweb/\"><img src = \"logo-via-rural.gif\" border = \"0\" alt = \"maquinaria\"></a>";
	echo "</div></body>";
?>