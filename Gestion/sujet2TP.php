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
	
	
	//$deroulant1 = <SELECT name="mat">
	$action = $_GET[action];
	if($action==1) {
		$rep = $_GET[mat];
		echo("Création des épreuves de TP dans $rep.");
	}
	
?>	
<!-- Nouvelles Epreuves -->
<form action="sujet2TP.php" method="get">
<table><tr><td>
<?php
	echo($deroulant1);
?>
<input type="hidden" value="1" name="action">
<input type="submit">
</td></tr></table>
</form>
<?php	
	Dropbox("$classe - Tous les sujets",$file);
	include("./bas.php");
?>
