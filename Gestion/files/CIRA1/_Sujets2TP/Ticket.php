<?php 
	include("./Settings/haut.php");
	
	$tp = $_GET["sujet"]; //echo($sujet);
	$drap = $_POST["drap"];
	$del = $_POST["del"];
	$indication = $_POST["indications"];
	$tickets_file = "tickets.txt";
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
				fprintf($fp, "\n$tp:$indication:");
				fclose($fp);
				echo("<p>Votre ticket est enregistré</p>");
			}
			else echo("<p class=\"orange\">Votre ticket est déjà enregistré !!</p>");
		}
		else {
			$fp = fopen($tickets_file, "w");
			fprintf($fp, "$tp:$indication:");
			fclose($fp);					
			echo("<p>Votre ticket est enregistré</p>");	
		}
	}
	
	if($del==$code_erase) {
		if(file_exists($tickets_file)) {
			$fp = fopen($tickets_file, "r");
				while(!feof($fp)){
					$ligne = fgets($fp);
					if(!strpos("_$ligne", $tp)) {
						$ligne = rtrim($ligne);
						if($content)  $content.= "\n$ligne"; else $content= "$ligne";
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
		<td>Indications</td>
		<td>Suppression</td>
	</tr>
<?php
	if(file_exists($tickets_file))	{
		$fp = fopen($tickets_file, "r");
		while(!feof($fp)){
			$ligne = fgets($fp);
			$part = explode(":", $ligne);
			$contenu .= "<form method=\"post\" action=\"Ticket.php?sujet=$part[0]\">";
			$contenu .= "<tr><td>$part[0]</td><td>$part[1]</td><td><input type=\"text\" name=\"del\"></td></tr></form>";
		}
		fclose($fp);
		echo("$contenu");
	}
?>
</table>









