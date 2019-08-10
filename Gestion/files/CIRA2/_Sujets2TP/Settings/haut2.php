<?php
	session_start();
	include("../../head2.html");
	
	$nom=$_SERVER['SCRIPT_NAME'];
	$txt = explode("/",$nom);
	$k = count($txt);
	$j = explode(".",$txt[$k-1]);
	if($titre=="") 
	{
		$titre=$j[0];
		$titre1=$txt[$k-2];
		$titre2=$j[0];
	}
	
	function easyreg(){
		echo("<a href=\"../EasyRegPhp\" target=\"_blank\">EASYREG</a>");
	}
	
	function sensdaction() {echo("<li>Déterminer le sens de fonctionnement du régulateur (inverse ou direct). <u>On fera un raisonnement complet</u>.</li>");}
	function schemaTI() {echo("<li>Établir le schéma TI de cette régulation. On indiquera dessus les entrées et sorties du régulateur choisies.</li>");}
	function schemaElec() {echo("<li>Proposer un schéma de câblage électrique répondant au cahier des charges.</li>");}
	function schemaBloc() {echo("<li>Réaliser la programmation du régulateur. On ajoutera sur la copie d'ecran le nom de toutes les entrées/sorties reliées. </li>");}
	function regleur() 
	{
		echo("<li>Régler la boucle de régulation, en utilisant une méthode par approches successives. ");
		echo("On fournira au moins trois copies d'écran, ainsi que les valeurs de Xp, Ti et Td choisies.</li>");
	}
	
	
?>		
	
	<title>BTS CIRA Rouvi&egrave;re</title>
	</head>
	
	
	<body>
	<img src="../../head.png"/>
	<table><tr><td><p class="titre"><?php echo("$titre");?></p></td><td><p class="titre"><?php echo("$titre1");?></p></td></tr></table>
<!--- fin de l'entête - Fichier haut.php-->