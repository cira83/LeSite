<?php
	$classe = $_COOKIE["laclasse"];
	if(!$classe) $classe="CIRA1";
	
	$separation = "$";

	function bulle($acteur,$paroles){
		$bulle = "<div class=\"bulles\">";
		$bulle .= "<h3>$acteur</h3>";
		$bulle .= "$paroles";
		$bulle .= "</div>";
		echo($bulle);
	}

	$filename = "./files/$classe/_chat.txt";
	$repertoire = "./files/$classe/_Copies/";
	$liste_eleve = scandir($repertoire);
	
	
	$fp = fopen($filename,"w");
	$i=0;
	foreach($liste_eleve as $eleve) {
		$maj = ord($eleve);
		if(($maj>64)&($maj<91)) {
			$repertoire_elv = "$repertoire/$eleve/rep";
			$liste_fichier = scandir($repertoire_elv);
			$last_file = 0;
			foreach($liste_fichier as $reponse) {
				if(strpos("_$reponse", "I")) {
					$part1 = explode("I", $reponse);
					$part2 = explode(".", $part1[1]);
					$nb_quest = $part2[0];
					if($nb_quest>$last_file) $last_file = $part2[0];
				}
			}
			if($last_file) {
				if($i==0) fprintf($fp, "$eleve$separation <a href=\"./copie2DS.php?name=$eleve&file=./files/CIRA2/_Copies/$eleve/index.htm\" target=\"_blank\">Q$last_file</a>");
				else fprintf($fp, "\n$eleve$separation <a href=\"./copie2DS.php?name=$eleve&file=./files/CIRA2/_Copies/$eleve/index.htm\" target=\"_blank\">Q$last_file</a>");
				$i++;
			}
			
		}
	}
	fclose($fp);
	
	$fp = fopen($filename,"r");
	while(!feof($fp)){
		$ligne = fgets($fp);
		$part = explode($separation, $ligne);
		bulle($part[0],$part[1]);
	}
	fclose($fp);
?>
