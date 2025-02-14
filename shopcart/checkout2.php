<?php
include 'variables.php';
session_start();
//connect to the database
$connect = mysql_connect($localhost, $user, $pass) or die ("Controlar conexión al servidor.");
mysql_select_db($db);
if ($_POST['same'] == 'on') {
	$_POST['shipfirst'] = $_POST['firstname'];
	$_POST['shiplast'] = $_POST['lastname'];
	$_POST['shipadd1'] = $_POST['add1'];
	$_POST['shipadd2'] = $_POST['add2'];
	$_POST['shipcity'] = $_POST['city'];
	$_POST['shipstate'] = $_POST['state'];
	$_POST['shipzip'] = $_POST['zip'];
	$_POST['shipphone'] = $_POST['phone'];
	$_POST['shipemail'] = $_POST['email'];
}
?>
<html>
<head>
<title>Paso 2 de 3 - Verificar la exactitud de la orden</title>
</head>
<body>
Paso 1 - Por favor igrese la información de facturación y envío<br>
<strong>Paso 2 - Por favor verifique la exactitud y haga cualquier cambio necesario</strong><br>
Paso 3 - Confirmación de orden y recibo<br>
	<form method="post" action="checkout3.php">
		<table width="300" border="1" align="left">
			<tr>
				<td colspan="2">
					<div align="center"><strong>Información de facturación</strong></div>
				</td>
			</tr>
			<tr>
				<td width="50%">
					<div align="right">Nombre</div>
				</td>
				<td width="50%">
					<input type="text" name="firstname" maxlength="15" value="<?php echo $_POST['firstname']; ?> ">
				</td>
			</tr>
			<tr>
				<td width="50%">
					<div align="right">Apellido</div>
				</td>
				<td width="50%">
					<input type="text" name="lastname" maxlength="50" value="<?php echo $_POST['lastname']; ?>">
				</td>
			</tr>
			<tr>
				<td width="50%">
					<div align="right">Dirección de Facturación</div>
				</td>
				<td width="50%">
					<input type="text" name="add1" maxlength="50" value="<?php echo $_POST['add1']; ?>">
				</td>
			</tr>
			<tr>
				<td width="50%">
					<div align="right">Dirección de Facturación 2</div>
				</td>
				<td width="50%">
					<input type="text" name="add2" maxlength="50" value="<?php echo $_POST['add2']; ?>">
				</td>
			</tr>
			<tr>
				<td width="50%">
					<div align="right">Ciudad</div>
				</td>
				<td width="50%">
					<input type="text" name="city" maxlength="50" value="<?php echo $_POST['city']; ?> ">
				</td>
			</tr>
			<tr>
				<td width="50%">
					<div align="right">Estado</div>
				</td>
				<td width="50%">
					<input type="text" name="state" size="2" maxlength="2" value="<?php echo $_POST['state']; ?>">
				</td>
			</tr>
			<tr>
				<td width="50%">
					<div align="right">Código postal</div>
				</td>
				<td width="50%">
					<input type="text" name="zip" maxlength="5" size="5" value="<?php echo $_POST['zip']; ?>">
				</td>
			</tr>
			<tr>
				<td width="50%">
					<div align="right">Número de Teléfono</div>
				</td>
				<td width="50%">
					<input type="text" name="phone" size="12" maxlength="12" value="<?php echo $_POST['phone']; ?>">
				</td>
			</tr>
			<tr>
				<td width="50%">
					<div align="right">Fax</div>
				</td>
				<td width="50%">
					<input type="text" name="fax" maxlength="12" size="12" value="<?php echo $_POST['fax']; ?>">
				</td>
			</tr>
			<tr>
				<td width="50%">
					<div align="right">Dirección de e-mail</div>
				</td>
				<td width="50%">
					<input type="text" name="email" maxlength="50" value="<?php echo $_POST['email']; ?>">
				</td>
			</tr>
		</table>
		<table width="300" border="1">
			<tr>
				<td colspan="2">
					<div align="center"><strong>Información de envío</strong></div>
				</td>
			</tr>
			<tr>
				<td width="50%">
					<div align="right">Información de envío (misma que para facturación)</div>
				</td>
				<td width="50%">
					<input type="checkbox" name="same">
				</td>
			</tr>
			<tr>
				<td width="50%">
					<div align="right">Nombre</div>
				</td>
				<td width="50%">
					<input type="text" name="shipfirst" maxlength="15" value="<?php echo $_POST['shipfirst']; ?>">
				</td>
			</tr>
			<tr>
				<td width="50%">
					<div align="right">Apellido</div>
				</td>
				<td width="50%">
					<input type="text" name="shiplast" maxlength="50" value="<?php echo $_POST['shiplast']; ?>">
				</td>
			</tr>
			<tr>
				<td width="50%">
					<div align="right">Dirección de envío</div>
				</td>
				<td width="50%">
					<input type="text" name="shipadd1" maxlength="50" value="<?php echo $_POST['shipadd1']; ?>">
				</td>
			</tr>
			<tr>
				<td width="50%">
					<div align="right">Dirección de envío 2</div>
				</td>
				<td width="50%">
					<input type="text" name="shipadd2" maxlength="50" value="<?php echo $_POST['shipadd2']; ?>">
				</td>
			</tr>
			<tr>
				<td width="50%">
					<div align="right">Ciudad</div>
				</td>
				<td width="50%">
					<input type="text" name="shipcity" maxlength="50" value="<?php echo $_POST['shipcity']; ?>">
				</td>
			</tr>
			<tr>
				<td width="50%">
					<div align="right">Estado</div>
				</td>
				<td width="50%">
					<input type="text" name="shipstate" size="2" maxlength="2" value="<?php echo $_POST['shipstate']; ?>">
				</td>
			</tr>
			<tr>
				<td width="50%">
					<div align="right">Código postal</div>
				</td>
				<td width="50%">
					<input type="text" name="shipzip" maxlength="5" size="5" value="<?php echo $_POST['shipzip']; ?>">
				</td>
			</tr>
			<tr>
				<td width="50%">
					<div align="right">Número de Teléfono</div>
				</td>
				<td width="50%">
					<input type="text" name="shipphone" size="12" maxlength="12" value="<?php echo $_POST['shipphone']; ?>">
				</td>
			</tr>
			<tr>
				<td width="50%">
					<div align="right">Dirección de e-mail</div>
				</td>
				<td width="50%">
					<input type="text" name="shipemail" maxlength="50" value="<?php echo $_POST['shipemail']; ?>">
				</td>
			</tr>
		</table>
		<hr>
		<table border="1" align="left" cellpadding="5">
			<tr>
				<td>Cantidad</td>
				<td>Imagen</td>
				<td>Nombre</td>
				<td>Precio unitario</td>
				<td>Precio Extendido</td>
				<td></td>
				<td></td>
			</tr>
