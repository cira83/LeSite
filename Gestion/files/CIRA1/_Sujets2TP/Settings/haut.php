<?php
	session_start();
	include("../../../../head4.html");
	$classe = $_COOKIE["laclasse"];
	
	$nom=$_SERVER['SCRIPT_NAME'];
	$txt = explode("/",$nom);
	$k = count($txt);
	$j = explode(".",$txt[$k-1]);
	if($titre=="") 
	{
		$titre=$j[0];
		$titre1=$txt[$k-1];
		$titre2=$j[0];
	}
	
	echo("\n<title>$titre - $classe</title>");
?>		
	

	</head>
	
	
	<body>
	<img src="../../../../head.png"/>
	<table>
		<tr>
			<td><p class="titre"><?php echo($titre);?></p></td>
			<td><p class="titre"><?php echo($classe);?></p></td>
			<td><a href="../../../Ticket.php?sujet=<?php echo($titre);?>"><img src="../../../icon/Ticket.png" height="50px"/></a></td>
		</tr>
	</table>
<!--- fin de l'entête - Fichier haut.php-->