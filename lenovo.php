<?php

	$fp = fopen("./ip.txt", "r");#get ip form file
	$ip = fgets($fp);
	fclose($fp);
?>

<script>
	function redirect(ip){
		lien = 'http://'+ip;
		window.location.replace(lien);
	}
</script>


<html>
	<body onload="redirect('<?php echo($ip);?>')">
<?php
	echo("L'IP de Lenovo est $ip");
?>
	</body>
</html>