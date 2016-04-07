<?php
if (isset($_POST["anio"])) {

$anio=$_POST["anio"];
$url="http://distrowatch.com/index.php?dataspan=".$anio;
$myHTML = file_get_contents($url);
# Create a DOM parser object
$dom = new DOMDocument();
$dom->loadHTML($myHTML);
$finder = new DomXPath($dom);
$tablas = $finder->query('//body/table[2]/tr/td[3]/table[2]');
$filas = array();
foreach ($tablas as $tabla) {
    $nodes = $tabla->childNodes;
    foreach ($nodes as $i => $node) {
        if($i>2){
            $valores = explode("\n", $node->nodeValue);
            $filas[] = [
                'posicion'=>intval($valores[0]),
                'nombre'=>ltrim($valores[1]),
                'visitas_por_dia'=>intval($valores[2])
            ];
        }
    }
}

header('Content-type: text/xml; charset="utf-8"', true);
echo '<?xml version="1.0" encoding="utf-8"?>';

// Y generamos nuestro documento
echo '<rss version="2.0">';

echo '<channel>
      <title>Ranking Hits Per Day de Distrowatch</title>
      <link>http://distrowatch.com/</link>
      <language>es-CO</language>
      <description>Visitas por día de las distribuciones GNU/Linux</description>
      <generator>Grupo GNU/Linux Udistrital</generator>';

foreach ($filas as $fila) {
echo '<item>
         <title>'.$fila['nombre'].'</title>
         <link>http://glud.org/news.php?id='.$fila['posicion'].'</link>
         <pubDate>'.date('r', time()).'</pubDate>
         <category>'.$fila['posicion'].'</category>
         <description><![CDATA['.$fila['visitas_por_dia'].']]></description>
      </item>';
}
   echo'   
   </channel>
</rss>';

}
?>
<?php if (!isset($_POST["anio"])):
header("Content-Type: text/html; charset=utf-8");
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset=utf-8 />
</head>
<body>
    <form action="test2.php" method="post">
            <p>Consulte las distros mas populares</p>
            <label>Año = </label>
            <input name="anio" type="number" maxlength="4"/>
            <input type="submit" value="Consultar">
    </form>
</body>
</html>
<?php endif; ?>
