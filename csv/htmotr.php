<?php
	$matriz = array ();
	$array_medidas_de_cada_producto = array ();
	$array_productos_de_cada_medida = array ();
	$handle1 = fopen ("otr.csv", "r");
	while ($array = fgetcsv ($handle1, 95, ';')) {
		if ($array[0]) {
			$matriz [] = $array;
			$nombre_indice_temporal = $array[2];
			$array_medidas_de_cada_producto [$nombre_indice_temporal][] = $array[3];
			$nombre_indice_temporal2 = $array[3];
			$array_productos_de_cada_medida [$nombre_indice_temporal2][] = $array[2];
		}
	}
	sort (&$matriz);
	foreach ($array_medidas_de_cada_producto as $key => $value) {
		$matriz_medidas_de_cada_producto [$key] = array_unique ($array_medidas_de_cada_producto [$key]);
	}
	foreach ($array_productos_de_cada_medida as $key => $value) {
		$matriz_productos_de_cada_medida [$key] = array_unique ($array_productos_de_cada_medida [$key]);
	}
	//print_r ($matriz_medidas_de_cada_producto);
	//print_r ($matriz_productos_de_cada_medida);
	//asort (&$array_medidas_de_cada_producto);
	//asort (&$array_productos_de_cada_medida);
	//print_r ($array_medidas_de_cada_producto);
	//print_r ($array_productos_de_cada_medida);
	$iterador = 0;
	while ($matriz[$iterador][0]) {
		$medida = str_replace ('r', '-r', strtolower($matriz[$iterador][3]));																
		$string_nombre_archivo = str_replace (' ', '-', strtolower ('neumaticos-' . $medida . '-' . $matriz[$iterador][2]));
		$string_nombre_archivo = str_replace ('/', '-', $string_nombre_archivo);
		$string_nombre_archivo = str_replace ('ñ', 'n', $string_nombre_archivo);
		$string_nombre_archivo = str_replace ('á', 'a', $string_nombre_archivo);
		$string_nombre_archivo = str_replace ('é', 'e', $string_nombre_archivo);
		$string_nombre_archivo = str_replace ('í', 'i', $string_nombre_archivo);
		$string_nombre_archivo = str_replace ('ó', 'o', $string_nombre_archivo);
		$string_nombre_archivo = str_replace ('ú', 'u', $string_nombre_archivo);
		$string_nombre_archivo = str_replace ('&', '-y-', $string_nombre_archivo);
		if (!is_file ('otr/' . $string_nombre_archivo . '.htm') ) {
			$archivo = fopen ('otr/' . $string_nombre_archivo . '.htm', "w");
			$medida_separada_para_imprimir = str_replace ('/', ' ', str_replace ('R', ' ', $matriz[$iterador][2]));
			$string_htm = "<html>
<head>
<meta content=\"es-ar\" http-equiv=\"Content-Language\">
<meta name=\"GOODYEAR\" content=\"NEUMATICOS CUBIERTAS LLANTAS RUEDAS\">
<meta content=\"text/html; charset=windows-1252\" http-equiv=\"Content-Type\">
<meta name=\"keywords\" content=\"NEUMATICO " .  $matriz[$iterador][3] . " " . strtoupper ($matriz[$iterador][2]) . " - NEUMATICOS GOODYEAR " . 
	$medida_separada_para_imprimir . "\">
<meta name=\"description\" content=\"NEUMATICO " . $matriz[$iterador][3] . " " . strtoupper ($matriz[$iterador][2]) . " - NEUMATICOS GOODYEAR " .
	$medida_separada_para_imprimir . "\">
<title>NEUMATICO " . $matriz[$iterador][3] . " " . strtoupper ($matriz[$iterador][2]) . " - NEUMATICOS GOODYEAR " . $medida_separada_para_imprimir . "</title>
<style type=\"text/css\">
body
{
font-family: Arial; 
font-size: 10pt;
background-color: #EBEEF3;
margin-top: 0px;
} 
a:link { color: #0000C8;}
a:visited { color: #0000C8; }
a:active  { color: #C0C0C0; }
a:link, a:visited { text-decoration: none }
a:hover{color: rgb(65,65,255)}
td, tr, th
{
font-size: 10pt;
}
</style>
</head>

<body bgcolor=\"#EBEEF3\" topmargin=\"0\" alink=\"#C0C0C0\">
<div align=\"center\">
  <center>
  <div align=\"center\">
	<table border=\"0\" width=\"600\" cellspacing=\"0\" cellpadding=\"6\" id=\"table1\">
		<tr style=\"font-size: 10pt\">
			<td style=\"font-size: 10pt\">
			<p align=\"left\">
			<a href=\"../default.htm\" style=\"text-decoration: none\">Neumáticos &gt;</a></td>
		</tr>
	</table>
	</div>
  <table cellspacing=\"0\" id=\"AutoNumber1\" bordercolor=\"#111111\" border=\"0\" height=\"89\" cellpadding=\"6\" width=\"600\" style=\"border-collapse: collapse\">
    <tr>
      <td height=\"89\" width=\"292\">
      <p align=\"center\"><font face=\"Arial\" size=\"2\"><a href=\"default.htm\">
      <img src=\"logo.gif\" border=\"0\" height=\"52\" alt=\"NEUMATICOS GOODYEAR\" width=\"230\"></a></font></p></td>
      <td height=\"89\" width=\"308\">
      <p align=\"center\"><font face=\"Arial\" size=\"4\" color=\"#F08D20\">NEUMATICOS 
      GOODYEAR<br>" . $matriz[$iterador][3] . " " . strtoupper ($matriz[$iterador][2]) . "</font></p></td>
    </tr>
  </table>
  </center>
</div>
<div align=\"center\">
  <center>
  <table cellspacing=\"0\" id=\"AutoNumber3\" bordercolor=\"#111111\" border=\"0\" cellpadding=\"6\" width=\"600\" style=\"border-collapse: collapse\">
    <tr>
      <td width=\"241\">
      &nbsp;</td>
      <td width=\"359\">
      &nbsp;</td>
    </tr>
    <tr>
      <td width=\"241\">
      <p align=\"center\">
      <a href=\"" . $matriz[$iterador][1] . "\">
      <img src=\"" . $matriz[$iterador][0] . "\" border=\"0\" alt=\"GOODYEAR NEUMATICOS " . strtoupper ($matriz[$iterador][2]) . "\"></a></p></td>
      <td width=\"359\">
      <p align=\"left\">
      <font face=\"Arial\" size=\"2\">
      <img src=\"cuadrado-negro.gif\" border=\"0\" height=\"12\" width=\"11\"> " . $matriz[$iterador][3] . " " . 
      "<a href=\"" . $matriz[$iterador][1] . "\">" . strtoupper ($matriz[$iterador][2]) . "</a></font></p></td>
    </tr>
  </table>
  <p align=\"left\">&nbsp;</p>
  </center>
</div>
<div align=\"center\">
  <center>
  <div align=\"center\">
    <table border=\"0\" cellpadding=\"6\" cellspacing=\"0\" width=\"600\" id=\"table2\">
      <tr>
		<td>
         <font face=\"Arial\" size=\"2\" color=\"#00923F\">Otros modelos en " . $matriz[$iterador][3] . "</font></td>
	  </tr>
	  <tr><td style=\"border-bottom-style: solid; border-bottom-width: 1px\">";
			foreach ($matriz_productos_de_cada_medida[$matriz[$iterador][3]] as $value) {
				$medida_temp = str_replace ('/', '-', $medida);
				$nombre_temp = str_replace (' ', '-', strtolower ($value));
				$nombre_temp = str_replace ('/', '-', $nombre_temp);
				$nombre_temp = str_replace ('ñ', 'n', $nombre_temp);
				$nombre_temp = str_replace ('á', 'a', $nombre_temp);
				$nombre_temp = str_replace ('é', 'e', $nombre_temp);
				$nombre_temp = str_replace ('í', 'i', $nombre_temp);
				$nombre_temp = str_replace ('ó', 'o', $nombre_temp);
				$nombre_temp = str_replace ('ú', 'u', $nombre_temp);
				$nombre_temp = str_replace ('&', '-y-', $nombre_temp);
				$string_htm .= "<a href = \"neumaticos-" . $medida_temp . "-" . $nombre_temp . ".htm\">" . $value . "</a>" . " - ";
			}
			$string_htm = substr ($string_htm, 0, -3);
			$string_htm .= "</td></tr>
	  <tr>
        <td>
         <font face=\"Arial\" color=\"#00923F\">Otras medidas de " . $matriz[$iterador][2] . "</font></td>
	  </tr><tr><td>";	
			foreach ($matriz_medidas_de_cada_producto[$matriz[$iterador][2]] as $value) {
				$nombre_temp = str_replace (' ', '-', strtolower ($matriz[$iterador][2]));
				$nombre_temp = str_replace ('/', '-', $nombre_temp);
				$nombre_temp = str_replace ('ñ', 'n', $nombre_temp);
				$nombre_temp = str_replace ('á', 'a', $nombre_temp);
				$nombre_temp = str_replace ('é', 'e', $nombre_temp);
				$nombre_temp = str_replace ('í', 'i', $nombre_temp);
				$nombre_temp = str_replace ('ó', 'o', $nombre_temp);
				$nombre_temp = str_replace ('ú', 'u', $nombre_temp);
				$nombre_temp = str_replace ('&', '-y-', $nombre_temp);
				$medida_temp = str_replace ('r', '-r', str_replace ('/', '-', strtolower($value)));
				$string_htm .= "<a href = \"neumaticos-" . $medida_temp . "-" . $nombre_temp . ".htm\">" . $value . "</a>" . " - ";
			}
			$string_htm = substr ($string_htm, 0, -3);
			$string_htm .= "</td></tr></table>
  </div>
  </center>
</div>
<div align=\"center\">
  <center>
  <table cellspacing=\"0\" border=\"0\" height=\"55\" cellpadding=\"0\" width=\"600\">
    <tr>
      <td height=\"32\">
      <p align=\"center\"><font face=\"Arial\" size=\"2\">&nbsp; <br>
      Para solicitar más información complete el siguiente formulario<br>
      &nbsp;&nbsp;</font></p></td>
    </tr>
    <tr>
      <td height=\"37\">
      <form action=\"http://www.viarrural.com.ar/local-cgi/FormMail.pl\" method=\"post\">
        <input name=\"email\" type=\"hidden\" value=\"formularios@viarrural.com.ar\">
        <input name=\"recipient\" type=\"hidden\" value=\"formularios@viarrural.com.ar\">
        <input name=\"redirect\" type=\"hidden\" value=\"http://www.viarural.com.ar/viarural.com.ar/formulario/gracias.htm\">
        <input name=\"subject\" type=\"hidden\" value=\"GOODYEAR - " . strtoupper ($matriz[$iterador][2]) . " - " . $matriz[$iterador][3] . "\">
        <div align=\"center\">
          <div align=\"center\">
            <table cellspacing=\"0\" border=\"0\" height=\"65\" cellpadding=\"0\" width=\"590\">
              <tr>
                <td height=\"33\" colspan=\"4\" width=\"563\">
                <p align=\"center\"><font face=\"Arial\" size=\"2\">Nombre y Apellido 
                o Razón Social:</font> <font face=\"Arial\" size=\"2\">
                <input name=\"nombre\" size=\"38\" style=\"font-size: 10pt; font-family: Arial\"></font></p></td>
              </tr>
              <tr>
                <td height=\"32\" width=\"82\"><font face=\"Arial\" size=\"2\">&nbsp; 
                Email:</font></td>
                <td height=\"32\" width=\"201\"><font face=\"Arial\" size=\"2\">
                <input name=\"mail\" size=\"32\" style=\"font-size: 10pt; font-family: Arial\"></font></td>
                <td height=\"32\" width=\"72\"><font face=\"Arial\" size=\"2\">&nbsp; 
                Teléfono:</font></td>
                <td height=\"32\" width=\"208\"><font face=\"Arial\" size=\"2\">
                <input name=\"telefono\" size=\"32\" style=\"font-size: 10pt; font-family: Arial\"></font></td>
              </tr>
              <tr>
                <td height=\"32\" width=\"82\"><font face=\"Arial\" size=\"2\">&nbsp; 
                Ciudad:</font></td>
                <td height=\"32\" width=\"201\"><font face=\"Arial\" size=\"2\">
                <input name=\"ciudad\" size=\"32\" style=\"font-size: 10pt; font-family: Arial\"></font></td>
                <td height=\"32\" width=\"72\"><font face=\"Arial\" size=\"2\">&nbsp; 
                País:</font></td>
                <td height=\"32\" width=\"208\"><font face=\"Arial\" size=\"2\">
                <input name=\"pais\" size=\"32\" value=\"Argentina\" style=\"font-size: 10pt; font-family: Arial\"></font></td>
              </tr>
            </table>
          </div>
        </div>
        <div align=\"center\">
          <div align=\"center\">
            <table cellspacing=\"0\" border=\"0\" height=\"163\" cellpadding=\"6\" width=\"590\">
              <tr>
                <td height=\"1\" valign=\"top\" width=\"105\">
                <font face=\"Arial\" size=\"2\">Comentarios:&nbsp;</font></td>
                <td height=\"1\" width=\"467\"><font face=\"Arial\" size=\"2\">
                <textarea name=\"Comentarios\" rows=\"4\" cols=\"53\"></textarea></font></td>
              </tr>
              <tr>
                <td height=\"1\" width=\"105\"></td>
                <td height=\"1\" width=\"467\">
                <p align=\"right\"><font face=\"Arial\" size=\"2\">
                <input type=\"submit\" value=\"Enviar\"></font></p></td>
              </tr>
            </table>
          </div>
        </div>
      </form>
      </td>
    </tr>
  </table>
  </center>
</div>
<p align=\"center\"><font face=\"Arial\" size=\"2\"><a href=\"default.htm\">
<img src=\"logo.gif\" border=\"0\" height=\"52\" alt=\"NEUMATICOS GOODYEAR\" width=\"230\"></a></font></p>
<p align=\"center\">
<a href=\"http://www.viarural.com.ar\" target=\"_top\" style=\"text-decoration: none\">
<img src=\"http://www.viarural.com.ar/viarural.com.ar/portada/logo-via-rural.gif\" border=\"0\" height=\"58\" alt=\"NEUMATICOS\" width=\"230\"></a></p>
<p align=\"center\">
<a href=\"http://www.viarural.com.ar/viarural.com.ar/servicios/exposiciones/ag-connect/default.htm\">
<img src=\"http://www.viarural.com.ar/viarural.com.ar/servicios/exposiciones/ag-connect/logo-red.gif\" border=\"0\" height=\"33\" alt=\"AG CONNECT - EXPOSICION DE MAQUINARIA AGRICOLA\" width=\"149\"></a></p>
<map name=\"bandeiras\">
<area href=\"http://www.viarural.com.ar\" shape=\"rect\" coords=\"27, 7, 55, 26\" alt=\"Agricultura y Ganaderia Argentina\" target=\"_top\">
<area href=\"http://www.viarural.com.bo\" shape=\"rect\" coords=\"74, 7, 102, 26\" alt=\"Agricultura y Ganaderia Bolivia\" target=\"_top\">
<area href=\"http://br.viarural.com\" shape=\"rect\" coords=\"121, 7, 149, 26\" alt=\"Agricultura e Pecuaria do Brasil\" target=\"_top\">
<area href=\"http://www.viarural.cl\" shape=\"rect\" coords=\"168, 7, 196, 26\" alt=\"Agricultura y Ganaderia Chile\" target=\"_top\">
<area href=\"http://www.viarural.com.co\" shape=\"rect\" coords=\"215, 7, 243, 26\" alt=\"Agricultura y Ganaderia Colombia\" target=\"_top\">
<area href=\"http://www.viarural.com.ec\" shape=\"rect\" coords=\"263, 7, 290, 26\" alt=\"Agricultura y Ganaderia Ecuador\" target=\"_top\">
<area href=\"http://www.viarural.com.es\" shape=\"rect\" coords=\"310, 7, 337, 26\" alt=\"Agricultura y Ganaderia Espana\" target=\"_top\">
<area href=\"http://www.viarural.com.mx\" shape=\"rect\" coords=\"356, 7, 384, 26\" alt=\"Agricultura y Ganaderia Mexico\" target=\"_top\">
<area href=\"http://www.viarural.com.py\" shape=\"rect\" coords=\"403, 7, 431, 26\" alt=\"Agricultura y Ganaderia Paraguay\" target=\"_top\">
<area href=\"http://www.viarural.com.pe\" shape=\"rect\" coords=\"450, 7, 478, 26\" alt=\"Agricultura y Ganaderia Peru\" target=\"_top\">
<area href=\"http://www.viarural.com.uy\" shape=\"rect\" coords=\"498, 7, 525, 26\" alt=\"Agricultura y Ganaderia Uruguay\" target=\"_top\">
<area href=\"http://www.viarural.com.ve\" shape=\"rect\" coords=\"544, 7, 572, 26\" alt=\"Agricultura y Ganaderia Venezuela\" target=\"_top\">
</map>
<p align=\"center\">
<img src=\"http://www.viarural.com.ar/viarural.com.ar/bandeiras.gif\" border=\"0\" height=\"34\" usemap=\"#bandeiras\" width=\"600\"></p>
</body>
</html>";
			fwrite ($archivo, $string_htm);
			fclose ($archivo);
		}
		$iterador ++;
	}
	echo "listo";
?>