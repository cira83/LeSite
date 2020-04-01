<?php
	$nom = $_GET[elv];
	$fait = "&#9679;";
	$non_fait = "&#9675;";
	$classe = $_COOKIE["laclasse"]; if($classe=="") $classe="CIRA1";
	
	$repertoire_rep = "./files/$classe/_Copies/$nom/rep";
	$liste_fichier = scandir($repertoire_rep);
	foreach($liste_fichier as $reponse) {
		if(strpos("_$reponse", "I")) {
			$part1 = explode("I", $reponse);
			$part2 = explode(".", $part1[1]);
			$nb_quest = $part2[0];
			if($nb_quest>$last_file) $last_file = $part2[0];
			$rep_ok .= "$nb_quest:";
		}
	}
	for($i=0;$i<$last_file;$i++) $bulle[$i]=$non_fait;
	$rep_donnees = explode(":", $rep_ok);
	foreach($rep_donnees as $number) 
		if($number) $bulle[$number-1]=$fait;
	
	$k = 0;
	for($i=0;$i<$last_file;$i++) {
		$k++;
		$phrase .= $bulle[$i];
		if($k==10) {
			$k=0;
			$phrase .= "</br>";
		}
	}
	echo("<font size=\"-1\">$phrase</font>");	
?>