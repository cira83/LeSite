<?php include("./Settings/haut.php");?>	


<center><p><img src="./img3/mixtebloc.gif" width="90%"></p></center>
<p>La figure ci-dessus fournit le schéma fonctionnel de votre régulation de température. Les questions suivantes se rapportent à ce schéma. On précisera le point de fonctionnement choisi (Θ, Q) avant de répondre aux questions suivantes.</p>


<h2>Modélisation (11 pts)</h2>
<ol>
<li>À l'aide d'un essai, déterminer le modèle de Broïda de H(p). On expliquera la méthode précisément et on donnera tous les calculs et tracés nécessaires à la détermination du modèle.</li>
<li>Même question avec H<sub>z</sub>(p).</li>	

<li>Déterminer un correcteur PI qui minimise le temps de réponse ainsi que le dépassement du système en boucle fermée, à l'aide du logiciel <?php easyreg();?>. On donnera la réponse théorique obtenue.</li>
<li>Donner pour ce réglage les valeurs théoriques du temps de réponse à ±5%, ainsi que la valeur du premier dépassement.</li>
<li>Déduire de la question 3 les valeurs de Xp, Ti et Td du régulateur mixte.</li>	

<li>Mesurer les performances de votre régulation vis à vis d'une augmentation du débit Q.</li>
</ol>

<h2>Tendance (6 pts)</h2>
<ol>
<li>Compléter le schéma fonctionnel, pour faire apparaître la correction de tendance.</li>
<li>Déduire des questions 1 et 2 la valeur du gain de tendance.</li>
<li>Procéder au réglage de votre régulateur. Donner le nom et la valeur des paramètres modifiés.</li>

</ol>
<h2>Performances de la boucle de tendance (3 pts)</h2>
<ol>
<li>Mesurer les performances de votre régulation vis à vis d'une augmentation du débit Q.</li>
<li>Comparer vos résultats à ceux obtenus en boucle simple.</li>
</ol>



<?php include("./Settings/bas.php");?>	

