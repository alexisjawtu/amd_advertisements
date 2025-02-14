<?php
    ini_set("display_errors", "off");
	require ("var.php");
	$env_report = $_POST["env_report"];
	$_texto_mail_ = "Recibido en www.viarural.com\n\n---------------------------------------------------------------------------\n\n";
	$nombre = htmlspecialchars(trim($_POST['nombre'], ENT_QUOTES));
	$mail = htmlspecialchars(trim($_POST['mail'], ENT_QUOTES));
	$telefono = htmlspecialchars(trim($_POST['telefono'], ENT_QUOTES));
	$ciudad = htmlspecialchars(trim($_POST['ciudad'], ENT_QUOTES));
	$pais = htmlspecialchars(trim($_POST['pais'], ENT_QUOTES));
	$Comentarios = htmlspecialchars(trim($_POST['Comentarios']), ENT_QUOTES);
	$subject = $_POST['subject'];
	$_texto_mail_ .= "Nombre: " . $nombre . "\n\n";
	$_texto_mail_ .= "Email: " . $mail . "\n\n";
	$_texto_mail_ .= "Teléfono: " . $telefono . "\n\n";
	$_texto_mail_ .= "Ciudad: " . $ciudad . "\n\n";
	$_texto_mail_ .= "País: " . $pais . "\n\n";
	$_texto_mail_ .= "Comentarios: " . htmlspecialchars($Comentarios) . "\n\n";
	if ($_GET['m'] == 1) {
		if (ctype_digit("{$_GET['rowid']}")) $idaviso = $_GET["rowid"];
		$region = htmlspecialchars($_GET['region'], ENT_QUOTES);
		$marca = htmlspecialchars($_GET['marca'], ENT_QUOTES);
		$rubro = htmlspecialchars($_GET['rubro'], ENT_QUOTES);
		$descripcion = htmlspecialchars($_GET['descripcion'], ENT_QUOTES);
		$_texto_mail_ .= "Recibido por el aviso $idaviso\n$rubro $marca $region.
					  \nDescripción: $descripcion\n\n";       //Recibido en $env_report\n\n
		if(!($mylink = mysql_connect($_host_, $_user_, $_clave_)))	{
			//echo (sprintf ("Error al conectar al host %s, por el usuario %s", $_host_, $_user_));
			exit();
		}
		if (!mysql_select_db($_sql_dbcl_, $mylink)) {
			//echo (sprintf("Error al seleccionar la base %s", $_sql_dbcl_));
			//echo (sprintf("error: %d %s", mysql_errno($mylink), mysql_error($mylink)));
			exit();
		}
		$anunciante = mysql_real_escape_string("{$_POST['anunc']}", $mylink);
		$cons_mi_mail = "SELECT * FROM USUARIOS WHERE USER='$anunciante'";
		$mi_mail = mysql_query ($cons_mi_mail, $mylink);
		if(!$mi_mail) {
			//echo ("Error al ejecutar la sentencia ".$cons_mi_mail);
			//echo ("Error: ".mysql_errno($mylink)." ".mysql_error($mylink));
			exit();
		}
		$el_mail_ = mysql_fetch_object ($mi_mail);
		$el_mail = $el_mail_ -> MAIL;
		$imagen = $_GET["img"];
		if (!$el_mail) {
			echo "<font face \"arial\">Problemas con el servidor.<br>\nIntente nuevamente en unos minutos.<br>\n
					Disculpe las molestias. <a \"text-decoration:none;\" href = \"consultar.php?rowid=$idaviso&pic=$imagen\">Volver</a></font>";
			exit ();
		}
		$recipients = $el_mail . ", maquinariausadaviarural@gmail.com"; //  Mail del receptor del correo - consultora.matematica@gmail.com"
		$headers["From"] = "anuncios@viarural.com"; // Cuenta de correo válida del dominio
		$headers["To"] = $el_mail; // Destinatario del correo
	} else if ($_GET['m'] == 2 || $_GET['m'] == 3) {
		$recipients = "avisos.viarural@gmail.com, maquinariausadaviarural@gmail.com";
		$headers["From"] = "anuncios@viarural.com"; // Cuenta de correo válida del dominio 
		$headers["To"] = "anuncios@viarural.com";	
	}
	$_texto_mail_ .= "---------------------------------------------------------------------------";
	$_texto_mail_ = wordwrap($_texto_mail_, 70);
	$_texto_mail_ = str_replace ("\n.", "\n..", $_texto_mail_);
	include("Mail.php"); // Archivo interno del servidor	
	$headers["Reply-TO"] = $mail; //este va en viarural.
	$headers["Subject"] = $subject;
	$smtpinfo["host"] = "smtp.viarural.com"; // Servidor SMTP ("mail.viarural.com" = 66.219.25.194) o mail.gmail.com
	$smtpinfo["port"] = "25";
	$smtpinfo["auth"] = true;
	$smtpinfo["username"] = "anuncios@viarural.com"; // Cuenta de correo para autentificar
	$smtpinfo["password"] = "malek001"; // Clave de la cuenta de correo
	$mail_object =& Mail::factory("smtp", $smtpinfo);
	if (!$mail_object->send($recipients, $headers, $_texto_mail_)) {
		echo "<font face = \"arial\"><br>\nProblemas con el servidor al enviar su consulta.<br>\nPor favor intente nuevamente en unos minutos.<br>\n<br>\n";
		echo "<a href = \"consultar.php?rowid=$idaviso\" style = \"text-decoration:none;\">Volver</a></font>";
	}
	else header ("Location:$redirect");
?>