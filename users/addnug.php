<?PHP session_start();
	require ("vars.php");
	function check_mail($string_) {
		if(ereg("^.+@.+\\..+$", $string_)) return 1;
		else return 0;
	}
	$addStmt = "Insert into USUARIOS(NAME, MAIL, USER, PASS, CLASE, COTA, FECHA)
	values('%s', '%s', '%s', '%s', '3', '1000', '%s')";
	$nom = trim($_GET["nom"]);
	$user = trim($_GET["user"]);
	$mail = trim($_GET["mail"]);
	if (!$nom || !$mail || !$user || !trim($_GET["pass"])) {
		header ("Location:nug.php?fd=1&nom=$nom&user=$user&mail=$mail"); //faltan datos
		exit();
	}
	else if(trim($_GET["pass"]) != trim($_GET["pass2"])) {
		header ("Location:nug.php?cd=1&nom=$nom&user=$user&mail=$mail"); //claves distintas
		exit();
	}
	else if(!check_mail($mail)) {
		header ("Location:nug.php?mi=1&nom=$nom&user=$user&mail=$mail"); //mail no válido
		exit();
	}
	if (!($link = mysql_pconnect($_host_, $_user_, $_clave_))) {
		//echo (sprintf ("Error al conectar al host %s, por el usuario %s", $_host_, $_user_));
		exit();
	}
	if (!mysql_select_db($_sql_dbcl_, $link)) {
		//echo (sprintf("Error al seleccionar la base %s", $_sql_dbcl_));
		//echo (sprintf("error: %d %s", mysql_errno($link), mysql_error($link)));
		exit();
	}
	//chequear usuarios repetidos:
	$nom = mysql_real_escape_string ($nom, $link);
	$user = mysql_real_escape_string ($user, $link);
	$mail = mysql_real_escape_string ($mail, $link);
	if (!($resource = mysql_query("SELECT * FROM USUARIOS WHERE USER='$user'", $link))) {
		//echo (sprintf("Error al ejecutar la sentencia SELECT * FROM USUARIOS WHERE USER=$user"));
		//echo (sprintf("error: %d %s", mysql_errno($link), mysql_error($link)));
		exit();
	}
	if(mysql_num_rows ($resource) < 1) {
		if (!mysql_query(sprintf($addStmt, $nom, $mail, $user, trim($_GET["pass"]), date ("y/m/d")), $link)) {
			//echo (sprintf("Error al ejecutar la sentencia %s", $addStmt));
			//echo (sprintf("error: %d %s", mysql_errno($link), mysql_error($link)));
			exit();
		}
		header ("Location:nug.php?ie=101");  // ingreso exitoso.   
		exit;
	}
	else if (mysql_num_rows ($resource) >= 1){
		header ("Location:nug.php?ii=1&nom=$nom&user=$user&mail=$mail"); // indicador ingreso = usuarios repetidos.
		exit ();
	}
?>