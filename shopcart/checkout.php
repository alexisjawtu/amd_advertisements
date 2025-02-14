<?php
session_start ();
?>
<html>
<head>
<title>Paso 1 de 3 - Informaci�n de Facturaci�n y Env�o</title>
</head>
<body>
<strong>Orden de pedido</strong><br>
<strong>Paso 1 - Por favor igrese la informaci�n de facturaci�n y env�o</strong><br>
Paso 2 - Por favor verifique la exactitud de la informaci�n de la orden y env�ela<br>
Paso 3 - Confirmaci�n de orden y recibo<br>
<form method="post" action="checkout2.php">
<table width="300" border="1" align="left">
<tr>
<td colspan="2">
<div align="center"><strong>Informaci�n de facturaci�n</strong></div>
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
<div align="right">Direcci�n de Facturaci�n</div>
</td>
<td width="50%">
<input type="text" name="add1" maxlength="50">
</td>
</tr>
<tr>
<td width="50%">
<div align="right">Direcci�n de facturaci�n 2</div>
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
<div align="right">C�digo Postal</div>
</td>
<td width="50%">
<input type="text" name="zip" maxlength="5" size="5">
</td>
</tr>
<tr>
<td width="50%">
<div align="right">N�mero de Tel�fono</div>
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
<div align="right">Direcci�n de e-mail</div>
</td>
<td width="50%">
<input type="text" name="email" maxlength="50">
</td>
</tr>
</table>
<table width="300" border="1">
<tr>
<td colspan="2">
<div align="center"><strong>Informaci�n de env�o</strong></div>
</td>
</tr>
<tr>
<td width="50%">
<div align="right">Informaci�n de env�o (misma que para facturaci�n)</div>
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
<div align="right">Direcci�n de env�o</div>
</td>
<td width="50%">
<input type="text" name="shipadd1" maxlength="50">
</td>
</tr>
<tr>
<td width="50%">
<div align="right">Direcci�n de env�o 2</div>
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
<div align="right">C�digo postal</div>
</td>
<td width="50%">
<input type="text" name="shipzip" maxlength="5" size="5">
</td>
</tr>
<tr>
<td width="50%">
<div align="right">N�mero de tel�fono</div>
</td>
<td width="50%">
<input type="text" name="shipphone" size="12" maxlength="12">
</td>
</tr>
<tr>
<td width="50%">
<div align="right">Direcci�n de e-mail</div>
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