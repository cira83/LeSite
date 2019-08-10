<?php include("./Settings/haut.php");?>	

<center><p><img src="img4_2018/niveau_2.png" width="45%"></p></center>
<table class="dedans2"><tr align="left"><td><font color="lightskyblue"><u>Cahier des charges :</u> On se propose de réaliser une régulation de niveau du réservoir du haut. L'organe de réglage sera la pompe P1. Les vannes V1 et V2 seront contrôlées manuellement, on devra régler le transmetteur de niveau. La régulation sera assurée par l'automate TSX37 Micro équipé de cartes d’E/S TOR et analogiques.</font></td></tr>
</table>

<h2>I. Instrumentation</h2>


<ol>
<li>Configurer le transmetteur pour une étendue de mesure imposée : 0% à 100% du niveau du réservoir supérieur.</li>
<li>Donner la valeur fournie par le transmetteur en mA et en points (sur l'API) pour un niveau de 20% et 80%.</li>
<li>Réaliser le câblage de l'automate lui permettant de contrôler le niveau du réservoir.</li>
<li>Vérifier que l’API contrôle bien le niveau au moyen d’une table d’animation.</li>
</ol>

<hr/>
<h2>II. Régulation</h2>
<ol>
	<li>En s'aidant de la <a href="img4_2018/TP4%20PID%20-%20PL7.pdf"> documentation constructeur</a>, réaliser une boucle de régulation PID permettant de contrôler le niveau dans le réservoir. La consigne sera égale à 50%, Xp = 30%, Ti = 20s et Td = 10s.</li>
	<li>Vérifier le fonctionnement de votre régulation. On donnera les manipulations, les résultats attendus et les résultats obtenus.</li>
</ol>
<div class="FF"></div>
<hr/>
<h2>III. Séquence d'alarme</h2>
<p>On souhaite déclencher une séquence d’alarme dès lors qu’un des deux seuils de niveau N<sub>mini</sub> (20%) et N<sub>max</sub> (80%), est atteint. Alors un voyant AL clignotera à la fréquence de 1 Hz jusqu’à l’appui sur un bouton poussoir acq puis le voyant AL sera allumé de manière permanente jusqu’à disparition du défaut. On rappelle que le bit %S6 bat la seconde.</p>
<ol>
	<li>Proposer un GRAFCET qui réponde au cahier des charges. On pourra utiliser l'application <a href="img4_2018/grafcet.exe">grafcet.exe</a> pour dessiner le GRAFCET.</li>
	<li>Implémenter ce GRAFCET dans votre automate.</li>
	<li>Vérifier le fonctionnement de votre GRAFCET. On donnera les manipulations, les résultats attendus et les résultats obtenus.</li>
</ol>

<hr/>
<h2>IV. Supervision</h2>
<img src="img4_2018/superniveau.gif"/>
<ol>
	<li>À l'aide de la <a href="img4_2018/Editeur%20ecran%20PL7.pdf">documentation constructeur</a>, réaliser la programmation d'une vue respectant le synopsis ci-dessus. On devra pouvoir afficher la commande, la consigne et le niveau en temps réel. Ne pas oublier le voyant AL.</li>
</ol>


<?php include("./Settings/bas.php");?>	