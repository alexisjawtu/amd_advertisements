<?php
include 'variables.php';
session_start();
$connect = mysql_connect($localhost, $user, $pass) or die ("Controlar conexión  del servidor.");
mysql_select_db($db);
//
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$firstname = $_POST['firstname'];
$add1 = $_POST['add1'];
$add2 = $_POST['add2'];
$city = $_POST['city'];
$state = $_POST['state'];
$zip = $_POST['zip'];
$phone = $_POST['phone'];
$fax = $_POST['fax'];
$email = $_POST['email'];
$shipfirst = $_POST['shipfirst'];
$shiplast = $_POST['shiplast'];
$shipadd1 = $_POST['shipadd1'];
$shipadd2 = $_POST['shipadd2'];
$shipcity = $_POST['shipcity'];
$shipstate = $_POST['shipstate'];
$shipzip = $_POST['shipzip'];
$shipstate = $_POST['shipstate'];
$shipphone = $_POST['shipphone'];
$shipemail = $_POST['shipemail'];
$total = $_POST['total'];
$sessid = session_id();
$today = date ("Y-m-d");
//1) Asignar número de cliente a cliente nuevo o encontrar número de cliente existente
$query = "SELECT * FROM customers WHERE (customers_firstname = '$firstname' AND
			customers_lastname = '$lastname' AND customers_add1 = '$add1' AND
			customers_add2 = '$add2' AND customers_city = '$city')";
$results = mysql_query ($query) or die (mysql_error());
$rows = mysql_num_rows ($results);
if ($rows < 1) {
//asignar nuevo número de cliente
	$query2 = "INSERT INTO customers (
				customers_firstname, customers_lastname, customers_add1,
				customers_add2, customers_city, customers_state,
				customers_zip, customers_phone, customers_fax, customers_email)
				VALUES ('$firstname', '$lastname', '$add1', '$add2', '$city', '$state', '$zip', '$phone', '$fax', '$email')";
	$insert = mysql_query ($query2) or die (mysql_error());
	$custid = mysql_insert_id();
}
//si custid existe, queremos hacerlo igual a custnum
//si no, usaremos el custnum existente
if ($custid) {
	$customers_custnum = $custid;
}
//2) Insertar Info en ordermain
//determinar costos de envío en función del total de la orden (25% del total)
$shipping = $total * 0.25;
$query3 = "INSERT INTO ordermain (
			ordermain_orderdate, ordermain_custnum,
			ordermain_subtotal,ordermain_shipping,
			ordermain_shipfirst, ordermain_shiplast,
			ordermain_shipadd1, ordermain_shipadd2,
			ordermain_shipcity, ordermain_shipstate,
			ordermain_shipzip, ordermain_shipphone,
			ordermain_shipemail)
			VALUES ('$today', '$customers_custnum', '$total', '$shipping', '$shipfirst', '$shiplast',
			'$shipadd1', '$shipadd2', '$shipcity', '$shipstate', '$shipzip', '$shipphone', '$shipemail')";
$insert2 = mysql_query ($query3) or die (mysql_error());
$orderid = mysql_insert_id();
//3) Insertar Info en orderdet
//encontrar la información correcta del carro siendo almacenada temporalmente
$query = "SELECT * FROM carttemp WHERE carttemp_sess='$sessid'";
$results = mysql_query($query) or die (mysql_error());
//poner los datos en la db de a una fila a la vez
while ($row = mysql_fetch_array ($results)) {
	extract ($row);
	$query4 = "INSERT INTO orderdet (orderdet_ordernum, orderdet_qty, orderdet_prodnum)
				VALUES ('$orderid', '$carttemp_quan', '$carttemp_prodnum')"; 
	$insert4 = mysql_query ($query4) or die (mysql_error());
}
//4)borrar de la tabla temporal
$query = "DELETE FROM carttemp WHERE carttemp_sess='$sessid'";
$delete = mysql_query ($query);
//5)confirmaciones por email para nosostros y para el
/* recipients = receptores */
$to = "<" . $email .">";
/* asunto */
$subject = "Confirmación de la Orden";
/* mensaje */
/* cabecera del mensaje */
$message = "<html>
<head>
<title>Confirmación de la Orden</title>
</head>
<body>
Aquí tiene un resumen de su orden:<br><br>
Fecha de la Orden: ";
$message .= $today;
$message .= "<br>Número de Orden: ";
$message .= $orderid;
$message .= "<table width=\"50%\" border=\"0\">
<tr><td><p>Factura a:<br>";
$message .= $firstname;
$message .= " ";
$message .= $lastname;
$message .= "<br>";
$message .= $add1;
$message .= "<br>";
if ($add2) {
	$message .= $add2 . "<br>";
}
$message .= $city . ", " . $state . " " . $zip;
$message .= "</p></td><td><p>Ship to:<br>";
$message .= $shipfirst . " " . $shiplast;
$message .= "<br>";
$message .= $shipadd1 . "<br>";
if ($shipadd2) {
	$message .= $shipadd2 . "<br>";
}
$message .= $shipcity . ", " . $shipstate . " " . $shipzip;
$message .= "</p></td></tr></table><hr width=\"250px\" align=\"left\">
<table cellpadding=\"5\">";
//tomar los contenidos de la orden e insertarlos en el campo del mensaje
$query = "SELECT * FROM orderdet WHERE orderdet_ordernum = '$orderid'";
$results = mysql_query($query) or die (mysql_error());
while ($row = mysql_fetch_array ($results)) {
	extract ($row);
	$prod = "SELECT * FROM products WHERE products_prodnum = '$orderdet_prodnum'";
	$prod2 = mysql_query ($prod);
	$prod3 = mysql_fetch_array ($prod2);
	extract ($prod3);
	$message .= "<tr><td>";
	$message .= $orderdet_qty;
	$message .= "</td><td>";
	$message .= $products_name;
	$message .= "</td><td align=\"right\">";
	$message .= $products_price;
	$message .= "</td><td align=\"right\">";
	//calcular precio extendido
	$extprice = number_format ($products_price * $orderdet_qty, 2, ",", ".");
	$message .= $extprice;
	$message .= "</td></tr>";
}
$message .= "<tr><td colspan=\"3\" align=\"right\">Total antes del envío:</td>
<td align=\"right\">";
$message .= number_format ($total, 2);
$message .= "</td></tr><tr><td colspan=\"3\" align=\"right\">Costos de Envío:</td><td align=\"right\">";
$message .= number_format ($shipping, 2);
$message .= "</td></tr><tr><td colspan=\"3\" align=\"right\">Su total final es:</td><td align=\"right\"> ";
$message .= number_format(($total + $shipping), 2);
$message .= "</td></tr></table></body></html>";
/* cabeceras */
$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
$headers .= "From: <storeemail@email.com>\r\n";
$headers .= "Cc: <alexis@viarural.com>\r\n";
$headers .= "X-Mailer: PHP / ".phpversion()."\r\n";
/* lo enviamos */
mail ($to, $subject, $message, $headers);
//6)Les mostramos la orden y les damos número de orden
echo "Step 1 - Por favor igrese la Información de Facturación y Envío<br>";
echo "Step 2 - Por favor verifique la exactitud de la información y haga cualquier cambio necesario<br>";
echo "<strong>Step 3 - Confirmación de orden y recibo</strong><br><br>";
echo $message;
?>