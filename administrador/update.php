<?PHP session_start();
	if($_SESSION["cookie_1_"] != "Paco" || $_SESSION["cookie_2_"] != "malek") {
		header("Location:index.php");
		exit();
	}
	require ("globals.php");
	require ("common.php");
	if (!($link = mysql_pconnect($hostName, $userName, $password))) {
		msj_error (sprintf ("Error al conectar al host %s, por el usuario %s", $hostName, $userName));
		exit();
	}
	if ($_GET['q'] == 1) {
		$nom = trim($_GET["nom"]);
		$mail = trim($_GET["mail"]);
		$user = trim($_GET["user"]);
		$pass = trim($_GET["pass"]);
		$class = trim($_GET["class"]);
		$cota = trim($_GET["cota"]);
		$rowid = $_SESSION["idfila"];
		$updateStmt = "UPDATE USUARIOS set NAME = '$nom', MAIL = '$mail', USER = '$user', PASS = '$pass', CLASE = '$class', COTA = '$cota' WHERE ROWID = $rowid";
		$base = $databaseName;
		$s = 1;
	} else if ($_GET['q'] == 2) {
		$identificador = $_GET['identificador'];
		$precio = mysql_real_escape_string (trim($_POST['precio']), $link);
		$plazo = mysql_real_escape_string (trim($_POST['plazo']), $link);
		$detalle = mysql_real_escape_string (trim($_POST['detalle']), $link);
		$updateStmt = "UPDATE precios SET precio = '$precio', plazo = '$plazo', detalle = '$detalle' WHERE id = '" . $identificador . "'";
		$base  = $databaseName_user;
		$s = 2;
	}
	if (!mysql_select_db($base, $link))	{
		msj_error (sprintf("Error al seleccionar la base %s", $databaseName_user));
		msj_error (sprintf("error: %d %s", mysql_errno($link), mysql_error($link)));
		exit();
	}
	if (!mysql_query($updateStmt, $link)) {
		msj_error (sprintf("Error al ejecutar la sentencia %s", $updateStmt));
		msj_error (sprintf("error: %d %s", mysql_errno($link), mysql_error($link)));
		exit();
	}
	header ("Location:default.php?s=$s"); // string=modificación de precio exitosa o bien Modificación de usuario exitosa
?>