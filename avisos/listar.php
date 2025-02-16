<?php
    ini_set("display_errors", "off");
	function msj_error_ ($_mensaje_) {
		echo "<body bgcolor = \"#EBEEF3\"><blockquote><h3><font face = \"arial\" color = \"#cc0000\">".$_mensaje_.
			 "</font></h3></blockquote>\n</body>";
	}
	require ("var.php");
	$__link__ = mysql_pconnect($_host_, $_user_, $_clave_);
	if(!$__link__ ) {
		//msj_error_ ("No me conecté.");
		return;
	}
	$ent = mysql_select_db ($_sql_dban_, $__link__ );
	if (!$ent) {
		//msj_error_ ("No seleccioné la base.");
		return;
	}
	if (isset ($_GET['pg'])) {
		if (ctype_digit("{$_GET['pg']}")) {
			$nro_pagina = "página " . $_GET['pg'];
		}
	}
	else $nro_pagina = "página 1";
	$accion = mysql_real_escape_string($_GET["accion"], $__link__);
	$eleccion = mysql_real_escape_string($_GET["eleccion"], $__link__);
	$eleccionmay = strtoupper ($eleccion);
 	$orden = "DATE DESC";
	if (isset($_GET["orden"]))  $orden = mysql_real_escape_string($_GET["orden"], $__link__);	
	if ($orden == "DATE") $orden = "DATE DESC";
	if ($accion == "USER") {
		$name = mysql_real_escape_string($_GET["name"], $__link__);
  		$name = strtoupper ($name);
		echo "<HEAD><style><!--a:hover{color: rgb(65,65,255)}--></style> 
				<meta http-equiv = \"content-type\" content = \"text/html; charset = iso-8859-1\">
				<meta name = \"KEYWORDS\" content = \"$name $nro_pagina\">
				<meta name = \"DESCRIPTION\" content = \"$name $nro_pagina\">
				<TITLE>$name MAQUINARIA AGRICOLA USADA $nro_pagina</TITLE>
			</HEAD>";
		echo "<BR>";
		$stringmayuscula = "<font face = \"arial\" size = \"+2\" color = \"#435470\"><nobr>$name</nobr></font>
							<br><font face = \"arial\" color = \"#435470\">$nro_pagina</font>";
	}
	else {
		if ($eleccionmay == "OTRA") $eleccionmay = "OTRAS MARCAS";
		if ($eleccionmay == "OTRO") $eleccionmay = "OTROS RUBROS";
		echo "<HEAD><style><!--a:hover{color: rgb(65,65,255)}--></style> 
				<meta name = \"KEYWORDS\" content = \"$eleccionmay $nro_pagina\">
				<meta name = \"DESCRIPTION\" content = \"$eleccionmay $nro_pagina\">
				<meta http-equiv = \"content-type\" content = \"text/html; charset = iso-8859-1\">
				<TITLE>$eleccionmay MAQUINARIA AGRICOLA USADA $nro_pagina</TITLE>
			</HEAD>";
		echo "<BR>";
		$stringmayuscula = "<font face = \"arial\" size = \"+2\" color = \"#435470\"><nobr>$eleccionmay</nobr></font>
							<br><font face = \"arial\" color = \"#435470\">$nro_pagina</font>";
	}
	
	echo "<BODY TEXT = \"#000000\" BGCOLOR = \"#EBEEF3\" LINK = \"#0000C8\" VLINK = \"#0000C8\" 
		  ALINK = \"#C0C0C0\">\n";
	printf("<DIV ALIGN = \"CENTER\">");
?>
<table width = "92%">
	   <tr><td> </td>
	       <td align = "right"><font face = "arial">
				<a target = "_top" href = "../users/index.php" style = "text-decoration: none;">Acceder</a>
							   </font>
		   </td>
	   </tr>
