<?PHP session_start();
	if($_SESSION["cookie_1_"] != "Paco" || $_SESSION["cookie_2_"] != "malek") {
		header("Location:index.php");
		exit();
	}
	require ("globals.php");
	$rowid = $_GET["rowid"];
	$deleteStmt = "DELETE from USUARIOS where ROWID = $rowid";
	if(!($link = mysql_pconnect($hostName, $userName, $password)))
	{
		echo ( sprintf("Error al conectar al host %s, por el usuario %s", $hostName, $userName) );
		exit();
	}
	if(!mysql_select_db($databaseName, $link))
	{
		echo ( sprintf("Error al seleccionar la base %s", $databaseName));
		echo ( sprintf("error: %d %s", mysql_errno($link), mysql_error($link)));
		exit();
	}
	if(!(mysql_query($deleteStmt, $link)))
	{
		echo ( sprintf("Error al ejecutar la sentencia %s", $deleteStmt));
		echo ( sprintf("error: %d %s", mysql_errno($link), mysql_error($link)));
		exit();
	}
 	header ("Location:search.php?eb=1&nom=$nom&mail=$mail&user=$user&pass=$pass&class=$class");
?>