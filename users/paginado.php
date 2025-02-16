<?php
if(empty($_pagi_sql)){
	die("<b>Error: </b>No se ha definido la consulta");
 }
 
 if(empty($_pagi_cuantos)){
	// Si no se especifica la cantidad de registros por página será por defecto 20
	$_pagi_cuantos = 20;
 }
 
 if(!isset($_pagi_mostrar_errores)){
	$_pagi_mostrar_errores = true;
 }

 if(!isset($_pagi_conteo_alternativo)){
	//conteo dese mySQL con COUNT(*)
	$_pagi_conteo_alternativo = false;
 }
  if(!isset($_pagi_separador)){
	$_pagi_separador = " | ";
 }
 
 if(!isset($_pagi_nav_anterior)){
	$_pagi_nav_anterior = "&laquo; Anterior";
 } 
 
 if(!isset($_pagi_nav_siguiente)){
	$_pagi_nav_siguiente = "Siguiente &raquo;";
 } 

 if(!isset($_pagi_nav_primera)){
	$_pagi_nav_primera = "&laquo;&laquo; Primera";
 } 
 
 if(!isset($_pagi_nav_ultima)){
	$_pagi_nav_ultima = "&Uacute;ltima &raquo;&raquo;";
 } 
 
/*página actual*/

if (empty($_GET['pg'])){
	// Si no se ha hecho click a ninguna página específica (si es la primera vez que se ejecuta el script)
    // $_pagi_actual es la pagina actual por defecto la primera.
	$_pagi_actual = 1;
 }else{
    	$_pagi_actual = $_GET['pg'];
 }

//número de páginas total de registros.
 
// Cuento el total de registros en la base (para saber cuántas páginas serán)
 // La forma de hacer ese conteo dependerá de la variable $_pagi_conteo_alternativo
 if($_pagi_conteo_alternativo == false){
 	$_pagi_sqlConta = eregi_replace("select[[:space:]](.*)[[:space:]]from", "SELECT COUNT(*) FROM", $_pagi_sql);
 	$_pagi_result2 = mysql_query($_pagi_sqlConta);
	// Si ocurrió error y mostrar errores está activado
 	if($_pagi_result2 == false && $_pagi_mostrar_errores == true){
		die (" Error en la consulta de conteo de registros: $_pagi_sqlConta. Mysql dijo: <b>".mysql_error()."</b>");
 	}
 	$_pagi_totalReg = mysql_result($_pagi_result2,0,0);//devuelve el resultado como un entero. Total de registros
 }else{
	$_pagi_result3 = mysql_query($_pagi_sql);
	if($_pagi_result3 == false && $_pagi_mostrar_errores == true){
		die (" Error en la consulta de conteo alternativo de registros: $_pagi_sql. Mysql dijo: <b>".mysql_error()."</b>");
 	}
	$_pagi_totalReg = mysql_num_rows($_pagi_result3);
 }
 //if ($_pagi_totalReg < 1) header("Location:index.php");
 //número de páginas
 $_pagi_totalPags = ceil($_pagi_totalReg / $_pagi_cuantos);

$_pagi_enlace = "action.php";
$_pagi_query_string = "?";
 
 if(!isset($_pagi_propagar)){
	if (isset($_GET['pg'])) unset($_GET['pg']); // elimino esa variable del $_GET
	$_pagi_propagar = array_keys($_GET);
 }elseif(!is_array($_pagi_propagar)){
	die("<b>Error: </b>La variable \$_pagi_propagar debe ser un array");
 }
 foreach($_pagi_propagar as $var){
 	if(isset($GLOBALS[$var])){
		// Si la variable es global al script
		$_pagi_query_string.= $var."=".$GLOBALS[$var]."&";
	}elseif(isset($_REQUEST[$var])){
		// Si no es global (o register globals está en OFF)
		$_pagi_query_string.= $var."=".$_REQUEST[$var]."&";
	}
 }

 // Añadimos el query string a la url.
 $_pagi_enlace .= $_pagi_query_string;
 
