<?php
	header ("Content-type: text/plain");//Pour le faire considérer par le système comme un fichier texte et non html
	
	$sem = $_GET[sem];
	$classe = $_GET[classe];

	$txt_output = "$classe Semestre $sem";
	
	
	
	//echo($txt_output);
	
	header("Content-disposition: attachment; filename=$part[0]_" . date("d_m").".txt");
	print $txt_output;
	exit;
?>