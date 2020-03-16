<?php
	$classe = $_COOKIE["laclasse"]; if($classe=="") $classe="CIRA1";
	$action44 = "./DSZone.php?action=44";
	$action = $_GET[action];

	
	
	include("./haut_DS.php");
	
	
	//Le 11 novembre 2017
	function start_stop($nom, $classe){//inversion mode on/off et retour de l'état
		$drap = false;
		$repertoire = "./files/$classe/_Copies/$nom/rep";
		if(!file_exists($repertoire)) mkdir($repertoire);
		$fichier_on = "$repertoire/on.txt";
		$fichier_off = "$repertoire/off.txt";
		if(!file_exists($fichier_on)&&!file_exists($fichier_off)) {// Création du fichier on/off
			$fp = fopen($fichier_off, "w");
			fclose($fp);
		}
		if(file_exists($fichier_on)) $drap = true;
		if(!$drap) rename($fichier_off, $fichier_on);
		else rename($fichier_on, $fichier_off);
		
		return(!$drap);
	}
	
	function state_onoff($nom, $classe){//retour de l'état
		$filename ="./files/$classe/_Copies/$nom/rep/off.txt";
		return(!file_exists($filename));
	}
	
	function bouton_onoff($nom, $classe){
		$etat = state_onoff($nom, $classe);
		if($etat) $bouton = "<a href=\"./DSZone.php?action=OnOff&name=$nom\">Marche</a>";
		else $bouton = "<a href=\"./DSZone.php?action=OnOff&name=$nom\">Arrêt</a>";
		return $bouton;
	}
	
	function nb2connections($nom, $classe){//Nb de Sessions ouvertes
		$nb = 0;
		$filename ="./files/$classe/_Copies/$nom/rep/sessions.txt";
		if(file_exists($filename)){
			$fp = fopen($filename, "r");
			while(!feof($fp)) {
				fgets($fp);
				$nb++;
			}
			fclose($fp);
		}
		return $nb;
	}
	
	// FIN DES FONCTIONS SPECIFIQUES ___________________________________________________________________________________________________________
	
	if($action=="OnOff"){
		$name17 = $_GET[name];
		affiche("OnOff -- $name17");
		start_stop($name17, $classe);
	}
	
	
	
	
	if($action==44){
		
		if(!empty($_FILES["fichier_choisi"]["name"])){
			//nom du fichier choisi:
			$nomFichier = $_FILES["fichier_choisi"]["name"] ;
			//nom temporaire sur le serveur:
			$nomTemporaire = $_FILES["fichier_choisi"]["tmp_name"] ;
			//type du fichier choisi:
			$typeFichier = $_FILES["fichier_choisi"]["type"] ;
			//poids en octets du fichier choisit:
			$poidsFichier = $_FILES["fichier_choisi"]["size"] ;
			//code de l'erreur si jamais il y en a une:
			$codeErreur = $_FILES["fichier_choisi"]["error"] ;
	
			//Pour tous et les autres
			$lebonnom = $_POST[nom];
			if($lebonnom=="Tous"){
				foreach($leleve as $txt){//Distribution du sujet à chaque élève
					$chemin = "./files/$classe/_Copies/$txt/index.htm";
					if(copy($nomTemporaire, $chemin)){
						$Message .= "Votre fichier $chemin est import&eacute;<br>" ;
						chmod("$chemin",0777);
					}
					else $Message .= "La sauvegarde vers $chemin a &eacute;chou&eacute; !!<br>" ;
				}	
			}
			else {
				$chemin = "./files/$classe/_Copies/$lebonnom/index.htm";
				if(copy($nomTemporaire, $chemin)){
					$Message .= "Votre fichier $chemin est import&eacute;<br>" ;
					chmod("$chemin",0777);
				}
				else $Message .= "La sauvegarde vers $chemin a &eacute;chou&eacute; !!<br>" ;
			}
		}
		else $Message = "Vous n'avez pas choisit de fichier !!";
		echo("<p>Action 44 : $Message</p>");
	}
	
	
	
	
	if($action==30){//Efface les sujets
		$poubelle = "./files/$classe/_Copies/_Poubelle";
		if(!file_exists($poubelle)) {
			mkdir($poubelle);
			affiche("$poubelle crée");
		}
		$newname = "$poubelle/index.htm";
		foreach($leleve as $txt){
			$filename = "./files/$classe/_Copies/$txt/index.htm";
			rename($filename, $newname);
		}
		$Message = "Sujets supprimés du répertoire des élèves";
		echo("<p>Action 30 : $Message</p>");
	}
	
	
	
	if($action==31){
		echo("<form method=\"post\" action=\"DSZone.php?action=32\">");
		echo("<table><tr><td>Effacer les réponses ? <input type=\"submit\" value=\"OUI\"> ");
		echo("<input type=\"button\" value=\"NON\" onclick=\"gotolien('./DSZone.php')\"></td></tr></table>");
		echo("</form>");
	}
	
	if($action==111){
		$nom111 = $_GET[nom];
		echo("<form method=\"post\" action=\"DSZone.php?action=110&nom=$nom111\">");
		echo("<table><tr><td>Effacer les réponses de $nom111 ? <input type=\"submit\" value=\"OUI\"> ");
		echo("<input type=\"button\" value=\"NON\" onclick=\"gotolien('./DSZone.php')\"></td></tr></table>");
		echo("</form>");
	}	

	if($action==110){//Efface les réponses de nom111
		$nom111 = $_GET[nom];
		$dossier_rep = "./files/$classe/_Copies/$nom111/rep/";
		if(file_exists($dossier_rep)){
			$listeDreponses = scandir($dossier_rep);
			foreach($listeDreponses as $filename){
				if(($filename[0]=="I")||($filename[0]=="R")||($filename[0]=="Q")||($filename[0]=="s")) {
					$avant = "./files/$classe/_Copies/$nom111/rep/$filename";
					$apres = "./files/$classe/_Copies/_Poubelle/$filename";
					rename($avant, $apres);
				}
			}
		}
		$Message = "Réponses  de $nom111 supprimées";
		echo("<p>Action 110 : $Message</p>");
	}

	if($action==51){
		$file2delete = $_GET[dir];
		echo("<form method=\"post\" action=\"DSZone.php?action=52&dir=$file2delete\">");
		echo("<table><tr><td>Effacer la réponse $file2delete ? <input type=\"submit\" value=\"OUI\"> ");
		echo("<input type=\"button\" value=\"NON\" onclick=\"gotolien('./DSZone.php')\"></td></tr></table>");
		echo("</form>");
	}
	
	if($action==52){//Efface la réponse
		$poubelle = "./files/$classe/_Copies/_Poubelle";
		if(!file_exists($poubelle)) {
			mkdir($poubelle);
			affiche("$poubelle crée");
		}
		$file2delete = $_GET[dir];
		if(file_exists($file2delete)){
			$apres = "./files/$classe/_Copies/_Poubelle/trash.txt";
			rename($file2delete, $apres);			
		}

		$Message = "Réponse $file2delete supprimée";
		echo("<p>Action 52 : $Message</p>");
	}	



	if($action==32){//Efface les réponses
		$repertoireDcopies = "./files/$classe/_Copies";
		$listeDrepondants = scandir($repertoireDcopies);
		$poubelle = "./files/$classe/_Copies/_Poubelle";
		if(!file_exists($poubelle)) {
			mkdir($poubelle);
			affiche("$poubelle crée");
		}
		
		foreach($listeDrepondants as $txt){
			$dossier_rep = "./files/$classe/_Copies/$txt/rep/";
			if(file_exists($dossier_rep)){
				$listeDreponses = scandir($dossier_rep);
				foreach($listeDreponses as $filename){
					if(($filename[0]=="I")||($filename[0]=="R")||($filename[0]=="Q")||($filename[0]=="s")) {
						$avant = "./files/$classe/_Copies/$txt/rep/$filename";
						$apres = "./files/$classe/_Copies/_Poubelle/$filename";
						rename($avant, $apres);
					}
				}
			}
		}
		$Message = "Réponses supprimées";
		echo("<p>Action 32 : $Message</p>");
	}	
	

	
	
	function file_liste($dir){
		$lesrepertoires = scandir($dir);
		$laliste = "";
		$bak = "";
		$br = "";
		foreach($lesrepertoires as $nom17){
			$part = explode(".", $nom17);
			
			if($part[1]=="txt") {
				$link = "<a href=\"./DSZone.php?action=51&dir=$dir/$nom17\">";
				if(strpos("_$nom17", "sessions")) $link = "<a href=\"$dir/$nom17\">";
				$laliste .= "$br$link$nom17</a>";
				$br = "<br/>";
			}
			$bak = $part[0];
		}
		return $laliste;
	}
	
	$repertoire_DS = "./files/$classe/_Copies/";
	$lesrepertoires = scandir($repertoire_DS);
	
	titre_tab("<a href=\"./DSZone.php\"><img src=\"./icon/reload.png\" height=\"20px\"/></a> Les copies");
	$i=0;
	echo("<table><tr>");
	foreach($lesrepertoires as $nom17){
		$nomsujet2DS = "$repertoire_DS$nom17/index.htm";
		if((file_exists($nomsujet2DS))and($nom17!="_Poubelle")){
			$i++;
			$photo = "./photos/$nom17.jpg";
			if(!file_exists($photo)) $photo = "./photos/----.jpg";
			$bouton = bouton_onoff($nom17,$classe);
			$etatonoff = state_onoff($nom17, $classe);
			if($etatonoff) $classetd =" bgcolor=\"#01DF74\" ";
			else $classetd =" bgcolor=\"#FF4000\" ";
			$nb2sessions = nb2connections($nom17, $classe);
			$info_session = "($nb2sessions)";
			if($nb2sessions) $info_session = "<a href=\"$repertoire_DS$nom17/rep/sessions.txt\">($nb2sessions)</a>";
			$efface = "<a href=\"./DSZone.php?action=111&nom=$nom17\" color=\"red\"><img src=\"./icon/effacer.jpg\" height=\"15px\" align=\"bottom\"></a>";
			echo("<td $classetd><b><u>$nom17</u></b><br/><a href=\"./copie2DS.php?name=$nom17&file=$nomsujet2DS\" target=\"_blank\"><img src=\"$photo\" height=\"100px\"></a><br/>$info_session $bouton $efface</a></td>");
			if($i==7){
				echo("</tr><tr>");
				$i=0;
			}
		}
		
	}
	echo("</tr></table>");
	
	titre_tab("Les sujets");
		
	echo("<table><tr><td>");
	$repertoire_Sujets = "./files/$classe/_Copies/_Sujets";
	$lessujets = scandir($repertoire_Sujets);
	foreach($lessujets as $nom01){
		if(estfichier($nom01)) {
			$filename = "$repertoire_Sujets/$nom01/index.htm";
			$repsujet = "$repertoire_Sujets/$nom01";
			if(file_exists($filename)){
				$fp = fopen($filename, "r");
				$titre2ds = fgets($fp);
				fclose($fp);
				$hauteur = "30px";
				echo("<td><font size=\"+1\"><b>$nom01</b> - $titre2ds<font></td>");
				echo("<td><a href=\"./devoir.php?name=_Sujets/$nom01&file=$repsujet\" target=\"_blank\"><img src=\"./icon/sujet_mod.png\" height=\"$hauteur\"></a></td>");
				echo("<td><a href=\"./copie2DS.php?name=_Sujets/$nom01&file2=$repsujet&calc=1\" target=\"_blank\"><img src=\"./icon/sujet.png\" height=\"$hauteur\"></a></td>");
				echo("<td><a href=\"./sujet2DS.php?name=_Sujets/$nom01&file2=$repsujet&calc=1\" target=\"_blank\"><img src=\"./icon/distrib.png\" height=\"$hauteur\"></a></td>");
				echo("<td><a href=\"$filename\" target=\"_blank\">Le sujet</a></td></tr><tr><td>\n");
			}
			
		}
	}
	
	echo("</td></tr></table>");
	
	//Création du menu pour la liste des répertoires
	$repertoireDcopies = "./files/$classe/_Copies";
	$listeDrepondants = scandir($repertoireDcopies); //echo(count($listeDrepondants));
	$menu_nom = "<select name=\"nom\">";
	$menu_nom .= "<option selected>Tous</option>";
	$u=0;
	foreach($listeDrepondants as $txt){
		if(($txt[0]!="_")&&($txt[0]!=".")&&($txt[0]!="-")&&($txt!="rep")) $menu_nom .= "<option>$txt</option>";
	}
	$menu_nom .= "</select>";
	
	
