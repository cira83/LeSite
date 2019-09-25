<?php
	if(!$tabgphw) $tabgphw = "width=\"420px\"";
	if(!$tabeprw) $tabeprw = "width=\"100px\"";
	if(!$tabnotw) $tabnotw = "width=\"100px\"";

	//LISTE LES MATIERES ET EPREUVES
	$repertoire = "./files/$classe"; 	
	$matieres = scandir($repertoire);
	sort($matieres);
	
	$font_orange = "<font color=\"orange\">";
	
	//les apréciations
	$file_eleve2016 = fopen("./files/$classe.txt", "r");
	while(!feof($file_eleve2016)){
		$ligne122016 = fgets($file_eleve2016);
		$content122016 = explode(":", $ligne122016);
		if($content122016[0]==$nom){
			if($content122016[9]) $apres122016 = $content122016[9];
			if($content122016[10]) $apres122016 = $content122016[10];
		}
		if($apres122016) {
			echo("<table><tr><td bgcolor=\"grey\" width=\"100px\">Appréciation</td><td align=\"left\">$apres122016</td></tr></table>");
		}
		$apres122016="";
	};
	fclose($file_eleve2016);
	
	//les absences 14 novembre
	$lesabsences = lesabsences2($classe,$nom,$tableaudesappels);
	echo($lesabsences);
	
	for($i=0;$i<count($matieres);$i++){
		$lamatiere = $matieres[$i];
		if(estfichier($lamatiere)) {
			echo("\n<table width=\"781px\" class=\"notes\">");//pleine 
			$periode = periode($lamatiere);
			$coefmat = coefmat($lamatiere);
			//LISTE DES EPREUVES
			$repertoire = "./files/$classe/$lamatiere";
			$epreuves = scandir($repertoire);
			sort($epreuves);
			for($j=0;$j<count($epreuves);$j++){
				$lepreuve = $epreuves[$j];
				$part = explode(".", $lepreuve);
				if(estfichier($lepreuve)) {
					//Ouverture du fichier de l'epreuve
					$fichier = $files."$classe/$lamatiere/$lepreuve"; 
					$fp = fopen($fichier, "r");
					$Description = "Historique:";
					$lanote = ""; $lecoef=""; $liens=""; $Description=""; $commentaire="";
					while (!feof($fp)){//On ne prend que la dernière ligne avec $nom dedans
						$ligne = fgets($fp);
						$data = explode(":", $ligne);
						$nom2 = $data[0];//le nom des participants
						$note = $data[1];
						$coef = $data[2]; if($coef=="") $coef=1;
						$nonfait = $data[3];//10-01-2019
						if(dansgroupe($nom2,$nom)) {
							$lanote = $note;
							$lecoef = $coef;
							$lenonfait = $nonfait;
							$commentaire = $data[6];
							$liens = lescopies2($nom2,$classe,$lepreuve,$repertoire_copies);
							if($data[3]=="Non Fait") $liens="<img src=\"./icon/absent.gif\"/>";	//On vire la copie si le copain la fait seul						
							$Description .= "\n$lanote le $data[3] ($data[4])";
						}
					}
					fclose($fp);
					if($lenonfait=="Non Fait"){//10-01-2019
						$lecoef = 0;
						$commentaire = $lenonfait;
						$lanote = "";
						$liens = " ";
					}
					if($liens=="") $liens = lescopies2($nom,$classe,$lepreuve,$repertoire_copies);//Au cas où la copie est dans son répertoire
					$somme_note += $lanote*$lecoef;
					
					$fichier = $files."$classe/$lamatiere/_$lepreuve";
					$file_image = str_replace("txt", "png", $fichier);
					$legraphe = "<img src=\"graphe_elv.php?filename=$file_image&note=$lanote\"/>";
					if(file_exists("B800.txt")) $legraphe = "<img src=\"$file_image\"/>"; //Pour RaspberryPu seulement
										
					if($lanote!="") $somme_coef += $lecoef;//Ne prendre que les coefs de copies notées
					
					$linkmodif = "./modif.php?mat=$lamatiere&epr=$lepreuve&nom=$nom";
					if($passwordOK==2) echo("<tr><td $tabeprw><a href=\"$linkmodif\">$part[0]</a></td>");
					else echo("<tr><td $tabeprw>$part[0]</td>");
					echo("<td $tabnotw><a title=\"$Description\">$lanote ($lecoef)</a></td><td><font size=\"-2\" color=\"blue\">$commentaire</font> $liens</td><td $tabgphw>$legraphe</td></tr>");
					$lanote = "";
					$lecoef = "";
				}
			}
			if($somme_coef>0) $lamoyenne = number_format($somme_note/$somme_coef,2); else $lamoyenne = "";
			$somme_sem[$periode-1] += $lamoyenne*$coefmat ;
			if($lamoyenne != "") $somme_coef_sem[$periode-1] += $coefmat ;
			$somme_note = 0;
			$somme_coef = 0;

			echo("</table>");
			
			
			//Moyenne dans la matière
			$file_image = $files."$classe/_$lamatiere.png";
			$legraphe = "<img src=\"graphe_elv.php?filename=$file_image&note=$lamoyenne\"/>";
			if(file_exists("B800.txt")) $legraphe = "<img src=\"$file_image\"/>"; //Pour RaspberryPu seulement
			
			echo("\n<!-- matière --><table class=\"notes\">");
			if($lamoyenne != "") echo("<tr><td>La moyenne de $font_orange$lamatiere</font> est $lamoyenne ($coefmat) <br/>qui compte pour le semestre $periode </td><td $tabgphw>$legraphe</td></tr>");
			else echo("<tr><td>Pas de moyenne en $lamatiere</td></tr>");
			echo("</table>");
		}
	}
	echo("<br/>");
	for($i=0;$i<count($somme_coef_sem);$i++){
		if($somme_coef_sem[$i]>0) {
			$lamoyennesem = number_format($somme_sem[$i]/$somme_coef_sem[$i],2);
			$semestre = $i + 1;
			//Moyenne du semestre
			$graphe = $files."$classe/_Semestre $semestre.png";
			//$image_semestre = "</td><td><img src=\"$graphe\" />";
			$image_semestre = "</td><td><img src=\"graphe_elv.php?filename=$graphe&note=$lamoyennesem\"/>";
			if(file_exists("B800.txt")) $image_semestre = "</td><td><img src=\"$file_image\"/>"; //Pour RaspberryPu seulement
			echo("<table class=\"notes\"><tr><td>La moyenne du$font_orange semestre $semestre</font> est de $lamoyennesem ($somme_coef_sem[$i])$image_semestre</td></tr></table>\n");
		}
	}
	echo("<br/>");	
?>
