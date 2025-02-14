<?php session_start ();
	require ("lib2.php");
	require ("vars.php");
	if(!autenticar_usuario($_SESSION["cookie_1"], $_SESSION["cookie_2"])) {
		header ("Location:index.php");
		exit ();
	}
?>
<html>
<HEAD><style type="text/css"><!--a:hover{color: rgb(65,65,255)}-->

.progress{
	width: 1px;
	height: 14px;
	color: white;
	font-size: 12px;
  overflow: hidden;
	background-color: navy;
	padding-left: 5px;
}

</style>

<script type="text/JavaScript" language="JavaScript">
function textCounter(field,counter,maxlimit,linecounter) {
	// text width//
	var fieldWidth =  parseInt(field.offsetWidth);
	var charcnt = field.value.length;        
	// trim the extra text
	if (charcnt > maxlimit) { 
		field.value = field.value.substring(0, maxlimit);
	}
	else { 
	// progress bar percentage
	var percentage = parseInt(100 - (( maxlimit - charcnt) * 100)/maxlimit) ;
	document.getElementById(counter).style.width =  parseInt((fieldWidth*percentage)/100)+"px";
	document.getElementById(counter).innerHTML="<font face = arial>Limit: "+percentage+"%</font>"
	// color correction on style from CCFFF -> CC0000
	setcolor(document.getElementById(counter),percentage,"background-color");
	}
}

function setcolor(obj,percentage,prop){
	obj.style[prop] = "rgb(80%,"+(100-percentage)+"%,"+(100-percentage)+"%)";
}
<!--
function validate() {
	var extensions = new Array("jpg","jpeg");
	var archivo = document.form.archivo.value;
	var image_length = document.form.archivo.value.length;
	if (image_length == 0) {
		return true;
	}
	var pos = archivo.lastIndexOf('.') + 1;
	var ext = archivo.substring(pos, image_length);
	var final_ext = ext.toLowerCase();
	for (i = 0; i < 2; i++) {
		if(extensions[i] == final_ext) {
			return true;
		}
	}
	alert("La imagen debe estar en alguno de los siguientes formatos: "+ extensions.join(', ') +".");
	return false;
}
</script>
			<meta http-equiv = "content-type" content = "text/html; charset = iso-8859-1">
			<meta name = "KEYWORDS" content = "MAQUINARIA AGRICOLA USADA">
			<meta name = "DESCRIPTION" content = "MAQUINARIA AGRICOLA USADA">
			<TITLE>MAQUINARIA AGRICOLA USADA</TITLE>
</HEAD>
<body TEXT = "#000000" BGCOLOR = "#EBEEF3" LINK = "#0000C8" VLINK = "#0000C8" ALINK = "#C0C0C0">
<div align = "center">
<table width = "92%">
	   <tr><td align = "left"><font face = "arial"><?php echo date("d/m/y"); ?></font></td>
	       <td align = "right"><font face = "arial"><?php $usactual = $_SESSION["cookie_1"];
		                                                  echo $usactual." | "; ?>
													<a href = cerrarsesion.php style = "text-decoration: none;">Cerrar sesión</a>
													<?php echo " | "; ?>
													<a href = default.php style = "text-decoration: none;">Opciones</a>
							   </font></td>
	   </tr>
