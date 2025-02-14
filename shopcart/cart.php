<?php
	include 'variables.php';
	if (!session_id ()) {
		session_start();
	}
	$connect = mysql_connect($localhost, $user, $pass) or die ("Controlar conexión al servidor.");
	mysql_select_db($db);
	/******* ¿ ESTE SE BORRA ? */ 
	$array_cantidades = $_POST['quantity'];
	/*******/
?>
<html>
<head>
<meta http-equiv="Content-Language" content="es">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title> </title>
</head>
<body>
<div align="center">
<font face = "arial">Usted actualmente tiene</font>
<?php
$sessid = session_id();
//echo $sessid;
$query = "SELECT * FROM carttemp WHERE carttemp_sess = '$sessid'";
$results = mysql_query ($query) or die (mysql_error());
$rows = mysql_num_rows($results);
echo "<font face = \"arial\">". $rows;
echo ($rows == 1 ? " producto " : " productos ");
//acá sumo el precio total
$total = 0;
?>
en su carrito.</font><br>
<form method="post" action="modcart.php?action=10476737">
	<table border="0" width="600" cellspacing="0" cellpadding="6" id="table1" style="border-width: 1px" bordercolor="#FFFFFF">
		<tr>
			<td bgcolor="#696A6D" width="53" style="border-left-style: none; border-left-width: medium; border-right-style: solid; 
			border-right-width: 1px; border-top-style: none; border-top-width: medium; border-bottom-style: none; border-bottom-width: medium">
			<p align="center"><b><font color="#FFFFFF" face="Verdana" size="1">
			Quitar</font></b></td>
			<td bgcolor="#696A6D" width="318" style="border-left-style: solid; border-left-width: 1px; border-right-style: solid; 
			border-right-width: 1px; border-top-style: none; border-top-width: medium; border-bottom-style: none; border-bottom-width: medium">
			<p align="left">
			<span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: Times New Roman; 
			font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; 
			text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; 
			-webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; 
			-webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium">
			<span class="Apple-style-span" style="color: rgb(255, 255, 255); font-family: Verdana; font-size: 10px; font-weight: bold; 
			-webkit-border-horizontal-spacing: 1px; -webkit-border-vertical-spacing: 1px">
			Producto(s)</span></span></td>
			<td bgcolor="#696A6D" width="83" style="border-left-style: solid; border-left-width: 1px; border-right-style: solid; 
			border-right-width: 1px; border-top-style: none; border-top-width: medium; border-bottom-style: none; border-bottom-width: medium" align="center">
			<p align="center">
			<span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: Times New Roman; 
			font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; 
			text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; 
			-webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; 
			-webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium">
			<span class="Apple-style-span" style="color: rgb(255, 255, 255); font-family: Verdana; font-size: 10px; font-weight: bold; 
			-webkit-border-horizontal-spacing: 1px; -webkit-border-vertical-spacing: 1px">
			<nobr>Precio unitario</nobr></nobr></span></span></td>
			<td bgcolor="#696A6D" style="border-left-style: solid; border-left-width: 1px; border-right-style: solid; 
			border-right-width: 1px; border-top-style: none; border-top-width: medium; border-bottom-style: none; border-bottom-width: medium">
			<p align="center">
			<span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: Times New Roman; 
			font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium">
			<span class="Apple-style-span" style="color: rgb(255, 255, 255); font-family: Verdana; font-size: 10px; font-weight: bold; 
			text-align: -webkit-center; -webkit-border-horizontal-spacing: 1px; -webkit-border-vertical-spacing: 1px">
			Cantidad</span></span></td>
			<td bgcolor="#696A6D" style="border-left-style: solid; border-left-width: 1px; border-right-style: none; 
			border-right-width: medium; border-top-style: none; border-top-width: medium; border-bottom-style: none; 
			border-bottom-width: medium">
			<p align="right">
			<span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: Times New Roman; 
			font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium">
			<span class="Apple-style-span" style="color: rgb(255, 255, 255); font-family: Verdana; font-size: 10px; font-weight: bold; 
			text-align: -webkit-right; -webkit-border-horizontal-spacing: 1px; -webkit-border-vertical-spacing: 1px">
			Total</span></span></td>
		</tr>
<?php

//CAMBIAR ACÁ CUANDO HAGA EL PAGINADO

while ($row = mysql_fetch_array ($results)) {
	extract ($row);
//	print_r ($row);
	$prod = "SELECT * FROM products WHERE products_prodnum='$carttemp_prodnum'";
	$prod2 = mysql_query ($prod);
	$prod3 = mysql_fetch_array ($prod2);
	extract ($prod3);
	//$carttemp_hidden es la primary del carrito temporal
	echo "<input type=\"hidden\" name=\"modified_hidden[]\" value=\"$carttemp_hidden\">";
?>
		<tr>
			<td width="53" height="70" style="border-top-style: none; border-top-width: medium; border-bottom-style: none; border-bottom-width: medium">
				<p align="left">
					<input type="checkbox" name="delete_checkbox[]" value="1">
				</p>
			</td>
			<td width="343" style="border-top-style: none; border-top-width: medium">
				<font face="Arial" size="2"><a href = "getprod.php?prodid=<? echo $products_prodnum; ?>" style = "text-decoration:none;">
<?
	echo "ID: " . $products_prodnum . "<br><br>" . $products_name . "<br><br>" . $products_proddesc;
?>
				</a></font>
			</td>
			<td width="85" style="border-top-style: none; border-top-width: medium" align="center" valign="top">
			<font face="Arial" size="2"><?php echo $products_price; ?></font></td>
			<td height="70" style="border-top-style: none; border-top-width: medium" valign="top">
				<p align="center"><font size="1" face="Verdana">
				<input type = "text" name = "modified_quan[]" value = "<? echo $carttemp_quan; ?>" size = "4" >
				</font>
			</td>
			<td height="70" style="border-top-style: none; border-top-width: medium" valign="top">
				<font face = "arial" size = "2">
<?php
	//precio total (precio extendido)
	$extprice = $products_price * $carttemp_quan; 
	echo number_format ($extprice, 2);
?>
				</font>
			</td>
		</tr>
<?
	//agregar precio extendido al total
	$total = $extprice + $total;
}
?>
		<tr>
			<td width="53" height="31">&nbsp;</td>
			<td width="343" height="31">&nbsp;</td>
			<td height="31" colspan="2">
				<font size="2" face="Verdana"><b>Subtotal: 
<?
	echo number_format ($total, 2);
?>
			</b></font>
			</td>
		</tr>
		<tr>
			<td width="396" height="31" colspan="2">
			<input type = "image" src = "update-cart.gif"></td>
			<td height="31" colspan="2">
			<p align="center">
			<a href = "checkout.php"><img border="0" src="checkout.gif"></a></td>
		</tr>
	</table>
	</form>
<a style = "text-decoration:none;" href="cbashop.php" style = "text-decoration:none;"><font face = "arial">Volver a la página principal</font></a>
</div>
</body>
</html>