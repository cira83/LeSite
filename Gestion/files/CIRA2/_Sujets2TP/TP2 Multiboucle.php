<?php include("./Settings/haut.php");?>	

<h2>I. Re&#769;gulation de température simple boucle (10 pts)</h2>
<center><img src="./img2018/multi.png"></center>
<table class="dedans"><tr align="left"><td><font color="lightskyblue"><u>Cahier des charges :</u> On se propose de re&#769;aliser une re&#769;gulation de température. L'organe de r&eacute;glage sera la vanne FV2. La vanne FV1 sera contrôlée par le T2550.</font></td></tr>
</table>
<ol>
<li>Donner le schéma électrique correspondant au cahier des charges.</li>
<li>Programmer votre T2550 afin de réaliser la régulation représentée ci-dessus.</li>
<li>Régler votre maquette pour avoir une mesure de 40% pour une commande de 50%.</li>
<li>Relever l'évolution de la mesure X en réponse à un échelon de commande Y. En déduire le sens de fonctionnement du régulateur (inverse ou direct).</li>
<li>Régler la boucle de régulation utilisant la méthode par <a href="./Reglages/Regleur.html" target="_blank">approches successives</a>.</li>
<li>Enregistrer l'influence d'une perturbation du débit d'eau chaude sur la température, en fermant V6.</li>

</ol>
<hr/>

<h2>II. Régulation cascade (10 pts)</h2>
<center><img src="./img2018/multi_cascade.png"></center>	
<table  class="dedans"><tr align="left"><td><font color="lightskyblue"><u>Cahier des charges :</u> On se propose de re&#769;aliser une re&#769;gulation cascade de température.</font></td></tr>
</table>
<ol>
<!-- Fin CdC -->	
<li>Rappeler le fonctionnement d'une boucle de régulation cascade.</li>
<li>Programmer le r&eacute;gulateur pour obtenir le fonctionnement en régulation cascade conformément au schéma TI ci-dessus.</li>
<li>Re&#769;gler la boucle de régulation esclave en utilisant la méthode par <a href="./Reglages/Regleur.html" target="_blank">approches successives</a>. On ne changera pas le réglage de la boucle maître.</li>
<li>Enregistrer l'influence d'une perturbation du débit d'eau chaude sur la température, en fermant V6.</li>
<li>Expliquez l'inte&#769;re&#770;t d'une régulation cascade en vous aidant de vos enregistrements. Citez un autre exemple pratique.</li>
</ol>

<?php include("./Settings/bas.php");?>	

