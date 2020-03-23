<script>
		
	function miseajour() {
        ip = document.getElementById("les_messages");
         
        var xhr = null;
        var xhr = new XMLHttpRequest();
         
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
                ip.innerHTML = xhr.responseText;
            }
        };
         
        xhr.open("GET", "./chatES.php", true);
        xhr.send(null);         
    }
	
	// Appelle la fonction diminuerCompteur toutes les secondes (1000 millisecondes)
    setInterval(miseajour, 1000);
	
	
	function logout(){
		document.cookie = 'elv=';
		document.cookie = 'password=';
		lien = './chat.php';
		window.location.replace(lien);
	}
	
	function login(){
	
	pwd = document.getElementById('password').value;
	elv = document.getElementById('elv').value;
	classe = document.getElementById('classe').value;
		
	document.cookie = 'elv='+elv;
	document.cookie = 'password='+pwd;
	document.cookie = 'laclasse='+classe;	
	
	lien = './chat.php';
	window.location.replace(lien);
}

</script>


<?php
	$classe = $_COOKIE["laclasse"]; if($classe=="") $classe="CIRA1";
	$action44 = "./DSZone.php?action=44";
	$action = $_GET[action];
	$repertoire_Sujets = "./files/$classe/_Copies/_Sujets";
	
	
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
		$lebonnom = $_POST[nom];
		$lebontd = $_POST[td];
		$nomTemporaire = "$repertoire_Sujets/$lebontd/index.htm";
		
		if($lebonnom=="Tous"){
			foreach($leleve as $txt){//Distribution du sujet à chaque élève
				$chemin = "./files/$classe/_Copies/$txt/index.htm";
				if(copy($nomTemporaire, $chemin)){
					$Message .= "Votre fichier $chemin est importé<br>" ;
					chmod("$chemin",0777);
				}
				else $Message .= "La sauvegarde vers $chemin a échouée !!<br>" ;
			}
		}
		else {
			$chemin = "./files/$classe/_Copies/$lebonnom/index.htm";
			if(copy($nomTemporaire, $chemin)){
				$Message .= "Votre fichier $chemin est importé<br>" ;
				chmod("$chemin",0777);
			}
			else $Message .= "La sauvegarde vers $chemin a échouée !!<br>" ;
		}		
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
	
	if($action==111){//Efface les réponses de nom111 et le sujet - demande de confirmation
		$nom111 = $_GET[nom];
		$td111 = $_GET[td];
		echo("<form method=\"post\" action=\"DSZone.php?action=110&nom=$nom111&td=$td111\">");
		echo("<table><tr><td>Archiver le $td111 de $nom111 ? <input type=\"submit\" value=\"OUI\"> ");
		echo("<input type=\"button\" value=\"NON\" onclick=\"gotolien('./DSZone.php')\"></td></tr></table>");
		echo("</form>");
	}	

	if($action==110){//Efface les réponses de nom111 et le sujet
		$nom111 = $_GET[nom];
		$td111 = $_GET[td];
		$dossier_rep = "./files/$classe/_Copies/$nom111/rep/";
		$dossier_bak = "./files/$classe/_Copies/$nom111/rep/$td111/"; //echo("<p>$dossier_bak</p>");
		if(file_exists($dossier_rep)){
			$listeDreponses = scandir($dossier_rep);
			if(!file_exists($dossier_bak)) {
				echo("<p>Création dossier $dossier_bak</p>");
				mkdir($dossier_bak);
			}
			foreach($listeDreponses as $filename){
				if(($filename[0]=="I")||($filename[0]=="R")||($filename[0]=="Q")||($filename[0]=="s")) {
					$avant = "./files/$classe/_Copies/$nom111/rep/$filename";
					$apres = "$dossier_bak$filename";
					rename($avant, $apres);
				}
			}
			$avant = "./files/$classe/_Copies/$nom111/index.htm";
			$apres = $dossier_bak."index.htm";
			rename($avant, $apres);
		}
		$Message = "$td111 de $nom111 archivé";

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
			$dossier_poubelle = $dossier_rep."Poubelle/";
			if(!file($dossier_poubelle)) mkdir($dossier_poubelle); //Créé une poubelle par élève 
			
			if(file_exists($dossier_rep)){
				$listeDreponses = scandir($dossier_rep);
				foreach($listeDreponses as $filename){
					if(($filename[0]=="I")||($filename[0]=="R")||($filename[0]=="Q")||($filename[0]=="s")) {
						$avant = "./files/$classe/_Copies/$txt/rep/$filename";
						$apres = "$dossier_poubelle$filename";
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
	
	
	
	// ------------------------------------------------------------------------------   LES COPIES
	titre_tab("<a href=\"./DSZone.php\"><img src=\"./icon/reload.png\" height=\"20px\"/></a> Les copies");  
	$i=0;
	echo("<table><tr>");
	foreach($lesrepertoires as $nom17){
		$nomsujet2DS = "$repertoire_DS$nom17/index.htm";
		if((file_exists($nomsujet2DS))and($nom17!="_Poubelle")){
			// Lecture du nom du sujet
			$fp_sujet1 = fopen($nomsujet2DS, "r");
			$ligne1 = fgets($fp_sujet1);
			fclose($fp_sujet1);
			$part_ligne1 = explode("#", $ligne1);
			$titre_sujet = $part_ligne1[1];
			
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
			$efface = "<a href=\"./DSZone.php?action=111&nom=$nom17&td=$titre_sujet\" color=\"red\"><img src=\"./icon/effacer.jpg\" height=\"15px\" align=\"bottom\"></a>";
			echo("<td $classetd><b><u>$nom17</u></b><br/>$titre_sujet<br/><a href=\"./copie2DS.php?name=$nom17&file=$nomsujet2DS\" target=\"_blank\"><img src=\"$photo\" height=\"100px\"></a>$info_session $bouton $efface</a></td>");
			$Nom_et_sujet[$k] = "$nom17:$titre_sujet:"; $k++; //La liste de nom et du sujet associé
			if($i==7){
				echo("</tr><tr>");
				$i=0;
			}
		}
		
	}
	echo("</tr></table>");
	
	titre_tab("Les sujets");//----------------------------------------------------    LES SUJETS
	echo("<!-- LES SUJETS -->");
	echo("<table><tr><td>");
	$lessujets = scandir($repertoire_Sujets);
	$menu_td = "<select name=\"td\">";
	foreach($lessujets as $nom01){
		if(estfichier($nom01)) {
			$filename = "$repertoire_Sujets/$nom01/index.htm";
			$repsujet = "$repertoire_Sujets/$nom01";
			$menu_td .= "<option>$nom01</option>";
			if(file_exists($filename)){
				$fp = fopen($filename, "r");
				$titre2ds = fgets($fp);
				fclose($fp);
				$hauteur = "30px";
				echo("<td><font size=\"+1\"><b>$nom01</b> - $titre2ds<font></td>");
				echo("<td><a href=\"./devoir.php?name=_Sujets/$nom01&file=$repsujet\" target=\"_blank\" Title=\"Corriger\"><img src=\"./icon/sujet_mod.png\" height=\"$hauteur\"></a></td>");
				echo("<td><a href=\"./copie2DS.php?name=_Sujets/$nom01&file2=$repsujet&calc=1\" target=\"_blank\" Title=\"Correction\"><img src=\"./icon/sujet.png\" height=\"$hauteur\"></a></td>");
				echo("<td><a href=\"./sujet2DS.php?name=_Sujets/$nom01&file2=$repsujet&calc=1\" target=\"_blank\" Title=\"Sujet\"><img src=\"./icon/distrib.png\" height=\"$hauteur\"></a></td>");
				echo("</tr><tr><td>\n");
			}
			
		}
	}
	echo("</td></tr></table>");
	$menu_td .= "</select>";
	
	
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
		<td><?php echo($menu_nom);?></td>
		<td><?php echo($menu_td);?></td>
		<!-- <td><input name="fichier_choisi" type="file"></td> -->
		<td><input name="bouton" value="Envoyer" type="submit">
		</td>
		</tr>
		</form>
	</table>

<?php
	titre_tab("Création");
?>
<!--                                                           NOUVEAU SUJET -->
<table><tr>
<form method="post" action="DSNew.php">
<td>
<input type="hidden" value="1" name="action">
TAG du sujet : <input type="text" name="TAG" size="10px"></td><td>
Titre du sujet : <input type="text" name="titre" size="50px"></td><td>
<input name="bouton" value="Nouveau sujet" type="submit">
</td>
</form>
</tr>
<tr>
<form method="post" action="DSNew.php">
<td>
<input type="hidden" value="2" name="action">
TAG du sujet : <?php echo($menu_td);?></td><td> 
</td><td>
<input name="bouton" value="Editer" type="submit">
</td></tr>
</table>


<!-- Action sur les fichiers supprimé le 21/03/2020
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
-->


<?php
	//----------------------------------------------------    LES REPONSES
	titre_tab("Liste des fichiers .txt des répertoires réponses");
	echo("<table>");
	$i=0;
	$contenu_case1 = "";
	$contenu_case2 = "";
	foreach($Nom_et_sujet as $nom1_sujet1){
		$part_of1 = explode(":", $nom1_sujet1);
		$nom17 = $part_of1[0]; 

		$lesreponses = "$repertoire_DS$nom17/rep";
		if(file_exists($lesreponses)&&($nom17!=".")){
			$i++;
			$contenu_case1 .= "<td><b>$nom17</b></td>";
			$contenu_case2 .= "<td>".file_liste($lesreponses)."</td>";
			if($i==8){
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

	include("./bas_DS.php");
?>



<!-- Partie à droite -->
</td><td valign="top" width="210px">
<span id="les_messages"></span>
</td></tr></table>
