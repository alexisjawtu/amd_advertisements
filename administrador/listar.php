<?php
	require ("../avisos/var.php");
	$__link__ = mysql_pconnect($_host_, $_user_, $_clave_);
	if(!$__link__ ) {
		msj_error_ ("No me conecté.");
		return;
	}
	$ent = mysql_select_db ($_sql_dbcl_, $__link__ );
	if (!$ent) {
		msj_error_ ("No seleccioné la base.");
		return;
	}
	//$user_result = mysql_query ();
	$ent = mysql_select_db ($_sql_dban_, $__link__ );
	if (!$ent) {
		msj_error_ ("No seleccioné la base.");
		return;
	}
	$user = mysql_real_escape_string ($_GET["user"], $__link__);
	$nro_id_usuario = $_GET['id'];
	$_pagi_sql = "SELECT * FROM AVISOS WHERE USER='$user' ORDER BY ID_AVISO";
	$_pagi_cuantos = 15;
	$_pagi_mostrar_errores = true;
	$_pagi_nav_num_enlaces = 15;
	$_pagi_listado = 1; //si vale 1 entonces vengo de listar.php
	include ("paginado.php");
?>
<html>
<head>
<title>Avisos por usuario</title>
</head>
<BODY TEXT = "#000000" BGCOLOR = "#EBEEF3" LINK = "#0000C8" VLINK = "#0000C8" ALINK = "#C0C0C0">
<div align = "center"><br>
	<a href = "http://www.viarural.com.ar"><img src="logo-via-rural.gif" alt="Logo" border="0"></a><br><br>
	<font face = "Arial">
	<b> Avisos Clasificados </b><BR><BR>
<table cellpadding="6" cellspacing="0" WIDTH = "600">
	<tr><td align ="center"><font face = "arial"><a href = "default.php" style = "text-decoration:none;">Página principal</a> | 
						  <a href = "search.php" style = "text-decoration:none;">Mostrar listado de usuarios</a></font>
		</td>
	</tr>
</table>
</div>
<div align="center">
  </br>
  <table border="0" cellpadding="6" cellspacing="0" width="600" bordercolor="#FFFFFF" id="table1">
    <tr>
      <td valign="top"><font face = "arial">
      <p align="center">Avisos de <font color = "00923F"><?php echo $name . "</font> - <font color = \"00923F\">" . $user; ?></font>
	  | Número de usuario: <font color = "00923F"><?php echo $nro_id_usuario; ?> </font>
      | Clase <font color = "00923F"><?php echo $clase; ?></font></font></td>
    </tr>
  </table>
  <div align="center">
  </br>
    <table border="1" cellpadding="6" cellspacing="0" bordercolor="#c0c0c0" id="table2">
      <tr>
        <td align="center"><font face = "arial">ID</font></td>
        <td align="center"><font face = "arial">Región</font></td>
        <td align="center"><font face = "arial">Marca</font></td>
        <td align="center"><font face = "arial">Rubro</font></td>
        <td align="center"><font face = "arial">Imagen</font></td>
        <td align="center"><font face = "arial">Fecha</font></td>
      </tr>
<?php
	while ($obj_lista = mysql_fetch_object ($_pagi_result)) {
      echo "<tr>
        <td><font face = \"arial\">" . $obj_lista -> ID_AVISO . "</font></td>
        <td><font face = \"arial\">" . $obj_lista -> REGION . "</font></td>
        <td><font face = \"arial\">" . $obj_lista -> MARCA . "</font></td>
        <td><font face = \"arial\">" . $obj_lista -> RUBRO . "</font></td>
        <td align = \"center\"><font face = \"arial\">" . ($obj_lista -> IMAGEN == 1 ? "<img src = \"../camara.gif\">" : "<img src = \"../avisos/sinfoto.gif\">") . "</font></td>
        <td><font face = \"arial\">" . $obj_lista -> DATE . "</font></td>
      </tr>";
	}
?>
    </table>
	</div>
<?php
	if (isset($_pagi_navegacion)) echo "\n" . $_pagi_navegacion;
	if (isset($_pagi_info)) echo "<br><br>\n\n" . $_pagi_info . "<br><br>\n\n";
?>
</div>
</body>
</html>