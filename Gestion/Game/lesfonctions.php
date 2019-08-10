<?php

/*
	function password($nom,$password,$classe)
	function beau_nombre($float)
	function menu_deroulant($liste,$nom,$selected)
	function estfichier($nom)
	function lien($filename)
	function afficheliste($liste)
	function affiche($texte)
	function tableau($content)
	$leleve = liste des elèves de la classe -> $deroulant3
	$classes = liste des classes -> $listedesclasses
*/


	function password($nom,$password,$classe){
		$reponse = false;
		$filename = "../files/$classe.txt";
		$fp = fopen($filename, "r");
		if($fp){
			$i = 0;
			while(!feof($fp)){
				$ligne = fgets($fp);
				$content = explode(":", $ligne);
				if(($nom==$content[0])&&(rtrim($password)==$content[3])) {
					$reponse = $i+1;
				}
				$i++;
			}
		}
		fclose($fp);
		
		//CAS DU PROFESSEUR
		if(($nom=="Professeur")&&($password=="b7wd5c")) $reponse = true;
		
		return $reponse;
	}


	function beau_nombre($float){//Retourne un nombre reel formatée  à ma guise
		$texte = number_format($float,2);
		return $texte;
	}

	function menu_deroulant($liste,$nom,$selected){ //Crée un menu deroulant avec la liste $liste et de nom $nom
		$lemenu = "<SELECT name=\"$nom\">";
		$lemenu .= "<OPTION>----</OPTION>";
		for($i=0;$i<count($liste);$i++){
			$drap = true;
			if($selected==$liste[$i]) {
				$lemenu .= "<OPTION selected>$liste[$i]</OPTION>";
				$drap = false;
			}else $lemenu .= "<OPTION>$liste[$i]</OPTION>";
		}
		//if($drap) $lemenu .= "<OPTION $selected selected>";
		$lemenu .= "<\SELECT>";
		return $lemenu;
	}
		
	function estfichier($nom){// Fichier ou non ?
		$drap = true;
		$data = explode(".", $nom);
		if($data[0]=="") $drap = false;
		if($nom[0]=="_") $drap = false;
		
		return($drap);
	}
	
	function lien($filename){ //Affiche un lien vers un fichier defini par son chemin
		echo("<a href=\"$filename\">$filename</a>");
	}
	
	function afficheliste($liste){//Affiche une liste 
		$nbelt = count($liste);
		echo("<p>$nbelt:");
		for($i=0;$i<$nbelt;$i++) echo("$liste[$i]/");
		echo("</p>");
	}
	
	function affiche($texte){ //affiche un texte et un saut à la ligne
		echo("<p>$texte</p>");
	}

	function tableau($content) {//Affiche $content dans un table 1x1
		echo("<table><tr bgcolor=\"yellow\"><td>$content</td></tr></table>\n");
	}

	//LISTE DES ELEVES DE LA CLASSE
	$deroulant3 = "<SELECT name=\"elv\" id=\"elv\"> <option>Professeur</option>";
	$listedeseleves = "&Eacute;l&egrave;ves : ";
	$laclassefile = "../files/$classe.txt";
	$fichierdenom = fopen($laclassefile, "r"); 
	$k = 0;
	while (!feof($fichierdenom)){
		$ligne123 = fgets($fichierdenom);
		$leseleves = explode(":", $ligne123);
		$nouveau = true;
		if($leseleves[8]=="oui") {
			$nouveau = false;
		}
		for($i=0;$i<$k;$i++){
			if($leseleves[0]==$leleve[$i]) $nouveau = false;
		}
		if($nouveau){
			$leleve[$k] = $leseleves[0];
			$listedeseleves .= "<a href=\"./eleve.php?nom=$leleve[$k]\">$leleve[$k]</a> ";
			$deroulant3 .= "<OPTION>$leleve[$k]</OPTION>";
			$k++;
		}
	}
	fclose($fichierdenom);
	$deroulant3 .= "</SELECT>";
	
	//LISTE DES CLASSES
	$listedesclasses = "<select name=\"classe\" id=\"classe\" onchange=\"newclasse(this.value)\">";
	$repertoire = "../files";
	$classes = scandir($repertoire);
	sort($classes);
	$i=0;
	while($i < count($classes)){
		if(estfichier($classes[$i])){
			$labonneclasse = explode(".", $classes[$i]);
			if($labonneclasse[1]!="") 
				if($labonneclasse[0] != $classe) $listedesclasses .= "<option>$labonneclasse[0]</option>";
				else $listedesclasses .= "<option selected>$labonneclasse[0]</option>";
		}
		$i++;
	}	
	$listedesclasses .= "</select>";
?>