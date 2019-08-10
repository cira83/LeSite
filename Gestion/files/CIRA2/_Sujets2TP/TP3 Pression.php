<?php include("./Settings/haut.php");?>	

<h2>I. Régulation de pression simple boucle</h2>
<center><img src="./img2018/pression1.png"></center>
<table class="dedans"><tr align="left"><td><font color="lightskyblue"><u>Cahier des charges :</u> On se propose de réaliser une régulation de pression sur la maquette Pignat 1 (à votre gauche). L'organe de réglage sera la vanne V1.</font></td></tr>
</table>
<ol>
<li>Programmer votre T2550 afin de réaliser la régulation représentée ci-dessus.</li>
<li>Régler votre maquette pour avoir une mesure de 50% pour une commande de 50%.</li>
<li>Déterminer le modèle de Broïda du procédé, en faisant un échelon de 10% autour du point de fonctionnement.</li>
<li>Déterminer un correcteur PI (avec Ti = &tau;) qui minimise le temps de réponse ainsi que le dépassement du système en boucle fermée, à l'aide du logiciel <?php easyreg();?>. On donnera la réponse théorique obtenue.</li>
<li>Donner pour ce réglage les valeurs théoriques du temps de réponse à ±5%, ainsi que la valeur du premier dépassement.</li>
<li>Déduire de la question 4 les valeurs de Xp, Ti et Td du régulateur mixte.</li>	
<li>Comparer les performances théoriques avec les performances réelles.</li>
</ol>


<hr>
<h2>II. Supervision</h2>
<ol>
	<li>Réaliser la programmation du superviseur en respectant le synopsis ci-dessous. On devra pouvoir contrôler la commande, la consigne et le mode de fonctionnement par l'intermédiaire d'Intouch. La mesure s'affichera en temps réel.</li>
</ol>
<center><img src="img2018/superpression.jpg"/></center>

<hr>
<h2>III. Profil de consigne</h2>
<table class="dedans"><tr align="left"><td><font color="lightskyblue"><u>Cahier des charges :</u> On désire rajouter au fonctionnement normal, un fonctionnement "profil". Après un appui sur le bouton "Start", la consigne devra suivre le profil ci-dessous.</font></td></tr>
</table>
<img src="img2019/profil1.png"/>
<ol>
	<li>Ajouter un bouton "Start" sur la vue du superviseur.</li>
	<li>Proposer une solution qui réponde au cahier des charges.</li>
	<li>Implémenter votre solution sur le régulateur.</li>
	<li>Réaliser des mesures qui permettent la validation de votre solution.</li>
</ol>




<?php include("./Settings/bas.php");?>	