//enlaces de paginación. $_pagi_navegacion: enlaces a las páginas.
 $_pagi_navegacion_temporal = array();
 if ($_pagi_actual != 1){
	$_pagi_url = 1;
	$_pagi_navegacion_temporal[] = "<a style = \"text-decoration: none\"; href='".$_pagi_enlace."pg=".$_pagi_url."'><font face = \"arial\" size = \"2\">$_pagi_nav_primera</font></a>";

	$_pagi_url = $_pagi_actual - 1;
	$_pagi_navegacion_temporal[] = "<a style = \"text-decoration: none\"; href='".$_pagi_enlace."pg=".$_pagi_url."'><font face = \"arial\" size = \"2\">$_pagi_nav_anterior</font></a>";
 }
 
 //$_pagi_nav_num_enlaces: cuántos enlaces con números de página se mostrarán como máximo.
 
 if(!isset($_pagi_nav_num_enlaces)){
	$_pagi_nav_desde = 1;//Desde la primera
	$_pagi_nav_hasta = $_pagi_totalPags;//hasta la última
 }else{
	$_pagi_nav_intervalo = ceil($_pagi_nav_num_enlaces/2) - 1;
	// desde qué número de página se mostrará
	$_pagi_nav_desde = $_pagi_actual - $_pagi_nav_intervalo;
	// hasta qué número de página se mostrará
	$_pagi_nav_hasta = $_pagi_actual + $_pagi_nav_intervalo;
	
	if($_pagi_nav_desde < 1){
		// Le sumamos la cantidad sobrante al final para mantener el número de enlaces que se quiere mostrar. 
		$_pagi_nav_hasta -= ($_pagi_nav_desde - 1);
		// Establecemos $_pagi_nav_desde como 1.
		$_pagi_nav_desde = 1;
	}
	// Si $_pagi_nav_hasta es un número mayor que el total de páginas
	if($_pagi_nav_hasta > $_pagi_totalPags){
		// Le restamos la cantidad excedida al comienzo para mantener el número de enlaces que se quiere mostrar.
		$_pagi_nav_desde -= ($_pagi_nav_hasta - $_pagi_totalPags);
		// Establecemos $_pagi_nav_hasta como el total de páginas.
		$_pagi_nav_hasta = $_pagi_totalPags;
		// Hacemos el último ajuste verificando que al cambiar $_pagi_nav_desde no haya quedado con un valor no válido.
		if($_pagi_nav_desde < 1){
			$_pagi_nav_desde = 1;
		}
	}
 }

 for ($_pagi_i = $_pagi_nav_desde; $_pagi_i <= $_pagi_nav_hasta; $_pagi_i ++){
	if ($_pagi_i == $_pagi_actual) {
		// si la página es la actual ($_pagi_actual) se escribe el número sin enlace y en negrita.
		$_pagi_navegacion_temporal[] = "<span><font face = \"arial\" size = \"2\">$_pagi_i</font></span>";
	}else{
		// si es otro va con enlace
		$_pagi_navegacion_temporal[] = "<a style = \"text-decoration: none\"; href='".$_pagi_enlace."pg=".$_pagi_i."'><font face = \"arial\" size = \"2\">".$_pagi_i."</font></a>";
	}
 }

 if ($_pagi_actual < $_pagi_totalPags){
	$_pagi_url = $_pagi_actual + 1; //número de página al que enlazamos
	$_pagi_navegacion_temporal[] = "<a style = \"text-decoration: none\"; href='".$_pagi_enlace."pg=".$_pagi_url."'><font face = \"arial\" size = \"2\">$_pagi_nav_siguiente</font></a>";

	$_pagi_url = $_pagi_totalPags; //número de página al que enlazamos
	$_pagi_navegacion_temporal[] = "<a style = \"text-decoration: none\"; href='".$_pagi_enlace."pg=".$_pagi_url."'><font face = \"arial\" size = \"2\">$_pagi_nav_ultima</font></a>";
 }

if ($_pagi_totalReg > 20) { //si hay 19 o menos no aclaro que es página 1 etc.
 $_pagi_navegacion = implode($_pagi_separador, $_pagi_navegacion_temporal);
}

//registros en la página actual. desde qué registro se mostrará en esta página
 $_pagi_inicial = ($_pagi_actual - 1) * $_pagi_cuantos;
 
 // Consulta SQL. Devuelve $cantidad registros empezando desde $_pagi_inicial
 $_pagi_sqlLim = $_pagi_sql . " LIMIT $_pagi_inicial,$_pagi_cuantos";
 $_pagi_result = mysql_query($_pagi_sqlLim);
 if($_pagi_result == false && $_pagi_mostrar_errores == true){
 	die ("Error en la consulta con LIMIT: $_pagi_sqlLim. Mysql dijo: <b>".mysql_error()."</b>");
 }

$_pagi_desde = $_pagi_inicial + 1;
 
$_pagi_hasta = $_pagi_inicial + $_pagi_cuantos;
if($_pagi_hasta > $_pagi_totalReg){
 	// Si estamos en la última página el último registro de la página actual será igual al número de registros.
 	$_pagi_hasta = $_pagi_totalReg;
 }
 if ($_pagi_totalReg > 20) { //si hay 19 o menos no aclaro que es página 1 etc.
 $_pagi_info = "<font face = \"arial\" size = \"2\">Desde el $_pagi_desde hasta el $_pagi_hasta de un total de $_pagi_totalReg.</font>";
}
 ?>
