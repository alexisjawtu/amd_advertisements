<?php
	require ("../avisos/var.php");
	require ("common.php");
	$__link__ = mysql_pconnect($_host_, $_user_, $_clave_);
	if(!$__link__ ) {
		msj_error_ ("No me conecté.");
		return;
	}
	$ent = mysql_select_db ($_sql_dban_, $__link__ );
	if (!$ent) {
		msj_error_ ("No seleccioné la base.");
		return;
	}
	$_pagi_sql = "SELECT * FROM AVISOS ORDER BY ID_AVISO DESC";
	$_pagi_cuantos = 15;
	$_pagi_mostrar_errores = true;
	$_pagi_nav_num_enlaces = 15;
	include ("paginado.php");
?>
<html>
<head>
<title>Avisos publicados</title>
</head>
<BODY TEXT = "#000000" BGCOLOR = "#EBEEF3" LINK = "#0000C8" VLINK = "#0000C8" ALINK = "#C0C0C0">
<DIV ALIGN = "CENTER"><br>
<a href = "http://www.viarural.com.ar"><img src = "logo-via-rural.gif" alt = "Logo" border = "0"></a><br><br>
<font face = "Arial">
<b> Avisos Clasificados </b><BR><BR>
</DIV>
<div align="center">
<font face = "arial"><a href = "search.php" style = "text-decoration:none;">Mostrar el listado de usuarios</a><br><br>
<a href = "default.php" style = "text-decoration:none;">Página principal</a></font><br><br>
<?php menu_principal(); ?>
  <table border="0" cellpadding="6" cellspacing="0" width="600" bordercolor="#FFFFFF" id="table1">
    <tr>
      <td valign="top"><p align="center"><b><font face = "arial" color="#647BA2">Avisos publicados</font></b></p></td>
	</tr>
  </table>
  <div align="center">
    <table border="1" cellpadding="6" cellspacing="0" bordercolor="#c0c0c3" id="table2">
      <tr>
		<td align="center"><font face = "arial">Fecha</font></td>
        <td align="center"><font face = "arial">Id</font></td>
        <td align="center"><font face = "arial">Usuario</font></td>
        <td align="center"><font face = "arial">Región</font></td>
        <td align="center"><font face = "arial">Rubro</font></td>
        <td align="center"><font face = "arial">Marca</font></td>
        <td align="center"><font face = "arial">Descripción</font></td>
        <td align="center"><font face = "arial">Clase</font></td>
        <td align="center"><font face = "arial">Imagen</font></td>
      </tr>
<?php
	while ($obj_lista = mysql_fetch_object ($_pagi_result)) {
      echo "<tr>
        <td><font face = \"arial\">" . $obj_lista -> DATE . "</font></td>
        <td><font face = \"arial\">" . $obj_lista -> ID_AVISO . "</font></td>
        <td><font face = \"arial\">" . $obj_lista -> USER . "</font></td>
        <td><font face = \"arial\">" . $obj_lista -> REGION . "</font></td>
        <td><font face = \"arial\">" . $obj_lista -> RUBRO . "</font></td>
        <td><font face = \"arial\">" . $obj_lista -> MARCA . "</font></td>
        <td><font face = \"arial\">" . $obj_lista -> DESCRIPCION . "</font></td>
        <td><font face = \"arial\">" . $obj_lista -> CLASE . "</font></td>
        <td>" . ($obj_lista -> IMAGEN == 1 ? "<img src = \"../camara.gif\">" : "<img src = \"../avisos/sinfoto.gif\">") . "</td>
      </tr>";
	}
?>
    </table>
  </div>
<?php
	if (isset($_pagi_navegacion)) echo "<br>\n" . $_pagi_navegacion;
	if (isset($_pagi_info))echo "<br><br>\n\n" . $_pagi_info . "<br><br>\n\n";
?>
</div>
</body>
</html>