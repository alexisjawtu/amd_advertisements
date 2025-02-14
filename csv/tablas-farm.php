<?
	$matriz = array ();
	$array_productos = array ();
	$handle1 = fopen ("farm.csv", "r");
	$i = 0;
	while ($array = fgetcsv ($handle1, 111, ';')) {
		if ($array[0]) {
			$matriz [] = $array;
			echo "fila " . ($i + 1) . " guardada... <br>\n";
			$i ++;
			$array_productos[] = $array[0];
		}
	}
	sort ($matriz);
	//print_r ($matriz);
	$iterador = 0;
	$string_nombre_archivo = str_replace (' ', '-', strtolower ($matriz[$iterador][0]));
	$string_nombre_archivo = str_replace ('/', '-', $string_nombre_archivo);
	$string_nombre_archivo = str_replace ('ñ', 'n', $string_nombre_archivo);
	$string_nombre_archivo = str_replace ('á', 'a', $string_nombre_archivo);
	$string_nombre_archivo = str_replace ('é', 'e', $string_nombre_archivo);
	$string_nombre_archivo = str_replace ('í', 'i', $string_nombre_archivo);
	$string_nombre_archivo = str_replace ('ó', 'o', $string_nombre_archivo);
	$string_nombre_archivo = str_replace ('ú', 'u', $string_nombre_archivo);
	$archivo = fopen ($string_nombre_archivo . '.htm', "w");
	fwrite ($archivo, "<html><body bgcolor = \"EBEEF3\"><div align = \"center\"><center>
	<table cellspacing=\"0\" id=\"AutoNumber5\" bordercolor=\"#FFFFFF\" border=\"1\" cellpadding=\"6\" width=\"600\">
    <tr>
      <td align=\"center\" width=\"99\"><font face=\"Arial\" size=\"2\">Medida</font></td>
      <td align=\"center\" width=\"76\"><font face=\"Arial\" size=\"2\">Tipo<br>de uso</font></td>
      <td align=\"center\" width=\"96\"><font face=\"Arial\" size=\"2\">Capacidad<br>de telas</font></td>
      <td align=\"center\" width=\"103\"><font face=\"Arial\" size=\"2\">Presión<br>máxima<br>(psi)</font></td>
      <td align=\"center\" width=\"87\"><font face=\"Arial\" size=\"2\">Carga<br>máxima<br>(kg)</font></td>
      <td align=\"center\" width=\"137\"><font face=\"Arial\" size=\"2\">Ancho de<br>llanta<br>(pulgadas)</font></td>
      <td align=\"center\" width=\"137\"><font face=\"Arial\" size=\"2\">Diámetro<br>externo<br>(mm)</font></td>
    </tr>");
	while ($matriz[$iterador + 1]) {
		fwrite ($archivo, "<tr>
			<td align=\"center\" width=\"99\"><font face=\"Arial\" size=\"2\">" . $matriz[$iterador][2] . "</font></td>
			<td align=\"center\" width=\"76\"><font face=\"Arial\" size=\"2\">" . $matriz[$iterador][8] . "</font></td>
			<td align=\"center\" width=\"96\"><font face=\"Arial\" size=\"2\">" . $matriz[$iterador][3] . "</font></td>
			<td align=\"center\" width=\"103\"><font face=\"Arial\" size=\"2\">" . $matriz[$iterador][5] . "</font></td>
			<td align=\"center\" width=\"87\"><font face=\"Arial\" size=\"2\">" . $matriz[$iterador][4] . "</font></td>
			<td align=\"center\" width=\"87\"><font face=\"Arial\" size=\"2\">" . $matriz[$iterador][7] . "</font></td>
			<td align=\"center\" width=\"137\"><font face=\"Arial\" size=\"2\">" . $matriz[$iterador][6] . "</font></td></tr>");
		if ($matriz[$iterador][0] != $matriz[$iterador + 1][0]) {
			fwrite ($archivo, "</table></center></div></body></html>");
			fclose ($archivo);
			$string_nombre_archivo = str_replace (' ', '-', strtolower ($matriz[$iterador + 1][0]));
			$string_nombre_archivo = str_replace ('/', '-', $string_nombre_archivo);
			$string_nombre_archivo = str_replace ('ñ', 'n', $string_nombre_archivo);
			$string_nombre_archivo = str_replace ('á', 'a', $string_nombre_archivo);
			$string_nombre_archivo = str_replace ('é', 'e', $string_nombre_archivo);
			$string_nombre_archivo = str_replace ('í', 'i', $string_nombre_archivo);
			$string_nombre_archivo = str_replace ('ó', 'o', $string_nombre_archivo);
			$string_nombre_archivo = str_replace ('ú', 'u', $string_nombre_archivo);
			$archivo = fopen ($string_nombre_archivo . '.htm', "w");
			fwrite ($archivo, "<html><body bgcolor = \"EBEEF3\"><div align = \"center\"><center>
			<table cellspacing=\"0\" id=\"AutoNumber5\" bordercolor=\"#FFFFFF\" border=\"1\" cellpadding=\"6\" width=\"600\">
			<tr>
			<td align=\"center\" width=\"99\"><font face=\"Arial\" size=\"2\">Medida</font></td>
			<td align=\"center\" width=\"76\"><font face=\"Arial\" size=\"2\">Tipo<br>de uso</font></td>
			<td align=\"center\" width=\"96\"><font face=\"Arial\" size=\"2\">Capacidad<br>de telas</font></td>
			<td align=\"center\" width=\"103\"><font face=\"Arial\" size=\"2\">Presión<br>máxima<br>(psi)</font></td>
			<td align=\"center\" width=\"87\"><font face=\"Arial\" size=\"2\">Carga<br>máxima<br>(kg)</font></td>
			<td align=\"center\" width=\"137\"><font face=\"Arial\" size=\"2\">Ancho de<br>llanta<br>(pulgadas)</font></td>
			<td align=\"center\" width=\"137\"><font face=\"Arial\" size=\"2\">Diámetro<br>externo<br>(mm)</font></td>
			</tr>");
		}
		$iterador ++;
	}
	fwrite ($archivo, "<tr>
			<td align=\"center\" width=\"99\"><font face=\"Arial\" size=\"2\">" . $matriz[$iterador][2] . "</font></td>
			<td align=\"center\" width=\"76\"><font face=\"Arial\" size=\"2\">" . $matriz[$iterador][8] . "</font></td>
			<td align=\"center\" width=\"96\"><font face=\"Arial\" size=\"2\">" . $matriz[$iterador][3] . "</font></td>
			<td align=\"center\" width=\"103\"><font face=\"Arial\" size=\"2\">" . $matriz[$iterador][5] . "</font></td>
			<td align=\"center\" width=\"87\"><font face=\"Arial\" size=\"2\">" . $matriz[$iterador][4] . "</font></td>
			<td align=\"center\" width=\"87\"><font face=\"Arial\" size=\"2\">" . $matriz[$iterador][7] . "</font></td>
			<td align=\"center\" width=\"137\"><font face=\"Arial\" size=\"2\">" . $matriz[$iterador][6] . "</font></td>
	  </tr></table></center></div></body></html>");
	print_r ($array_productos);
	print_r (array_count_values(array_values ($array_productos)));
	echo count (array_count_values(array_values ($array_productos)));
?>