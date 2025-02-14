<?php
	echo "<font face = \"arial\">" . date("d/m/y") . "</font>";
	require("common.php");
	echo ("<HEAD><TITLE> Avisos clasificados </TITLE> </HEAD>");
	echo("<body TEXT = \"#000000\" BGCOLOR = \"#EBEEF3\" LINK = \"#0000EE\" VLINK = \"#551A8B\" ALINK = \"#FF0000\"><DIV ALIGN = \"CENTER\"><br>\n");
	echo("<a href = \"http://www.viarural.com.ar\"><img src=\"logo-via-rural.gif\" alt=\"Logo\" border=\"0\"></a><br><br>");
	echo("<font face = \"Arial\">");
	echo("<b> Avisos Clasificados </b><BR><BR>");
	msj_error ("Algún dato ingresado es incorrecto.");
	echo "<A href = \"index.php\" style = \"text-decoration: none;\"><font face = \"arial\">Página principal</font></A>";
?>