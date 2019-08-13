<?php 
	include("./haut.php");
	
	$mat = $_GET[mat];
	$epr = $_GET[epr];
	$modif = $_GET[modif];
	$laliste = $_POST[laliste];
	$action = $_GET[action];
	$nb2copies = 0; //nb de copies rendues
	
	
	$nbphotoslignes = 7.5;
	
	if($epr=="") $epr=$_POST[epreuve].".txt";
	if($mat=="") $mat=$_POST[mat];
	$lien_sujet = $_POST[lien];//Lien http vers le sujet -- modif du 21 novembre 2017
	$nomdufichierlien = "$files$classe/$mat/_link$epr";
	if($lien_sujet){
		if(!file_exists($nomdufichierlien)){
			$fp12 = fopen($nomdufichierlien, "w");
			fprintf($fp12,"$lien_sujet");
			fclose($fp12);
		}
	}
	//FTP 
	$ftp_filename = $nomdufichierlien;
	
	//Ouverture du fichier MDR
	$nomdufichiermdr = "$files$classe/$mat/_mdr$epr";
	$mdr_file = fopen($nomdufichiermdr, "w");

	
	$fichier = $files."$classe/$mat/$epr"; //echo($fichier."--".$laliste);
	//lien($fichier);
	
	
	//-- Entête de la page ---------------------------------------------------------------------
	if(file_exists($nomdufichierlien)){
		$fp12 = fopen($nomdufichierlien, "r");
		$sujet_lien = fgets($fp12);
		fclose($fp12);
		tableau("<b>$mat</b></td><td><a href=\"$fichier\">$epr</a></td><td><a href=\"$sujet_lien\" target=\"_blank\">Le sujet</a>");
	}
	else tableau("<b>$mat</b></td><td><a href=\"$fichier\">$epr</a>");
	
	
	//Création du fichier si il n'existe pas
	if(!file_exists($fichier)) {
		echo("<p>Le fichier est crée.</p>");
		$personne = explode(":", $laliste); //affiche("!!".$laliste);
		$handle = fopen($fichier, "w");
		for($i=0;$i<count($personne)-1;$i++) {
			fprintf($handle, "$personne[$i]::1:");
			if($i<count($personne)-2) fprintf($handle, "\n");
		}		
		fclose($handle);
	}
	
	//Ajout des nouvelles informations dans le fichier
	if($modif=="oui"){
		$newnote = str_replace(",", ".", $_POST[note]);
		$newnom = $_POST[nom];
		$newcoef = $_POST[coef];
		$newdate = $_POST[date]; if($newdate=="") $newdate = $date0212;
		$newcause = $_POST[cause];
		$url = $_POST[url];
		$rq = $_POST[rq];
		echo("<p>Nouvelle note pour $newnom : $newnote ($newcoef) le $newdate<p>");
		$handle = fopen($fichier, "a");
		fprintf($handle, "\n$newnom:$newnote:$newcoef:$newdate:$newcause:$url:$rq:");
		fclose($handle);
	}
	
	if($action==44){//insertion d'un fichie de note - ne sert plus
		$chemin = "./files/$classe/$mat/$epr";
		
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
	
			if(copy($nomTemporaire, $chemin)){
				$Message = "Votre fichier $chemin est import&eacute;" ;
				chmod("$chemin",0777);
			}
			else $Message = "La sauvegarde a &eacute;chou&eacute; !!" ;
		}
		else $Message = "Vous n'avez pas choisit de fichier !!";
		echo("<p>Action 44 : $Message</p>");
	}

	if($action==45){//Rangement d'une copie dans le dossier elv  #####
		$nom45 = $_POST[elv];
		$epr45 = explode(".", $epr);
		//Création du répertoire si nécéssaire
		$repertoire_elv = "$repertoire_copies";
		if(!file_exists($repertoire_elv)){
			mkdir($repertoire_elv, 0777);
			affiche("-- $repertoire_elv cr&eacute;e --");
		}
		$repertoire_elv = "$repertoire_copies/$nom45";
		if(!file_exists($repertoire_elv)){
			mkdir($repertoire_elv, 0777);
			affiche("-- $repertoire_elv cr&eacute;e --");
		}
		
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

			//Recherche du nom de l'élève et le place dans $nom45 - Le 31/09/2016		
			for($j=0;$j<count($leleve);$j++){
				if(stripos($nomFichier,$leleve[$j])){
					$nom45 = $leleve[$j];
				}
			}
			$chemin = "$repertoire_copies/$nom45/";
			
			if(stripos($nomFichier, $nom45)){
				if(copy($nomTemporaire, $chemin.$nomFichier)){
					$Message = "Votre fichier $chemin$nomFichier est import&eacute;" ;
					chmod("$chemin$nomFichier",0777);
				}
				else $Message = "La sauvegarde a &eacute;chou&eacute; de $chemin$nomFichier !!" ;
			}
			else $Message = "Le fichier choisi [$nomFichier] ne contient pas le nom de l'&eacute;l&egrave;ve [$nom45] !!" ;
		}
		else $Message = "Vous n'avez pas choisit de fichier !!";
		echo("<p>Action 45 : $Message</p>");
	}
	
	//Lecture du fichier, toutes les lignes sont dans $ligne[]
	$handle = fopen($fichier, "r");
	if($handle){
		$i = 0;
		$j = 0;
		while (!feof($handle)){
			$ligne[$i] = fgets($handle);
			$data = explode(":", $ligne[$i]);
			if($j==0){
				$listeofname[0]=$data[0];
				$j++;
			}
			$flag = true;
			for($k=0;$k<count($listeofname);$k++) {
				if($data[0]==$listeofname[$k]) $flag = false;
			}
			if($flag){
				$listeofname[$j] = $data[0];
				$j++;
			}
			$i++;
		}
	}
	fclose($handle);
	
	//afficheliste($listeofname);
	sort($listeofname); //Classes les noms dans l'ordre alphabétique
	
	$j = 0;
	$n = 0;
	echo("<table>");
	for($i=0;$i<count($listeofname);$i++){
		
		for($k=0;$k<count($ligne);$k++){
			$data = explode(":", $ligne[$k]);
			if($data[0]==$listeofname[$i]){
				$note = $data[1];
				$coef = $data[2]; if($coef=="") $coef=1;
				$date0212 = $data[3];//la date de modification de la note
				
				//compare la date et aujourd'hui - 09/2017
				$part0917_1 = explode(" ", $date0212);
				$part0917_2 = explode(" ", $date_heure);
				$drap_passe = false;
				$signe = $data[4][0];
				if(($part0917_2[0]==$part0917_1[0])&&($signe=="+")) $drap_passe = true;
			}
		}
		$nom = $listeofname[$i];
		$lien = "./modif.php?mat=$mat&epr=$epr&nom=$nom";
		if($date0212!=$nonfait){
			$listedesparticipants .= $nom.":";//Necessaire à la création de nouvelles copies
			$somme_note += $note; 
			if($note!="") {
				$somme_coef++;//ne prendre que les copies notées
				$lesnoms14[$n]=$listeofname[$i];
				$lesnotes[$n] = $note; $n++;
			}
			
																													//CREATION DU TABLEAU
			
			$pas = nbparticipants($nom);//pour les groupes de plusieurs personnes
			
			if($j==0) {//première ligne
				$line1 .= "<table>";
				//$line2 = "<tr>";//modif du 6 septembre 2017
			}
			$j = $j + $pas;
			
			//Fichiers
			$lien_copies_tab = explode(":",lescopies3($nom,$classe,$epr,$repertoire_copies));//Liens vers les copies :+ codes md5
			$lien_copies = $lien_copies_tab[0];// Les liens vers les copies rendues
			if($lien_copies) $nb2copies++; //compte le nombre de copie rendue
			fwrite($mdr_file, "$lien_copies_tab[1]\n");//####
			$drap_dejavu = dejavu($lien_copies_tab[1],$liens_vus);
			$liens_vus .= $lien_copies_tab[1];
			
			
			$bgcolor = "#c0c0c0";
			if(!$note) $photo = photobord($nom,"#fff");
			else $photo = photobord($nom,"#00b900");
			if($lien_copies) {
				if(!$note) $photo = photobord($nom,"#fffb01");
			}
						
			//Dèjà passé au tableau - 18/09/2017
			if($drap_passe) $photo = photobord($nom,"#FF8000");
			//Copie déjà vue		
			if($drap_dejavu) $photo = photobord($nom,"#f00");
			
			
			

			if($j<=4){//Modif le 27/09/2016
				$line1 .= "<td>$photo<br/>$lien_copies<a href=\"$lien\">$nom $note ($coef)</a></td>";
				//$line2 .= "<td bgcolor=\"$bgcolor\">$lien_copies<a href=\"$lien\">$nom $note ($coef)</a></td>";
			}
			else {
				$line1 .= "<td>$photo<br/>$lien_copies<a href=\"$lien\">$nom $note ($coef)</a></td></tr></table>\n";
				//$line2 .= "<td bgcolor=\"$bgcolor\">$lien_copies<a href=\"$lien\">$nom $note ($coef)</a></td></tr>\n";
				//$line1 .= $line2;
				//$line2 = "";
				$j = 0;
			}
		}
		else {
			$listedesnonfait .= "<a href=\"$lien\">".$nom."</a> ";
		}
	}

	echo($line1);	
	echo("</table>");
	
	$action44 = "./epreuve.php?action=45&mat=$mat&epr=$epr";
	$menu_elv = menu_deroulant($leleve,"elv");
