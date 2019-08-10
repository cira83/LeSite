<!-- Fichier HEAD -->
<script type="text/javascript">
	
	function question(){
		reponse = confirm('Charger une nouvelle question ?');
		lien = './game1.php';
		if(reponse) window.location.replace(lien);
	}
	
	function logout(){
		document.cookie = 'elv=';
		document.cookie = 'password=';
		lien = './index.php';
		window.location.replace(lien);
	}
	
	function delreponses(){
		lien = './game1.php?action=2';
		reponse = confirm("Effacer les r\351ponses ?");
		if(reponse) window.location.replace(lien);
	}

	function delscores(){
		lien = './quest1.php?action=4';
		reponse = confirm("Effacer les scores ?");
		if(reponse) window.location.replace(lien);
	}
		
	function changequestion(laquestion){
		delreponses();
		document.cookie = 'laquestion='+laquestion;
		lien = './quest1.php?action=1';
		window.location.replace(lien);
	}
	
</script>

<html>
	<head>
		<link rel="stylesheet" type="text/css" media="screen" href="styles.css">
		<title>GAME4STUDENTS</title>
	</head>
<body>
<center>

<?php
/*
	Les $lesnotes20 : les notes des tous les élèves
	function reponses($nom,$reponse,$numero) //Regarde si pa déjà répondu
	function rang_eleve($note,$lesnotes)
*/
	//ELEMENTS DES MENUS
	
	//Lecture des notes
	$lesnotesfile = "./lesnotes.txt";
	$fp = fopen($lesnotesfile, "r");
	if($fp) $lesnotes20 = explode(":", fgets($fp));
	else for($i=0;$i<count($leleve);$i++) $lesnotes20[$i]=0;
	fclose($fp);
	
	
	function rang_eleve($note,$lesnotes){
		$rang = 1;
		for($i=0;$i<count($lesnotes);$i++){
			if($note<$lesnotes[$i]) {
				$rang++;
			}
		}
		$img .= "$rang";
		if($rang<4) $img="<img src=\"./level/$rang.png\" />";
		return $img;
	}
	
	function listedesquestions(){
		$select = "<select name=\"quest1\" id=\"quest1\" onchange=\"changequestion(this.value);\">";
		$select .= "<option>---</option>";
		$repertoire = "./img";
		$questions = scandir($repertoire);
		for($i=0;$i<count($questions);$i++){
			$part = explode(".", $questions[$i]);
			if($part[0]!="") $select .= "<option>$questions[$i]</option>";
		}
		
		echo($select);
	}
	
	
	function questionphp(){
		$fp = fopen("./laquestion.txt", "r");
		if($fp){
			$image = fgets($fp);
			fclose($fp);
		}
		else {
			$image = "./img/Diap00.jpg";
			fclose($fp);
			$fp = fopen("./laquestion.txt", "w");
			fprintf($fp, $image."\n");
			fclose($fp);
		}
		
		echo($image);	
	}
	
	function reponses($nom,$reponse,$numero){
		//Regarde si pa déjà répondu
		$fp = fopen("./lesreponses.txt", "r");
		$drap = true;
		if($fp){
			while(!feof($fp)){
				$champs = explode(":", fgets($fp));
				if($champs[2]=="$numero") $drap = false;//déjà répondu à la question
			}
		}
		
		if($drap){
			$ligne = "$nom:$reponse:$numero:";
			$fp = fopen("./lesreponses.txt", "a");
			fprintf($fp, $ligne."\n");
			fclose($fp);
		}
		
		return($drap);
	}
	
	$choix = "<select name=\"reponse\" id=\"reponse\">";
	$choix .= "<option>---</option>";
	$choix .= "<option>A</option>";
	$choix .= "<option>B</option>";
	$choix .= "<option>C</option>";
	$choix .= "<option>D</option>";
	$choix .= "<option>E</option>";
	$choix .= "<option>F</option>";
	$choix .= "</select>";
	
	$classe_default = "TS1ET";//Classe par défaut si pas de Cookie
	
?>