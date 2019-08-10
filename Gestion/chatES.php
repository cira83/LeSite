<?php
	$classe = $_COOKIE["laclasse"];
	if(!$classe) $classe="CIRA1";
	
	$separation = "§";

	function bulle($acteur,$paroles){
		$bulle = "<div class=\"bulles\">";
		$bulle .= "<h1>$acteur</h1>";
		$bulle .= "$paroles";
		$bulle .= "</div>";
		echo($bulle);
	}

	$filename = "./files/$classe/_chat.txt";
	if(!file_exists($filename)) {
		$fp = fopen($filename,"w");
		$init = "Administrateur$separation Le fichier de discussion est créé.";
		fwrite($fp, $init);			
		fclose($fp);
	}
	
	$fp = fopen($filename,"r");
	while(!feof($fp)){
		$ligne = fgets($fp);
		$part = explode($separation, $ligne);
		bulle($part[0],$part[1]);
	}
	fclose($fp);
	
	

?>
