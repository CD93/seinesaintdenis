<?php
function formulaires_caf_charger_dist()
{
	$valeurs = array
	(
		'revenus' 			=> '',
		'presta' 			=> '',
		'parts' 			=> ''
	);
	return $valeurs;
}

function formulaires_caf_verifier_dist()
{
}

function formulaires_caf_traiter_dist()
{
	$retour = array('editable' => true);
	$quotient=((_request('revenus')/12)+_request('presta'))/_request('parts');
	$retour ="Votre quotient CAF : ".round($quotient); 
	if(round($quotient)<250){$lettre="A";}
	elseif(round($quotient)<350){$lettre="B";}
	elseif(round($quotient)<460){$lettre="C";}
	elseif(round($quotient)<580){$lettre="D";}
	elseif(round($quotient)<700){$lettre="E";}
	elseif(round($quotient)<800){$lettre="F";}
	elseif(round($quotient)<950){$lettre="G";}
	elseif(round($quotient)<1100){$lettre="H";}
	elseif(round($quotient)<1300){$lettre="I";}
	elseif(round($quotient)<1600){$lettre="J";}
	else{$lettre="K";}
	$retour .="<br/>Votre lettre est : ".$lettre;
	return array("message_ok" =>$retour);
}
?>