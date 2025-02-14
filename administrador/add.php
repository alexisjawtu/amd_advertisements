<?PHP session_start();
	if($_SESSION["cookie_1_"] != "Paco" || $_SESSION["cookie_2_"] != "malek") {
		header("Location:index.php");
		exit();
	}
	require ("globals.php");
	function check_mail($string_) {
		if(ereg("^.+@.+\\..+$", $string_)) return 1;
		else return 0;
	}
	$addStmt = "Insert into USUARIOS(NAME, MAIL, USER, PASS, CLASE, COTA, FECHA)
	values('%s', '%s', '%s', '%s', '%s', '%s', '%s')";
	$nom = trim($_GET["nom"]);
	$user = trim($_GET["user"]);
	if (!$nom || !trim($_GET["mail"]) || !$user || !trim($_GET["pass"]) || !trim($_GET["class"]) || !trim($_GET["cota"]))
	{
		header ("Location:default.php?faltadato=1");
		exit();
	}
	else if(!check_mail($_GET["mail"]))
	{
		header ("Location:default.php?mailinv=1");
		exit();
	}
	if (!($link = mysql_pconnect($hostName, $userName, $password)))
	{
		echo (sprintf ("Error al conectar al host %s, por el usuario %s", $hostName, $userName));
		exit();
	}
	if (!mysql_select_db($databaseName, $link))
	{
		echo (sprintf("Error al seleccionar la base %s", $databaseName));
		echo (sprintf("error: %d %s", mysql_errno($link), mysql_error($link)));
		exit();
	}
	//chequear usuarios repetidos:
	if (!($resource = mysql_query("SELECT * FROM USUARIOS WHERE USER='$user'", $link))) {
		echo (sprintf("Error al ejecutar la sentencia SELECT * FROM USUARIOS WHERE USER=$user"));
		echo (sprintf("error: %d %s", mysql_errno($link), mysql_error($link)));
		exit();
	}
	if(mysql_num_rows ($resource) < 1) {
		if (!mysql_query(sprintf($addStmt, $nom, trim($_GET["mail"]), $user, trim($_GET["pass"]), trim($_GET["class"]), trim($_GET["cota"]), date ("y/m/d")), $link)) {
			echo (sprintf("Error al ejecutar la sentencia %s", $addStmt));
			echo (sprintf("error: %d %s", mysql_errno($link), mysql_error($link)));
			exit();
		}
		header ("Location:default.php?indicadoringreso=1");
		exit;
	}
	else if (mysql_num_rows ($resource) >= 1){
		header ("Location:default.php?indicadoringreso=2");
		exit ();
	}
?>