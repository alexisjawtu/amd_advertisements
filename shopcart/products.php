<?php
// sólo para insertar algunos productos
include 'variables.php';
$connect = mysql_connect ($localhost, $user, $pass) or die ("Controlar conexión al servidor.");
mysql_select_db ($db);
	$query = "INSERT INTO products VALUES (
				'00001', 'Logo 1',
				'Descripción detallada. Descripción detallada. Descripción detallada. Descripción detallada.',
				97.95, '2009-08-01'),
				('00002', 'Logo 2',
				'Descripción detallada. Descripción detallada. Descripción detallada. Descripción detallada.',
				5.95, '2009-10-01'),
				('00003', 'Logo 3',
				'Descripción detallada. Descripción detallada. Descripción detallada. Descripción detallada.',
				8.95, '2009-10-28'),
				('00004', 'Logo 4',
				'Descripción detallada. Descripción detallada. Descripción detallada. Descripción detallada.',
				40, '2010-02-01'),
				('00005', 'Otro',
				'Descripción detallada. Descripción detallada. Descripción detallada. Descripción detallada.',
				139, '2009-08-01'),
				('00006', 'Otro más',
				'Descripción detallada. Descripción detallada. Descripción detallada. Descripción detallada.',
				199, '2008-08-01')";
$result = mysql_query ($query) or die (mysql_error());
echo "Productos agregados exitosamente.";
?>