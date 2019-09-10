<?php
	include("../head1.html");
	include("../Dropbox.php");
	
	if($_COOKIE["laclasse"]) $classe = $_COOKIE["laclasse"];
	else $classe="CIRA1";
	
	if($B800) echo("<title>B800 - TP $classe</title>"); 
	else echo("<title>TP $classe</title>"); 
		
?>	
<!-- fin head -->
<title>TP <?php echo($classe);?></title>
	</head>
	<body>
		<img src="../../../../head.png"/>
		<table><tr><td><p class="titre">TP <?php echo($classe);?></p></td></tr></table>

<?php

	Dropbox("","./files/$classe/_Sujets2TP/liste.txt");//Liste des documents nom,adresse web	


	include("../foot2.html");
?>	

