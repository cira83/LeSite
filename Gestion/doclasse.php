﻿<?php
	include("../head1.html");
	include("../Dropbox.php");
	$classe = $_COOKIE["laclasse"];
	
	if($B800) echo("<title>B800 - Documents $classe</title>");
	else echo("<title>Documents $classe</title>");
?>	
<!-- fin head -->
	</head>
	<body>
		<img src="../../../../head.png"/>
		<table><tr><td><p class="titre">Documents <?php echo($classe);?></p></td></tr></table>

<?php

	if($B800) Dropbox("","./files/$classe/_Documents/B800_Documents.txt");//Liste des documents nom,adresse web	
	else Dropbox("","./files/$classe/_Documents/Documents.txt"); 


	include("../foot2.html");
?>	