?>
	<table>
		<form name="envoi fichier 2" enctype="multipart/form-data" method="post" action="<?php echo("$action44");?>">
		<tr><td>Envoi d'un sujet à</td>
		<td><?php echo("$menu_nom");?></td>
		<td><input name="fichier_choisi" type="file"></td>
		<td><input name="bouton" value="Envoyer" type="submit">
		</td>
		</tr>
		</form>
	</table>
<?php
	titre_tab("Actions sur les fichiers");
?>
<table><tr>
<td>
	<form method="post" action="DSZone.php?action=30">
		<input name="bouton" value="Effacer les sujets (pas les r&eacute;ponses)" type="submit">
	</form>
</td>
<td>
	<form method="post" action="DSZone.php?action=31">
		<input name="bouton" value="Effacer les r&eacute;ponses (pas les sujets)" type="submit">
	</form>
</td>
</tr></table>
<?php
	titre_tab("Liste des fichiers .txt des répertoires réponses");
	echo("<table>");
	$i=0;
	$contenu_case1 = "";
	$contenu_case2 = "";
	foreach($lesrepertoires as $nom17){
		$lesreponses = "$repertoire_DS$nom17/rep";
		if(file_exists($lesreponses)&&($nom17!=".")){
			$i++;
			$contenu_case1 .= "<td><b>$nom17</b></td>";
			$contenu_case2 .= "<td>".file_liste($lesreponses)."</td>";
			if($i==5){
				echo("<tr>$contenu_case1</tr>");
				echo("<tr valign=\"top\">$contenu_case2</tr>");
				$contenu_case1 = "";
				$contenu_case2 = "";
				$i=0;
			}
		}
	}
	echo("</tr>$contenu_case1</tr>");
	echo("</tr>$contenu_case2</tr>");	
	echo("</table>");

	include("./bas.php");
?>

</td><td valign="top" width="210px"><!-- Partie à droite -->
	<br><br><br><hr>
	<div id="news">
                <input type="submit" name="executer" value="----------" class="button">
    </div>
</td></tr></table>
