<?php
	require ('var.php');
	$__link__ = mysql_pconnect ($_host_, $_user_, $_clave_);
	if(!$__link__ ) {
		//msj_error_ ("No me conecté.");
		return;
	}
	$ent = mysql_select_db ($_sql_dbcl_, $__link__ );
	if (!$ent) {
		//msj_error_ ("No seleccioné la base.");
		return;
	}
	$resultado = mysql_query ("select USER from usuarios", $__link__);
	while ($obj = mysql_fetch_object ($resultado) ) {
		$usuario []= $obj -> USER;
	}
	//print_r ($usuario);
	mysql_select_db ($_sql_dban_, $__link__ );
	$i = 0;
	while ($usuario[$i]) {
		$resu = mysql_query ("select count(*) as Cantidad from avisos where USER = ' ".  $usuario[$i] . "'", $__link__);
		$obj2 = mysql_fetch_array ($resu);
		$array [] = array ($usuario[$i] => $obj2[Cantidad]);
		$i ++;
	}
	sort ($array);
	print_r ($array);
?>