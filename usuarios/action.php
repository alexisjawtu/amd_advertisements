<?php session_start ();
	require ('funciones.php');
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

a img {border:0}

</style>

<script type="text/JavaScript" language="JavaScript">
function textCounter(field,counter,maxlimit,linecounter) {
	// ancho de texto
	var fieldWidth =  parseInt(field.offsetWidth);
	var charcnt = field.value.length;        
	// recortar el texto extra
	if (charcnt > maxlimit) { 
		field.value = field.value.substring(0, maxlimit);
	}
	else { 
	// porcentaje de la barra de progreso 
	var percentage = parseInt(100 - (( maxlimit - charcnt) * 100)/maxlimit) ;
	document.getElementById(counter).style.width =  parseInt((fieldWidth*percentage)/100)+"px";
	document.getElementById(counter).innerHTML="<font face = arial>Limit: "+percentage+"%</font>"
	// corrección de color en style de CCFFF -> CC0000
	setcolor(document.getElementById(counter),percentage,"background-color");
	}
}
function setcolor(obj,percentage,prop){
	obj.style[prop] = "rgb(80%,"+(100-percentage)+"%,"+(100-percentage)+"%)";
}
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
</head>
<body TEXT = "#000000" BGCOLOR = "#EBEEF3" LINK = "#0000C8" VLINK = "#0000C8" ALINK = "#C0C0C0">
<div align = "center">
<table width = "92%">
	   <tr><td align = "left"><font face = "arial"><?php echo date("d/m/y"); ?></font></td>
	       <td align = "right"><font face = "arial"><?php $usactual = $_SESSION["cookie_1"];
		                                                  echo $usactual." | "; ?>
													<a href = default.php style = "text-decoration: none;">Opciones</a> | 
													<a href = default.php?help=1 style = "text-decoration: none;">Ayuda</a> | 
													<a href = cerrarsesion.php style = "text-decoration: none;">Cerrar sesión</a>
							   </font></td>
	   </tr>
</table>
<?php
    echo "<a target = \"_top\" href = \"../avisos/index.php\"><img src=\"clasificados.gif\" alt=\"Maquinaria Agrícola Usada\"></a><br>";
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
	mysql_free_result ($res_cons);
	
	/////////////   ¿con la nueva modalidad se retira lo referente a la cota?
	
	$cota = $obj_["COTA"];
	
	////////////
	
	$idusuario = $obj_["ROWID"];
	if ($_GET["choice"] == "Cargar") {
		if ($cota < 1) {
			encabezado_ ("<br><br>\nSu capacidad para publicar avisos está colmada.");
			echo ("<BR><FORM ACTION = \"default.php\" METHOD = post>\n");
			echo ("<INPUT TYPE = submit VALUE = \"Click\"><font face = \"arial\"> para retornar a las opciones </font></FORM>");
		}
		else if ($cota >= 1) {
			mysql_select_db ($_sql_dban_, $enlace);
			$resprecios = mysql_query ("select * from precios", $enlace);
			while ($precios = mysql_fetch_object ($resprecios)) {
				$matriz_precios [$precios -> id] = array ($precios -> precio, $precios -> plazo, $precios -> detalle);
			}
			if ($_GET['class'] != 10476737 && $_GET['class'] != 30791 && $_GET['class'] != 248347) {
				tipo_aviso ();
			} else {
				$clase = $array_clases_avisos[$_GET['class']];
				encabezado_ ("<br><br>\nCargue los datos del aviso.<br>\nRecuerde que las fotos deben estar
				en fomato <b>.jpg</b><br>\n<br>\nSerán dados de baja los usuarios que publiquen dirección 
				de email, teléfono o sitio web.<br>\n");
				$tabla = "AVISOS";
				echo "<form name = \"form\" enctype = \"multipart/form-data\" METHOD = post 
						action = \"agregar.php?clase=$clase&idusuario=$idusuario\" onSubmit = \"return validate();\">"; 
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
				if ($clase == 1) {
					campo_foto ();
				}
			echo "<tr><td align = \"right\"> </td><td align = \"left\"><INPUT TYPE = \"submit\" name=\"submit\" VALUE= \"Publicar\"> 
					</td></tr></table></form>";
			}
		}
?>
<br>
<a href = "action.php?choice=Ver" style = "text-decoration:none;"><font face = "arial">Inicio</font></a>
<?php
	} else if ($_GET["choice"] == "Ver") {
		encabezado_vista_usuario ();
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
		mostrar_avisos ($_pagi_result, $idusuario);
		paginado_de_avisos ($_pagi_navegacion, $_pagi_info);
?>
<font face = "arial"><a href="http://ar.viarural.com/usuarios/action.php?choice=Cargar"><img src="http://ar.viarural.com/usuarios/cargar.gif"></a></font>
<?php
		if ($clase != 1) {
			formulario_aviso_destacado ();
			}
	}
?>
</body>
</html>