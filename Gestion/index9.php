<?php
	include("./security.php");
	include("../head1.html");
	if($password_OK) echo("<title>$classe - $elv</title>");
	else echo("<title>$classe</title>");

?>		
		<script type="text/javascript">
		function login(){
			classe = document.getElementById('classe').value;
			document.cookie = 'laclasse='+classe;
			location.reload() ;
		}
	</script>
		
	</head>
	<body>

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
			if($TP_du_jour) echo("<p class=\"liste\"><a href=\"$sujet2TP$TP_du_jour.php\" class=\"no-under-orange\">Mon TP du jour ($TP_du_jour)</a></p>");
			echo("<p class=\"liste\"><a href=\"./tp.php\" class=\"no-under\">Sujets de TP</a></p>");
			echo("<p class=\"liste\"><a href=\"./sav9.php\" class=\"no-under\">Rendre un fichier</a></p>");
			echo("<p class=\"liste\"><a href=\"./documents.php\" class=\"no-under\">Mes documents</a></p>");
			echo("<p class=\"liste\"><a href=\"./info4elv.php\" class=\"no-under\">Mes Notes</a></p>");
			echo("<p class=\"liste\"><a href=\"./doclasse.php\" class=\"no-under\">Documents de la classe</a></p>");
			//if($classe=="CIRA2") echo("<p class=\"liste\"><a href=\"./wordpress\" class=\"no-under\">Sujets de TP</a></p>");
			//echo("<p class=\"liste\"><a href=\"$doc\" class=\"no-under\">Documentation</a></p>");
			//echo("<p class=\"liste\"><a href=\"./cahier4elv.php\" class=\"no-under\">Cahier de texte</a></p>");
			
			
			echo("<p class=\"liste\"><a href=\"./cahier4elv.php\" class=\"no-under\">Cahier de texte</a></p>");

			$questionnaire_perso = "$repertoire$classe/_Copies/$elv/index.htm"; //echo($questionnaire_perso);
			if(file_exists($questionnaire_perso)) echo("<p class=\"liste\"><a href=\"./devoir.php\" class=\"no-under\" target=\"_blank\">Questionnaire personnalisé</a></p>");
			
			
			if(($elv=="Chapelain")||($elv=="Turkcan")||($elv=="Spite")||($elv=="Selegue")) echo("<p class=\"liste\"><a href=\"https://docs.google.com/presentation/d/e/2PACX-1vR8_aj-DF_Zussym1i6Zr2YQIFL0taP8WS90-veEUpQDvjx16sOh3i1VEzVKVe5LUxkrA35RncDhtsx/pub?start=false&loop=false&delayms=3000\" target=\"_blank\" class=\"no-under\">Présentation de mon projet</a></p>");
			if(($elv=="Bellemere")||($elv=="Andre")||($elv=="Mengual")||($elv=="Raspaud")) echo("<p class=\"liste\"><a href=\"https://docs.google.com/presentation/d/e/2PACX-1vT7H_hP_EyZ6JJt0TMzi5J90HEZdpBTwG5r0Y1CPywxntoC5YL59haCujNadTpzTCt_ujR-JtbO9oZB/pub?start=false&loop=false&delayms=3000\" target=\"_blank\" class=\"no-under\">Présentation de mon projet</a></p>");
			if(($elv=="Agostino")||($elv=="Couillet")||($elv=="Dubois")) echo("<p class=\"liste\"><a href=\"https://docs.google.com/presentation/d/e/2PACX-1vQNqWpAYqkPXXo-DMSGDgT_JtjbN4U7_5ASW9Byc3oJX7h_jZbOgZvMlwj4e5Ly1tLLpHQE7jVpYzHA/pub?start=false&loop=false&delayms=3000\" target=\"_blank\" class=\"no-under\">Présentation de mon projet</a></p>");		
		
		}
	}
	else echo("<p class=\"liste\">Pas de TP pour les $classe</p>");
	
	if(($classe=="Visiteur")&&$password_OK){
		echo("<a href=\"https://docs.google.com/forms/d/e/1FAIpQLSfY9BOlWK11bAI7-3yU3C0sFIbdHpKJ0WBNvtPG6Z0O3sGoDQ/viewform?usp=pp_url\" class=\"no-under\">Questionnaire futur CIRA ?</a>");	
	}
?>

<!-- <p class="Liste"><a href="https://ecc.orion.education.fr/inscrinetbts/inscription?Unom_schema=t1a230119f&Uuad_pre=A23&Uind_tel=I" target="_blank"><font color="orange">Inscription au BTS |</font></a> Identification : 0831616F</p> -->

<?php
	if($prof_login){
		echo("<hr><h2>Complément Professeur</h2>");
		echo("<p class=\"liste\"><a href=\"DSZone.php\" class=\"no-under\">Gestion des questionnaires</a></p>");
		//echo("<p class=\"liste\"><a href=\"ftp.php\" class=\"no-under\">Synchronisation Pi</a></p>");
		echo("<p class=\"liste\"><a href=\"index.php\" class=\"no-under\">Gestion Pi</a></p>");

	}
	include("../foot1.html");
?>	
