<?php include("./Settings/haut.php");?>	

<center><p><img src="./img2/multiboucle.gif"></p></center>


<h3>Description fonctionnelle</h3><p>
<p>L'installation ci-dessus doit permettre réguler la température mesurée par le capteur TTI, la consigne sera fixée à 50ºC. Afin de limiter l'influence des variations de pression du circuit d'eau chaude sur la grandeur réglée, on mettra en place une régulation cascade. À la mise sous tension du système, la régulation cascade devra démarrer "en douceur", sans à coups.</p>

<h3>Démarrage en douceur</h3>
<ul>
<li>À la mise sous tension, les deux régulateurs en manuel, on amène lentement la grandeur réglée à la consigne.</li>
<li>Sur le régulateur esclave, on fixe alors FF_PID à la valeur de la commande, la consigne (externe) à la mesure du même régulateur, puis on passe le régulateur en mode de régulation REMOTE.</li>
<li>Sur le régulateur maître, on fixe alors FF_PID à la valeur de la commande, la consigne à la mesure du même régulateur, puis on passe le régulateur en mode de régulation AUTO.</li>
</ul>

<p>Réaliser la programmation du régulateur afin de répondre au cahier des charges ci-dessus. On fournira toutes les informations nécessaires à la compréhension de votre démarche et plusieurs enregistrements permettant de valider son fonctionnement, notamment vis à vis des variations de pression du circuit d'eau chaude.</p>

<?php include("./Settings/bas.php");?>	