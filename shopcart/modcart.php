<?php
include 'variables.php';
session_start();
$connect = mysql_connect($localhost, $user, $pass) or die ("Controlar conexión  del servidor.");
mysql_select_db ($db);
if (isset ($_POST['qty'])) { // qty viene de getprod.php por $_POST
	$qty = $_POST['qty'];
}
if (isset ($_POST['products_prodnum'])) {
	$prodnum = $_POST['products_prodnum'];
}
if (isset($_POST['modified_hidden'])) {
// ojo: ahora esto es un array.
	$modified_hidden = $_POST['modified_hidden'];
}
if (isset($_POST['modified_quan'])) {
// ojo: ahora esto es un array.
	$modified_quan = $_POST['modified_quan'];
}
// esta parte es para los tildados para borrarlos
if (isset ($_POST['delete_checkbox'])) {
	$vector_de_borrado = $_POST['delete_checkbox'];
}	
$sess = session_id();
$action = $_REQUEST['action'];
//echo $sess;
if ($action == 104767371) {
	if ($qty > 0) {
		$query = "INSERT INTO carttemp (carttemp_sess, carttemp_quan, carttemp_prodnum) VALUES ('$sess','$qty','$prodnum')";
		$resultado_add = mysql_query ($query, $connect) or die (mysql_error ());
		$message = "<div align=\"center\"><strong><font face = \"arial\">Item agregado.</font></strong></div>";
	}
}
else if ($action == 10476737) { //cambiar
	$iter = 0;
	$cantidad_de_cambios = 0;
	/******************
	puedo traer $cantidad = longitud de $modified_quan[] de cart.php
	            $cantidad se va incrementando en cart.php cada vez que imprimo un producto en el carrito en la pantalla
				y comparar $iter con $cantidad
	******************************/
	while ($modified_quan[$iter]) {
		if (1 == $vector_de_borrado[$iter]) {
			//subrutina de borrado
			$query = "DELETE FROM carttemp WHERE carttemp_hidden = '" . $modified_hidden[$iter] . "'";
			$resultado_del = mysql_query ($query) or die (mysql_error());
			//$message = "<div align=\"center\"><strong>Item deleted.</strong></div>";
			/*
			“empty”:
				$query = "DELETE FROM carttemp WHERE carttemp_sess = '$sess'";
				$message = "<div align=\"center\"><strong>Cart emptied.</strong></div>";
			*/
			$cantidad_de_cambios ++;			
		}
		else {
			$query = "UPDATE carttemp SET carttemp_quan = '" . $modified_quan[$iter] . "' WHERE carttemp_hidden = '" . $modified_hidden[$iter] . "'";
			$resu_iterado = mysql_query ($query) or die (mysql_error());
			$cantidad_de_cambios ++;
		}
		$iter ++;
	}
	$message = "<div align='center'><strong><font face = \"arial\">" . 
				($cantidad_de_cambios == 1 ? "Cantidad cambiada." : "Cantidades cambiadas.") . "</font></strong></div>";
}
	/*
	switch ($action)
	case 
	break;
	case "delete":
		$query = "DELETE FROM carttemp WHERE carttemp_hidden = '$modified_hidden'";
		$message = "<div align='center'><strong>Item eliminado.</strong></div>";
	break;
	case "empty":
	$query = "DELETE FROM carttemp WHERE carttemp_sess = '$sess'";
	$message = "<div align='center'><strong>Carrito vaciado.</strong></div>";
	break;
	//falta caso default
	$results = mysql_query ($query) or die (mysql_error());
	*/	
echo $message;
include("cart.php");
?>