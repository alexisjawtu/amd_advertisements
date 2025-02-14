<?php
	printf("<DIV ALIGN = \"CENTER\">");
	printf("<a href = \"index.php\"><img src=\"clasificados.gif\" alt=\"Maquinaria Agr&iacute;cola Usada\" border=\"0\"></a><br>");
	printf("</DIV>");
	function encabezado_ ($_mensaje_) {
		echo "<font face = \"arial\">".$_mensaje_."</font>";
		echo "<BR>";
	}
	function msj_error_ ($_mensaje_) {
		echo "<body bgcolor = \"#EBEEF3\"><blockquote><h3><font face = \"arial\" color = \"#cc0000\">".$_mensaje_."</font></h3></blockquote>\n</body>";
	}
?>