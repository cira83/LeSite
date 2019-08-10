<!-- bas.php 
	
	$_SESSION['classe']
	$_SESSION['nom']
	$_SESSION['password']
-->
<hr>
<?php
	$fichier_classe = "../../$classe.txt";
	if(!file_exists($fichier_classe)) {
		$sauvegarde="Le fichier $fichier_classe est absent !!";
	}
	else {
		$fp = fopen($fichier_classe, "r");
		$drap = 0;
		while(!feof($fp)){
			$ligne=fgets($fp);
			$part=explode(":", $ligne);
			if($part[0]==$_SESSION['nom']&&$part[3]==$_SESSION['password']) $drap = 1;
		}
		fclose($fp);
	
		if($drap){
			$sauvegarde="<center><a href=\"../../../sav9.php\" class=\"pied\">Rendre votre TP</a></center>";
		}
		else {
			$sauvegarde="<center><a href=\"../../../index7.php\" class=\"pied\">Connectez-vous pour enregistrer votre TP</a></center>";
		}
	}

	echo($sauvegarde);	
?>