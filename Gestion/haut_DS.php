<?php
	$photos = "../photos/";
	$files = "./files/";
	$nbphotoslignes = 5;
	if(!file_exists("./files/$classe.txt")) $classe = $_COOKIE["laclasse"];  //$classe = $_COOKIE["laclasse"]; if($classe=="") $classe="TS2CIRA";
	$largeurdelecran = $_COOKIE["largeur"];
	$password = $_COOKIE["password"];
	$accueil = "<a href=\"./index.php\">";
	$date = date("j/m");
	$cheminfichiertp = "../Commun/tp/";
	$nonfait = "Non Fait";
	$tabgphw = " width=\"420px\"";//largeur case graphique
	$tabeprw = " width=\"100px\"";//largeur case epreuve
	$tabnotw = " width=\"100px\"";//largeur case epreuve
	//$repertoire_copies =  "./files/$classe/_Copies";
	$file2delete = "Pas de fichier &agrave; supprimer";

	include("./lesfonctions.php");
	$passwordOK = password($nom,$password,$classe);//=1 eleve, =2 prof
	
	//Ajouter le 8 septembre 2016
	if(!$passwordOK){
		$tableaudesmatieres = "";
		$tableaudesappels = "";
		$leleve = "";
		$lepreuve1 = "";
		$tableauplanning = "";
		$tableaudesTP = "";
	}
	
	
	//historique
	$adressdelapage = $_SERVER['REQUEST_URI'];
	$historique = "./files/$classe/_historique.txt";
	$historique_select = "<select name=\"histo\" onchange=\"redirect(this.value);\" style=\"max-width:150px;\">";
	if(!file_exists($historique)){
		$histo = fopen($historique, "w");
		fwrite($histo, "$adressdelapage");
		fclose($histo);
		$historique_select .= "<option selected>$adressdelapage</option>";
	}
	else {
		$historique_select .= "<option selected>$adressdelapage</option>";
		$histo = fopen($historique, "r");
		$histo_nb = 0;
		while(!feof($histo)){
			$ligne_histo[$histo_nb]=fgets($histo);
			$histo_nb++;
		}
		fclose($histo);
		$histo = fopen($historique, "w");
		fwrite($histo, "$adressdelapage\n");
		for($histo_nb2=0;($histo_nb2<$histo_nb)&&($histo_nb2<15);$histo_nb2++) {
			fwrite($histo, "$ligne_histo[$histo_nb2]");
			$historique_select .= "<option>$ligne_histo[$histo_nb2]</option>";
		}
		fclose($histo);
		
		
	}
	$historique_select .= "<select name=\"histo\" onchange=\"redirect(this.value);\" style=\"max-width:150px;\"></select>";
	if(!$passwordOK) $historique_select="";
?>
<!--                                  DEBUT DU FICHIER                         -->
<script type="text/javascript" src="./script.js"></script>
<html>
	<head>
		<link rel="stylesheet" type="text/css" media="screen" href="styles.css">
		<link rel="icon" type="image/jpg" href="./icon/favicon.jpg" />
		<title><?php echo("$titre_page");?></title>
	</head>
	
	<body onload="tailledelafenetre();">
	<center>
	<table class="max"><tr><td>	
		<table>
		<tr>
			<td><a href="./index.php" title="Appel"><img src="./icon/home.png" height="15px" style="border:solid 4px #fff"></a></td>
			<td><?php echo($listedesclasses);?></td>
		<?php
			if(!$passwordOK){
				echo("<td><input type=\"text\" name=\"nom\" id=\"nom\" size=\"8\"><input type=\"password\" name=\"pwd\" id=\"pwd\" size=\"8\"></td>");
			}
		?>
		<td><input type="submit" onclick="<?php if($passwordOK) echo("out();"); else echo("motdepasse();");?>" value="<?php if($passwordOK) echo("Logout"); else echo("Login");?>"></td>
		<td align="right"><?php echo($historique_select);?></td>
		</tr></table>
<!-- haut.php -->
