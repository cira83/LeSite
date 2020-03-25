<!-- DSFonctionPlus -->
<?php

function sommaire_document($sujet2DS){
		$fp = fopen($sujet2DS, "r");
		$ligne = fgets($fp);
		$i=0;
		while(!feof($fp)){
			$ligne = fgets($fp);
			$part = explode("#", $ligne);
			if($part[0]=="Q") {//Question
				$i++;
				if($i==1) $sommaire_td = "<a href=\"#Q$i\" ><font size=\"-2\">Q$i</font></a>";
				else $sommaire_td .= "</td><td><a href=\"#Q$i\"><font size=\"-2\">Q$i</font></a>";
			}
		}
		fclose($fp);
		
		return $sommaire_td;
}



?>
<!-- /DSFonctionPlus -->
