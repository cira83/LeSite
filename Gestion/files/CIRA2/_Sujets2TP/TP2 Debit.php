<?php include("./Settings/haut.php");?>	

<h2>I. Re&#769;gulation de débit simple boucle (10 pts)</h2>
<center><img src="./img2018/niveau_simple.png"></center>
<table class="dedans"><tr align="left"><td><font color="lightskyblue"><u>Cahier des charges :</u> On se propose de re&#769;aliser une re&#769;gulation de débit utilisant les deux maquettes. L'organe de r&eacute;glage sera la vanne FV1. La mesure de niveau sera accessible sur le T2550.</font></td></tr>
</table>
<ol>
<li>Donner le schéma électrique correspondant au cahier des charges.</li>
<li>Programmer votre T2550 afin de réaliser la régulation représentée ci-dessus.</li>
<li>Re&#769;gler le syste&#768;me pour avoir un niveau de 50% pour une commande de la vanne FV1 de 50%.</li>
<li>Relever l'évolution de la mesure X en réponse à un échelon de commande Y. En déduire le sens de fonctionnement du régulateur (inverse ou direct).</li>
<li>Re&#769;gler la boucle de re&#769;gulation, en utilisant une me&#769;thode par <a href="./Reglages/Regleur.html" target="_blank">approches successives</a>, en mode de re&#769;gulation PI.</li>
<li>Enregistrer l'influence d'une variation du de&#769;bit de sortie sur le niveau.</li>

</ol>
<hr/>

<h2>II. Re&#769;gulation paralle&#768;le (10 pts)</h2>
<center><img src="./img2018/niveau_parallele.png"></center>	
<table  class="dedans"><tr align="left"><td><font color="lightskyblue"><u>Cahier des charges :</u> On se propose de re&#769;aliser une re&#769;gulation paralle&#768;le de niveau-de&#769;bit.</font></td></tr>
</table>
<ol>
<!-- Fin CdC -->	
<li>Rappeler le fonctionnement d'une boucle de re&#769;gulation paralle&#768;le.</li>
<li>Programmer le r&eacute;gulateur pour obtenir le fonctionnement en r&eacute;gulation parrall&egrave;le conformément au schéma TI ci-dessus.</li>
<li>Régler la boucle de niveau en utilisant la méthode de <a href="./Reglages/Ziegler.html"  target="_blank">Ziegler & Nichols</a>. On choisira un correcteur PI.</li>
<li>Enregistrer l'influence d'une variation du de&#769;bit de sortie sur le niveau.</li>
<li>Expliquez l'inte&#769;re&#770;t d'une re&#769;gulation paralle&#768;le <u>en vous aidant de vos enregistrements</u>. Citez un autre exemple pratique.</li>
</ol>

<?php include("./Settings/bas.php");?>	


