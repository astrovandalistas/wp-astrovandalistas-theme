<?php 


$titulos = array();

$titulos['inicio'] = 0;
$titulos['proyectos'] = 0;
$titulos['Árma Sonora Telemática'] = array("Presentación","Código","Hardware","Galería","Bitácora");

foreach ($titulos as $key => $value) {
	echo $key."  ".$value;
}

 ?>