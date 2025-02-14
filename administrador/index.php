<?php
	echo ("<HEAD><TITLE> Avisos clasificados </TITLE> </HEAD>");
	echo "<body TEXT = \"#000000\" BGCOLOR = \"#EBEEF3\" LINK = \"#0000EE\" VLINK = \"#551A8B\" ALINK = \"#FF0000\">";
	echo "<DIV ALIGN = \"left\"><br>\n";
	echo "<font face = \"arial\">" . date("d/m/y") . "</font>";
	echo "<DIV ALIGN = \"CENTER\"><br>\n";
	echo("<a href = \"http://www.viarural.com.ar\"><img src=\"logo-via-rural.gif\" alt=\"Logo\" border=\"0\"></a><br><br>");
	echo("<font face = \"Arial\">");
	echo("<b> Avisos Clasificados </b><BR><BR>");
	require ("common.php");
	encabezado ("Datos de administrador");
	echo "<form action = \"login.php\" method = post>";
	echo "<table border = 1 bordercolor = white cellpadding = \"4\" cellspacing = \"0\" style = \"border-collapse: collapse\">
				<tr><td align = \"right\" style = \"border-left-style: solid; border-left-width: 1; border-right-style: none; border-right-width: medium; border-top-style: solid; border-top-width: 1; border-bottom-style: none; border-bottom-width: medium\">
						<font face = \"arial\">Nombre de usuario de administrador:</font></td>
					<td align = \"left\"><input type = text size = 25 name = id></td></tr>
				<tr><td align = \"right\"><font face = \"arial\">Contraseña de administrador:</font></td>	 
					<td align = \"left\"><input type = password size = 25 maxlength = 10 name = contr></td></tr>
				<tr><td align = \"right\">&nbsp;</td><td align = \"left\"><input type = \"submit\" value = \"Ingresar\"></td></tr></table></form>";
?>