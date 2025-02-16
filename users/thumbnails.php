<?php
	require ("vars.php");
	/*function DisplayErrMsg( $message ) {   
		printf("<BODY BGCOLOR = \"#EBEEF3\">");
		printf("<BLOCKQUOTE><H3><FONT COLOR = \"#CC0000\">%s</FONT></H3></BLOCKQUOTE>\n", $message);
		printf("</BODY>");
	}*/
	if (isset($_GET['id'])) {
		if (ctype_digit("{$_GET['id']}")) {
			if (!($link = mysql_pconnect($_host_, $_user_, $_clave_))) {
				//DisplayErrMsg (sprintf ("Error al conectar al host %s, por el usuario %s", $_host_, $_user_));
				exit();
			}
			if (!mysql_select_db($_sql_dban_, $link)) {
				//DisplayErrMsg(sprintf("Error al seleccionar la base %s", $_sql_dban_));
				//DisplayErrMsg(sprintf("error: %d %s", mysql_errno($link), mysql_error($link)));
				exit();
			}
			$selectStmt = "SELECT archivo_binario, archivo_tipo, archivo_nombre FROM ARCHIVOS WHERE id='".$_GET['id']."'";
			$query = mysql_query($selectStmt, $link);
			$_imagen = mysql_result($query, 0, "archivo_binario");
			header ("Content-type: image/jpeg");
			$img = imagecreatefromstring($_imagen);
			$_picsize = 500;
			$_new_w = imagesx($img);
			$_new_h = imagesy($img);
			$_aspect_ratio = $_new_h / $_new_w;
			$_new_w = $_picsize;
			$_new_h = $_new_w * $_aspect_ratio;
			$_mascara = imagecreatetruecolor($_new_w, $_new_h);
			imagecopyresampled($_mascara, $img, 0, 0, 0, 0, $_new_w, $_new_h, imagesx($img), imagesy($img));	
			imagejpeg($_mascara, '', 100);
		}
	}
?>