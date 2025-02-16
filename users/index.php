<HEAD><style><!--a:hover{color: rgb(65,65,255)}--></style>
			<meta http-equiv = "content-type" content = "text/html; charset = iso-8859-1">
			<meta name = "KEYWORDS" content = "MAQUINARIA AGRICOLA USADA">
			<meta name = "DESCRIPTION" content = "MAQUINARIA AGRICOLA USADA">
			<TITLE>MAQUINARIA AGRICOLA USADA</TITLE>
</HEAD>
<body TEXT = "#000000" BGCOLOR = "#EBEEF3" LINK = "#0000C8" VLINK = "#0000C8" ALINK = "#C0C0C0">
<?php
	echo "<div align = \"center\">";
	echo "<table width = \"92%\"><tr><td align = \"left\"><font face = \"arial\">" . date("d/m/y") . "</font></td><td>&nbsp;</td></tr></table>";
    echo("<a target = \"_top\" href = \"../avisos/index.php\"><img src=\"clasificados.gif\" alt=\"Maquinaria Agrícola Usada\" border=\"0\"></a><br>");
    require ('funciones.php');
	encabezado_ ("<br>\n");
	echo "<table width = \"92%\"><tr><td align = \"left\" valign = \"top\"><font face = \"arial\">Para cargar un nuevo aviso ingrese a su cuenta y haga click en <b>cargar</b>.<br><br>\n
	                                                                             Para ver sus avisos publicados ingrese a su cuenta y haga click en <b>ver</b>.<br><br>\n
																				 Una vez cargado un aviso, podrá también modificarlo o borrarlo.<br><br>\n
																				 No olvide cerrar su sesión y el explorador luego de usar su cuenta.<br><br>\n
																				 Si tiene alguna consulta puede hacer click en <b>ayuda</b> al acceder a su cuenta.</font></td>";
	echo "<td align = \"center\" valign = \"top\"><font face = \"arial\">Ingrese su nombre de usuario y contraseña</font>";
	echo "<form action = \"login.php\" method = post>";
	echo "<table border = 1 bordercolor = white cellpadding = \"4\" cellspacing = \"0\" style = \"border-collapse: collapse\">
				<tr><td align = \"right\" style = \"border-left-style: solid; border-left-width: 1; border-right-style: none; border-right-width: medium; border-top-style: solid; border-top-width: 1; border-bottom-style: none; border-bottom-width: medium\">
						<font face = \"arial\">Nombre de usuario:</font></td>
					<td align = \"left\"><input type = text size = 25 name = id></td></tr>
				<tr><td align = \"right\"><font face = \"arial\">Contraseña:</font></td>	 
					<td align = \"left\"><input type = password size = 25 maxlength = 10 name = contr></td></tr>
				<tr><td align = \"right\">&nbsp;</td><td align = \"left\"><input type = \"submit\" value = \"Ingresar\"></td></tr></table></form>
				</td></tr></table></div>";
?>
</body>