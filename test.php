<form action="http://localhost/test.php" method="post">
	<p>Consulte las distros mas populares</p>
	<p>Año = 
	<input  type="number" name="a" maxlength="4"/>
	<input type="submit" value="Consultar" name="si"> 
	<input type="submit" value="Ultimos meses" name="po"> </p>

<?php 


//Para caracteres especiales
header("Content-Type: text/html; charset=utf-8");


//Si se inicia la busqueda

if ($_POST[si]) {
$t=$_POST[a];
$w="http://distrowatch.com/index.php?dataspan=".$t;
printf("Busqueda para el año  " .$t);
//Capturamos la web
	
	$texto = file_get_contents($w);

}
if ($_POST[po]) {
printf("Busqueda de popularidad para los ultimos meses");
	
	$texto = file_get_contents("http://distrowatch.com/dwres.php?resource=popularity");

}

echo $texto;
?>
