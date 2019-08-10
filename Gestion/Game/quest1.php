<?php
	include("./head.php");

	$nom = $_COOKIE[elv];
	$password = $_COOKIE[password];	
	
	if($_GET[action]==4){//Prof Efface les scores
		if($password=="b7wd5c") {
			$fp = fopen("./lesnotes.txt", "w");
			fclose($fp);
		}
	}
	
	if($_GET[action]==2){
		//Enregistrement d'une nouvelle image
		$chemin = "./img/" ;
		//on vérifie que le champ est bien rempli:
		if(!empty($_FILES["fichier_choisi"]["name"])){
			//nom du fichier choisi:
			$nomFichier = $_FILES["fichier_choisi"]["name"] ;
			//nom temporaire sur le serveur:
			$nomTemporaire = $_FILES["fichier_choisi"]["tmp_name"] ;
			//type du fichier choisi:
			$typeFichier = $_FILES["fichier_choisi"]["type"] ;
			//poids en octets du fichier choisit:
			$poidsFichier = $_FILES["fichier_choisi"]["size"] ;
			//code de l'erreur si jamais il y en a une:
			$codeErreur = $_FILES["fichier_choisi"]["error"] ;
	
			if(copy($nomTemporaire, $chemin.$nomFichier)){
				$Message = "Votre fichier $nomFichier est sauvegard&eacute;." ;
				chmod("$chemin$nomFichier",0777);
				
				
				//Chargement de la nouvelle question
				$image = "./img/".$nomFichier; //echo($image);
				$fp = fopen("./laquestion.txt", "w");
				fprintf($fp, $image."\n");
				fclose($fp);

				
			}
			else $Message = "La sauvegarde a &eacute;chou&eacute; !!" ;
		}
		else $Message = "Vous n'avez pas choisit de fichier !!";
	
		$Message = "<table><tr><td><font size=\"-2\">$Message</font></td></tr></table>";
		
	}
	
	$classe = $_COOKIE["laclasse"]; if($classe=="") $classe=$classe_default;
	include("./lesfonctions.php");	
	
	
?>
<img  src="head.jpg">
<?php
	$logout = "<input type=\"button\" value=\"Se deconnecter\" onclick=\"logout();\">";
	
	$login = false;
	$number = password($nom,$password,$classe);
	if($number){
		tableau("$classe</td><td>$nom</td><td>$logout");
		$login = true;
	}
	else{
		tableau("$nom</td><td>Mot de passe incorrect</td><td>$logout");
	}

	if($_GET[action]==1){//Question Change
		$image = "./img/".$_COOKIE[laquestion]; //echo($image);
		$fp = fopen("./laquestion.txt", "w");
		fprintf($fp, $image."\n");
		fclose($fp);
	}
?>
<table class="question"><tr><td><img src="<?php questionphp();?>" width="780"></td></tr></table>
<table><tr><td>
	<font size="-2">Largeur des questions = 780px --- Question actuelle : <?php $im = questionphp();echo($im); ?>
	</font></td></tr></table>
<table><tr><td>Choisir une question : <?php listedesquestions();?></td>
<td><a href="./lesquestions.php">Voir toutes les questions</a></td></tr></table>
<table><form action="game1.php">
	<tr><td><input type="submit" value="Voir les r&eacute;ponses"> </td></tr>
</form></table>
<table><form name="envoie fichier" enctype="multipart/form-data" method="post" action="./quest1.php?action=2">
<tr><td><input name="fichier_choisi" type="file"></td><td><input name="password" type="hidden" value="OK"</td>
<td><input name="bouton" value="Envoyer le fichier" type="submit"></td></tr>
</form></table>
<?php if($_GET[action]==2) echo($Message); ?>
<table><tr><td><a href="./img/Diap01.jpg">R&egrave;gle du jeu</a></td></tr></table>

