<?
	$matriz = array ();
	$array_productos = array ();
	$handle1 = fopen ("lt.csv", "r");
	$i = 0;
	while ($array = fgetcsv ($handle1, 107, ';')) {
		if ($array[0]) {
			$matriz [] = $array;
			echo "fila " . ($i + 1) . " guardada... <br>\n";
			$array_productos[] = $array[0];
			$i ++;
		}
	}
	sort ($matriz);
	$iterador = 0;
	$string_nombre_archivo = str_replace (' ', '-', strtolower ($matriz[$iterador][0]));
	$string_nombre_archivo = str_replace ('/', '-', $string_nombre_archivo);
	$string_nombre_archivo = str_replace ('�', 'n', $string_nombre_archivo);
	$string_nombre_archivo = str_replace ('�', 'a', $string_nombre_archivo);
	$string_nombre_archivo = str_replace ('�', 'e', $string_nombre_archivo);
	$string_nombre_archivo = str_replace ('�', 'i', $string_nombre_archivo);
	$string_nombre_archivo = str_replace ('�', 'o', $string_nombre_archivo);
	$string_nombre_archivo = str_replace ('�', 'u', $string_nombre_archivo);
	$string_nombre_archivo = str_replace ('&', '-y-', $string_nombre_archivo);
	if (mkdir ('goodyear lt')) echo "<br>\n<br>\nDirectorio inicializado...<br>\n<br>\n";
	print_r ($matriz);
	$archivo = fopen ('goodyear lt/' . $string_nombre_archivo . '.htm', "w");
	fwrite ($archivo, "<html><body bgcolor = \"EBEEF3\"><div align = \"center\"><center>
	<table cellspacing=\"0\" id=\"AutoNumber5\" bordercolor=\"#FFFFFF\" border=\"1\" cellpadding=\"6\" width=\"600\">
    <tr>
      <td align=\"center\" width=\"99\"><font face=\"Arial\" size=\"2\">Medida</font></td>
      <td align=\"center\" width=\"76\"><font face=\"Arial\" size=\"2\">Ancho de<br>secci�n</font></td>
	  <td align=\"center\" width=\"137\"><font face=\"Arial\" size=\"2\">Medida de<br>llanta<br>(pulgadas)</font></td>
      <td align=\"center\" width=\"96\"><font face=\"Arial\" size=\"2\">Indice<br>de carga</font></td>
      <td align=\"center\" width=\"103\"><font face=\"Arial\" size=\"2\">Indice de<br>velocidad</font></td>
      <td align=\"center\" width=\"137\"><font face=\"Arial\" size=\"2\">Di�metro<br>externo*<br>(mm)</font></td>
    </tr>");
	while ($matriz[$iterador + 1]) {
		fwrite ($archivo, "<tr>
			<td align=\"center\" width=\"99\"><font face=\"Arial\" size=\"2\"><nobr>" . $matriz[$iterador][2] . "</nobr></font></td>
			<td align=\"center\" width=\"76\"><font face=\"Arial\" size=\"2\"><nobr>" . $matriz[$iterador][5] . "</nobr></font></td>
			<td align=\"center\" width=\"96\"><font face=\"Arial\" size=\"2\">" . $matriz[$iterador][4] . "</font></td>
			<td align=\"center\" width=\"103\"><font face=\"Arial\" size=\"2\">" . $matriz[$iterador][7] . "</font></td>
			<td align=\"center\" width=\"87\"><font face=\"Arial\" size=\"2\">" . $matriz[$iterador][3] . "</font></td>
			<td align=\"center\" width=\"87\"><font face=\"Arial\" size=\"2\">" . $matriz[$iterador][6] . "</font></td>
		</tr>");
		if ($matriz[$iterador][0] != $matriz[$iterador + 1][0]) {
			fwrite ($archivo, "</table></center></div></body></html>");
			fclose ($archivo);
			$string_nombre_archivo = str_replace (' ', '-', strtolower ($matriz[$iterador + 1][0]));
			$string_nombre_archivo = str_replace ('/', '-', $string_nombre_archivo);
			$string_nombre_archivo = str_replace ('�', 'n', $string_nombre_archivo);
			$string_nombre_archivo = str_replace ('�', 'a', $string_nombre_archivo);
			$string_nombre_archivo = str_replace ('�', 'e', $string_nombre_archivo);
			$string_nombre_archivo = str_replace ('�', 'i', $string_nombre_archivo);
			$string_nombre_archivo = str_replace ('�', 'o', $string_nombre_archivo);
			$string_nombre_archivo = str_replace ('�', 'u', $string_nombre_archivo);
			$string_nombre_archivo = str_replace ('&', '-y-', $string_nombre_archivo);
			$archivo = fopen ('goodyear lt/' . $string_nombre_archivo . '.htm', "w");
			fwrite ($archivo, "<html><body bgcolor = \"EBEEF3\"><div align = \"center\"><center>
			<table cellspacing=\"0\" id=\"AutoNumber5\" bordercolor=\"#FFFFFF\" border=\"1\" cellpadding=\"6\" width=\"600\">
			<tr>
			<td align=\"center\" width=\"99\"><font face=\"Arial\" size=\"2\">Medida</font></td>
      <td align=\"center\" width=\"76\"><font face=\"Arial\" size=\"2\">Ancho de<br>secci�n</font></td>
	  <td align=\"center\" width=\"137\"><font face=\"Arial\" size=\"2\">Medida de<br>llanta<br>(pulgadas)</font></td>
      <td align=\"center\" width=\"96\"><font face=\"Arial\" size=\"2\">Indice<br>de carga</font></td>
      <td align=\"center\" width=\"103\"><font face=\"Arial\" size=\"2\">Indice de<br>velocidad</font></td>
      <td align=\"center\" width=\"137\"><font face=\"Arial\" size=\"2\">Di�metro<br>externo*<br>(mm)</font></td>
			</tr>");
		}
		$iterador ++;
	}
	fwrite ($archivo, "<tr>
			<td align=\"center\" width=\"99\"><font face=\"Arial\" size=\"2\"><nobr>" . $matriz[$iterador][2] . "</nobr></font></td>
			<td align=\"center\" width=\"76\"><font face=\"Arial\" size=\"2\"><nobr>" . $matriz[$iterador][5] . "</nobr></font></td>
			<td align=\"center\" width=\"96\"><font face=\"Arial\" size=\"2\">" . $matriz[$iterador][4] . "</font></td>
			<td align=\"center\" width=\"103\"><font face=\"Arial\" size=\"2\">" . $matriz[$iterador][7] . "</font></td>
			<td align=\"center\" width=\"87\"><font face=\"Arial\" size=\"2\">" . $matriz[$iterador][3] . "</font></td>
			<td align=\"center\" width=\"87\"><font face=\"Arial\" size=\"2\">" . $matriz[$iterador][6] . "</font></td>
	  </tr></table></center></div><br><br></body></html>");
	print_r ($array_productos);
	echo "<br>\n";
	print_r (array_count_values(array_values ($array_productos)));
	echo "<br>\n";
	echo count (array_count_values(array_values ($array_productos)));
?>