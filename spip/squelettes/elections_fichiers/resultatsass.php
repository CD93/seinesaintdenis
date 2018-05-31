<?php
include_once("../mes_fonctions.php");
//echo '<table class="table table-striped"><th>Binômes</th><th>Nuances</th><th>Résultats<br/>1er tour</th>';
//echo '<table class="table table-striped"><th>Binômes</th><th>Nuances</th><th>Résultats<br/>2ème tour</th>';
echo '<table class="table">';
$row = 1;
$ligne_resultat =array();
if (($handle = fopen("elus2015.csv", "r")) !== FALSE) {
	while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
		$num = count($data);
		$row++;
		if ($_GET["id_canton"]<=9) {$id_canton="cant0".$_GET["id_canton"];} else {$id_canton="cant".$_GET["id_canton"];}
			if ($data[0]==$id_canton) {
				$ligne = "<tr><td width='80px'><img src='squelettes/images/elus/".$data[5].".jpg' /></td><td>".$data[5]." ".$data[6]."</td><td>".$data[8]."</td></tr>";
				$ligne_resultat[$data[3]] = $ligne;
			}
			
	}
	fclose($handle);
}
ksort($ligne_resultat);
foreach ($ligne_resultat as $key => $value) {
    echo $value;
}
echo "</table>";
?>