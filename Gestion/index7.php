<?php
	include("./security.php");
	include("../head1.html");
	if($password_OK) echo("<title>$classe - $elv</title>");
	else echo("<title>$classe</title>");
	$date_fin_cookie = time()+60*60*24*30;//30 jours
	setcookie("nom", $elv,$date_fin_cookie);
	setcookie("password", $password,$date_fin_cookie);
?>		
	<script type="text/javascript">
		function login(){
			var date = new Date(Date.now() + 86400000*30);//86400000 = 1 jour
			classe = document.getElementById('classe').value;
			document.cookie = 'laclasse='+classe+"; expires="+date.toUTCString();
			location.reload() ;
		}

		function init(){
			var date = new Date(Date.now() + 86400000*30);//86400000 = 1 jour
			classe = document.getElementById('classe').value;
			document.cookie = 'laclasse='+classe+"; expires="+date.toUTCString();
		}


	</script>
		
	</head>
	<body>
		<img src="head.png"/>

<?php
	$sujet2TP="./files/$classe/_Sujets2TP"; //echo($sujet2TP);
	if(!file_exists($sujet2TP)) $sujet2TP="";
	$doc="./files/$classe/_Documents";
	$class_cook = $_COOKIE["laclasse"];

	if($class_cook) echo("<table><tr><td><p class=\"titre\">$class_cook</p></td></tr></table>");
	else echo("<table><tr><td><p class=\"titre\">Pour mes élèves</p></td></tr></table>");
	echo("<br>$invite");
?>

<center>
<?php
	$date_du_jour = date("d_m");
	$planning_du_jour = "$repertoire$classe/_Plannings/$date_du_jour.txt";
	if(file_exists($planning_du_jour)){
		$fp = fopen($planning_du_jour, "r");
		while(!feof($fp)){
			$ligne = fgets($fp); //echo("$ligne");
			if(strpos($ligne, $elv)){
				$part = explode(":", $ligne);
				$TP_du_jour = $part[0];
			}
		}
	}
	
	
	if($sujet2TP) {
		if($password_OK){
			echo("<p class=\"liste\"><a href=\"./tp.php?elv=$elv\" class=\"no-under\">Sujets de TP</a></p>");
			echo("<p class=\"liste\"><a href=\"./sav9.php\" class=\"no-under\">Rendre un fichier</a></p>");
			echo("<p class=\"liste\"><a href=\"./documents.php\" class=\"no-under\">Mes documents</a></p>");
			echo("<p class=\"liste\"><a href=\"./info4elv.php\" class=\"no-under\">Mes Notes</a></p>");
			echo("<p class=\"liste\"><a href=\"./doclasse.php\" class=\"no-under\">Documents de la classe</a></p>");
			
			echo("<p class=\"liste\"><a href=\"./cahier4elv.php\" class=\"no-under\">Cahier de texte</a></p>");

			$questionnaire_perso = "$repertoire$classe/_Copies/$elv/rep/index.htm"; 
			if(file_exists($questionnaire_perso)) echo("<p class=\"liste\"><a href=\"./devoir.php\" class=\"no-under\" target=\"_blank\">Questionnaire personnalisé</a></p>");	
		
		}
	}
	else echo("<p class=\"liste\">Pas de TP pour les $classe</p>");
	
	if(($classe=="Visiteur")&&$password_OK){
		echo("<a href=\"https://docs.google.com/forms/d/e/1FAIpQLSfY9BOlWK11bAI7-3yU3C0sFIbdHpKJ0WBNvtPG6Z0O3sGoDQ/viewform?usp=pp_url\" class=\"no-under\">Questionnaire futur CIRA ?</a>");	
	}
?>

<!-- <p class="Liste"><a href="https://ecc.orion.education.fr/inscrinetbts/inscription?Unom_schema=t1a230119f&Uuad_pre=A23&Uind_tel=I" target="_blank"><font color="orange">Inscription au BTS |</font></a> Identification : 0831616F</p> -->

<!-- En travaux. Revenez plus tard. Merci. ->

<?php
	if($prof_login){
		echo("<hr><h2>Complément Professeur</h2>");
		echo("<p class=\"liste\"><a href=\"DSZone.php\" class=\"no-under\">Gestion des questionnaires</a></p>");
		echo("<p class=\"liste\"><a href=\"index.php\" class=\"no-under\">Gestion Pi</a></p>");

	}
	include("../foot1.html");
?>	
