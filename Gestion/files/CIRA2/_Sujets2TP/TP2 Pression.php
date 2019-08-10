<?php include("./Settings/haut.php");?>	

<h2>I. Re&#769;gulation de pression simple boucle (10 pts)</h2>
<center><img src="./img2018/pression1.png"></center>
<table class="dedans"><tr align="left"><td><font color="lightskyblue"><u>Cahier des charges :</u> On se propose de réaliser une régulation de pression sur la maquette Pignat 1 (à votre gauche). L'organe de r&eacute;glage sera la vanne V1.</font></td></tr>
</table>
<ol>
<li>Donner le schéma électrique correspondant au cahier des charges.</li>
<li>Programmer votre T2550 afin de réaliser la régulation représentée ci-dessus.</li>
<li>Régler votre maquette pour avoir une mesure de 50% pour une commande de 50%.</li>
<li>Relever l'évolution de la mesure X en réponse à un échelon de commande Y. En déduire le sens de fonctionnement du régulateur (inverse ou direct).</li>
<li>Re&#769;gler la boucle de re&#769;gulation, en utilisant la me&#769;thode de <a href="./Reglages/Ziegler.html"  target="_blank">Ziegler & Nichols</a>. On choisira un correcteur PID.</li>
<li>Enregistrer la réponse de la mesure à un échelon de consigne W.</li>

</ol>
<hr/>

<h2>II. Régulation de proportion (10 pts)</h2>
<center><img src="./img2018/pression_prop.png"></center>	
<table  class="dedans"><tr align="left"><td><font color="lightskyblue"><u>Cahier des charges :</u> On se propose de réaliser une régulation de proportion de pression. La pression mesurée par PIT1 sera égale à 0,8 fois la pression mesurée par PIT2.</font></td></tr>
</table>
<ol>
<!-- Fin CdC -->	
<li>Rappeler le fonctionnement d'une boucle de régulation de proportion.</li>
<li>Programmer le r&eacute;gulateur pour obtenir le fonctionnement en régulation de proportion conformément au schéma TI ci-dessus.</li>
<li>Re&#769;gler la boucle de régulation menée en utilisant la méthode par <a href="./Reglages/Regleur.html" target="_blank">approches successives</a>. On ne changera pas le réglage de la boucle menante.</li>
<li>Enregistrer la réponse des mesures à un échelon de consigne W.</li>
<li>Expliquez l'inte&#769;re&#770;t d'une régulation de proportion en vous aidant de vos enregistrements. Citez un autre exemple pratique.</li>
</ol>

<?php include("./Settings/bas.php");?>	