</table>
<?PHP
	printf("<a href = \"index.php\"><img src=\"clasificados.gif\" alt=\"Maquinaria Agr&iacute;cola Usada\" 
			border=\"0\"></a><br>");
	echo "<BR>" . $stringmayuscula . "<BR>\n<br>\n";
	if (1 == $_GET ['destac']) $_pagi_sql = "SELECT * FROM AVISOS WHERE $accion='$eleccion' and pagado = '1' ORDER BY CLASE, IMAGEN, $orden";
	else $_pagi_sql = "SELECT * FROM AVISOS WHERE $accion='$eleccion' and ( pagado = '1' or CLASE  = '3' ) ORDER BY CLASE, IMAGEN, $orden";
	$_pagi_cuantos = 15;
	$_pagi_mostrar_errores = false;
	$_pagi_nav_num_enlaces = 15;
	include ("paginado.php");
	echo "<table border width = \"600\" bordercolor = \"#d9dee8\" cellpadding = \"6\" cellspacing = \"0\">";
	echo "<tr>
			<td align = \"center\" bgcolor = \"" . ($orden == "RUBRO" ? "#F7D89E" : "#F5C15F") . "\"><font face = \"arial\" size = \"2\">
				<A HREF = \"listar.php?accion=$accion&eleccion=$eleccion&orden=RUBRO&destac=" . $_GET ['destac'] . "\" 
				style = \"text-decoration: none;\"> RUBRO </A></font></td>
			<td align = \"center\" bgcolor = \"" . ($orden == "MARCA" ? "#F7D89E" : "#F5C15F") . "\"><font face = \"arial\" size = \"2\">
				<A HREF = \"listar.php?accion=$accion&eleccion=$eleccion&orden=MARCA&destac=" . $_GET ['destac'] . "\" 
				style = \"text-decoration: none;\"> MARCA </A></font></td>
			<td align = \"center\" bgcolor = \"" . ($orden == "REGION" ? "#F7D89E" : "#F5C15F") . "\"><font face = \"arial\" size = \"2\">
				<A HREF = \"listar.php?accion=$accion&eleccion=$eleccion&orden=REGION&destac=" . $_GET ['destac'] . "\" 
				style = \"text-decoration: none;\"> REGION </A></font></td>
			<td align = \"center\" bgcolor = \"#F5C15F\"><font face = \"arial\" size = \"2\"> DESCRIPCION </font></td>
			<td align = \"center\" bgcolor = \"" . ($orden == "DATE DESC" ? "#F7D89E" : "#F5C15F") . "\"><font face = \"arial\" size = \"2\">
				<A HREF = \"listar.php?accion=$accion&eleccion=$eleccion&orden=DATE&destac=" . $_GET ['destac'] . "\" 
				style = \"text-decoration: none;\"> FECHA </A></font></td>
			<td align = \"center\" bgcolor = \"#F5C15F\"><img src = \"camara.gif\" border = \"0\" alt = \"maquinaria\"></td>";
	echo "</tr>";
	$indice_paridad_color = 0;
	$vector_colores = array (1 => array ("#EBCC1A", "#EBCC5C"),
							 2 => array ("#EDF2FA", "#EDF2F1"),
							 3 => array ("#EBEEF3", "#EBEEF8"));
	$vector_cadenas_malas = array (' - ', 'á', 'é', 'í', 'ó', 'ú', 'ü', 'ñ', ' ');
	$vector_cadenas_buenas = array ('-', 'a', 'e', 'i', 'o', 'u', 'u ', 'n', '-');		
	while ($obj_lista = mysql_fetch_object ($_pagi_result)) {
		$paridad_color = $indice_paridad_color % 2;
		$la_clase_del_aviso = $obj_lista -> CLASE;
		$fecha = $obj_lista -> DATE;
		$string_nombre_foto = "../images/miniaturas/" . $obj_lista -> ID_AVISO . "-" . str_replace($vector_cadenas_malas, $vector_cadenas_buenas, strtolower(trim($obj_lista -> RUBRO))) . "-" . str_replace($vector_cadenas_malas, $vector_cadenas_buenas, strtolower(trim($obj_lista -> MARCA))) . ".jpg";
		$aux = split ("-", $fecha);
		$fecha = $aux[2] . "-" . $aux[1] . "-" . $aux[0];
		$fecha_aux = substr ($fecha, 0, 6);
		$fecha = $fecha_aux . substr ($fecha, 8, 2);
		$string_descrip_abreviada = $obj_lista -> DESCRIPCION;
		if (strlen ($string_descrip_abreviada) > 80) $string_descrip_abreviada = substr ($string_descrip_abreviada, 0, 77) . "...";
		echo "<tr>
				<td align = \"left\" bgcolor =\"" . $vector_colores[$la_clase_del_aviso][$paridad_color] . "\"><font face = \"arial\" size = \"2\">
					<A HREF = \"consultar.php?p=". $obj_lista -> IMAGEN . "&rowid=" . $obj_lista -> ID_AVISO . 
					"\" style = \"text-decoration: none;\">" . $obj_lista -> RUBRO . "</A></font></td>
				<td align = \"left\" bgcolor =\"" . $vector_colores[$la_clase_del_aviso][$paridad_color] . "\"><font face = \"arial\" size = \"2\">
					<A HREF = \"consultar.php?p=". $obj_lista -> IMAGEN . "&rowid=" . $obj_lista -> ID_AVISO . 
					"\" style = \"text-decoration: none;\">" . $obj_lista -> MARCA . "</A></font></td>
				<td align = \"left\" bgcolor =\"" . $vector_colores[$la_clase_del_aviso][$paridad_color] . "\"><font face = \"arial\" size = \"2\">
					<A HREF = \"consultar.php?p=". $obj_lista -> IMAGEN . "&rowid=" . $obj_lista -> ID_AVISO .
					"\" style = \"text-decoration: none;\"><nobr>" . $obj_lista -> REGION .	"</nobr></A></font></td>
				<td align = \"left\" bgcolor =\"" . $vector_colores[$la_clase_del_aviso][$paridad_color] . "\"><font face = \"arial\" size = \"2\">
					<A HREF = \"consultar.php?p=". $obj_lista -> IMAGEN . "&rowid=" . $obj_lista -> ID_AVISO .
					"\" style = \"text-decoration: none;\">" . $string_descrip_abreviada . "</A></font></td>
				<td align = \"left\" bgcolor =\"" . $vector_colores[$la_clase_del_aviso][$paridad_color] . "\"><font face = \"arial\" size = \"2\">
					<A HREF = \"consultar.php?p=". $obj_lista -> IMAGEN . "&rowid=" . $obj_lista -> ID_AVISO .
					"\" style = \"text-decoration: none;\"><nobr>" . $fecha . "</nobr></A></font></td>";
		echo "<td align = \"center\" bgcolor =\"" . $vector_colores[$la_clase_del_aviso][$paridad_color] . "\"><A HREF = \"consultar.php?p=". $obj_lista -> IMAGEN . 
				"&rowid=" . $obj_lista -> ID_AVISO . "\" style = \"text-decoration: none;\">
				<img src = \"" . (($obj_lista -> CLASE == 1 && $obj_lista -> IMAGEN == 1) ? $string_nombre_foto : "sinfoto.gif") . "\" border = \"0\" alt = \"" . $obj_lista -> RUBRO . " " . $obj_lista -> MARCA . "\"></A></td>";
		echo "</tr>";
		$indice_paridad_color ++;
	}
	echo "</table>";
	echo "<br>\n";
	if (isset($_pagi_navegacion)) echo "\n" . $_pagi_navegacion;
	if (isset($_pagi_info)) echo "<br><br>\n\n" . $_pagi_info . "<br><br>\n\n";
