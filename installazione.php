<?php
	include "/var/www/html/iscrizioni/newCDB.php";
	
	$inst=new CDB();
	$r=$inst->test();
	
	$inst->fcreaCitta();
	if($r=$inst->fcreaCitta()){
		echo "Errore tabella Città<br>".$r;
		return "";
	}
	$inst->fcreaRuoli();
	if($r=$inst->fcreaRuoli()){
		echo "Errore tabella Ruoli<br>".$r;
		return "";
	}
	$inst->fcreaNazioni();
	if($r=$inst->fcreaNazioni()){
		echo "Errore tabella Nazioni<br>".$r;
		return "";
	}
	$inst->fcreaComponenti();
	if($r=$inst->fcreaComponenti()){
		echo "Errore tabella Componenti<br>".$r;
		return "";
	}
	$inst->fcreaAnagrafiche();
	if($r=$inst->fcreaAnagrafiche()){
		echo "Errore tabella Anagrafiche<br>".$r;
		return "";
	}
	$inst->fcreaAccount();
	if($r=$inst->fcreaAccount()){
		echo "Errore tabella Account<br>".$r;
		return "";
	}
	$inst->fcreaCittadinanze();
	if($r=$inst->fcreaCittadinanze()){
		echo "Errore tabella Cittadinanze<br>".$r;
		return "";
	}
	$inst->fcreaRuoliAnagrafica();
	if($r=$inst->fcreaRuoliAnagrafica()){
		echo "Errore tabella RuoliAnagrafica<br>".$r;
		return "";
	}	
?>	
