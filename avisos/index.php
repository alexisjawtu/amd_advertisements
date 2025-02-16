<HEAD><style><!--a:hover{color: rgb(65,65,255)}--></style> 
		<meta http-equiv = "content-type" content = "text/html; charset = iso-8859-1">
		<meta name = "KEYWORDS" content = "CLASIFICADOS DE MAQUINARIA AGRICOLA USADA TRACTORES
										   COSECHADORAS SEMBRADORAS DESMALEZADORAS MIXERS TOLVAS">
		<meta name = "DESCRIPTION" content = "CLASIFICADOS DE MAQUINARIA AGRICOLA USADA TRACTORES
											  COSECHADORAS SEMBRADORAS DESMALEZADORAS MIXERS TOLVAS">
		<TITLE>CLASIFICADOS DE MAQUINARIA AGRICOLA USADA TRACTORES
			   COSECHADORAS SEMBRADORAS DESMALEZADORAS MIXERS TOLVAS</TITLE>
</HEAD>
<?PHP echo "<BODY TEXT = \"#000000\" BGCOLOR = \"#EBEEF3\" LINK = \"#0000C8\" VLINK = \"#0000C8\" ALINK = \"#C0C0C0\">\n"; ?>
<div align = "center">
<table width = "92%">
	   <tr><td> </td>
	       <td align = "right"><font face = "arial">
				<a target = "_top" href = "../users/index.php" style = "text-decoration: none;">Acceder</a>
							   </font>
		   </td>
	   </tr>