<?php
$sessid = session_id();
$query = "SELECT * FROM carttemp WHERE carttemp_sess = '$sessid'";
$results = mysql_query ($query) or die (mysql_error());
$total = 0;
while ($row = mysql_fetch_array ($results)) {
	extract ($row);
	$prod = "SELECT * FROM products WHERE products_prodnum = '$carttemp_prodnum'";
	$prod2 = mysql_query ($prod);
	$prod3 = mysql_fetch_array ($prod2);
	extract ($prod3);
	echo "<tr><td>";
	echo $carttemp_quan;
	echo "</td>";
	echo "<td>";
	echo "<a style = \"text-decoration:none;\" href=\"getprod.php?prodid=" . $products_prodnum . "\">";
	echo "Miniatura</td></a>";
	echo "<td><a style = \"text-decoration:none;\" href=\"getprod.php?prodid=" . $products_prodnum . "\">";
	echo $products_name . "</td></a>";
	echo "<td align=\"right\">" . $products_price . "</td>";
	echo "<td align=\"right\">";
	//obtener precio extendido
	$extprice = number_format($products_price * $carttemp_quan, 2, ",", ".");
	echo $extprice . "</td>";
	echo "<td><a style = \"text-decoration:none;\" href=\"cart.php\">Hacer cambios al carrito</a>";
	echo "</td></tr>";
	//agregar precio extendido al total
	$total = $extprice + $total;
}
?>
			<tr>
				<td colspan="4" align="right">Total antes del envío:</td>
				<td align="right"> <?php echo number_format($total, 2, ",", "."); ?></td>
				<td></td>
				<td></td>
			</tr>
		</table>
		<input type="hidden" name="total" value="<?php echo $total; ?>">
		<p>
		<input type="submit" name="Submit" value="Enviar orden --&gt;">
		</p>
	</form>
</body>
</html>