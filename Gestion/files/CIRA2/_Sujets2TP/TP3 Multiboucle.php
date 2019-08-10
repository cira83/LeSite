<?php include("./Settings/haut.php");?>	

<center><p><img src="./img2/multiboucle.gif"></p></center>


<h2>I. Régulation de température à la chauffe</h2>
<ol>
<p><font color="aqua"><b>Cahier des charges :</b> On vous propose de réaliser une régulation de température. L'organe de réglage sera la vanne FV2.</font></p>


<li>Paramétrer les entrées/sorties du régulateur en %.</li>
<li>Déterminer le modèle de Broïda H2(p) (de gain A2, de constante de temps τ2 et de retard T2) de votre procédé. On expliquera la méthode précisément et on donnera tous les calculs et tracés nécessaires à la détermination du modèle.</li>
</ol>

<h2>II. Régulation de température au refroidissement</h2>	
<ol>
<p><font color="aqua"><b>Cahier des charges :</b> On vous propose de réaliser une régulation de température. L'organe de réglage sera la vanne FV1.</font></p>

<li>Paramétrer les entrées/sorties du régulateur en %.</li>
<li>Déterminer le modèle de Broïda H1(p) (de gain A1, de constante de temps τ1 et de retard T1) de votre procédé. On expliquera la méthode précisément et on donnera tous les calculs et tracés nécessaires à la détermination du modèle.</li>
</ol>

<h2>III. Régulation à partage d’étendue ou split-range</h2>
<ol>
<p><font color="aqua"><b>Cahier des charges :</b> 
On vous propose de réaliser une régulation de température à partage d’étendue utilisant deux vannes. Le point de partage sera fixé à 50%.
</font></p>
<br/><!-- Fin CdC -->
<li>Donner le schéma TI de la régulation.</li>
<li><b>Choisir</b> un sens de fonctionnement du régulateur (inverse ou direct).</li>
<li>Représenter graphiquement la relation entre Y1 la commande de la vanne VR1 et la sortie Y du régulateur.</li>
<li>Représenter graphiquement la relation entre Y2 la commande de la vanne VR2 et la sortie Y du régulateur.</li>
<li>Exprimer la commande de chaque vanne, Y1 et Y2, en fonction de la sortie Y du régulateur.</li>
<li>Programmer les deux modules ADD2 pour commander les deux vannes.</li>
<li>Déterminer un correcteur PI qui associé au partage d'échelle, minimise le temps de réponse ainsi que le dépassement du système en boucle fermée, à l'aide du logiciel <?php easyreg();?>. On donnera la réponse théorique obtenue.</li>
<li>Donner pour ce réglage les valeurs théoriques du temps de réponse à ±5%, ainsi que la valeur du premier dépassement.</li>
<li>Déduire de la question 7 les valeurs de Xp, Ti et Td du régulateur mixte.</li>	

<li>Enregistrer la réponse du système à une perturbation. Expliquez ce qui se passe.</li>
</ol>


<?php include("./Settings/bas.php");?>	