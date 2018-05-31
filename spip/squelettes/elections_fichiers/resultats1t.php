<?php
include_once("../mes_fonctions.php");
//echo '<table class="table table-striped"><th>Binômes</th><th>Nuances</th><th>Résultats<br/>1er tour</th>';
//echo '<table class="table table-striped"><th>Binômes</th><th>Nuances</th><th>Résultats<br/>2ème tour</th>';
echo '<table class="table"><th>Binômes</th><th>Nuances</th><th>R&eacute;sultat</th>';
$row = 1;
$ligne_resultat =array();
if (($handle = fopen("resultats.csv", "r")) !== FALSE) {
	while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
		$num = count($data);
		$row++;
		if ($_GET["id_canton"]<=9) {$id_canton="cant0".$_GET["id_canton"];} else {$id_canton="cant".$_GET["id_canton"];}
			if ($data[3]==$id_canton) {
				$ligne = "<tr class='elus".$data[6]."'><td width=60%>".str_replace(CHR(10),"<br/>",$data[1])."</td><td>".nuancebinome($data[2])."</td><td>".$data[4]."</td></tr>";
				$ligne_resultat[$data[5]] = $ligne;
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