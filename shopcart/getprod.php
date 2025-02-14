<?php
session_start();
include 'variables.php';
$connect = mysql_connect($localhost, $user, $pass) or die ("Controlar conexión al servidor.");
mysql_select_db($db);
//Acá podría ser $_GET
if (ctype_digit ("{$_REQUEST['prodid']}")) $prodid = $_REQUEST['prodid'];
$query = "SELECT * FROM products WHERE products_prodnum='$prodid'";
$results = mysql_query ($query) or die (mysql_error());
$row = mysql_fetch_array ($results);
extract ($row);
?>
<html>
<head>
	<title><?php echo $products_name; ?></title>
</head>
<body>
	<div align="center">
		<table cellpadding="5" width="80%">
			<tr>
				<td>IMAGEN</td>
				<td><strong><?php echo $products_name; ?></strong><br>
					<?php echo $products_proddesc; ?><br>
					<br>Número: <?php echo $products_prodnum; ?>
					<br>Precio: $<?php echo $products_price; ?><br>
					<form method="POST" action="modcart.php?action=104767371">
						Cantidad: <input type="text" name="qty" size="2" value = "1"><br>
						<input type="hidden" name="products_prodnum" value="<?php echo $products_prodnum ?>">
						<input type="submit" name="Submit" value="Agregar al carro">
					</form>
					<form method="POST" action="cart.php">
						<input type="submit" name="Submit" value="Ver carro">
					</form>
</td>
</tr>
</table>
<hr width="200">
<p><a style = "text-decoration:none;" href="cbashop.php">Volver a la página principal</a></p>
</div>
</body>
</html>