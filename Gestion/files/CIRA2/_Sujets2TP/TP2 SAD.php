<?php include("./Settings/haut.php");?>

<h2>I. Re&#769;gulation de pression simple boucle (10 pts)</h2>
<center><img src="./img2018/sad1.png"></center>
<table class="dedans"><tr align="left"><td><font color="lightskyblue"><u>Cahier des charges :</u> On se propose de réaliser une régulation de pression. L'organe de r&eacute;glage sera la vanne V1.</font></td></tr>
</table>
<ol>
<li>Donner le schéma électrique correspondant au cahier des charges.</li>
<li>Programmer votre T2550 afin de réaliser la régulation représentée ci-dessus.</li>
<li>Régler votre maquette pour avoir une mesure de 50% pour une commande de 50%.</li>
<li>Relever l'évolution de la mesure X en réponse à un échelon de commande Y. En déduire le sens de fonctionnement du régulateur (inverse ou direct).</li>
<li>Re&#769;gler la boucle de régulation, en utilisant la méthode de <a href="./Reglages/Ziegler.html"  target="_blank">Ziegler & Nichols</a>. On choisira un correcteur PID.</li>
<li>Enregistrer la réponse de la mesure X à un échelon de consigne W.</li>

</ol>
<hr/>

<h2>II. Régulation à partage d'échelle (10 pts)</h2>
<center><img src="./img2018/sad_partage.png"></center>	
<table  class="dedans"><tr align="left"><td><font color="lightskyblue"><u>Cahier des charges :</u> On se propose de réaliser une régulation  de pression à partage d'échelle. Le sens d'action du régulateur restera inchangé, le point de partage se fera à 50%.</font></td></tr>
</table>
<ol>
<!-- Fin CdC -->	
<li>Rappeler le fonctionnement d'une boucle de régulation à partage d'échelle.</li>
<li>Représenter graphiquement la relation entre Y1 la commande de la vanne V1 et la sortie Y du régulateur.</li>
<li>Représenter graphiquement la relation entre Y2 la commande de la vanne V2 et la sortie Y du régulateur.</li>
<li>Programmer le r&eacute;gulateur pour obtenir le fonctionnement de la régulation conformément au schéma TI ci-dessus.</li>
<li>Re&#769;gler la boucle de régulation utilisant la méthode par <a href="./Reglages/Regleur.html" target="_blank">approches successives</a>.</li>
<li>Enregistrer la réponse des commandes Y1 et Y2 à une variation de la consigne W permettant l'ouverture des deux vannes.</li>
<li>Expliquez l'inte&#769;re&#770;t d'une régulation à partage d'échelle en vous aidant de vos enregistrements. Citez un autre exemple pratique.</li>
</ol>

<?php include("./Settings/bas.php");?>	

