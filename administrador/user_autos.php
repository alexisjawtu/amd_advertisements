<?php
	include ("globals.php");
	$link = mysql_connect ($hostName, $userName, $password);
	mysql_select_db ($databaseName, $link);
	$query = "SELECT * FROM USUARIOS WHERE CLASE='1'";
	$resu = mysql_query ($query, $link);
	$matriz_datos = array();
	while ($matriz = mysql_fetch_object ($resu))
	{
		$matriz_datos[] = array ($matriz -> NAME, $matriz -> MAIL, $matriz -> USER, $matriz -> PASS);
	}
	$link2 = mysql_connect ($hostName2, $userName2, $password2);
	mysql_select_db ($databaseName2, $link2);
	$int = 0;
	while ($matriz_datos[$int])
	{
		$query2 = "INSERT into USUARIOS (NOMBRE, EMAIL, USUARIO, CLAVE, CLASE, TOTAL, COTA) 
			    VALUES ($matriz_datos[$int][0], $matriz_datos[$int][1], $matriz_datos[$int][2], $matriz_datos[$int][3], 1, 1000, 1000)";	
		mysql_query ($query2, $link2);
	}
?>