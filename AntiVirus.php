<?php
	include("./head.html");
	
	$filename = $_POST['filename'];
	
	
?>

		<title>ANTIVIRUS</title>
	</head>
	<body>
		<img src="head.png"/>
		<table><tr><td align="right" width="50px"><img src="img/LOGO%20Flamme.svg" height="50px"></td>
		<td><p class="titre">ANTIVIRUS</p></td>
		<td align="right" width="30px"><a href="https://twitter.com/BtsCira"><img src="img/twitter1.png" height="30px"></a>
		<td align="right" width="30px"><a href="https://www.linkedin.com/school/bts-cira-rouviere/"><img src="img/linkedin.png" height="30px"></a>
		</td></tr></table>

		<center>
		<form method="post" action="./AntiVirus.php">
			Fichier à supprimer : 
			<input type="text" name="filename" size="70">
			<input type="submit">
		</form>
		</center>
	
<?php
	if($filename){
		$filename = ".".$filename;
		if(!file_exists($filename)) echo("<p><font color=\"red\">Le fichier <br/>$filename<br/> n'existe pas</font></p>");
		else {
			rename($filename, "./sheet.txt");
			echo("<p><font color=\"green\">Le fichier <br/>$filename<br/> n'existe plus</font></p>");
			$fp = fopen("./sheet_list.txt", "a");
			fprintf($fp, "$filename\n");
			fclose($fp);
			$fp = fopen("./sheet.txt", "w");
			fclose($fp);
		}	
	}
	
?>	
	
	
	
	</body>
</html>