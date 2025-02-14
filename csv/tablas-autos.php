<?
	$matriz = array ();
	$handle1 = fopen ("auto.csv", "r");
	while ($array = fgetcsv ($handle1, 110, ';')) {
		$matriz [] = $array;
	}
	sort ($matriz);
	$iterador = 0;
	$string_nombre_archivo = str_replace (' ', '-', strtolower ($matriz[$iterador][1]));
	$archivo = fopen ($string_nombre_archivo . '.htm', "w");
	fwrite ($archivo, "<html><body bgcolor = \"EBEEF3\"><div align = \"center\"><center>
	<table cellspacing=\"0\" id=\"AutoNumber5\" bordercolor=\"#FFFFFF\" border=\"1\" cellpadding=\"6\" width=\"600\">
    <tr>
      <td align=\"center\" width=\"99\"><font face=\"Arial\" size=\"2\">Medida</font></td>
      <td align=\"center\" width=\"76\"><font face=\"Arial\" size=\"2\">Indice</font></td>
      <td align=\"center\" width=\"96\"><font face=\"Arial\" size=\"2\">Ancho<br>de sección (mm)</font></td>
      <td align=\"center\" width=\"103\"><font face=\"Arial\" size=\"2\">Diámetro externo<br>(mm)</font></td>
      <td align=\"center\" width=\"87\"><font face=\"Arial\" size=\"2\">Medida<br>de llanta (pulgadas)</font></td>
      <td align=\"center\" width=\"137\"><font face=\"Arial\" size=\"2\">Llantas<br>permitidas (pulgadas)</font></td>
    </tr>");
	while ($matriz[$iterador + 1]) {
		fwrite ($archivo, "<tr>
			<td align=\"center\" width=\"99\"><font face=\"Arial\" size=\"2\">" . $matriz[$iterador][2] . "</font></td>
			<td align=\"center\" width=\"76\"><font face=\"Arial\" size=\"2\">" . $matriz[$iterador][11] . " " . $matriz[$iterador][6] . "</font></td>
			<td align=\"center\" width=\"96\"><font face=\"Arial\" size=\"2\">" . $matriz[$iterador][9] . "</font></td>
			<td align=\"center\" width=\"103\"><font face=\"Arial\" size=\"2\">" . $matriz[$iterador][10] . "</font></td>
			<td align=\"center\" width=\"87\"><font face=\"Arial\" size=\"2\">" . $matriz[$iterador][7] . "</font></td>
			<td align=\"center\" width=\"137\"><font face=\"Arial\" size=\"2\">" . $matriz[$iterador][8] . "</font></td></tr>");
		if ($matriz[$iterador][1] != $matriz[$iterador + 1][1]) {
			fwrite ($archivo, "</table></center></div></body></html>");
			fclose ($archivo);
			$string_nombre_archivo = str_replace (' ', '-', strtolower ($matriz[$iterador + 1][1]));
			$archivo = fopen ($string_nombre_archivo . '.htm', "w");
			fwrite ($archivo, "<html><body bgcolor = \"EBEEF3\"><div align = \"center\"><center>
			<table cellspacing=\"0\" id=\"AutoNumber5\" bordercolor=\"#FFFFFF\" border=\"1\" cellpadding=\"6\" width=\"600\">
			<tr>
			<td align=\"center\" width=\"99\"><font face=\"Arial\" size=\"2\">Medida</font></td>
			<td align=\"center\" width=\"76\"><font face=\"Arial\" size=\"2\">Indice</font></td>
			<td align=\"center\" width=\"96\"><font face=\"Arial\" size=\"2\">Ancho<br>de sección (mm)</font></td>
			<td align=\"center\" width=\"103\"><font face=\"Arial\" size=\"2\">Diámetro externo<br>(mm)</font></td>
			<td align=\"center\" width=\"87\"><font face=\"Arial\" size=\"2\">Medida<br>de llanta (pulgadas)</font></td>
			<td align=\"center\" width=\"137\"><font face=\"Arial\" size=\"2\">Llantas<br>permitidas (pulgadas)</font></td>
			</tr>");
		}
		$iterador ++;
	}
	fwrite ($archivo, "<tr>
      <td align=\"center\" width=\"99\"><font face=\"Arial\" size=\"2\">" . $matriz[$iterador][2] . "</font></td>
      <td align=\"center\" width=\"76\"><font face=\"Arial\" size=\"2\">" . $matriz[$iterador][11] . " " . $matriz[$iterador][6] . "</font></td>
      <td align=\"center\" width=\"96\"><font face=\"Arial\" size=\"2\">" . $matriz[$iterador][9] . "</font></td>
      <td align=\"center\" width=\"103\"><font face=\"Arial\" size=\"2\">" . $matriz[$iterador][10] . "</font></td>
      <td align=\"center\" width=\"87\"><font face=\"Arial\" size=\"2\">" . $matriz[$iterador][7] . "</font></td>
      <td align=\"center\" width=\"137\"><font face=\"Arial\" size=\"2\">" . $matriz[$iterador][8] . "</font></td>
	  </tr></table></center></div></body></html>");
?>