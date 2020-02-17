<?php 
	include("./haut.php");
	$sujetlink = $_GET[file]; 	//echo($sujet);
	$part1 = explode("_link", $sujetlink);
	$part0 = explode(".", $part1[1]); //echo($part[1]);
	$part3 = explode("/", $sujetlink);
	
	if($_GET[src]==1){
		affiche("Modification du fichier info : $sujetlink");
		$sujet = $_POST[doc];
		affiche("Sujet : $sujet");
		$cor = $_POST[ppt];
		affiche("Correction : $cor");
		$active = $_POST[active];
		affiche("Disponibles : $active");
		
		$sujet = urldecode($sujet);
		$cor = urldecode($cor);
		
		$fp = fopen($sujetlink, "w");
		fprintf($fp, "$sujet");
		fprintf($fp, "\n$cor");
		fprintf($fp, "\n$active");
		fclose($fp);
	}
	
	
	
	
	tableau("$part3[3]</td><td><a href=\"epreuve.php?mat=$part3[3]&epr=$part1[1]\">$part0[0]</a>");

	if(file_exists($sujetlink)) {
		$fp = fopen($sujetlink, "r");
		$i = 0;
		while(!feof($fp)){
			$ligne[$i]=fgets($fp);
			$i++;
		}
		fclose($fp);
	} 
	
	$action = "info_sujet.php?file=$sujetlink";	
	if($ligne[2]=="on") $checked = "checked";
?>
<table><form name="envoie fichier" enctype="multipart/form-data" method="post" action="<?php echo("$action&src=1");?>">
	<tr>
		<td width="120px"><b>Sujet</b> : </td>
		<td><input name="doc" type="txt" value="<?php echo($ligne[0]);?>" size="80px"></td>
		<td><a href="<?php echo($ligne[0]);?>">__&uarr;__</a></td>
	</tr><tr>
		<td><b>Correction</b> : </td>
		<td><input name="ppt" type="txt" value="<?php echo($ligne[1]);?>" size="80px"></td></td>
		<td><a href="<?php echo($ligne[1]);?>">__&uarr;__</a></td>
	</tr><tr>
		<td><input type="submit"></td>
		<td>Informations disponibles</td>
		<td><input type="checkbox" name="active" <?php echo($checked);?> ></td>
	</tr>
	
</form></table>
<?php
	include("./bas.php");
?>