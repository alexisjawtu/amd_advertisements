<?php
include 'variables.php';
$connect = mysql_connect($localhost, $user, $pass) or die ("Controlar conexión al servidor.");
mysql_select_db($db);
//tabla temporal
$query = "CREATE TABLE carttemp(
			carttemp_hidden INT(10) NOT NULL AUTO_INCREMENT,
			carttemp_sess CHAR(50) NOT NULL,
			carttemp_prodnum CHAR(5) NOT NULL,
			carttemp_quan INT(3) NOT NULL,
			PRIMARY KEY (carttemp_hidden),
			KEY(carttemp_sess))";
$temp = mysql_query ($query) or die (mysql_error());
echo "tabla temporal del carrito inicializada correctamente.";
?>