<?php
session_start ();
?>
<html>
<head>
<title>Paso 1 de 3 - Información de Facturación y Envío</title>
</head>
<body>
<strong>Orden de pedido</strong><br>
<strong>Paso 1 - Por favor igrese la información de facturación y envío</strong><br>
Paso 2 - Por favor verifique la exactitud de la información de la orden y envíela<br>
Paso 3 - Confirmación de orden y recibo<br>
<form method="post" action="checkout2.php">
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
<input type="text" name="firstname" maxlength="15">
</td>
</tr>
<tr>
<td width="50%">
<div align="right">Apellido</div>
</td>
<td width="50%">
<input type="text" name="lastname" maxlength="50">
</td>
</tr>
<tr>
<td width="50%">
<div align="right">Dirección de Facturación</div>
</td>
<td width="50%">
<input type="text" name="add1" maxlength="50">
</td>
</tr>
<tr>
<td width="50%">
<div align="right">Dirección de facturación 2</div>
</td>
<td width="50%">
<input type="text" name="add2" maxlength="50">
</td>
</tr>
<tr>
<td width="50%">
<div align="right">Ciudad</div>
</td>
<td width="50%">
<input type="text" name="city" maxlength="50">
</td>
</tr>
<tr>
<td width="50%">
<div align="right">Estado</div>
</td>
<td width="50%">
<input type="text" name="state" size="2" maxlength="2">
</td>
</tr>
<tr>
<td width="50%">
<div align="right">Código Postal</div>
</td>
<td width="50%">
<input type="text" name="zip" maxlength="5" size="5">
</td>
</tr>
<tr>
<td width="50%">
<div align="right">Número de Teléfono</div>
</td>
<td width="50%">
<input type="text" name="phone" size="12" maxlength="12">
</td>
</tr>
<tr>
<td width="50%">
<div align="right">Fax</div>
</td>
<td width="50%">
<input type="text" name="fax" maxlength="12" size="12">
</td>
</tr>
<tr>
<td width="50%">
<div align="right">Dirección de e-mail</div>
</td>
<td width="50%">
<input type="text" name="email" maxlength="50">
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
<input type="text" name="shipfirst" maxlength="15">
</td>
</tr>
<tr>
<td width="50%">
<div align="right">Apellido</div>
</td>
<td width="50%">
<input type="text" name="shiplast" maxlength="50">
</td>
</tr>
<tr>
<td width="50%">
<div align="right">Dirección de envío</div>
</td>
<td width="50%">
<input type="text" name="shipadd1" maxlength="50">
</td>
</tr>
<tr>
<td width="50%">
<div align="right">Dirección de envío 2</div>
</td>
<td width="50%">
<input type="text" name="shipadd2" maxlength="50">
</td>
</tr>
<tr>
<td width="50%">
<div align="right">Ciudad</div>
</td>
<td width="50%">
<input type="text" name="shipcity" maxlength="50">
</td>
</tr>
<tr>
<td width="50%">
<div align="right">Estado</div>
</td>
<td width="50%">
<input type="text" name="shipstate" size="2" maxlength="2">
</td>
</tr>
<tr>
<td width="50%">
<div align="right">Código postal</div>
</td>
<td width="50%">
<input type="text" name="shipzip" maxlength="5" size="5">
</td>
</tr>
<tr>
<td width="50%">
<div align="right">Número de teléfono</div>
</td>
<td width="50%">
<input type="text" name="shipphone" size="12" maxlength="12">
</td>
</tr>
<tr>
<td width="50%">
<div align="right">Dirección de e-mail</div>
</td>
<td width="50%">
<input type="text" name="shipemail" maxlength="50">
</td>
</tr>
</table>
<p>
<input type="submit" name="Submit"
value="Ir al siguiente paso --&gt;">
</p>
</form>
</body>
</html>