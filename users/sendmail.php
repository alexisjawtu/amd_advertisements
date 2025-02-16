<?php
	session_start ();
    ini_set("display_errors", "off");
	$usuario = $_SESSION["cookie_1"];
	require ('funciones.php');
	require ("vars.php");
	$env_report = $_POST["env_report"];
	$_texto_mail_ = "Recibido en www.viarural.com\n\n---------------------------------------------------------------------------\n\n";
	if ($_GET['tipo'] == 1) { // pedido de ayuda
		if(!($mylink = mysql_connect($_host_, $_user_, $_clave_)))	{
			//echo (sprintf ("Error al conectar al host %s, por el usuario %s", $_host_, $_user_));
			exit();
		}
		if (!mysql_select_db($_sql_dbcl_, $mylink)) {
			//echo (sprintf("Error al seleccionar la base %s", $_sql_dbcl_));
			//echo (sprintf("error: %d %s", mysql_errno($mylink), mysql_error($mylink)));
			exit();
		}
		$cons_mi_mail = "SELECT * FROM USUARIOS WHERE USER='$usuario'";
		$mi_mail = mysql_query ($cons_mi_mail, $mylink);
		if(!$mi_mail) {
			//echo ("Error al ejecutar la sentencia ".$cons_mi_mail);
			//echo ("Error: ".mysql_errno($mylink)." ".mysql_error($mylink));
			exit();
		}
		$el_mail_ = mysql_fetch_object ($mi_mail);
		$el_mail = $el_mail_ -> MAIL;	
		if (!$el_mail) {
			echo "<font face \"arial\">Problemas con el servidor.<br>\nIntente nuevamente en unos minutos.<br>\n
					Disculpe las molestias. <a \"text-decoration:none;\" href = \"action.php?choice=Ver\">Volver</a></font>";
			exit ();
		}
		$recipients = "alexis@viarural.com, maquinariausadaviarural@gmail.com"; //  Mail del receptor del correo - consultora.matematica@gmail.com"
		$headers["From"] = "anuncios@viarural.com"; // Cuenta de correo válida del dominio
		$headers["To"] = "alexis@viarural.com"; // Destinatario del correo
		$headers["Reply-To"] = $el_mail; // Destinatario del correo
		$_texto_mail_ .= $_POST['consulta'];
		$_texto_mail_ .= "\n\n";
		$subject = "Pedido de ayuda desde Argentina. Usuario $usuario.";
	} else if ($_GET['tipo'] == 2) {  // consulta avisos destacados
		$nombre = htmlspecialchars(trim($_POST['nombre'], ENT_QUOTES));
		$mail = htmlspecialchars(trim($_POST['mail'], ENT_QUOTES));
		$telefono = htmlspecialchars(trim($_POST['telefono'], ENT_QUOTES));
		$ciudad = htmlspecialchars(trim($_POST['ciudad'], ENT_QUOTES));
		$pais = htmlspecialchars(trim($_POST['pais'], ENT_QUOTES));
		$Comentarios = htmlspecialchars(trim($_POST['Comentarios']), ENT_QUOTES);
		$subject = $_POST['subject'];
		$subject .= " Usuario $usuario";
		$_texto_mail_ .= "Nombre: " . $nombre . "\n\n";
		$_texto_mail_ .= "Email: " . $mail . "\n\n";
		$_texto_mail_ .= "Teléfono: " . $telefono . "\n\n";
		$_texto_mail_ .= "Ciudad: " . $ciudad . "\n\n";
		$_texto_mail_ .= "País: " . $pais . "\n\n";
		$_texto_mail_ .= "Comentarios: " . htmlspecialchars($Comentarios) . "\n\n";
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
		echo "<a \"text-decoration:none;\" href = \"action.php?choice=Ver\">Volver</a></font>";
	}
	else header ("Location:$redirectayuda");
?>