<?php
	//$filesave = $_GET[filename];
	//$notes = explode(":", $_GET[notes]);
	//$noms = explode(":", $_GET[noms]);

	function moyenne($notes){
		if(count($notes)>1) {
			$sigma = 0;
			for($i=0;$i<count($notes);$i++) $sigma += $notes[$i];	
			$moyenne = $sigma/$i;		
		}
		else $moyenne = -1;
		
		return $moyenne;
	}	
	
	function distribution_note($notes) {
		for($i=0;$i<10;$i++) $value[$i] = 0;
		foreach($notes as $valeur) {
			$entier = explode(".", $valeur);
			if($entier[0]<20) $value[intdiv($entier[0],2)]++;
			else if($entier[0]<30) $value[9]++;
		}
		return($value);
	}
	
	function create_graphe_svg($id,$value,$moyenne) {
		$max = 1;//Pour ne pas diviser par 0
		for($i=0;$i<10;$i++)
			if($value[$i]>$max) $max = $value[$i];
		$stepy = 34/$max;
		
		$image_svg = "<svg id=\"$id\" width=\"400\" height=\"50\">\n";
		$image_svg .= "<!-- max=$max -->\n";
		$image_svg .= "<rect width=\"400\" height=\"50\" style=\"fill:rgb(255,255,255);stroke-width:2;stroke:rgb(0,0,0)\" />\n";
		$image_svg .= "<rect width=\"400\" height=\"35\" style=\"fill:#efefef;stroke-width:2;stroke:rgb(0,0,0)\" />\n";
		
		for($i=1;$i<$max;$i++) {
			$dy = $i*$stepy;
			$y0 = intval(35-$dy);
			$image_svg .= "<line x1=\"1\" y1=\"$y0\" x2=\"399\" y2=\"$y0\" style=\"stroke:#333;stroke-width:1\"/>\n";
		}
		for($i=0;$i<10;$i++) {
			$x = $i*40 + 4;
			$tx = 2*$i;
			$ptx = $x - 6;
			if($i>4) $ptx = $ptx - 4;
			$dy = $value[$i]*$stepy;
			$y0 = 35-$dy ;
			$image_svg .= "<!-- $i = $value[$i] -->\n";
			$image_svg .= "<rect x=\"$x\" y=\"$y0\" id=\"BN$i\" width=\"34\" height=\"$dy\" style=\"fill:#ffed02;stroke-width:1;stroke:rgb(0,0,0)\" />\n";
			if($i>0) $image_svg .= "<text x=\"$ptx\" y=\"47\" fill=\"black\" font-family=\"Times\" font-size=\"12\">$tx</text>\n";
		}
		$x = 2+$moyenne*20-1;
		if($moyenne>-1) $image_svg .= "<line id=\"moyenne\" x1=\"$x\" y1=\"1\" x2=\"$x\" y2=\"36\" style=\"stroke:#F00;stroke-width:3\"/>\n";
		$image_svg .= "<line id=\"moyenne\" x1=\"#\" y1=\"1\" x2=\"#\" y2=\"36\" style=\"stroke:rgb(0,0,0);stroke-width:3\"/>\n";

		
		$image_svg .= "</svg>";
		return $image_svg;
	}

	function extract_name($filesave) {
		$part1 = explode("/", $filesave);
		$part2 = explode(".", $part1[count($part1)-1]);
		return $part2[0];
	} 
	
	//Ecriture du fichier texte
	for($i=0;$i<count($notes);$i++){
		if($i<count($notes)-1) {
			$listedesnotes .= rtrim("$notes[$i]").":";//pour nettoyer
			$listedesnoms .= rtrim("$noms[$i]").":";
		}
		else {
			$listedesnotes .= rtrim("$notes[$i]");
			$listedesnoms .= rtrim("$noms[$i]");
		}
	}
	//id du graphique
	$svg_name = "no_name";
	
	$moyenne = moyenne($notes);
	$value = distribution_note($notes);
	$image_svg = create_graphe_svg("$svg_name",$value,$moyenne); 	
	if($filesave) {
		$svg_name = extract_name($filesave);
		$fp = fopen($filesave, "w");
		fprintf($fp, "$listedesnotes\n$listedesnoms");
		fclose($fp);
		$filesave = str_replace("txt", "svg", $filesave);
		$fp = fopen($filesave, "w");
		fprintf($fp, "$image_svg");
		fclose($fp);		
	}

	echo($image_svg);
?>
	
