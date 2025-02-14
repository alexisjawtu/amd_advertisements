<?php
    ini_set("display_errors", "off");
	/*function msj_error_ ($_mensaje_) {
		echo "<body bgcolor = \"#EBEEF3\"><blockquote><h3><font face = \"arial\" color = \"#cc0000\">".
				$_mensaje_."</font></h3></blockquote>\n</body>";
	}*/
	require ("var.php");
	if(!($mylink = mysql_pconnect($_host_, $_user_, $_clave_)))	{
		//msj_error_(sprintf ("Error al conectar al host %s, por el usuario %s", $_host_, $_user_));
		exit();
	}
	if (!mysql_select_db($_sql_dban_, $mylink)) {
		//msj_error_(sprintf("Error al seleccionar la base %s", $_sql_dban_));
		//msj_error_(sprintf("error: %d %s", mysql_errno($mylink), mysql_error($mylink)));
		exit();
	}
	if (ctype_digit("{$_GET['rowid']}")) $rowid = $_GET["rowid"];
	if ($_GET['p'] == 1) $miconsulta = "SELECT * FROM AVISOS INNER JOIN ARCHIVOS ON AVISOS.ID_AVISO = ARCHIVOS.IDAVISO WHERE ID_AVISO = '$rowid'";
	else if ($_GET['p'] == 2) $miconsulta = "SELECT * FROM AVISOS WHERE ID_AVISO = '$rowid'";	
	$resu = mysql_query ($miconsulta, $mylink);
	if(!$resu) {
		//msj_error_ ("Error al ejecutar la sentencia ".$miconsulta);
		//msj_error_ ("Error: ".mysql_errno($mylink)." ".mysql_error($mylink));
		exit();
	}
	$obj_cons = mysql_fetch_object ($resu);
	$region = $obj_cons -> REGION;
	$marca = $obj_cons -> MARCA;
	$rubro = $obj_cons -> RUBRO;
	$descripcion = $obj_cons -> DESCRIPCION;
	$fecha = $obj_cons -> DATE;
	$aux = split ("-", $fecha);
	$fecha = $aux[2] . "-" . $aux[1] . "-" . $aux[0];
	$fecha_aux = substr ($fecha, 0, 6);
	$fecha = $fecha_aux . substr ($fecha, 8, 2);
	$anunciante = $obj_cons -> USER;
	$archivo = $obj_cons -> archivo;
	//título
	if ($marca == "otra") $marca_tit = "OTRAS MARCAS";
	else $marca_tit = strtoupper ($marca);
	if ($rubro == "otro") $rubro_tit = "OTROS RUBROS";
	else $rubro_tit = strtoupper ($rubro);
	$descripcion_tit = strtoupper ($descripcion);
	$region_tit = strtoupper ($region);
	echo "<HEAD><style><!--a:hover{color: rgb(65,65,255)}--></style>
		<meta name = \"KEYWORDS\" content = \"$rubro_tit $marca_tit $region_tit\">
		<meta name = \"DESCRIPTION\" content = \"$rubro_tit $marca_tit $region_tit $descripcion_tit\">
		<meta http-equiv = \"content-type\" content = \"text/html; charset = iso-8859-1\">
		<TITLE>" . $rubro_tit . " " . $marca_tit . " " . $descripcion_tit . "</TITLE>		 
		</HEAD>";
	echo "<BODY TEXT = \"#000000\" BGCOLOR = \"#EBEEF3\" LINK = \"#0000C8\" VLINK = \"#0000C8\"
		ALINK = \"#C0C0C0\">\n";
	//logo
	echo "<DIV ALIGN = \"CENTER\">";
	echo "<a href = \"index.php\"><img src=\"clasificados.gif\" alt=\"Maquinaria Agr&iacute;cola Usada\" border=\"0\"></a><br>";
	echo "<br><font face = \"arial\" size = \"+2\" color = \"#435470\">$rubro_tit" . " " . "$marca_tit</font>";
	echo "<BR>";
	// si $marca o $rubro o $descripcion están inicializadas, muestro lo que haya
	if ($marca || $rubro || $descripcion) {
		//aviso consultado
		echo "<br>\n<table border width = \"600\" bordercolor = \"#d9dee8\" cellpadding = \"6\" cellspacing = \"0\">";
		echo "<tr>
				<td align = \"center\"><font face = \"arial\" size = \"2\"> RUBRO </font></td>
				<td align = \"center\"><font face = \"arial\" size = \"2\"> MARCA </font></td>
				<td align = \"center\"><font face = \"arial\" size = \"2\"> REGION </font></td>
				<td align = \"center\"><font face = \"arial\" size = \"2\"> DESCRIPCION </font></td>
				<td align = \"center\"><font face = \"arial\" size = \"2\"> FECHA </font></td>";
		echo "</tr>";
		echo "<tr>        <td align = \"left\"><font face = \"arial\" size = \"2\">
<a style=\"text-decoration:none;\" href=\"http://$webusuarios/avisos/listar.php?accion=RUBRO&eleccion=$rubro\">" . $rubro . "</a>" .
			"</font></td><td align = \"left\"><font face = \"arial\" size = \"2\">
<a style=\"text-decoration:none;\" href=\"http://$webusuarios/avisos/listar.php?accion=MARCA&eleccion=$marca\">" . $marca . "</a>" . 
			"</font></td><td align = \"left\"><font face = \"arial\" size = \"2\"><nobr>" . $region . 
			"</nobr></font></td><td align = \"left\"><font face = \"arial\" size = \"2\">" . $descripcion . 
			"</font></td><td align = \"left\"><font face = \"arial\" size = \"2\"><nobr>" . $fecha . 
			"</nobr></font></td></tr></table>";
		//foto
		if ($obj_cons -> CLASE == 1 && $obj_cons -> IMAGEN == 1) {			
			echo "<br>\n";
			echo "<table border = \"1\" bordercolor = \"#d9dee8\" cellpadding = \"6\" cellspacing = \"0\">";
			echo "<tr><td><img alt = \"$rubro_tit" . " " . "$marca_tit\" 
			src = \"../images/$archivo\"></td></tr></table>";			
		}
		echo "<br><br>\n";
		echo "<table border = \"0\" width = \"600\"><tr><td align = \"center\"><font face = \"arial\" size = \"2\"> 
				Para consultar por el producto publicado complete el siguiente formulario </font></td></tr></table><br>";
		$elhost = $_SERVER["REMOTE_HOST"];
		$elagent = $_SERVER["HTTP_USER_AGENT"];
		$info = $elhost . ", " . $elagent;
		echo "<form action=\"sendmail.php?m=1&rowid=" . rawurlencode($rowid) . "&region=" . rawurlencode($region) . "&marca=" . rawurlencode($marca) .
			 "&rubro=" . rawurlencode($rubro) . "&descripcion=" . rawurlencode($descripcion) . "&fecha=" . rawurlencode($fecha) . "\" method=\"post\">
			<input type=\"hidden\" value=\"Consulta aviso $rubro_tit $marca_tit Aviso $rowid\" name=\"subject\">
			<input type=\"hidden\" value=\"$anunciante\" name=\"anunc\">
			<div align=\"center\">
			<div align=\"center\">
				<table height=\"65\" cellSpacing=\"0\" cellPadding=\"0\" width=\"590\" border=\"0\">
				<tr>
					<td width=\"563\" height=\"33\" colspan=\"4\">
					<p align=\"center\"><font face=\"Arial\" size=\"2\">Nombre y Apellido 
					o Razón Social:</font> <font face=\"Arial\" size=\"2\">
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
					<input type=hidden name=\"env_report\" value=\"$info\">
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
	}
	// si $marca y $rubro y $descripcion no están inicializadas, no muestro nada
	else if (!$marca && !$rubro && !$descripcion) {
?>
<div align = "center">
	<table>
		<tr>
			<td align = "left"><font face = "arial">La máquina que usted está buscando<br>
													fue vendida por Viarural.<br>
													Consulte más maquinaria haciendo click 
												<a style = "text-decoration:none; "href = "index.php">aquí</a>.
							   </font>
			</td>
		</tr>
	</table>
<?php
	}
?>
	<br>
	<font face = "arial" face = "2"><a href = "index.php" style = "text-decoration:none;"> Maquinaria Agr&iacute;cola Usada </a></font>
	<br>
	<br>
<font face = "arial" size = "2">
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
	echo "<br>\n<a target = \"_top\" href = \"http://$miweb/\"><img src = \"logo-via-rural.gif\" border = \"0\" alt = \"maquinaria\"></a>";
	echo "<br><br>\n";
?>
	</center>
</div>
</body>