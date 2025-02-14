<?php
	$_host_ = "192.168.4.198"; // ip interna 192.168.4.194
	$_user_ = "uv9432";
	$_clave_ = "log271828182napier";
	$_sql_dban_ = "uv9432_aranuncios";
	$_sql_dbcl_ = "uv9432_arclasificados";
	$mipais = "Argentina";
	$regiones = array ( "Buenos Aires", "Catamarca", "Chaco", "Chubut", "C�rdoba", "Corrientes", "Entre R�os", "Formosa",
				  "Jujuy", "La Pampa", "La Rioja", "Mendoza", "Misiones", "Neuqu�n", "R�o Negro", "Salta", 
				  "San Juan", "San Luis", "Santa Cruz", "Santa Fe", "Santiago del Estero", "Tierra del Fuego", 
				  "Tucum�n" );
	sort ($regiones);
	$marcas_ = array ( "Sem", "Bobcat", "Yale", "Dodge", "Valmet", "Cerro", "Logus", "Bedford", "Cummins", "Tedeschi", "Kuhn", "Perkins", "Grosspal", "Komatsu",
						"Toyota", "Renault", "Scania", "Volvo", "Volkswagen", "Barbuy", "Cestari", "Allochis", "Templar", "Agromec", "Dancar", 
					   "Schiarre", "Same", "Bernardin", "Metalfor", "Jacto", "Gherardi", "Claas", "Agrinar", "Agrometal", "Akron", "Altina", 
					   "Apache", "Agco Allis", "Ascanelli", "Bianchi", "Cafito", "Case", "Caterpillar", "Challenger", "Conese", "Deutz", "El Sol", 
					   "Fiat", "Flexi Coil", "Ford", "Gentili", "Giorgi", "Gr�as San Blas", "John Deere", "Loyto", "Mainero", "Maizco", "Mancini", 
					   "Martinez y Staneck", "Massey Ferguson", "New Holland", "Omar Martin", "Ombu", "Pierobon", "Pla", "Santa Rosa", "Stefoni", 
					   "TyM", "Valtra", "Vassalli", "VHB", "Vulcano", "Yomel", "Zanello", "Erca", "Crucianelli", "Bertini", "Crescente", "Mic", 
					   "Siam", "Michigan", "Cameco", "Mahindra", "Belarus", "Montenegro", "Fercam", "Don Roque", "Fabimag", "Tanzi", "Valenti" );
	$marcas_ = array_unique ($marcas_);
	sort ($marcas_);
	$rubros_ = array ( "Fertilizadora", "Hileradora", "Tractoelevadores", "Palas Cargadoras Invertidas", 
					   "Palas Cargadoras Frontales", "Acoplados", "Acoplados Tanque", "Arados", 
					   "Cabezales para Cosechadoras", "Cargadoras Frontales", "Casillas Rurales",
					   "Cinceles", "Cosechadoras", "Carretones", "Cultivadores", "Desmalezadoras", 
					   "Distribuidoras de Fertilizantes", "Embolsadoras - Embutidoras", "Escardillos", 
					   "Extractores de Silos", "Hoyadoras", "Maquinaria Vial", "Mezcladoras - Moledoras", "Mixers", 
					   "Motocultivadores", "Motores - Grupos Electr�genos", "Palas de Arrastre", 
					   "Picadoras", "Pulverizadoras", "Rastras", "Rastrillos", "Retroexcavadoras", "Rotoenfardadoras",
					   "Sembradoras", "Tolvas", "Topadoras", "Tractores", "Minitractores", "Grupos Electr�genos", 
					   "Autoelevadores", "Camiones", "Camiones articulados", "Cargadoras sobre neum�ticos", 
					   "Excavadoras sobre orugas", "Excavadoras sobre ruedas", "Gr�as", "Gr�as puente", "Plataformas", 
					   "Plumas", "Herramientas - Martillos neum�ticos", "Hormigoneras - Vibradores",
					   "Iluminaci�n - Columnas - Torres", "Manipuladores telesc�picos", "Minicargadoras", 
					   "Miniexcavadoras", "Motoniveladoras", "Pilotes - t�neles", "Plataformas elevadoras", 
					   "Topadoras - Bulldozer","Zanjadoras", "Aplanadoras", "Compactadoras", "Carretones viales", 
					   "Compresores para herramientas neum�ticas", "M�quinas pavimentadoras para asfalto",
					   "M�quinas pavimentadoras para hormig�n", "Minicompactadoras", "Niveladoras", "Bombas", 
					   "Bombas industriales", "Camiones fuera de ruta", "Equipos de medici�n y control", "Excavadoras - palas", 
					   "Perforadoras", "Trituradoras", "Aparatos individuales de bombeo - Cig�e�as", 
					   "Motobombas contra incendio", "Motobombeadores", "Tanques", "Chimango" );
	$rubros_ = array_unique ($rubros_);
	sort ($rubros_);
	$redirectayuda = "http://ar.viarural.com/usuarios/action.php?choice=Ver";
	$miweb  = "www.viarural.com.ar";
	$webusuarios = "ar.viarural.com";
	$array_clases_avisos = array (10476737 => 1, 30791 => 2, 248347 => 3);
	print_r ($rubros_);
?>