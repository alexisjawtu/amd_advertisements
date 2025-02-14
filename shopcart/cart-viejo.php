<?php
include 'variables.php';
if (!session_id ()) {
	session_start();
}
$connect = mysql_connect($localhost, $user, $pass) or die ("Controlar conexión al servidor.");
mysql_select_db($db);
?>
<html>
<head>
<title> </title>
</head>
<body>
<div align="center">
Usted actualmente tiene
<?php
$sessid = session_id();
$query = "SELECT * FROM carttemp WHERE carttemp_sess = '$sessid'";
$results = mysql_query ($query) or die (mysql_error());
$rows = mysql_num_rows($results);
echo $rows;
echo ($rows == 1 ? " producto " : " productos ");
?>
en su carrito.<br>
<table border="0" align="center" cellpadding="6">
<tr>
<td>Cantidad</td>
<td>Imagen</td>
<td>Nombre</td>
<td>Precio unitario</td>
<td>Precio</td>
<td></td>
<td></td>
<?php
$total = 0;
while ($row = mysql_fetch_array ($results)) {
	echo "<tr>";
	extract ($row);
	$prod = "SELECT * FROM products WHERE products_prodnum='$carttemp_prodnum'";
	$prod2 = mysql_query ($prod);
	$prod3 = mysql_fetch_array ($prod2);
	extract ($prod3);
	//$carttemp_hidden es la primary del carrito temporal
	echo "<td><form method=\"POST\" action=\"modcart.php?action=change\">
			<input type=\"hidden\" name=\"modified_hidden\" value=\"$carttemp_hidden\">
			<input type=\"text\" name=\"modified_quan\" size=\"2\" value=\"$carttemp_quan\">";//estas dos irían como vectores
	echo "</td>";
	echo "<td>";
	echo "<a href=\"getprod.php?prodid=" . $products_prodnum . "\" style = \"text-decoration:none;\">";
	echo "MINIATURA</a></td>";
	echo "<td><a href=\"getprod.php?prodid=" . $products_prodnum . "\" style = \"text-decoration:none;\">";
	echo $products_name . "</a></td>";
	echo "<td align=\"right\">" . $products_price . "</td>";
	echo "<td align=\"right\">";
//precio total (precio extendido)
	$extprice = $products_price * $carttemp_quan; 
	echo number_format ($extprice, 2);
	echo "</td>";
	echo "<td>";
	echo "<input type=\"submit\" name=\"Submit\" value=\"Cambiar cant.\"></form></td>";
	echo "<td>";
	echo "<form method=\"post\" action=\"modcart.php?action=delete\">
	<input type=\"hidden\" name=\"modified_hidden\" value=\"$carttemp_hidden\">";
	echo "<input type=\"submit\" name=\"Submit\" value=\"Eliminar\">
			</form></td>";
	echo "</tr>";
	//agregar precio extendido al total
	$total = $extprice + $total;
}
?>
<tr>
<td colspan="4" align="right">
Total antes del envio:</td>
<td align="right"> <?php echo number_format ($total, 2); ?></td>
<td></td>
<td>
<?php
echo "<form method=\"POST\" action=\"modcart.php?action=empty\">
		<input type=\"hidden\" name=\"carttemp_hidden\"value=\"";
if (isset ($carttemp_hidden)) {
	echo $carttemp_hidden;
}
echo "\">";
echo "<input type=\"submit\" name=\"Submit\" value=\"Vaciar Carrito\"></form>";
?>
</td>
</tr>
</table>
<br>
<form method="post" action="checkout.php">
	<input type="submit" name="Submit" value="Checkout">
</form>
<a style = "text-decoration:none;" href="cbashop.php" style = "text-decoration:none;">Volver a la página principal</a>
</div>
</body>
</html>