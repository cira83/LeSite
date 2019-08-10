<?php
	include("./head.php");
	$classe = $_COOKIE["laclasse"]; if($classe=="") $classe="TS2CIRA";
	$nom = $_COOKIE[elv];
	$password = $_COOKIE[password];	
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
?>
<table>
<?php
	if($password=="b7wd5c"){
		for($i=0;$i<count($lesnotes20)-1;$i++){
			$lanote = $lesnotes20[$i];
			$rang_elv = rang_eleve($lanote,$lesnotes20);
			echo("<tr><td>$i</td><td>$leleve[$i] ($lanote)</td></td><td>$rang_elv</td><td><img src=\"./level/$lanote.jpg\"/></tr>");
		}
	}
?>
</table>
<table><form action="game1.php">
	<tr><td><input type="button" value="Effacer les scores" onclick="delscores();"></td><td><input type="submit" value="Voir les r&eacute;ponses"> </td></tr>
</form></table>