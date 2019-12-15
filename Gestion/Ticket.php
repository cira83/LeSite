<?php
	include("../head1.html");
	include("../Dropbox.php");

	if($_COOKIE["laclasse"]) $classe = $_COOKIE["laclasse"];
	else $classe = "CIRA1";
	
	if($_COOKIE["nom"]) $elv = $_COOKIE["nom"];
	else $elv = "inconnu";
	
	if($B800) echo("<title>B800 - Tickets $classe</title>"); 
	else echo("<title>Tickets $classe</title>"); 
		
?>	
<!-- fin head -->
<title>Tickets <?php echo($classe);?></title>
	</head>
	<body>
		<img src="../../../../head.png"/>
		<table><tr><td><p class="titre">Tickets <?php echo("$classe - $elv");?></p></td></tr></table>

<?php 	
	$tp = $_GET["sujet"]; // nom du ticket à ajouter
	$target = $_POST["target"]; // nom du ticket à supprimer
	$drap = $_POST["drap"];
	$del = $_POST["del"];
	$indication = $_POST["indications"];
	$tickets_file = "./files/$classe/_tickets.txt";
	$tickets_rep = "./files/$classe/";
	$code_erase = "2020";//Pour supprimer un ticket
	
	if($drap) {
		if(file_exists($tickets_file)) {
			$fp = fopen($tickets_file, "r");
			//Vérifie qu'un ticket n'est pas déjà présent
			$nb_ticket = 0;
			while(!feof($fp)){
				$ligne = fgets($fp);
				$part = explode(":", $ligne);
				if(strpos("_$ligne", $tp)) $flag12 = 1; 
			}			
			fclose($fp);
			if(!$flag12) {
				$fp = fopen($tickets_file, "a");
				fprintf($fp, "\n$tp:$indication:$elv:");
				fclose($fp);
				echo("<p>Votre ticket est enregistré</p>");
			}
			else echo("<p class=\"orange\">Votre ticket est déjà enregistré !!</p>");
		}
		else {
			$fp = fopen($tickets_file, "w");
			fprintf($fp, "$tp:$indication:$elv:");
			fclose($fp);					
			echo("<p>Votre ticket est enregistré</p>");	
		}
	}
	
	if($del==$code_erase) {//supprime le Ticket - inscrit l'intervention dans le fichier _Nom du TP.txt
		$filedutp = "$tickets_rep"."_$target.txt"; //echo($filedutp);
		if(file_exists($filedutp)) {
			$fp2 = fopen($filedutp, "a");
			fprintf($fp2, "\n");
		}
		else $fp2 = fopen($filedutp, "w");
		fclose($fp2);

		if(file_exists($tickets_file)) {
			$fp = fopen($tickets_file, "r");
				while(!feof($fp)){
					$ligne = fgets($fp);
					if(!strpos("_$ligne", $target)) {//cherche le TP dans la liste des tickets
						$ligne = rtrim($ligne);
						if($content)  $content.= "\n$ligne"; else $content= "$ligne";
					} 
					else { // le ticket existe
						$fp2 = fopen($filedutp, "a");
						fprintf($fp2, "$ligne");
						fclose($fp2);
					}
				}
			fclose($fp);
			if($content) {
				$fp = fopen($tickets_file, "w");
				fprintf($fp, "$content");
				fclose($fp);
			}
			else unlink($tickets_file);
		}
	}


?>


<h1>Ajouter un ticket</h1>
<form method="post" action="Ticket.php?sujet=<?php echo($tp);?>">
	<table>
		<tr class="orange">
			<td>Sujet de TP</td>
			<td>Indications</td>
			<td></td>
		</tr>
		<tr>
			<td><?php echo($tp);?></td>
			<td><input type="text" size="100" name="indications"></td>
			<td><input type="hidden" name="drap" value="1"><input type="submit"></td>
		</tr>
	</table>
</form>

<h1>Liste des tickets</h1>
<table>
	<tr class="orange">
		<td>Sujet de TP</td>
		<td>Requérant</td>
		<td>Indications</td>
		<td>Code</td>
	</tr>
<?php
	if(file_exists($tickets_file))	{
		$fp = fopen($tickets_file, "r");
		while(!feof($fp)){
			$ligne = fgets($fp);
			$part = explode(":", $ligne);
			$contenu .= "<form method=\"post\" action=\"Ticket.php?sujet=$tp\">";
			$contenu .= "<tr><td>$part[0]</td><td>$part[2]</td><td>$part[1]</td><td><input type=\"text\" name=\"del\"><input type=\"hidden\" name=\"target\" value=\"$part[0]\"></td></tr></form>";
		}
		fclose($fp);
		echo("$contenu");
	}
?>
</table>









