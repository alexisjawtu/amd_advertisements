<?php
include 'variables.php';
$connect = mysql_connect ($localhost, $user, $pass) or die ("Controlar conexión al servidor.");
mysql_select_db ($db);
$_pagi_sql = "SELECT * FROM products";
$_pagi_cuantos = 15;
$_pagi_nav_num_enlaces = 15;
$_pagi_mostrar_errores = false;
include 'paginado.php';
?>
<html>
<head>
<title>Lista de Productos del Sitio</title>
</head>
<body>
<div align="center">
<table width="300">
<?php
// muestro sólo nombre, precio e imagen
while ($obj = mysql_fetch_object ($_pagi_result)) {
	echo "<tr><td align=\"center\">";
	echo "<a href=\"getprod.php?prodid=" . $obj -> products_prodnum . "\" style = \"text-decoration:none;\">";
	echo "<font face = \"arial\">MINIATURA</font></a></td>";
	echo "<td>";
	echo "<a href=\"getprod.php?prodid=" . $obj -> products_prodnum . "\" style = \"text-decoration:none;\">";
	echo "<font face = \"arial\">" . $obj -> products_name . "</font>";
	echo "</a></td>";
	echo "<td align=\"right\">";
	echo "<a href=\"getprod.php?prodid=" . $obj -> products_prodnum . "\" style = \"text-decoration:none;\">";
	echo "<font face = \"arial\">$" . $obj -> products_price . "</font>";
	echo "</a></td></tr>";
}
echo "</table>";
echo $_pagi_navegacion . "<br>\n<br>\n";
echo $_pagi_info . "<br>\n<br>\n";
?>
</div>
</body>
</html>