</table>
<?php
    echo("<a target = \"_top\" href = \"../avisos/index.php\"><img src=\"clasificados.gif\" alt=\"Maquinaria Agrícola Usada\" border=\"0\"></a><br>");
	require ("lib.php");
	$enlace = mysql_pconnect($_host_, $_user_, $_clave_);
	if(!$enlace) {
		//msj_error_ ("No me conecté.");
		return;
	}
	$int = mysql_select_db ($_sql_dbcl_, $enlace);
	if (!$int) {
		//msj_error_ ("No seleccioné la base.");
		return;
	}
	// buscar clase y cota
	$qry_buscar_clase = "SELECT * FROM USUARIOS WHERE USER='".$_SESSION["cookie_1"]."'";
	$res_cons = mysql_query ($qry_buscar_clase, $enlace);
	if(!$res_cons) {
		//msj_error_ ("Error al ejecutar la sentencia ".$res_cons);
		//msj_error_ ("Error: ".mysql_errno($enlace)." ".mysql_error($enlace));
		exit();
	}
	$obj_ = mysql_fetch_array ($res_cons);
	$clase = $obj_["CLASE"];
	$cota = $obj_["COTA"];
	$idusuario = $obj_["ROWID"];
	if ($_GET["choice"] == "Cargar") {
		if ($cota < 1) {
			encabezado_ ("<br><br>\nSu capacidad para publicar avisos está colmada.");
			echo ("<BR><FORM ACTION = \"default.php\" METHOD = post>\n");
			echo ("<INPUT TYPE = submit VALUE = \"Click\"><font face = \"arial\"> para retornar a las opciones </font></FORM>");
		}
		else if ($cota >= 1) {
			encabezado_ ("<br><br>\nCargue los datos del aviso.<br>\nRecuerde que las fotos deben estar
			en fomato <b>.jpg</b><br>\n<br>\nSerán dados de baja los usuarios que publiquen dirección 
			de email, teléfono o sitio web.<br>\n");
			$tabla = "AVISOS";
			echo "<FORM name = \"form\" enctype = \"multipart/form-data\" METHOD = post ACTION = \"agregar.php?tabla=$tabla&clase=$clase&idusuario=$idusuario\" onSubmit = \"return validate();\">"; 
			echo "<table><tr><td align = \"right\"><font face = \"arial\">País:</font></td>
							<td align = \"left\"><font face = \"arial\">$mipais</font></td></tr>";
			$iterador_ = 0;
			echo "<tr><td align = \"right\"><font face = \"arial\">Región:</font></td>
				<td align = \"left\"><select name = \"region\">";
			while ($regiones[$iterador_]) {
				echo "<option value = \"".$regiones[$iterador_]."\">".$regiones[$iterador_]."</option>";
				$iterador_ ++;
			}
			echo "</select></td></tr>";
			$_iterador_ = 0;
			echo "<tr><td align = \"right\"><font face = \"arial\">Marca:</font></td>
				<td align = \"left\"><select name = \"marca\">";
			while ($marcas_[$_iterador_]) {
				echo "<option value = \"".$marcas_[$_iterador_]."\">".$marcas_[$_iterador_]."</option>";
				$_iterador_ ++;
			}
			echo "<option selected value = \"otra\">otra</option></select></td></tr>";
			$_index_ = 0;
			echo "<tr><td align = \"right\"><font face = \"arial\">Rubro:</font></td>
					<td align = \"left\"><select name = \"rubro\">";
			while ($rubros_[$_index_]) {
                echo "<option value = \"".$rubros_[$_index_]."\">".$rubros_[$_index_]."</option>";
				$_index_ ++;
			}
			echo "<option selected value = \"otro\">otro</option></select></td></tr>";
			echo "<tr><td align = \"right\"><font face = \"arial\">Descripción:</font></td>
					<td align =\"left\">";
?>
					<textarea rows="4" cols="53" name="descrip" id="maxcharfield" 
						onKeyDown="textCounter(this,'progressbar1',255)" 
						onKeyUp="textCounter(this,'progressbar1',255)" 
						onFocus="textCounter(this,'progressbar1',255)" ></textarea><br>
					<div id="progressbar1" class="progress"></div>
					<script>textCounter(document.getElementById("maxcharfield"),"progressbar1",255)</script>
				</td></tr>
<?php
			if($clase == 1) {
				echo "<tr><td align = \"right\"><font face = \"arial\">Foto jpg:</font></td>
						<td align = \"left\"><INPUT type = \"file\" name = \"archivo\" size = \"20\"></td></tr>";
				echo "<tr><td align = \"right\"> </td><td align = \"left\">
						<font face = arial size = 1>Máximo 1 Mbyte</font></td></tr>";
			}
			echo "<tr><td align = \"right\"> </td><td align = \"left\"><INPUT TYPE = \"submit\" name=\"submit\" VALUE= \"cargar\"> 
					</td></tr></table></FORM>";
		}
	}
	else if ($_GET["choice"] == "Ver") {
		encabezado_ ("<br><br>\nEstos son sus avisos<br>");
		$__enlace__ = mysql_pconnect($_host_, $_user_, $_clave_);
		if(!$__enlace__) {
			//msj_error_ ("No me conecté.");
			return;
		}
		$int = mysql_select_db ($_sql_dban_, $__enlace__);
		if (!$int) {
			//msj_error_ ("No seleccioné la base.");
			return;
		}
		$_pagi_cuantos = 20;
		$_pagi_mostrar_errores = false;
		$_pagi_nav_num_enlaces = 15;
		$_pagi_sql = "SELECT * FROM AVISOS WHERE USER='".$_SESSION["cookie_1"]."' ORDER BY ID_AVISO";
		include ("paginado.php");
		if ($clase == 1) $col_span = 3;
		else $col_span = 2;
		echo "<table border width = \"60%\" bordercolor = \"#d9dee8\" cellpadding = \"6\" cellspacing = \"0\">";
		echo "<tr>
				<td align = \"center\"><font face = \"arial\" size = \"2\"> REGION </font></td>
				<td align = \"center\"><font face = \"arial\" size = \"2\"> MARCA </font></td>
				<td align = \"center\"><font face = \"arial\" size = \"2\"> RUBRO </font></td>
				<td align = \"center\"><font face = \"arial\" size = \"2\"> DESCRIPCION </font></td>
				<td align = \"center\"><font face = \"arial\" size = \"2\"> FECHA </font></td>
				<td align = \"center\"><font face = \"arial\" size = \"2\"> ID AVISO </font></td>
				<TD colspan = \"$col_span\" align = \"center\"><B><font face = \"arial\">Opciones</font></B></TD>";
		echo "</tr>";
		while ($obj_ = mysql_fetch_object ($_pagi_result)) {
            echo "<tr>
					             <td align = \"left\"><font face = \"arial\" size = \"2\"><nobr>" . $obj_ -> REGION . 
					"</nobr></font></td><td align = \"left\"><font face = \"arial\" size = \"2\">" . $obj_ -> MARCA . 
					"</font></td><td align = \"left\"><font face = \"arial\" size = \"2\">" . $obj_ -> RUBRO .
					"</font></td><td align = \"left\"><font face = \"arial\" size = \"2\">" . $obj_ -> DESCRIPCION . 
					"</font></td><td align = \"left\"><font face = \"arial\" size = \"2\"><nobr>" . $obj_ -> DATE . 
					"</nobr></font></td><td align = \"left\"><font face = \"arial\" size = \"2\">" . $obj_ -> ID_AVISO . 
					"</font></td>
								 <td align = \"left\"><font face = \"arial\" size = \"2\"><A HREF = \"borrar.php?idusuario=$idusuario&pic=". $obj_ -> FOTO . "&rowid=" . $obj_ -> ID_AVISO . "\" style = \"text-decoration: none;\" onClick = \"return confirm('¿Desea borrar el aviso?')\">Borrar</A></font></td>
								 <td align = \"left\"><font face = \"arial\" size = \"2\"><A HREF = \"modificar.php?pic=". $obj_ -> FOTO . "&rowid=" . $obj_ -> ID_AVISO . "&region=" . $obj_ -> REGION . "&rubro=" . $obj_ -> RUBRO . "&marca=" . $obj_ -> MARCA . "&descripcion=" . $obj_ -> DESCRIPCION . "\" style = \"text-decoration: none;\">Modificar</A></font></td>";
			if ($clase == 1) {
				echo "<td width = \"20%\" align = \"left\"><font face = \"arial\" size = \"2\">";
				if ( $obj_ -> FOTO == "SI" ) {
					$cod = $obj_ -> ID_AVISO;
					echo "<a href = \"imagenes.php?cod=$cod\" style = \"text-decoration: none;\">Ver imagen</a></font>";
				}
				echo "</td>";
			}
			echo "</tr>";
		}
		echo "</font></table>";
		if (isset($_pagi_navegacion)) echo "<br>\n" . $_pagi_navegacion;
		if (isset($_pagi_info))echo "<br><br>\n\n" . $_pagi_info . "<br><br>\n\n";
		if ($clase != 1) {
			echo "<br><br>\n<font face = \"arial\">Si desea consultar por avisos destacados y con foto complete el siguiente formulario.</font><br>";
			echo "<form action=\"mailindex.php\" method=\"post\">
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
		}
		echo "<BR><FORM ACTION = \"default.php\" METHOD = post>
											<INPUT TYPE = submit VALUE = \"Click\"> <font face = \"arial\">para retornar a las opciones</font> 
										</FORM></div>";
	}
?>
</body>
</html>