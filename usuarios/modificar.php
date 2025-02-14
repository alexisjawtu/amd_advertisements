<?php session_start ();
	require ('funciones.php');
	require ("vars.php");
	if(!autenticar_usuario($_SESSION["cookie_1"], $_SESSION["cookie_2"])) {
		header ("Location:index.php");
		exit ();
	}
?>
<html>
<HEAD><style><!--a:hover{color: rgb(65,65,255)}--></style>
			<meta http-equiv = "content-type" content = "text/html; charset = iso-8859-1">
			<meta name = "KEYWORDS" content = "MAQUINARIA AGRICOLA USADA">
			<meta name = "DESCRIPTION" content = "MAQUINARIA AGRICOLA USADA">
			<TITLE>MAQUINARIA AGRICOLA USADA</TITLE>
</HEAD>
<body TEXT = "#000000" BGCOLOR = "#EBEEF3" LINK = "#0000C8" VLINK = "#0000C8" ALINK = "#C0C0C0">
<div align = "center">
<table width = "92%">
	   <tr><td align = "left"><font face = "arial"><?php echo date("d/m/y"); ?></font></td>
	       <td align = "right"><font face = "arial"><?php $usactual = $_SESSION["cookie_1"];
		                                                  echo $usactual." | "; ?><a href = cerrarsesion.php style = "text-decoration: none;">Cerrar sesión</a></font></td>
	   </tr>
</table>
<a target = "_top" href = "../avisos/index.php">
   <img src="clasificados.gif" alt="Maquinaria Agrícola Usada" border="0">
</a><br>
<?php
	encabezado_ ("<br><br>\nModifique los datos del aviso");
	$tabla = "AVISOS";
	$marca = htmlspecialchars($_GET["marca"]);
	$rubro = htmlspecialchars($_GET["rubro"]);
	echo "<br>\n<FORM METHOD = post ACTION = \"actualizar.php?aviso=$rowid\">"; 
	echo "<table><tr><td align = \"right\"><font face = \"arial\">País:</font></td>
					 <td align = \"left\"><font face = \"arial\">$mipais</font></td></tr>";
	$iterador_ = 0;
	echo "<tr><td align = \"right\"><font face = \"arial\">Región:</font></td>
		<td align = \"left\"><select name = \"region\">";
	$regiondef = htmlspecialchars($_GET["region"]);
	while ($regiones[$iterador_]) {
		if ($regiones[$iterador_] == $regiondef) echo "<option selected value = \"".$regiones[$iterador_]."\">".$regiones[$iterador_]."</option>";
		else echo "<option value = \"".$regiones[$iterador_]."\">".$regiones[$iterador_]."</option>";
		$iterador_ ++;
	}
	echo "</select></td></tr>";
	echo "<tr><td align = \"right\"><font face = \"arial\">Marca:</font></td>
		<td align = \"left\"><font face = \"arial\">" . htmlspecialchars($_GET["marca"]) . "</font></td></tr>
		<input type = \"hidden\" value = \"$marca\" name = \"marca\">";
	echo "<tr><td align = \"right\"><font face = \"arial\">Rubro:</font></td>
		<td align = \"left\"><font face = \"arial\">" . htmlspecialchars($_GET["rubro"]) . "</font></td></tr>
		<input type = \"hidden\" value = \"$rubro\" name = \"rubro\">";
	$descripdef = htmlspecialchars($_GET["descripcion"]);
	echo "<tr><td align = \"right\"><font face = \"arial\">Descripción:</font></td>
			<td align =\"left\"><textarea name = \"descrip\" rows = \"4\" cols = \"53\">$descripdef</textarea></td></tr>";
	echo "<tr><td align = \"right\"> </td><td align = \"left\"><INPUT TYPE = submit VALUE = \"Guardar\"></td></tr></FORM>";	
?>
</div>
<table>
       <tr>
           <td>
               <font face = "ARIAL"><br>Si su aviso tiene foto y quiere modificarla entonces dé de baja su aviso<BR>clickeando en <b>borrar</b> en su listado
					 de avisos y vuélvalo a cargar con la<br>nueva foto.</font>
           </td>
      </tr>
</table>
</body>
</html>