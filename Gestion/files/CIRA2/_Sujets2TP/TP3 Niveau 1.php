<?php include("./Settings/haut.php");?>	



<center><img src="./img2/debit-niveau.gif"/></center>

<h2>I. Régulation de niveau simple boucle (10 pts)</h2>
<ol>
<p><font color="aqua"><b>Cahier des charges :</b> On se propose de re&#769;aliser une re&#769;gulation simple boucle de niveau. L'organe de r&eacute;glage sera la vanne de la r&eacute;gulation de d&eacute;bit.</font></p>
<!-- Fin CdC -->


<?php schemaTI(); ?>
<?php sensdaction(); ?>
<?php schemaBloc(); ?>
<li>Déterminer le modèle de Broïda H1(p) (de gain A1, de constante de temps τ1 et de retard T1) de votre procédé. On expliquera la méthode précisément et on donnera tous les calculs et tracés nécessaires à la détermination du modèle.</li>

<li>Déterminer un correcteur PI qui minimise le temps de réponse ainsi que le dépassement du système en boucle fermée, à l'aide du logiciel <?php easyreg();?>. On donnera la réponse théorique obtenue.</li>
<li>Donner pour ce réglage les valeurs théoriques du temps de réponse à ±5%, ainsi que la valeur du premier dépassement.</li>

<li>Déduire de la question 5 les valeurs de Xp, Ti et Td du régulateur mixte.</li>	
<li>Enregistrer l'influence d’une perturbation sur le débit sur la mesure de niveau.</li>
</ol>

<h2>II. Régulation cascade de niveau (10 pts)</h2>
<ol>
<p><font color="aqua"><b>Cahier des charges :</b> 
	On se propose de réaliser une régulation cascade de niveau. La régulation esclave sera la régulation de débit.</font></p>
<!-- Fin CdC -->


<?php schemaTI(); ?>
<li>Déterminer le sens de fonctionnement des régulateurs (inverse ou direct). <u>On fera un raisonnement complet</u>.</li>
<?php schemaElec(); ?>
<?php schemaBloc(); ?>
<li>Régler les boucles de régulation, en utilisant une méthode de votre choix. On choisira des correcteurs PI pour les deux boucles.</li>
<li>Enregistrer l'influence d’une perturbation sur le débit sur la mesure de niveau.</li>
<li>Comparer le fonctionnement en boucle simple et le fonctionnement en boucle cascade.</li>	
</ol>


<?php include("./Settings/bas.php");?>	