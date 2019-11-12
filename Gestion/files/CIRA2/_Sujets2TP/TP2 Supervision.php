<?php include("./Settings/haut.php");?>	

<font color="red" size="+1"><p><u>Important :</u> Pour ce TP vous devez utiliser l'Eycon pour simuler un process.</p></font>

<h2>I. Création du process virtuel (1pt)</h2>
<ol>
<li>Ajouter un bloc SIM sur votre programme, il simulera le fonctionnement d'un procédé réel. Donner lui un nom.</li>
<li>Procéder à son paramètrage en respectant les valeurs suivantes :</li>
</ol>
<center><img src="img2018/SIM_Settings.png"/></center>
<hr/>

<h2>II. Réglage de la boucle de régulation (7pts)</h2>
<ol>
	<li>Ajouter à votre programme un bloc PID afin de créer une régulation de votre procédé virtuel.</li>
<li>Régler la boucle de régulation utilisant la méthode par <a href="./Reglages/Regleur.html" target="_blank">approches successives</a>.</li>	<li>Enregistrer la réponse de la mesure X à un échelon de consigne W de 20%.</li>
	<li>Mesurer le temps de réponse à ±5%, le premier dépassement, ainsi que l'erreur statique.</li>
</ol>

<h2>III. Supervision (5pts)</h2>
<ol>
	<li>Réaliser la programmation du superviseur en respectant le synopsis ci-dessous. On devra pouvoir contrôler la commande, la consigne et le mode de fonctionnement par l'intermédiaire d'Intouch. La mesure s'affichera en temps réel.</li>
</ol>
<center><img src="img2018/superpression.jpg"/></center>


<h2>IV. Alarme (5pts)</h2>
<ol>
	<li>Modifier votre synopsis pour y ajouter un voyant d'alarme haute.</li>
	<p>Le voyant sera :</p>
	<ul>
		<li>Rouge pour l'alarme active ;</li>
		<li>Vert pour l'alarme non active ;</li>
	</ul>
</ol>
<center><img src="img2018/superpression2.jpg"/></center>

<h2>V. Boutons (2pts)</h2>
<ol>
<li>Créer deux boutons, un pour passer le régulateur en mode AUTO, un autre pour passer le régulateur en mode MANU. Un voyant sur chaque bouton indiquera le mode selectionné.</li>
</ol>

<?php include("./Settings/bas.php");?>	
