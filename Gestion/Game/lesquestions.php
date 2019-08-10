<?php
	include("./head.php");

	function estfichier2($nom){// Fichier ou non ?
		$drap = true;
		$data = explode(".", $nom);
		if($data[0]=="") $drap = false;
		if($nom[0]=="_") $drap = false;
		
		return($drap);
	}
?>
<img  src="head.jpg">
<table>
<?php
	$repertoire = "./img/";
	$questions = scandir($repertoire);
	sort($questions);
	$i=0;$j=0;$tab = "<tr>";$tab2 = "<tr>";
	while($i<count($questions)){
		if(estfichier2($questions[$i])){
			$tab .= "<td><img src=\"$repertoire$questions[$i]\" width=\"190px\"";
			$tab .= " onclick=\"changequestion('$questions[$i]');\"></td>";
			$tab2 .= "<td><font size=\"-2\">$questions[$i]</font></td>";
			$j++;
		}
		if($j==4){
			$tab .="</tr>\n<tr>";
			$tab2 .="</tr>";
			$tab .= $tab2;
			$tab2 ="<tr>";
			$j=0;
		}
		$i++;
	}
	while($j<4){
		$tab .= "<td></td>";
		$tab2 .= "<td></td>";
		$j++; if($j==3){
			$tab .="</tr><tr>";
			$tab2 .="</tr>";
			$tab .= $tab2;
		}
	}
	echo($tab);
?>	
</table>
<table><form method="post" action="./quest1.php">
<tr><td><input type="submit" value="G&eacute;rer les questions"></td></tr>
</form></table>