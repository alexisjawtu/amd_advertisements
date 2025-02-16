<?php
	session_start ();
	require ("vars.php");
	require ('funciones.php');
	if(!autenticar_usuario($_SESSION["cookie_1"], $_SESSION["cookie_2"])) {
		header ("Location:index.php");
		exit ();
	}
	$la_clase_del_aviso = $_GET['clase'];
	function large_size ($ancho, $alto) {
		$rate = $alto / $ancho;
		if ($ancho > 450) {
			$ancho = 450;
			$alto = 450 * $rate;
		}
		if ($alto > 400) {
			$alto = 400;
			$ancho = 400 / $rate;
		}
		$resultado = array ($ancho, $alto);
		return $resultado;
	}
	function thumb_size ($ancho, $alto) {
		$rate = $alto / $ancho;
		if ($ancho > 100) {
			$ancho = 100;
			$alto = 100 * $rate;
		}
		if ($alto > 75) {
			$alto = 75;
			$ancho = 75 / $rate;
		}
		$resultado = array ($ancho, $alto);
		return $resultado;
	}
?>
<HEAD><style><!--a:hover{color: rgb(65,65,255)}--></style> 
			<meta http-equiv = "content-type" content = "text/html; charset = iso-8859-1">
			<meta name = "KEYWORDS" content = "MAQUINARIA AGRICOLA USADA">
			<meta name = "DESCRIPTION" content = "MAQUINARIA AGRICOLA USADA">
			<TITLE>MAQUINARIA AGRICOLA USADA</TITLE>
</HEAD>
<body text = "#000000" BGCOLOR = "#EBEEF3" LINK = "#0000C8" VLINK = "#0000C8" ALINK = "#C0C0C0">
<div align = "center">
<table width = "92%">
	   <tr><td align = "left"><font face = "arial"><?php echo date("d/m/y"); ?></font></td>
	       <td align = "right"><font face = "arial"><?php $usuarioactual = $_SESSION["cookie_1"];
		                                                  echo $usuarioactual." | "; ?>
														  <a href = cerrarsesion.php style = "text-decoration: none;">Cerrar sesión</a>
														  <?php echo " | "; ?>
														  <a href = default.php style = "text-decoration: none;">Opciones</a>
														  </font></td>
	   </tr>
