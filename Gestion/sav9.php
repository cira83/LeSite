<?php
	include("./security.php");
	include("../head1.html");
	echo("<title>SAUVEGARDE $classe</title>");
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
		<img src="head.png"/>
		<table><tr><td><p class="titre">$classe - Fichier(s) Sauvegardé(s)</p></td></tr></table>

<!-- Liste des fichiers sauvegardés -->
<?php
	$repertoire_TP = "./files/$classe/_Sujets2TP/Copies/"; 	
	if(!file_exists($repertoire_TP)){
		mkdir($repertoire_TP);
		echo("Création de $repertoire_TP");
	}
	
	
	$ListFiles = scandir($repertoire_TP);
	sort($ListFiles);
	$i=0;
	$k=1;
	$nbfichier=0;
	echo("<p class=\"jaune\">");
	while ( $i < count($ListFiles)){
       	$file = $ListFiles[$i];
		$array=explode('.',$file);
		$extension=$array[1];
        if(($array[1]!="php")&&($array[1]!="")){
			echo($array[0].".".$array[1]);
			echo("<br/>");
			$nbfichier++;
    	}
    	$i++;
	}
	echo("</p><p>$nbfichier fichier(s) sauvegard&eacute;(s) </p>");
	
	include("./sav8_form.html");
	echo("<hr/>");	
	
	$chemin = "./" ;
	//on vérifie que le champ est bien rempli:
	if(!empty($_FILES["fichier_choisi"]["name"])){
		//nom du fichier choisi:
		$nomFichier = $_FILES["fichier_choisi"]["name"] ;
		//nom temporaire sur le serveur:
		$nomTemporaire = $_FILES["fichier_choisi"]["tmp_name"] ;
		//type du fichier choisi:
		$typeFichier = $_FILES["fichier_choisi"]["type"] ;
		//poids en octets du fichier choisit:
		$poidsFichier = $_FILES["fichier_choisi"]["size"] ;
		//code de l'erreur si jamais il y en a une:
		$codeErreur = $_FILES["fichier_choisi"]["error"] ;
	
		if(copy($nomTemporaire, $chemin.$nomFichier)){
			$Message = "Votre fichier $nomFichier est sauvegard&eacute;." ;
			chmod("$chemin$nomFichier",0777);
		}
		else $Message = "La sauvegarde a &eacute;chou&eacute; !!" ;
	}
	else $Message = "Vous n'avez pas choisit de fichier !!";	
		
		
	include("../foot2.html");
?>	



