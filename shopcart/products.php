<?php
// s�lo para insertar algunos productos
include 'variables.php';
$connect = mysql_connect ($localhost, $user, $pass) or die ("Controlar conexi�n al servidor.");
mysql_select_db ($db);
	$query = "INSERT INTO products VALUES (
				'00001', 'Logo 1',
				'Descripci�n detallada. Descripci�n detallada. Descripci�n detallada. Descripci�n detallada.',
				97.95, '2009-08-01'),
				('00002', 'Logo 2',
				'Descripci�n detallada. Descripci�n detallada. Descripci�n detallada. Descripci�n detallada.',
				5.95, '2009-10-01'),
				('00003', 'Logo 3',
				'Descripci�n detallada. Descripci�n detallada. Descripci�n detallada. Descripci�n detallada.',
				8.95, '2009-10-28'),
				('00004', 'Logo 4',
				'Descripci�n detallada. Descripci�n detallada. Descripci�n detallada. Descripci�n detallada.',
				40, '2010-02-01'),
				('00005', 'Otro',
				'Descripci�n detallada. Descripci�n detallada. Descripci�n detallada. Descripci�n detallada.',
				139, '2009-08-01'),
				('00006', 'Otro m�s',
				'Descripci�n detallada. Descripci�n detallada. Descripci�n detallada. Descripci�n detallada.',
				199, '2008-08-01')";
$result = mysql_query ($query) or die (mysql_error());
echo "Productos agregados exitosamente.";
?>