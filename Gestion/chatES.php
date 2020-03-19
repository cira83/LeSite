<?php
	$classe = $_COOKIE["laclasse"];
	if(!$classe) $classe="CIRA1";
	
	$separation = "$";
	$fait = "&#9679;";
	$non_fait = "&#9675;";

	function bulle($acteur,$paroles){
		$bulle = "<div class=\"bulles\">";
		$bulle .= "<b>$acteur</b><br>";
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
			$rep_ok = "";
			$last_file = 0;
			foreach($liste_fichier as $reponse) {
				if(strpos("_$reponse", "I")) {
					$part1 = explode("I", $reponse);
					$part2 = explode(".", $part1[1]);
					$nb_quest = $part2[0];
					if($nb_quest>$last_file) $last_file = $part2[0];
					$rep_ok .= "$nb_quest:";
				}
			}
			$liste2nombre = explode(":", $rep_ok);//liste des réponses disponibles
			for($ii=0;$ii<$last_file;$ii++) $case_quest[$ii]=$non_fait;
			foreach($liste2nombre as $nombre) $case_quest[$nombre-1]=$fait;
			$ligne2led = "";
			$kkdoit = 0;
			for($ii=0;$ii<$last_file;$ii++) {
				$ligne2led.=$case_quest[$ii];
				$kkdoit++;
				if($kkdoit==10) {
					$kkdoit = 0;
					$ligne2led.="<br>";
				}
			}
			
			if($last_file) {//ecriture du fichier
				if($i==0) fprintf($fp, "$eleve$separation $ligne2led");
				else fprintf($fp, "\n$eleve$separation $ligne2led");
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
