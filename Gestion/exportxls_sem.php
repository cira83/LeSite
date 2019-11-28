<?php
	header ("Content-type: text/plain");//Pour le faire considérer par le système comme un fichier texte et non html
	
	$sem = $_GET[sem];
	
	foreach($tableaudesmatieres as $mat){
		$txt_output .= "$mat\n";
	}	
	
	//echo($txt_output);
	
	//header("Content-Type: application/csv-tab-delimited-table");
	header("Content-disposition: attachment; filename=$part[0]_" . date("d_m").".txt");
	print $txt_output;
	exit;
?>