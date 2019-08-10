<?php
	//Les fonctionnalités du professeur uniquement
	
	
	if($_GET[action]==2){//Prof Efface
		if($password=="b7wd5c") {
			$fp = fopen("./lesreponses.txt", "w");
			fclose($fp);
		}
	}

	if($_GET[action]==3){//Validation des nouvelles notes
		for($i=0;$i<count($leleve);$i++) {
			$lesnotes20[$i]+=$_POST[$i];
			//GESTION DES EXEPTIONS
			if($lesnotes20[$i]==7) $lesnotes20[$i]=10;
			if($lesnotes20[$i]==14) $lesnotes20[$i]=17;
			if($lesnotes20[$i]==11) $lesnotes20[$i]=0;
			if($lesnotes20[$i]==18) $lesnotes20[$i]=0;
			if($lesnotes20[$i]>21) $lesnotes20[$i]=21;
			$nouvelleligne .= $lesnotes20[$i].":";
		}
		$fp = fopen($lesnotesfile, "w");
		fprintf($fp, $nouvelleligne);
		fclose($fp);
	}
	
?>



<table><form method="post" action="./game1.php?action=3"><tr>
	<?php
		$filename = "./lesreponses.txt";
		function select($lenom){
			$select = "<select name=\"$lenom\" id=\"$lenom\"><option>+0</option><option>+1</option>";
			$select .= "<option>+2</option><option>+3</option></select>";
			return $select;
		}
		$fp = fopen($lesnotesfile, "r");
		$lesnotes = explode(":", fgets($fp));
		fclose($fp);
				
		$fp = fopen($filename, "r");
		$i = 0;
		if($fp){
			while(!feof($fp)){
				$ligne23[$i] = fgets($fp);$i++;
			}
			for($j=0;$j<$i-1;$j++){
				$ligneprof = explode(":", $ligne23[$j]);
				$lanote = $lesnotes[$ligneprof[2]]; if($lanote=="") $lanote="0";
				$rang_elv = rang_eleve($lanote,$lesnotes20);
				if($_GET[action]==4){
					if($_POST[reponse]==$ligneprof[1]){//Uniquement les bonnes réponses
						$tr .= "<tr><td>$ligneprof[0] ($lanote)</td><td>$rang_elv</td><td>$ligneprof[1]</td>";
						$tr .= "<td><img src=\"./level/$lanote.jpg\"/></td>";
						$select = select($ligneprof[2]);
						$tr .= "<td>$select</td></tr>";						
					}
				}
				else {
					$tr .= "<tr><td>$ligneprof[0] ($lanote)</td><td>$rang_elv</td><td>$ligneprof[1]</td>";
					$tr .= "<td><img src=\"./level/$lanote.jpg\"/></td>";
					$select = select($ligneprof[2]);
					$tr .= "<td>$select</td></tr>";
				}
			}
		}
		fclose($fp);
		
		echo($tr);
	?>
	<tr><td><input type="button" value="Effacer les r&eacute;ponses" onclick="delreponses();"></td><td></td>
	<td width="10"><input type="reset" value="RAZ"></td><td></td>
	<td width="15"><input type="submit" value="Valider les scores"></td></tr>
</tr></form></table>

<table><form method="post" action="./game1.php?action=4">
	<tr>
		<td>Ne montrer que les bonnes r&eacute;ponses : <?php echo($choix); ?> <input type="submit"></td></tr></form>
	</table>

<table><form method="post" action="./scores.php">
	<tr>
		<td>Montrer tous les scores <input type="submit"></td></tr></form>
	</table>

<table><form method="post" action="./quest1.php">
	<tr><td><input type="submit" value="G&eacute;rer les questions"></td></tr>
</form></table>
