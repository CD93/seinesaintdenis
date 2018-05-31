<?php
include_once("../mes_fonctions.php");
//echo '<table class="table table-striped"><th>Binômes</th><th>Nuances</th><th>Résultats<br/>1er tour</th>';
//echo '<table class="table table-striped"><th>Binômes</th><th>Nuances</th><th>Résultats<br/>2ème tour</th>';
echo '<table class="table">';
$row = 1;
$ligne_resultat =array();
if (($handle = fopen("colleges-travaux.csv", "r")) !== FALSE) {
	while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
		$num = count($data);
		$row++;
		if ($_GET["code_rne"]<=9) {$code_rne=$_GET["code_rne"];} else {$code_rne=$_GET["code_rne"];}
			if ($data[0]==$code_rne) {
				$ligne = "<tr><td>".$data[4]."</td><td>".$data[6]."</td></tr>";
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