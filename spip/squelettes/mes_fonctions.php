<?php
function filtre_nb_joueurs($v) {
	$select="LEFT(`maj`,10) as datemaj,COUNT(*) as nb";
	$from="`spip_auteurs`";
	$where="`bio` !='' AND `statut`='6forum'";
	$groupby="datemaj";
	$res = array();
	$tot = 0;
	if ($resultats = sql_allfetsel($select, $from, $where, $groupby)) {
		foreach ($resultats as $l) {
			$res[$l['datemaj']] = $l['nb'];
			$tot += $l['nb'];
		}
	}
	//$resultats = array("1","2");
	$res['total']=$tot;
	return $res;
}
function filtre_timestamp2datespip($timestamp) {
	return date('d/m/Y', $timestamp);
}
function filtre_nettoyer_url_fb($texte) {
	$pattern = '/href="([^&]*)/';
	return preg_replace_callback($pattern,"nettoyage_url", $texte);
}
function nettoyage_url($matches) {
	$url = str_replace('/l.php?u=','',rawurldecode($matches[1]));
	return 'href="'.$url.'"';
}
function filtre_creer_date_liste($date="2014-05") {
	$current_month = substr($date,-2);
	$current_year = substr($date,0,4);
	$value = array();
	$value2=$current_month;
	$value3=$current_year;
	for($i = 0, $m = $current_month, $y = $current_year; $i < 12; $i++, $m++) {
        if($m > 12) {
            $m = 1;
            $y++;
        }
        if(strlen($m) < 2) {
           $value[] = $y."-0".$m;
        } else {
	        $value[] = $y."-".$m;
        }
    }
    return $value;
  }
function filtre_issecure() {
	return
		(!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
		|| $_SERVER['SERVER_PORT'] == 443;
}
	function nuancebinome($nuanceabb){
		$nuance = array(
			"BC-EXG" => "Extrême gauche",
			"BC-FG" => "Front de Gauche",
			"BC-PG" => "Parti de Gauche",
			"BC-COM" => "Parti communiste français",
			"BC-SOC" => "Parti Socialiste",
			"BC-UG" => "Union de la Gauche",
			"BC-RDG" => "Parti radical de gauche",
			"BC-DVG" => "Divers gauche",
			"BC-VEC" => "Europe-Ecologie-Les Verts",
			"BC-DIV" => "Divers",
			"BC-MDM" => "Modem",
			"BC-UC" => "Union du Centre",
			"BC-UDI" => "Union Démocrates et Indépendants",
			"BC-UMP" => "Union pour un Mouvement Populaire",
			"BC-UD" => "Union de la Droite",
			"BC-DLF" => "Debout la France",
			"BC-DVD" => "Divers droite",
			"BC-FN" => "Front National",
			"BC-EXD" => "Extrême droite"
		);
		return $nuance[$nuanceabb];
	}
?>