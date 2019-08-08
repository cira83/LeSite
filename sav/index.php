<?php
	include("../head1.html");
?>		
	<!-- test de github -->	
	<title>BTS CIRA Rouvi&egrave;re</title>
</head>
<body>
		<img src="../head.png"/>
		<table><tr><td><p class="titre">Fichier(s) Sauvegardé(s)</p></td></tr></table>

<?php
			


	$repertoire = "./TP"; 	
	$ListFiles = scandir($repertoire);
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
	echo("</p><p>$nbfichier fichier(s) sauvegard&eacute;(s) </p><hr/>");
	
	include("./Setting/header8.php");
	include("../foot2.html");
?>	