</table>
<a target = "_top" href = "../avisos/index.php"><img src="clasificados.gif" alt="Maquinaria Agrícola Usada" border="0"></a><br>
<?php 
	$_fecha_ = date("y/m/d");
	if (ctype_digit("{$_GET['idusuario']}")) $idusuario = $_GET["idusuario"];
	$_link_ = mysql_pconnect ($_host_, $_user_, $_clave_);
	if (!$_link_) {
		//msj_error_ ("No me conecté.");
		return;
	}
	$base_ = mysql_select_db ($_sql_dban_, $_link_);
	if (!$base_) {
		//msj_error_ ("No seleccioné la base.");
		return;
	}
	if ($_GET["clase"] == 1) {
		if (empty($_FILES['archivo']['name'])) {			
			$query_insertar_sin_foto = "INSERT INTO AVISOS(REGION, MARCA, RUBRO, DESCRIPCION, USER, CLASE, DATE, IMAGEN, pagado) 
			VALUES('".trim($_POST["region"])."', '".trim($_POST["marca"])."', '".trim($_POST["rubro"])."', '".mysql_real_escape_string(trim($_POST["descrip"]), $_link_)."', '".$_SESSION["cookie_1"]."', '1', '".$_fecha_."', '2', '0')";
			$z = mysql_query ($query_insertar_sin_foto, $_link_);
			if (!$z) {
				//msj_error_("Error al ejecutar la sentencia ".$query_insertar_sin_foto);
				//msj_error_("Error: ".mysql_errno($_link_).mysql_error($_link_));
				exit();
			}
		} else {		
			$insertStmt2 = "INSERT INTO AVISOS(REGION, MARCA, RUBRO, DESCRIPCION, USER, CLASE, DATE, IMAGEN, pagado)
			VALUES('".trim($_POST["region"])."', '".trim($_POST["marca"])."', '".trim($_POST["rubro"])."', '".mysql_real_escape_string(trim($_POST["descrip"]), $_link_)."', '".$_SESSION["cookie_1"]."', '1', '".$_fecha_."', '1', '0')";
			mysql_query($insertStmt2, $_link_) or die(); //(sprintf("Error al ejecutar la sentencia %s. Error: %d %s", $insertStmt, mysql_errno($_link_), mysql_error($_link_)));
			$primary_key_aviso = mysql_insert_id($_link_);
			$binario_nombre_temporal = $_FILES['archivo']['tmp_name'];
			$binario_peso = $_FILES['archivo']['size'];
			$binario_tipo = $_FILES['archivo']['type'];
			$vector_cadenas_malas = array (' - ', 'á', 'é', 'í', 'ó', 'ú', 'ü', 'ñ', ' ');
			$vector_cadenas_buenas = array ('-', 'a', 'e', 'i', 'o', 'u', 'u ', 'n', '-');
			$nombre_archivo = "$primary_key_aviso-" . str_replace($vector_cadenas_malas, $vector_cadenas_buenas, strtolower(trim($_POST["rubro"]))) . "-" . str_replace($vector_cadenas_malas, $vector_cadenas_buenas, strtolower(trim($_POST["marca"]))) . ".jpg";
			$destino = "../images/$nombre_archivo";
			$destino_miniatura = "../images/miniaturas/$nombre_archivo";
			move_uploaded_file ($binario_nombre_temporal, $destino);
			if ($img = imagecreatefromstring (file_get_contents ($destino))) {
				$medidas = large_size (imagesx($img), imagesy($img));
				$medidas_lista = thumb_size (imagesx($img), imagesy($img));
				$masc = imagecreatetruecolor($medidas[0], $medidas[1]);
				$masc_lista = imagecreatetruecolor($medidas_lista[0], $medidas_lista[1]);
				imagecopyresampled($masc, $img, 0, 0, 0, 0, $medidas[0], $medidas[1], imagesx($img), imagesy($img));
				imagecopyresampled($masc_lista, $img, 0, 0, 0, 0, $medidas_lista[0], $medidas_lista[1], imagesx($img), imagesy($img));
				imagejpeg ($masc, $destino, 100);
				imagejpeg ($masc_lista, $destino_miniatura, 100);
			} else {
				echo "<font face = \"arial\">Hay problemas con su foto. Intente nuevamente o pruebe con otra imagen. 
								<br>Ante cualquier duda consulte con el administrador del servicio.</font>";
			}
			$cookie_1 = $_SESSION["cookie_1"];
			$insertStmt = "INSERT INTO ARCHIVOS (id, USUARIO, IDUSUARIO, IDAVISO, archivo_peso, archivo_tipo, archivo) VALUES 
			('', '$cookie_1', '$idusuario', '$primary_key_aviso', '$binario_peso', '$binario_tipo', '$nombre_archivo')";
			mysql_query($insertStmt, $_link_) or die(sprintf("Error al ejecutar la sentencia %s. Error: %d %s", $insertStmt, mysql_errno($_link_), mysql_error($_link_)));
			// asunto operación a cobrar:
		}
	} else if ($_GET["clase"] == 2 || $_GET["clase"] == 3) {
		$query_insertar_ = "INSERT INTO AVISOS(REGION, MARCA, RUBRO, DESCRIPCION, USER, CLASE, DATE, IMAGEN, pagado)
							VALUES('".trim($_POST["region"])."', '".trim($_POST["marca"])."', '".trim($_POST["rubro"])."', '".mysql_real_escape_string(trim($_POST["descrip"]), $_link_)."', '".$_SESSION["cookie_1"]."', '".$_GET["clase"]."', '".$_fecha_."', '2', '0')";
		$z = mysql_query ($query_insertar_, $_link_);
		if (!$z) {
			//msj_error_("Error al ejecutar la sentencia ".$query_insertar_);
			//msj_error_("Error: ".mysql_errno($_link_).mysql_error($_link_));
			exit();
		}
		$primary_key_aviso = mysql_insert_id($_link_);
	}	
	/* echo "Botón que diga cerrar sesión de carga y habilitar avisos"; */
	if ($la_clase_del_aviso == 3) {
		encabezado_ ("<br><br>\nIngreso exitoso");
		echo ("<BR><form action = \"default.php\" METHOD = post>\n");
		echo ("<INPUT TYPE = submit VALUE = \"Click\"><font face = \"arial\"> para retornar a las opciones\n</font></form>");
	} else if ($la_clase_del_aviso < 3) {
		$id_para_consultar = $la_clase_del_aviso + 3;
		$consulta_precio = mysql_query("select precio from precios where id = '$id_para_consultar'", $_link_);
		$resu_precio = mysql_fetch_object ($consulta_precio);
		$precio_para_mostrar = $resu_precio -> precio;
?>
<br>
<?php
		checkout ($precio_para_mostrar, $primary_key_aviso);
	}
	$base_ = mysql_select_db ($_sql_dbcl_, $_link_);
	if (!$base_) {
		//msj_error_ ("No seleccioné la base $_sql_dbcl_.");
		return;
	}
	$actualizar_cota = "UPDATE USUARIOS SET COTA=COTA - 1 WHERE ROWID=$idusuario";
	mysql_query($actualizar_cota, $_link_) or die(); //(sprintf("Error al ejecutar la sentencia %s. Error: %d %s", $actualizar_cota, mysql_errno($_link_), mysql_error($_link_)));
?>
<br>
<font face = "arial"><a href = "action.php?choice=Ver" style = "text-decoration:none;">Inicio</a> |
<a href = "action.php?choice=Cargar" style = "text-decoration:none;">Cargar más avisos</a></font>
</div>
</body>