?>	
	<!-- 04-04 Ligne importation des notes -->
	<!-- <table><form name="envoie fichier" enctype="multipart/form-data" method="post" action="<?php echo "$action44";?>">
		<tr><td>Importation de notes</td>
		<td><input name="fichier_choisi" type="file"></td>
		<td><input name="bouton" value="Envoyer le fichier" type="submit">
		</td>
		</tr>
	</form></table>
	-->
	<!-- 04-04 Ligne importation de fichiers -->
	<table><form name="envoie fichier" enctype="multipart/form-data" method="post" action="<?php echo "$action44";?>">
		<tr><td>Rangement du fichier corrigé (ciblé)</td>
		<td><input name="fichier_choisi" type="file"></td>
		<td><input name="bouton" value="Envoyer le fichier corrig&eacute;" type="submit">
		</td>
		</tr>
	</form></table>

<?php
/*
	if($somme_coef>0) {
		$moyenne = number_format($somme_note/$somme_coef,2); //
		echo("<p>Moyenne de la classe : $moyenne ($somme_coef notes pour $nb2copies copies rendues)</p>");
	}
	
	$filesave = "./files/$classe/$mat/_$epr";
	//mars 2018
	$savefileicon = "<a href=\"exportxls.php?filesave=$filesave&file=$epr&moy=$moyenne\"><img src=\"./icon/backup.gif\" width=\"49px\" style=\"border:solid 1px #000000;\"></a>";
	
	$texte_notes = liste2texte($lesnotes);
	$texte_noms = liste2texte($lesnoms14);
	$image = "<a href=\"./geo.php?nomfichier=$filesave\">";
	$image .= "<img src=\"./graphe.php?notes=$texte_notes&filename=$filesave&noms=$texte_noms\"/></a>".$savefileicon;
	echo("<table><tr><td>$image</td>");
	
		echo("<td><a href=\"./pub_notes.php?filesave=$filesave&file=$epr&moy=$moyenne\">Publier les statistiques</a></td>");

	echo("</tr></table>");

	//Fichier à supprimer
	$aeffacer = "./files/$classe/$mat/$epr";
	$file2delete = "<a href=\"delfile.php?name=$aeffacer&action=0\">Supprimer</a> $epr";
	
	//Fichier à comparer
	$filecompare = "<a href=\"compare.php?mat=$mat&epr=$epr&classe=$classe\">Comparer</a> $epr";
	
	
	fclose($mdr_file);
	
	echo("<center>");
	//Nouvelle épreuves
	include("newepreuve.php");
	echo("</center>");
	
	//les epreuves 3 janvier 2017
	$tabEpreuves = tabEpreuves($classe,$mat);
	echo($tabEpreuves);
	include("./bas.php");
*/
?>
