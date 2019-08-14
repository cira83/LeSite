<?php    	
	$classe = $_COOKIE["laclasse"];
	$Dir_TP = "./files/$classe/_Sujets2TP";
	include("./haut.php");
	include("../Dropbox.php");

	Dropbox("$classe - Les sujets du moment","$Dir_TP/liste.txt");
	
	$liste2 = scandir($Dir_TP);
	$file = "$Dir_TP/allfiles.txt";
	$fp = fopen($file, "w");
	foreach($liste2 as $tp) {
		$part = explode(".", $tp);
		if($part[1]&$part[0]) {
			if($pass) fprintf($fp, "\n$tp,$Dir_TP/$tp");
			else {
				$pass++;
				fprintf($fp, "$tp,$Dir_TP/$tp");
			}
		}
	}
	fclose($fp);
	
	echo("<!-- Nouvelles Epreuves -->");
	echo("<table><tr><td>");
	
	echo("</td></tr></table>");
	
	
	
	Dropbox("$classe - Tous les sujets",$file);
	
	include("./bas.php");
?>
