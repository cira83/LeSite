<!-- bas.php 
	
	$_SESSION['classe']
	$_SESSION['nom']
	$_SESSION['password']
-->
<hr>
<?php
	$fichier_classe = "../../Gestion/files/CIRA1.txt";
	if(!file_exists($fichier_classe)) echo("Le fichier classe est absent !!");

	$fp = fopen($fichier_classe, "r");
	$drap = 0;
	while(!feof($fp)){
		$ligne=fgets($fp);
		$part=explode(":", $ligne);
		if($part[0]==$_SESSION['nom']&&$part[3]==$_SESSION['password']) $drap = 1;
	}
	fclose($fp);
	
	if($drap){
		$sauvegarde="<center><a href=\"../../Gestion/sav8.php\" class=\"pied\">Rendre votre TP</a></center>";
	}
	else {
		$sauvegarde="<center><a href=\"../../Gestion/index7.php\" class=\"pied\">Connectez-vous pour enregistrer votre TP</a></center>";
	}

	echo($sauvegarde);	
?>