<?php
	function autenticar_usuario ($_nombre_, $_key_ingresada_) {
		global $_host_, $_user_, $_clave_, $_sql_dbcl_;
		if(!($_conexion_ = mysql_pconnect ($_host_, $_user_, $_clave_))) {
			//echo ("No hubo conexión al host ".$_host_."por el usuario ".$_user_);
			return 0;
		}
		if(!(mysql_select_db($_sql_dbcl_, $_conexion_))) {
			//echo ("No hubo selección de la base ".$_sql_dbcl_.". Error: ".mysql_errno($_conexion_).". ".mysql_error($_conexion_));
			return 0;
		}
		$_nombre_ = mysql_real_escape_string($_nombre_, $_conexion_);
		$_key_ingresada_ = mysql_real_escape_string($_key_ingresada_, $_conexion_);
		$_consulta_ = "select * from USUARIOS where USER='$_nombre_'";
		if(!($_respuesta_ = mysql_query ($_consulta_))) {
			//echo ("No hubo ejecución de la consulta ".$_consulta_.". Error: ".mysql_errno($_conexion_).". ".mysql_error($_conexion_));
			return 0;
		}
		$_row_ = mysql_fetch_array ($_respuesta_);
		if ($_row_ && $_key_ingresada_ == $_row_["PASS"]) {
			mysql_free_result ($_respuesta_);
			return 1;
		}
		else {
			mysql_free_result ($_respuesta_);
			return 0;
		}
	}
	
	function encabezado_ ($_mensaje_) {
		echo "\n<font face = \"arial\">" . $_mensaje_ . "</font><br>";
	}
	
	function msj_error_ ($_mensaje_) {
		echo "<body bgcolor = \"#EBEEF3\"><blockquote><h3><font face = \"arial\" color = \"#cc0000\">" . $_mensaje_ .
             "</font></h3></blockquote>\n</body>";
	}
	
	function tipo_aviso () {
		global $matriz_precios;
		encabezado_ ("<br><br>\n¿Qué tipo de aviso desea cargar?<br>\n");
		//$ php echo $matriz_precios[4][0]; &nbsp; $ echo $matriz_precios[5][0]; &nbsp; echo $matriz_precios[6][0]; &nbsp; 
?>
<table border="0" cellpadding="6" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width = "600">
    <tr>
      <td height="38"><font face="Arial"><nobr><a style = "text-decoration:none;" href = "action.php?choice=Cargar&class=10476737"><?php echo $matriz_precios[4][2]; ?></a></nobr></font></td>
      <td align="center" height="38"><font face="Arial"><a style = "text-decoration:none;" href = "action.php?choice=Cargar&class=10476737">(<?php echo $matriz_precios[4][1]; ?> días de publicación)</a></font></td>
      <td align="center" height="38">
      <a style = "text-decoration:none;" href = "action.php?choice=Cargar&class=10476737">
	  <img border="0" src="medallaoro.gif" width="24" height="32"></a></td>
    </tr>
    <tr>
      <td height="42"><font face="Arial"><nobr><a style = "text-decoration:none;" href = "action.php?choice=Cargar&class=30791"><?php echo $matriz_precios[5][2]; ?></a></nobr></font></td>
      <td align="center" height="42"><font face="Arial"><a style = "text-decoration:none;" href = "action.php?choice=Cargar&class=30791">(<?php echo $matriz_precios[5][1]; ?> días de publicación)</a></font></td>
      <td align="center" height="42">
	  <a style = "text-decoration:none;" href = "action.php?choice=Cargar&class=30791">
      <img border="0" src="medallaplata.gif" width="24" height="32"></a></td>
    </tr>
    <tr>
      <td height="32"><font face="Arial"><nobr><a style = "text-decoration:none;" href = "action.php?choice=Cargar&class=248347"><?php echo $matriz_precios[6][2]; ?></a></nobr></font></td>
      <td align="center" height="32"><font face="Arial"><a style = "text-decoration:none;" href = "action.php?choice=Cargar&class=248347">(<?php echo $matriz_precios[6][1]; ?> días de publicación)</a></font></td>
      <td align="center" height="32">
	  <a style = "text-decoration:none;" href = "action.php?choice=Cargar&class=248347">
      <img border="0" src="medallabronce.gif" width="24" height="32"></a></td>
    </tr>
</table>
<?php
	}
	
	function checkout ($precio_para_mostrar, $primary_key_aviso) {
?>
<table border="0" cellpadding="6" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="600" bgcolor="#EBEEF3">
    <tr>
      <td colspan="4" width="588">

<font face = "arial">Su aviso fue cargado exitosamente.
</font>

      </td>
    </tr>
    <tr>
      <td colspan="4" width="588">

<font face = "arial">El costo de su operación es de $ <? echo $precio_para_mostrar; ?>.</font></td>
    </tr>
    <tr>
      <td colspan="4" width="588">

<font face = "arial">El código de su operación es: <b><? echo $primary_key_aviso; ?></b>.</font></td>
    </tr>
    <tr>
      <td colspan="4" width="588">

<font face = "arial">Recuerde guardar este código o imprimirlo.</font></td>
    </tr>
    <tr>
      <td colspan="4" width="588">

<font face = "arial">Para hacer visible su aviso y comenzar ahora mismo a 
      recibir consultas deberá depositar el importe mencionado en la siguiente 
      cuenta:</font></td>
    </tr>
    <tr>
      <td width="13">&nbsp;</td>
      <td width="212">

<font face = "arial">Cuenta Banco Santander Río</font></td>
      <td width="338">

&nbsp;</td>
      <td width="13">&nbsp;</td>
    </tr>
    <tr>
      <td width="13">&nbsp;</td>
      <td width="212">

<font face = "arial">Titular</font></td>
      <td width="338">

<font face = "arial">ViaRural.com SA</font></td>
      <td width="13">&nbsp;</td>
    </tr>
    <tr>
      <td width="13">&nbsp;</td>
      <td width="212">

<font face = "arial">Número de Cuenta</font></td>
      <td width="338">

<font face = "arial">194-000099228</font></td>
      <td width="13">&nbsp;</td>
    </tr>
    <tr>
      <td width="13">&nbsp;</td>
      <td width="212">

<font face = "arial">CBU</font></td>
      <td width="338">

<font face = "arial">07201949 20000000992286</font></td>
      <td width="13">&nbsp;</td>
    </tr>
    <tr>
      <td width="13">&nbsp;</td>
      <td width="212">

<font face = "arial">Número de CUIT</font></td>
      <td width="338">

<font face = "arial">30-70842182-7</font></td>
      <td width="13">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4" width="588">

<font face = "arial">Después de esto envíenos un mail a <font color="#0000FF">anuncios@viarural.com</font> con el código de la operación, confirmando el depósito, y su aviso estará visible inmediatamente.</font></td>
    </tr>
    <tr>
      <td colspan="4" width="588">

<font face = "arial">Gracias por publicar en Viarural.</font></td>
    </tr>
  </table>
<?php
	}
	
	function campo_foto () {
		echo "<tr><td align = \"right\"><font face = \"arial\">Foto jpg:</font></td>
						<td align = \"left\"><INPUT type = \"file\" name = \"archivo\" size = \"20\"></td></tr>";
		echo "<tr><td align = \"right\"> </td><td align = \"left\">
						<font face = arial size = 1>Máximo 1 Mbyte</font></td></tr>";
	}
	
	function formulario_aviso_destacado () {
		global $mipais;
		echo "<br><br>\n<font face = \"arial\">Si desea consultar por avisos destacados y con foto complete el siguiente formulario.</font><br>";
		echo "<form action=\"sendmail.php?tipo=2\" method=\"post\">
			<input type=\"hidden\" value=\"Consulta Aviso destacado $mipais.\" name=\"subject\">
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
	}
	
	function encabezado_vista_usuario () {
?>
		<table width="600" id="table1" height="108">
	<tr>
		<td align="left" width="243" height="36">&nbsp;<span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium; "><span class="Apple-style-span" style="text-align: -webkit-center; ">&nbsp;</span></span></td>
		<td align="left" width="243" height="36">&nbsp;</td>
		<td align="left" width="104" rowspan="3" height="113">
		<span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: Times New Roman; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px">
		<span class="Apple-style-span" style="text-align: -webkit-center">
		<font face="Arial">
		<a href="http://ar.viarural.com/users/action.php?choice=Cargar"><img src="http://ar.viarural.com/users/cargar.gif"></a></font>
		</span></span></td>
	</tr>
	<tr>
		<td align="left" width="243" height="36">
<span class="Apple-style-span" 
      style="border-collapse: separate; 
	color: rgb(0, 0, 0); 
	font-family: Times New Roman; 
	font-style: normal; 
	font-variant: normal; 
	font-weight: normal; 
	letter-spacing: normal; 
	line-height: normal; 
	orphans: 2; 
	text-align: auto; 
	text-indent: 0px; 
	text-transform: none; 
	white-space: normal; 
	widows: 2; 
	word-spacing: 0px; 
	-webkit-border-horizontal-spacing: 0px; 
	-webkit-border-vertical-spacing: 0px; 
	-webkit-text-decorations-in-effect: none; 
	-webkit-text-size-adjust: auto; 
	-webkit-text-stroke-width: 0px">
		<span class="Apple-style-span" style="text-align: -webkit-center">
		<font face="Arial">Estos son sus avisos.</font></span></span></td>
		<td align="right" width="243" height="36">
		
		<span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: Times New Roman; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px">
		<span class="Apple-style-span" style="text-align: -webkit-center">
		</span></span></td>
	</tr>
	<tr>
		<td align="left" width="243" height="36">&nbsp;</td>
		<td align="left" width="243" height="36">&nbsp;</td>
	</tr>
</table>
<?php
	}
	
	function mostrar_avisos ($resource, $idusuario) {
		$medallas = array ("oro" => array ("<img src = \"medallaoro.gif\">", "-", "-"),
						   "plata" => array ("-", "<img src = \"medallaplata.gif\">", "-"),
						   "bronce" => array ("-", "-", "<img src = \"medallabronce.gif\">"));
?>
<table border width = "60%" bordercolor = "#d9dee8" cellpadding = "6" cellspacing = "0">
	<tr>
		<td align = "center"><font face = "arial" size = "2"> REGION </font></td>
		<td align = "center"><font face = "arial" size = "2"> MARCA </font></td>
		<td align = "center"><font face = "arial" size = "2"> RUBRO </font></td>
		<td align = "center"><font face = "arial" size = "2"> DESCRIPCION </font></td>
		<td align = "center"><font face = "arial" size = "2"> FECHA </font></td>
		<td align = "center" width = "40"><font face = "arial" size = "2">ID</font></td>
		<td align = "center" colspan = "3"><b><font face = "arial">Opciones</font></b></td>
		<td align = "center"><img src = "medallaoro.gif"></td>
		<td align = "center"><img src = "medallaplata.gif"></td>
		<td align = "center"><img src = "medallabronce.gif"></td>
	</tr>
<?
		while ($obj_ = mysql_fetch_object ($resource)) {
			if (strlen ($obj_ -> DESCRIPCION) > 41) {
				$string_desc = substr ($obj_ -> DESCRIPCION, 0, 38) . "...";
			} else $string_desc = $obj_ -> DESCRIPCION;
            echo "<tr>
					             <td align = \"left\"><font face = \"arial\" size = \"2\"><nobr>" . $obj_ -> REGION . 
					"</nobr></font></td><td align = \"left\"><font face = \"arial\" size = \"2\">" . $obj_ -> MARCA . 
					"</font></td><td align = \"left\"><font face = \"arial\" size = \"2\">" . $obj_ -> RUBRO .
					"</font></td><td align = \"left\"><font face = \"arial\" size = \"2\">" . $string_desc . 
					"</font></td><td align = \"left\"><font face = \"arial\" size = \"2\"><nobr>" . $obj_ -> DATE . 
					"</nobr></font></td><td align = \"left\"><font face = \"arial\" size = \"2\">" . $obj_ -> ID_AVISO . 
					"</font></td>
								 <td align = \"left\"><font face = \"arial\" size = \"2\"><A HREF = \"borrar.php?idusuario=$idusuario&pic=". $obj_ -> IMAGEN . "&rowid=" . $obj_ -> ID_AVISO . "\" style = \"text-decoration: none;\" onClick = \"return confirm('¿Desea borrar el aviso?')\">Borrar</A></font></td>
								 <td align = \"left\"><font face = \"arial\" size = \"2\"><A HREF = \"modificar.php?rowid=" . $obj_ -> ID_AVISO . "&region=" . $obj_ -> REGION . "&rubro=" . $obj_ -> RUBRO . "&marca=" . $obj_ -> MARCA . "&descripcion=" . $obj_ -> DESCRIPCION . "\" style = \"text-decoration: none;\">Modificar</A></font></td>";
			echo "<td align = \"left\"><font face = \"arial\" size = \"2\">";
			if ( $obj_ -> IMAGEN == 1 ) {
				$cod = $obj_ -> ID_AVISO;
				echo "<a href = \"imagenes.php?cod=$cod\" style = \"text-decoration: none;\"><img src = \"../camara.gif\"></a></font>";
			} else echo "<img src = \"sinfoto.gif\">";
			echo "</td>";
			$la_clase_del_aviso = $obj_ -> CLASE;
?>
<td align = "center"><? echo $medallas["oro"][$la_clase_del_aviso - 1]; ?></td>
<td align = "center"><? echo $medallas["plata"][$la_clase_del_aviso - 1]; ?></td>
<td align = "center"><? echo $medallas["bronce"][$la_clase_del_aviso - 1]; ?></td>
<?php
			echo "</tr>";
		}
		echo "</font></table>";
	}
	
	function paginado_de_avisos ($_pagi_navegacion, $_pagi_info) {
		if (isset($_pagi_navegacion)) echo "<br>\n" . $_pagi_navegacion;
		if (isset($_pagi_info))echo "<br><br>\n\n" . $_pagi_info . "<br><br>\n\n";
	}
?>