</table>
<?php
	require ("lib.php");
	require ("var.php");
	echo "<br/>\n<a href = \"http://www.rbauction.com/spanish_site/index.jsp\"><img src = \"ritchie.gif\" alt=\"Ritchie Bros\" border=\"0\" width = \"400\"></a><br/>";
	encabezado_ ("<br>\n<a href = \"../users/nug.php\" style = \"text-decoration:none;\">Publique gratis sus avisos
				 clasificados en Viarural.</a><br>\n"); // nug = "nuevo usuario gratis"
	$__link_r = mysql_connect($_host_, $_user_, $_clave_);
	if(!$__link_r ) {
		//msj_error_ ("No me conecté.");
		return;
	}
	$ent = mysql_select_db ($_sql_dban_, $__link_r );
	if (!$ent) {
		//msj_error_ ("No seleccioné la base.");
		return;
	}
	$qry_rubro = "SELECT RUBRO, MARCA, REGION, ID_AVISO, IMAGEN, pagado FROM AVISOS where pagado = '1' or CLASE = '3'"; //"SELECT RUBRO, MARCA, REGION, ID_AVISO, IMAGEN, pagado FROM AVISOS";
	$res_ = mysql_query ($qry_rubro, $__link_r );
	if(!$res_) {
		//msj_error_ ("Error al ejecutar la sentencia ".$qry_rubro);
		//msj_error_ ("Error: ".mysql_errno($__link_r)." ".mysql_error($__link_r ));
		exit();
	}
	if (mysql_num_rows ($res_) >= 1) {
		//selecciono las tres columnas del index
		while ($columnas = mysql_fetch_assoc ($res_)) {
			if (1 == $columnas[pagado]) {
				$rubropagado[] = array ($columnas[RUBRO], $columnas[ID_AVISO]);
				$regionpagado[] = array ($columnas[REGION], $columnas[ID_AVISO]);
				$marcapagado[] = array ($columnas[MARCA], $columnas[ID_AVISO]);
				$imagenpagado[$columnas[ID_AVISO]] = $columnas[IMAGEN];
			} else {
				$rubro[] = array ($columnas[RUBRO], $columnas[ID_AVISO]);
				$region[] = array ($columnas[REGION], $columnas[ID_AVISO]);
				$marca[] = array ($columnas[MARCA], $columnas[ID_AVISO]);
				$imagen[$columnas[ID_AVISO]] = $columnas[IMAGEN];
			}
		}
		mysql_free_result ($res_);
		sort ($rubropagado);
		sort ($regionpagado);
		sort ($marcapagado);
		sort ($rubro);
		sort ($region);
		sort ($marca);
?>
<font face = "arial" color = "#00923F">Avisos Destacados</font>
</br>
</br>
<table width = "600" border bordercolor = "#00923F" cellpadding = "6" cellspacing = "0">
	<tr><td align = "center"><font face = "arial" size = "2"> RUBROS </font></td>
		<td align = "center"><font face = "arial" size = "2"> MARCAS </font></td>
		<td align = "center"><font face = "arial" size = "2"> REGIONES </font></td>
	</tr>
	<tr><td align = "left" valign = "top"><font face = "arial" size = "2">
<?php
		//listo rubros no vacíos
		$int = 0;
		$cant = 1;
		while ($rubropagado [$int + 1]) {
			if ($rubropagado [$int][0] != $rubropagado [$int + 1][0]) {
				if ($cant == 1) echo "<a style = \"text-decoration:none;\" href = \"consultar.php?p=" . $imagenpagado [$rubropagado [$int][1]] . "&rowid=" . 
									$rubropagado [$int][1] . "\">" . $rubropagado [$int][0] . "<a/> <font color = \"#B9C4D7\">1</font><br>\n";
				else echo "<a style = \"text-decoration:none;\" href = \"listar.php?destac=1&accion=RUBRO&eleccion=" . rawurlencode($rubropagado [$int][0])
							. "\">" . $rubropagado [$int][0] . "<a/> <font color = \"#B9C4D7\">" . $cant . "</font><br>\n";
				$int ++;
				$cant = 1;
			}
			else {
				$cant ++;
				$int ++;
			}
		}
		if ($rubropagado[$int][0] == "otro") $rub = "otros";
		else $rub = $rubropagado[$int][0];
		if ($cant == 1) echo "<a style = \"text-decoration:none;\" href = \"consultar.php?p=" . $imagenpagado [$rubropagado [$int][1]] . "&rowid=" . $rubropagado[$int][1]
								. "\">" . $rub . "</a> <font color = \"#B9C4D7\">1</font>";
		else echo "<a style = \"text-decoration:none;\" href = \"listar.php?destac=1&accion=RUBRO&eleccion=" .
					rawurlencode($rubropagado[$int][0]) . "\">" . $rub . "</a> <font color = \"#B9C4D7\">" . $cant . "</font>";
		echo "</td>";
		//listo marcas no vacías
		$ent = 0;
		$cant_ = 1;
		echo "<td align = \"left\" valign = \"top\"><font face = \"arial\" size = \"2\">";
		while ($marcapagado [$ent + 1]) {
			if ($marcapagado [$ent][0] != $marcapagado [$ent + 1][0]) {
				if ($cant_ == 1) echo "<a style = \"text-decoration:none;\" href = \"consultar.php?p=" . $imagenpagado [$marcapagado [$ent][1]] . "&rowid=" . $marcapagado[$ent][1] . "\">"
									  . $marcapagado [$ent][0] . "</a> <font color = \"#B9C4D7\">1</font><br>\n";
				else echo "<a style = \"text-decoration:none;\" href = \"listar.php?destac=1&accion=MARCA&eleccion=" . rawurlencode($marcapagado[$ent][0]) .
							"\">" . $marcapagado [$ent][0] . "</a> <font color = \"#B9C4D7\">" . $cant_ . "</font><br>\n";
				$ent ++;
				$cant_ = 1;
			}
			else {
				$cant_ ++;
				$ent ++;
			}
		}
		if ($marcapagado[$ent][0] == "otra") $mar = "otras"; //aquí $ent debería valer count($marca) - 1
		else $mar = $marcapagado[$ent][0];
		if ($cant_ == 1) echo "<a style = \"text-decoration:none;\" href = \"consultar.php?p=" . $imagenpagado [$marcapagado [$ent][1]] . "&rowid=" . $marcapagado[$ent][1] .
								"\">" . $mar . "</a> <font color = \"#B9C4D7\">1</font>";
		else echo "<a style = \"text-decoration:none;\" href = \"listar.php?destac=1&accion=MARCA&eleccion=" . rawurlencode($marcapagado[$ent][0]) .
					"\">" . $mar . "</a> <font color = \"#B9C4D7\">" . $cant_ . "</font>";
		echo "</td>";
		//listo regiones no vacías
		$n = 0;
		$_cant_ = 1;
		echo "<td align = \"left\" valign = \"top\"><font face = \"arial\" size = \"2\">";
		while ($regionpagado [$n + 1]) {
			if ($regionpagado [$n][0] != $regionpagado [$n + 1][0]) {
				if ($_cant_ == 1) echo "<a style = \"text-decoration:none;\" href = \"consultar.php?p=" . $imagenpagado [$regionpagado [$n][1]] . "&rowid=" . $regionpagado[$n][1] .
										"\">" . $regionpagado [$n][0] . "</a> <font color = \"#B9C4D7\">1</font><br>\n";
				else echo "<a style = \"text-decoration:none;\" href = \"listar.php?destac=1&accion=REGION&eleccion=" . rawurlencode($regionpagado[$n][0]) .
							"\">" . $regionpagado [$n][0] . "</a> <font color = \"#B9C4D7\">" . $_cant_ . "</font><br>\n";
				$n ++;
				$_cant_ = 1;
			}
			else {
				$_cant_ ++;
				$n ++;
			}
		}
		if ($_cant_ == 1) echo "<a style = \"text-decoration:none;\" href = \"consultar.php?p=" . $imagenpagado [$regionpagado [$n][1]] . "&rowid=" . $regionpagado[$n][1] . "\">" . $regionpagado[$n][0] .
								"</a> <font color = \"#B9C4D7\">1</font>"; // aquí $n debería valer count($region) - 1
		else echo "<a style = \"text-decoration:none;\" href = \"listar.php?destac=1&accion=REGION&eleccion=" . rawurlencode($regionpagado[$n][0]) . "\">" . $regionpagado[$n][0] .
					"</a> <font color = \"#B9C4D7\">" . $_cant_ . "</font>"; // aquí $n debería valer count($region) - 1
		echo "</td>";
		echo "</tr></table>";	
?>
</br>
<font face = "arial" color = "#000099">Avisos Comunes</font>
</br>
</br>
<table width = "600" border bordercolor = "#d9dee8" cellpadding = "6" cellspacing = "0">
	<tr><td align = "center"><font face = "arial" size = "2"> RUBROS </font></td>
		<td align = "center"><font face = "arial" size = "2"> MARCAS </font></td>
		<td align = "center"><font face = "arial" size = "2"> REGIONES </font></td>
	</tr>
	<tr><td align = "left" valign = "top"><font face = "arial" size = "2">
<?php
		//listo rubros no vacíos
		$int = 0;
		$cant = 1;
		while ($rubro [$int + 1]) {
			if ($rubro [$int][0] != $rubro [$int + 1][0]) {
				if ($cant == 1) echo "<a style = \"text-decoration:none;\" href = \"consultar.php?p=" . $imagen [$rubro [$int][1]] . "&rowid=" . 
									$rubro [$int][1] . "\">" . $rubro [$int][0] . "<a/> <font color = \"#B9C4D7\">1</font><br>\n";
				else echo "<a style = \"text-decoration:none;\" href = \"listar.php?accion=RUBRO&eleccion=" . rawurlencode($rubro [$int][0])
							. "\">" . $rubro [$int][0] . "<a/> <font color = \"#B9C4D7\">" . $cant . "</font><br>\n";
				$int ++;
				$cant = 1;
			}
			else {
				$cant ++;
				$int ++;
			}
		}
		if ($rubro[$int][0] == "otro") $rub = "otros";
		else $rub = $rubro[$int][0];
		if ($cant == 1) echo "<a style = \"text-decoration:none;\" href = \"consultar.php?p=" . $imagen [$rubro [$int][1]] . "&rowid=" . $rubro[$int][1]
								. "\">" . $rub . "</a> <font color = \"#B9C4D7\">1</font>";
		else echo "<a style = \"text-decoration:none;\" href = \"listar.php?accion=RUBRO&eleccion=" .
					rawurlencode($rubro[$int][0]) . "\">" . $rub . "</a> <font color = \"#B9C4D7\">" . $cant . "</font>";
		echo "</td>";
		//listo marcas no vacías
		$ent = 0;
		$cant_ = 1;
		echo "<td align = \"left\" valign = \"top\"><font face = \"arial\" size = \"2\">";
		while ($marca [$ent + 1]) {
			if ($marca [$ent][0] != $marca [$ent + 1][0]) {
				if ($cant_ == 1) echo "<a style = \"text-decoration:none;\" href = \"consultar.php?p=" . $imagen [$marca [$ent][1]] . "&rowid=" . $marca[$ent][1] . "\">"
									  . $marca [$ent][0] . "</a> <font color = \"#B9C4D7\">1</font><br>\n";
				else echo "<a style = \"text-decoration:none;\" href = \"listar.php?accion=MARCA&eleccion=" . rawurlencode($marca[$ent][0]) .
							"\">" . $marca [$ent][0] . "</a> <font color = \"#B9C4D7\">" . $cant_ . "</font><br>\n";
				$ent ++;
				$cant_ = 1;
			}
			else {
				$cant_ ++;
				$ent ++;
			}
		}
		if ($marca[$ent][0] == "otra") $mar = "otras"; //aquí $ent debería valer count($marca) - 1
		else $mar = $marca[$ent][0];
		if ($cant_ == 1) echo "<a style = \"text-decoration:none;\" href = \"consultar.php?p=" . $imagen [$marca [$ent][1]] . "&rowid=" . $marca[$ent][1] .
								"\">" . $mar . "</a> <font color = \"#B9C4D7\">1</font>";
		else echo "<a style = \"text-decoration:none;\" href = \"listar.php?accion=MARCA&eleccion=" . rawurlencode($marca[$ent][0]) .
					"\">" . $mar . "</a> <font color = \"#B9C4D7\">" . $cant_ . "</font>";
		echo "</td>";
		//listo regiones no vacías
		$n = 0;
		$_cant_ = 1;
		echo "<td align = \"left\" valign = \"top\"><font face = \"arial\" size = \"2\">";
		while ($region [$n + 1]) {
			if ($region [$n][0] != $region [$n + 1][0]) {
				if ($_cant_ == 1) echo "<a style = \"text-decoration:none;\" href = \"consultar.php?p=" . $imagen [$region [$n][1]] . "&rowid=" . $region[$n][1] .
										"\">" . $region [$n][0] . "</a> <font color = \"#B9C4D7\">1</font><br>\n";
				else echo "<a style = \"text-decoration:none;\" href = \"listar.php?accion=REGION&eleccion=" . rawurlencode($region[$n][0]) .
							"\">" . $region [$n][0] . "</a> <font color = \"#B9C4D7\">" . $_cant_ . "</font><br>\n";
				$n ++;
				$_cant_ = 1;
			}
			else {
				$_cant_ ++;
				$n ++;
			}
		}
		if ($_cant_ == 1) echo "<a style = \"text-decoration:none;\" href = \"consultar.php?p=" . $imagen [$region [$n][1]] . "&rowid=" . $region[$n][1] . "\">" . $region[$n][0] .
								"</a> <font color = \"#B9C4D7\">1</font>"; // aquí $n debería valer count($region) - 1
		else echo "<a style = \"text-decoration:none;\" href = \"listar.php?accion=REGION&eleccion=" . rawurlencode($region[$n][0]) . "\">" . $region[$n][0] .
					"</a> <font color = \"#B9C4D7\">" . $_cant_ . "</font>"; // aquí $n debería valer count($region) - 1
		echo "</td>";
		echo "</tr></table>";
	}
	else if (mysql_num_rows ($res_) < 1) {
		echo "<br>\n";
		echo "<table border = \"0\" width = \"60%\"><tr><td align = \"center\"><font face = \"arial\" size = \"2\"> 
				Aún no hay avisos publicados </font></td></tr></table><br>";
	}
	echo "<br>\n";
	echo "<br>\n";
?>
<font face = "arial" size = "2">
<a href = "http://www.viarural.com.ar/viarural.com.ar/insumosagropecuarios/agricolas/cubiertas/default.htm" style = "text-decoration:none;">
	Neumáticos para maquinaria</a>
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
<?php
	echo "<br>\n";
	echo "<br>\n";
	echo "<table border = \"0\" width = \"600\"><tr><td align = \"center\"><font face = \"arial\" size = \"2\">
	Para publicar avisos destacados de maquinaria usada complete el siguiente formulario</font></td></tr></table><br>";
	echo "<form action=\"sendmail.php?m=2\" method=\"post\">
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
	echo "<br>\n<a target = \"_top\" href = \"http://$miweb/\"><img src = \"logo-via-rural.gif\" border = \"0\" alt = \"maquinaria\"></a>";
	echo "</div></body>";
?>
