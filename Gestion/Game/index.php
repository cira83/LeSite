<script type="text/javascript">
	
	function newclasse(lavaleur){
		document.cookie = 'laclasse='+lavaleur;
		lien = './index.php';
		window.location.replace(lien);
	}
	
	function login(){
		pwd = document.getElementById('password').value;
		elv = document.getElementById('elv').value;
		laclasse = document.getElementById('classe').value;
		
		
		document.cookie = 'elv='+elv;
		document.cookie = 'password='+pwd;
		document.cookie = 'laclasse='+laclasse;
		
		alert(elv+' de '+laclasse+' Ready ?');
			
		lien = './game1.php';
		window.location.replace(lien);
	}

</script>

<?php
	include("./head.php");
	
	$nom = $_POST[elv];
	$password = $_POST[password];
	$classe = $_COOKIE["laclasse"]; if($classe=="") $classe="CIRA1";//laclasse doit être définie avant lesfonctions
	include("./lesfonctions.php");

?>
<img  src="head.jpg">
	<table class="accueil"><tr>
<?php 
	echo("<td>$listedesclasses</td>");
	echo("<td>$deroulant3</td>"); 
?>
	<td>
		<input type="password" name="password" id="password">
		<input type="button" onclick="login();" value="Se connecter">
	</td></tr></table>
</center>
</body>
</html>