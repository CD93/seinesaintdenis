<?php
include_once("../mes_fonctions.php");
//echo '<table class="table table-striped"><th>Binômes</th><th>Nuances</th><th>Résultats<br/>1er tour</th>';
//echo '<table class="table table-striped"><th>Binômes</th><th>Nuances</th><th>Résultats<br/>2ème tour</th>';
echo '<table class="table table-striped"><th>Binômes</th><th>Nuances</th>';
$row = 1;
if (($handle = fopen("resultats.csv", "r")) !== FALSE) {
	while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
		$num = count($data);
		$row++;
		if ($_GET["id_canton"]<=9) {$id_canton="cant0".$_GET["id_canton"];} else {$id_canton="cant".$_GET["id_canton"];}
		if ($data[3]==$id_canton) {
				echo "<tr><td width=60%>".str_replace(CHR(10),"<br/>",$data[1])."</td><td>".nuancebinome($data[2])."</td></tr>";
				//echo "<tr><td>".str_replace(CHR(10),"<br/>",$data[1])."</td><td>".substr($data[2],3)."</td><td>".$data[3]."</td></tr>";
				//echo "<tr><td>".str_replace(CHR(10),"<br/>",$data[1])."</td><td>".substr($data[2],3)."</td><td>".$data[4]."</td></tr>";
			}
	}
	fclose($handle);
}
echo "</table>";
?>