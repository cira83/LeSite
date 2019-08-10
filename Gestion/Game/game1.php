<?php
	$nom = $_COOKIE[elv];
	$password = $_COOKIE[password];
	$classe = $_COOKIE[laclasse]; if(!$classe) $classe="CIRA1";
	
	include("./lesfonctions.php");
	include("./head.php");

?>
<img  src="head.jpg">
<?php
	$logout = "<input type=\"button\" value=\"Se deconnecter\" onclick=\"logout();\">";
	
	
	//PREMIERE LIGNE
	$login = false;
	$number = password($nom,$password,$classe);
	if($number){
		tableau("$classe</td><td>$nom</td><td>$logout");
		$login = true;
	}
	else{
		tableau("$nom</td><td>Mot de passe incorrect</td><td>$logout");//<td>$classe/$nom/$password</td>
	}

	$num_alpha = $number-1; //echo("<p>num_alpha = $num_alpha</p>");

	//GESTION DE LA REPONSE
	if($_GET[action]==1){//Eleve répond
		$reponse = $_POST[reponse];
		$ligne = reponses($nom,$reponse,$num_alpha);
		if($ligne) echo("<table><tr><td>Ma r&eacute;ponse : $reponse</td></tr></table>");
		else echo("<table><tr><td>Vous avez d&eacute;j&agrave; r&eacute;pondu &agrave; la question</td></tr></table>");
	}
		
	//Affichage suivant connecté
	if($login){
		if($nom=="Professeur") include("professeur.php");
		else include("eleve.php");
	}
?>


</center>
</body></html>