?>
<font face = "arial" size = "2">
<?php
	if ($accion == "RUBRO" && $eleccion != "otro") {
?>
<a style = "text-decoration:none;" href = "<?php echo $links ["$eleccion"]; ?>"><?php echo $eleccion; ?> en Argentina</a>
<br>
<br>
<?
	}
?>
<a href = "http://www.viarural.com.ar/viarural.com.ar/insumosagropecuarios/agricolas/cubiertas/default.htm" style = "text-decoration:none;">
	Neumáticos para maquinaria</a>
<br>
<br>
<a href = "http://www.viarural.com.ar/viarural.com.ar/insumosagropecuarios/agricolas/cubiertas/bridgestone/default.htm" style = "text-decoration:none;">
Bridgestone Firestone</a> |
<a href = "http://www.viarural.com.ar/viarural.com.ar/insumosagropecuarios/agricolas/cubiertas/fate/default.htm" style = "text-decoration:none;">
Fate</a> |
<a href = "http://www.viarural.com.ar/viarural.com.ar/insumosagropecuarios/agricolas/cubiertas/galaxy/default.htm" style = "text-decoration:none;">
Galaxy</a> |
<a href = "http://www.viarural.com.ar/viarural.com.ar/insumosagropecuarios/agricolas/cubiertas/goodyear/default.htm" style = "text-decoration:none;">
Goodyear</a> |
<a href = "http://www.viarural.com.ar/viarural.com.ar/insumosagropecuarios/agricolas/cubiertas/pirelli/default.htm" style = "text-decoration:none;">
Pirelli</a>
</font>
<br>
<br>
<?php
	//formulario ofreciendo contacto
	echo "<table border = \"0\" width = \"600\"><tr><td align = \"center\"><font face = \"arial\" size = \"2\">
	Para publicar maquinaria usada complete el siguiente formulario</font></td></tr></table><br>";
	echo "<form action=\"sendmail.php?m=3\" method=\"post\">
        <input type=\"hidden\" value=\"Consulta desde $mipais\" name=\"subject\">
        <div align=\"center\">
          <div align=\"center\">
            <table height=\"65\" cellSpacing=\"0\" cellPadding=\"0\" width=\"590\" border=\"0\">
              <tr>
                <td width=\"563\" height=\"33\" colspan=\"4\">
                <p align=\"center\"><font face=\"Arial\" size=\"2\">Nombre completo o Razón Social:</font> <font face=\"Arial\" size=\"2\">
                <input style=\"FONT-SIZE: 10pt; FONT-FAMILY: Arial\" size=\"38\" name=\"nombre\"></font></td>
              </tr>
              <tr>
                <td width=\"82\" height=\"32\"><font face=\"Arial\" size=\"2\">&nbsp; 
                Email:</font></td>
                <td width=\"201\" height=\"32\"><font face=\"Arial\" size=\"2\">
                <input style=\"FONT-SIZE: 10pt; FONT-FAMILY: Arial\" size=\"32\" name=\"mail\"></font></td>
                <td width=\"72\" height=\"32\"><font face=\"Arial\" size=\"2\">&nbsp; 
                Teléfono:</font></td>
                <td width=\"208\" height=\"32\"><font face=\"Arial\" size=\"2\">
                <input style=\"FONT-SIZE: 10pt; FONT-FAMILY: Arial\" size=\"32\" name=\"telefono\"></font></td>
              </tr>
              <tr>
                <td width=\"82\" height=\"32\"><font face=\"Arial\" size=\"2\">&nbsp; 
                Ciudad:</font></td>
                <td width=\"201\" height=\"32\"><font face=\"Arial\" size=\"2\">
                <input style=\"FONT-SIZE: 10pt; FONT-FAMILY: Arial\" size=\"32\" name=\"ciudad\"></font></td>
                <td width=\"72\" height=\"32\"><font face=\"Arial\" size=\"2\">&nbsp; 
                País:</font></td>
                <td width=\"208\" height=\"32\"><font face=\"Arial\" size=\"2\">
                <input style=\"FONT-SIZE: 10pt; FONT-FAMILY: Arial\" size=\"32\" value=\"$mipais\" name=\"pais\"></font></td>
              </tr>
            </table>
          </div>
        </div>
        <div align=\"center\">
          <div align=\"center\">
            <table height=\"163\" cellSpacing=\"0\" cellPadding=\"6\" width=\"590\" border=\"0\">
              <tr>
                <td valign=\"top\" width=\"105\" height=\"1\">
                <font face=\"Arial\" size=\"2\">Comentarios:&nbsp;</font></td>
                <td width=\"467\" height=\"1\"><font face=\"Arial\" size=\"2\">
                <textarea name=\"Comentarios\" rows=\"4\" cols=\"53\"></textarea></font></td>
              </tr>
              <tr>
                <td width=\"105\" height=\"1\"></td>
                <td width=\"467\" height=\"1\">
                <p align=\"right\"><font face=\"Arial\" size=\"2\">
                <input type=\"submit\" value=\"Enviar\"></font></td>
              </tr>
            </table>
          </div>
        </div>
      </form>";
	echo "<a target = \"_top\" href = \"http://$miweb/\">
			<img src = \"logo-via-rural.gif\" border = \"0\" alt = \"maquinaria\"></a>";
?>
	</center>
</div>
</body>
