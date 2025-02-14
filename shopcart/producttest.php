<?php
include 'variables.php';
$connect = mysql_connect ($localhost, $user, $pass) or die ("Controlar conexión al servidor.");
mysql_select_db ($db);
$query = "SELECT * FROM products";
$results = mysql_query ($query) or die (mysql_error());
?>
<html>
<head>
<title>Lista de Productos</title>
</head>
<body>
<table>
<tr>
<td width="10%">Número</td>
<td width="20%">Nombre</td>
<td width="50%">Descripción</td>
<td width="10%">Precio</td>
<td width="10%">Fecha</td>
</tr>
<?php
while ($row = mysql_fetch_array ($results)) {
	extract ($row);
	echo "<tr><td width=\"10%\">";
	echo $products_prodnum;
	echo "</td><td width=\"20%\">";
	echo $products_name;
	echo "</td><td width=\"50%\">";
	echo $products_proddesc;
	echo "</td><td width=\"10%\">";
	echo $products_price;
	echo "</td><td width=\"10%\">";
	echo $products_dateadded;
	echo "</td></tr>";
}
?>
</table>
</body>
</html>