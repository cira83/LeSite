<?php include("./Settings/haut.php");?>	

<h2>I. Création et réglage du process virtuel (4 pts)</h2>
<ol>
	<li>Ajouter un bloc SIM sur votre programme, il simulera le fonctionnement d'un procédé réel. Donner lui un nom.</li>
	<li>Procéder à son paramètrage en respectant les valeurs suivantes :</li>

	<img src="img2018/SIM_Settings.png"/>

	<li>Ajouter à votre programme un bloc PID afin de créer une régulation de votre procédé virtuel.</li>
	<li>Régler le bloc PID, en utilisant une méthode de votre choix. On optimisera le temps de réponse à 10% et on limitera de dépassement à 10%. Aucune erreur statique ne sera tolérée.</li>
	<li>Enregistrer la réponse de votre mesure, la consigne passera de 30% à 50%.</li>
	<li>Mesurer le temps de réponse à ± 5% de votre régulation à l'aide de votre enregistrement.</li>
</ol>
<hr/>



<h2>II. Supervision - Page 1 (8 pts)</h2>
<ol>
	<li>Réaliser la programmation du superviseur en respectant le synopsis ci-dessous. </li>


	<img src="img3/TP3S1.jpg" width="400px"/>
</ol>


<ul>	
	<li>On devra pouvoir contrôler le seuil de déclenchement de l'alarme haute.</li> 
	<li>La consigne et la mesure s'afficheront en temps réel sur un graphe déroulant.</li>
	<li>La couleur du voyant d'alarme haute sera :</li>
	<ul>
		<li>Rouge pour alarme active - non acquittée ;</li>
		<li>Rouge clignotant pour alarme active - acquittée ;</li>
		<li>Verte pour alarme non active - non acquittée ;</li>
		<li>Verte clignotant pout alarme - non active non acquittée.</li>
	</ul>
	<li>Prévoir un bouton d'acquittement et un bouton pour passer à la page 2.</li>
</ul>
<hr/>

<h2>III. Profil de consigne - Page 2 (8 pts)</h2>
<ol>
	<li>Ajouter au superviseur le synopsis ci-dessous.</li>


<img src="img3/TP3S2.jpg" width="400px"/>
	
	<li>Créer un GRAFCET afin d'assurer le fonctionnement suivant :</li>
</ol>
<ul>
	<li>Au repos, la consigne du régulateur sera de 50%.</li>
	<li>Lors d'un appui sur le bouton B1, la consigne passe à 60% pendant 10s, puis 70% pendant 10s.</li>
	<li>Les voyants 50%, 60% et 70%, s'allumeront en vert lorsque la consigne correspond à la valeur indiquée.</li>
</ul>




<?php include("./Settings/bas.php");?>	