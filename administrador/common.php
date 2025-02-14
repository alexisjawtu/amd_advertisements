<?php
	$_botones = array ("Buscar usuario", "Agregar usuario");
	
	function encabezado($mensaje) {
		echo "\n";
		echo $mensaje;
		echo "<BR>";
		echo "<BR>";
	}
	
	function menu_principal () {
		printf("<FORM METHOD = post ACTION = \"default.php\">");
		global $_botones;
		$i = 0;
		while ($_botones[$i]) {
			printf("<INPUT TYPE = \"submit\" NAME = \"choice\" VALUE = \"%s\">", $_botones[$i]);
			printf("&nbsp; &nbsp; &nbsp;");
			if ($_botones[$i + 1]) {
				printf("<INPUT TYPE = \"submit\" NAME = \"choice\" VALUE = \"%s\">", $_botones[$i + 1]);
				echo "<BR>";
			}
			$i += 2;
		}
		printf("</FORM>");
	}
				
	function msj_error ($message) {   
		printf("<BODY BGCOLOR = \"#EBEEF3\">");
		printf("<BLOCKQUOTE><H3><FONT COLOR = \"#CC0000\">%s</FONT></H3></BLOCKQUOTE>\n", $message);
		printf("</BODY>");
	}
	
	function formulario_usuario ($formValues, $actionScript, $submitLabel) {
		printf("<FORM METHOD = get ACTION = \"%s\"><DIV ALIGN = \"CENTER\">\n", $actionScript); 
?>
	<input type = "hidden" value = "1" name = "q">
	<table>
<?php
		printf("<tr><td align = \"right\">Nombre:</td>
				<td><INPUT TYPE = text SIZE = 35 NAME = nom VALUE = \"%s\">
				</td></tr>", ($formValues) ? $formValues["nom"] : "");  //los índices de este vector tienen que ser los mismos que en el vector argumento cada vez que se llame a esta función. 
		printf("<tr><td align = \"right\">Email:</td>
				<td><INPUT TYPE = text SIZE = 35 NAME = mail VALUE = \"%s\">
				</td></tr>", ($formValues) ? $formValues["mail"] : "");
		printf("<tr><td align = \"right\">Usuario:</td>
				<td><INPUT TYPE = text SIZE = 35 NAME = user VALUE = \"%s\">
				</td></tr>", ($formValues) ? $formValues["user"] : "");
		printf("<tr><td align = \"right\">Contraseña:</td>
				<td><INPUT TYPE = password SIZE = 35 NAME = pass MAXLENGTH = 10 VALUE = \"%s\">
				</td></tr>", ($formValues) ? $formValues["pass"] : "");
		printf("<tr><td align = \"right\">Clase de prioridad:</td>
				<td><INPUT TYPE = text SIZE = 5 NAME = class MAXLENGTH = 2 VALUE = \"%s\">
				</td></tr>", ($formValues) ? $formValues["class"] : "");
		printf("<tr><td align = \"right\">Cota:</td>
				<td><INPUT TYPE = text SIZE = 5 NAME = cota MAXLENGTH = 5 VALUE = \"%s\">
				</td></tr>", ($formValues) ? $formValues["cota"] : "");
		printf("<tr><td> </td><td align = \"left\"><INPUT TYPE = submit VALUE = \"%s\"></td></tr>", $submitLabel);
		printf("</table></DIV></FORM>");
	}
	
	function to_main()
	{
		printf("<div align = \"center\"><BR><FORM ACTION = \"default.php\" METHOD = post>\n");
		printf("<INPUT TYPE = submit VALUE = \"Click\"> <font face = \"arial\">para retornar a la p&aacute;gina principal</font></form>\n</div>");
	}
?>