<?php 
	$action = $_POST[action];//1. Nouveau Sujet 2.Editer sujet 3.Supprimer Ligne 4.Editer Ligne 5. Ajouter ligne 6. Saut de page
	if($action==1) $TAG = $_POST[TAG];//nouveau sujet
	else $TAG = $_POST[td];//edition sujet
	$num2ligne = $_GET[ligne];
	$champs = $_POST[Champs];
	
	if(!$action) $action = $_GET[action];
	if(!$TAG) $TAG = $_GET[TAG];
	$requete = "./imagesES.php?TAG=$TAG";
	$lettres = array("C","Q","I","T","I","U","L");
	$classe = $_COOKIE["laclasse"]; if($classe=="") $classe="CIRA1";
	$repertoire_Sujets = "./files/$classe/_Copies/_Sujets/";
	$repertoire_Images = "./files/$classe/_Copies/_Sujets/$TAG/img/";
	
	$titre = $_POST[titre];
	
	
?>
<script>
		
	function miseajour() {
        ip = document.getElementById("images");
         
        var xhr = null;
        var xhr = new XMLHttpRequest();
         
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
                ip.innerHTML = xhr.responseText;
            }
        };
         
        xhr.open("GET", "<?php echo($requete);?>", true);
        xhr.send(null);         
    }
	
	// Appelle la fonction diminuerCompteur toutes les secondes (1000 millisecondes)
    setInterval(miseajour, 2000);

	function addimage(lavaleur){
		back = document.getElementById('Champs').value;
		tipe = document.getElementById('tipe').value;
		if(tipe!="I") new_valeur = "<img src=\"<?php echo($repertoire_Images);?>" + lavaleur + "\">";
		else new_valeur = "<?php echo($repertoire_Images);?>" + lavaleur;
		document.getElementById('Champs').value = back + new_valeur;
	}

</script>



