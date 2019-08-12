<?php    	
	$classe = $_COOKIE["laclasse"];
	$Dir_TP = "./files/$classe/_Sujets2TP";
	include("./haut.php");
	include("../Dropbox.php");

	Dropbox("Les TP du moment :","$Dir_TP/liste.txt");
	
	include("./bas.php");
?>