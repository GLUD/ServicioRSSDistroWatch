<form action="http://localhost/test.php" method="post">
	<p>Consulte una cuenta de Twitter</p>
	<p>Cuenta = 
	<input  type="string" name="a" maxlength="20"/>
	<input type="submit" value="Consultar" name="si"> 



<?php 

$direccion = "http://www.twitter.com/";
$a = $_POST['a'];
$cuenta = trim($a);
$URL = trim($direccion.$cuenta);

echo ($URL);
if($_POST[si]){
echo ($URL);
$texto = file_get_contents($URL);
}
echo ($texto);

?>