<?php
	// FONCTIONS
	function est_image($image) {
		$type_img = array("jpg","jpeg","gif","png");
		
		$part = explode(".",rtrim($image));
		$ext = $part[count($part)-1];
		return(in_array($ext,$type_img));
	}
	
	function ligne($numero,$code,$contenu,$quest,$page,$TAG) {
		$SUP = "<a href=\"./DSNew.php?action=3&ligne=$numero&TAG=$TAG\" title=\"Supprimer\"><img src=\"icon/Moins.gif\"/></a>";
		$C = "<a href=\"./DSNew.php?action=5&ligne=$numero&TAG=$TAG\" title=\"Commentaire\"><img src=\"icon/C_vert.gif\"/></a>";
		$Mod = "<a href=\"./DSNew.php?action=4&ligne=$numero&TAG=$TAG\" title=\"Mofifier\"><img src=\"icon/Editer.gif\"/></a>";
		$Q = "<a href=\"./DSNew.php?action=51&ligne=$numero&TAG=$TAG\" title=\"Question\"><img src=\"icon/Q_vert.gif\"/></a>";
		$T = "<a href=\"./DSNew.php?action=52&ligne=$numero&TAG=$TAG\" title=\"R&eacute;ponse courte\"><img src=\"icon/T_vert.gif\"/></a>";
		$U = "<a href=\"./DSNew.php?action=53&ligne=$numero&TAG=$TAG\" title=\"R&eacute;ponse longue\"><img src=\"icon/Ligne.gif\"/></a>";
		$I = "<a href=\"./DSNew.php?action=54&ligne=$numero&TAG=$TAG\" title=\"R&eacute;ponse image\"><img src=\"icon/I_vert.gif\"/></a>";
		$L = "<a href=\"./DSNew.php?action=6&ligne=$numero&TAG=$TAG\" title=\"Saut de page\"><img src=\"icon/Page.gif\"/></a>";
		$BR = "<br>";
		$HR = "<hr>";
		switch($code) {
			case "C": 
				echo("<table><tr><td align=\"left\">$contenu</td><td width=\"10px\"><img src=\"icon/C_vert.gif\"/>$HR$SUP$BR$Mod$BR$C$BR$Q$BR$L</td><tr></table>");
				break;
			case "Q": 
				echo("<table><tr><td align=\"left\"><font color=\"blue\">Q$quest)</font> $contenu</td><td width=\"10px\"><img src=\"icon/Q_vert.gif\"/>$HR$SUP$BR$Mod$BR$C$BR$T$BR$U$BR$I</td><tr></table>");
				break;
			case "T":
				echo("<table><tr><td align=\"left\">Réponse texte sur une ligne</td><td width=\"10px\"><img src=\"icon/T_vert.gif\"/>$HR$SUP$BR$C$BR$Q$BR$L</td><tr></table>");
				break;
			case "U":
				echo("<table><tr><td align=\"left\">Réponse sur plusieurs lignes</td><td width=\"10px\"><img src=\"icon/Ligne.gif\"/>$HR$SUP$BR$C$BR$Q$BR$L</td><tr></table>");
				break;
			case "I":
				echo("<table><tr><td align=\"left\"><img src=\"$contenu\"></td><td width=\"10px\"><img src=\"icon/I_vert.gif\"/>$HR$SUP$BR$Mod$BR$C$BR$Q$BR$L</td><tr></table>");
				break;
			case "L":
				echo("<table><tr><td bgcolor=\"white\">Page $page</td><td width=\"10px\"><img src=\"icon/Page.gif\"/>$HR$SUP$BR$C$BR$Q</td><tr></table>");
				break;
		}
	}
	
	function lecture($filename, $numero) {
		$fp = fopen($filename, "r");
		while(!feof($fp)){
			$ligne = fgets($fp);
			$i++;
			$part = explode("#", $ligne);
			if($i==$numero) $partie = rtrim($ligne);
		}
		fclose($fp);
		return $partie;
	}
	
	function ecriture($chemin_du_sujet, $num2ligne,$champs) {
		rename($chemin_du_sujet, "$chemin_du_sujet.bak");
		$source = fopen("$chemin_du_sujet.bak", "r");
		$cible = fopen($chemin_du_sujet, "w");
		$order   = array("\r\n", "\n", "\r");
		$replace = '<br/>';
		$champs1 = str_replace($order, $replace, $champs);
		while(!feof($source)){
			$ligne = fgets($source);
			$i++;
			$part = explode("#", $ligne);
			if($i==$num2ligne) fprintf($cible, "$part[0]#$champs1\n");
			else fprintf($cible, $ligne);
		}
	}
	
	function insert_ligne($chemin_du_sujet, $num2ligne,$champs) {
		rename($chemin_du_sujet, "$chemin_du_sujet.bak");
		$source = fopen("$chemin_du_sujet.bak", "r");
		$cible = fopen($chemin_du_sujet, "w");
		while(!feof($source)){
			$ligne = fgets($source);
			$i++;
			$part = explode("#", $ligne);
			if($i==$num2ligne+1) fprintf($cible, "$champs#\n");
			fprintf($cible, $ligne);
		}
		if($i==$num2ligne) fprintf($cible, "\n$champs#");
	}

	function del_ligne($chemin_du_sujet, $num2ligne) {
		rename($chemin_du_sujet, "$chemin_du_sujet.bak");
		$source = fopen("$chemin_du_sujet.bak", "r");
		$cible = fopen($chemin_du_sujet, "w");
		while(!feof($source)){
			$ligne = fgets($source);
			$i++;
			$part = explode("#", $ligne);
			if($i!=$num2ligne) fprintf($cible, $ligne);
		}
	}
		
	include("./haut_DS.php");

	//Création du répertoire
	$repertoire_du_sujet = $repertoire_Sujets."$TAG";
	if(!file_exists($repertoire_du_sujet)) {
		mkdir($repertoire_du_sujet);
		echo("<p>Dossier $TAG créer </p>");
		mkdir("$repertoire_du_sujet/img");
	}
	
	//Création du sujet
	$chemin_du_sujet = $repertoire_du_sujet."/index.htm";
	if(!file_exists($chemin_du_sujet)) {
		$fp = fopen($chemin_du_sujet, "a");
		fprintf($fp, "$titre#$TAG\n");
		fprintf($fp, "C#");
		echo("<p>Sujet créer </p>");
		fclose($fp);
	}	
	
	//Liste des images
	$Deroulant_image = "<select name=\"image\" onchange=\"addimage(this.value);\">";
	$Deroulant_image .= "<option>+ Image</option>";
	$LaListeDesImages = scandir($repertoire_Images);
	foreach($LaListeDesImages as $img) //echo("$img<br>");
	if(est_image($img)) $Deroulant_image .= "<option value=\"$img\">$img</option>";
	$Deroulant_image .= "</select>";
	
	
	if($action==3) {
		$contenu = lecture($chemin_du_sujet, $num2ligne);
		$message = "<table>";
		$message .= "<tr><td bgcolor=\"white\">$contenu</td><td>";
		$message .= "<tr></form></table>";
		$message .= "<table><form method=\"POST\" action=\"./DSNew.php?action=31&ligne=$num2ligne&TAG=$TAG\">";
		$message .= "<tr bgcolor=\"red\"><td><b>Supprimer ligne $num2ligne ??</b></td><td><input type=\"submit\"></td><tr></form></table>";
	}

	if($action==31) {
		del_ligne($chemin_du_sujet,$num2ligne);
	}
	
	if($action==4) {//Edition
		$contenu = lecture($chemin_du_sujet, $num2ligne);
		$part2ligne = explode("#", $contenu);
		
		$message = "<table><form method=\"POST\" action=\"./DSNew.php?action=41&ligne=$num2ligne&TAG=$TAG\">";
		$message .= "<tr><td bgcolor=\"white\"><textarea cols=\"130\" rows=\"5\" name=\"Champs\" id=\"Champs\">$part2ligne[1]</textarea></td><td>";
		$message .= "$Deroulant_image<br><br><input type=\"submit\"><input type=\"hidden\" id=\"tipe\" value=\"$part2ligne[0]\"></td><tr></form></table>";
		
		$message .= "<table><tr><td bgcolor=\"#0085cf\"><b>Edition ligne $num2ligne</b></td><tr></table>";
	}

	if($action==41) {
		ecriture($chemin_du_sujet, $num2ligne,$champs);
	}
	
	if($action==5) {
		insert_ligne($chemin_du_sujet, $num2ligne,"C");
	}
	
	if($action==51) {
		$contenu = insert_ligne($chemin_du_sujet, $num2ligne,"Q");
	}

	if($action==52) {
		insert_ligne($chemin_du_sujet, $num2ligne,"T");
	}

	if($action==53) {
		insert_ligne($chemin_du_sujet, $num2ligne,"U");
	}

	if($action==54) {
		insert_ligne($chemin_du_sujet, $num2ligne,"I");
	}
			
	if($action==6) {
		insert_ligne($chemin_du_sujet, $num2ligne,"L");
	}
	
	if($action==100) {
		//on vérifie que le champ est bien rempli:
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
		
			if(copy($nomTemporaire, $repertoire_Images.$nomFichier)){
				chmod("$repertoire_Images$nomFichier",0777);
				$extension = substr(strrchr($nomFichier, '.'), 1);
				$LDIMAGE = scandir($repertoire_Images);
				$nbimageplus1 = count($LDIMAGE) - 2;
				$nomFichier_propre = "$nbimageplus1.$extension";
				rename("$repertoire_Images$nomFichier", "$repertoire_Images$nomFichier_propre");
				$message .= "<table><tr><td>Votre fichier <font color=\"blue\">$nomFichier</font> est sauvegardé.</td><tr></table>" ;
			}
			else $message .= "<table><tr><td>La sauvegarde a échouée !!</td><tr></table>" ;
		}
		else $message .= "<table><tr><td>Pas de fichier choisi !!!</td><tr></table>" ;

	}
	
	$i=0;
	$quest=0;
	$page=0;
	$fp = fopen($chemin_du_sujet, "r");
	$ligne = fgets($fp);
	$i++;
	$part = explode("#", $ligne);
	titre_tab("<a href=\"./DSNew.php?TAG=$TAG\"><img src=\"./icon/reload.png\" height=\"20px\"/></a> $TAG $part[0]");
	echo($message);//informations et edition
	while(!feof($fp)){
		$ligne = fgets($fp);
		$i++;
		$part = explode("#", $ligne);
		if($part[0]=="Q") $quest++;
		if($part[0]=="L") $page++;
		if(in_array($part[0],$lettres)) ligne($i,$part[0],$part[1],$quest,$page,$TAG);
	}
	fclose($fp);
	
	
?>

<!-- Partie à droite -->
</td><td valign="top" width="210px">
<b>Images disponibles</b><br><hr>
<form name="envoie fichier" enctype="multipart/form-data" method="post" action="DSNew.php">
<input name="td" type="hidden" value="<?php echo($TAG);?>">
<input name="action" type="hidden" value="100">
<input name="fichier_choisi" type="file"><br>
<input type="submit"><br><hr>
</form>
<span id="images"></span>
</td></tr></table>