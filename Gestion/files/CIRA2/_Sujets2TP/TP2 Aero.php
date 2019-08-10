<?php include("./Settings/haut.php");?>

<h2>I. Re&#769;gulation de température simple boucle (10 pts)</h2>
<center><img src="./img2018/aerotherm.png"></center>
<table class="dedans"><tr align="left"><td><font color="lightskyblue"><u>Cahier des charges :</u> On se propose de re&#769;aliser une re&#769;gulation de température. L'organe de r&eacute;glage sera le réchauffeur. Le ventilateur sera contrôlé par le T2550.</font></td></tr>
</table>
<ol>
<li>Donner le schéma électrique correspondant au cahier des charges.</li>
<li>Programmer votre T2550 afin de réaliser la régulation représentée ci-dessus.</li>
<li>Relever l'évolution de la mesure X en réponse à un échelon de commande Y. En déduire le sens de fonctionnement du régulateur (inverse ou direct).</li>
<li>Re&#769;gler la boucle de re&#769;gulation, en utilisant une me&#769;thode par <a href="./Reglages/Regleur.html" target="_blank">approches successives</a>, en mode de re&#769;gulation PI.</li>
<li>Enregistrer l'influence d'une variation du de&#769;bit d'air sur la température.</li>

</ol>
<hr/>

<h2>II. Régulation mixte (10 pts)</h2>
<center><img src="./img2018/aerotherm_mixte.png"></center>
<table  class="dedans"><tr align="left"><td><font color="lightskyblue"><u>Cahier des charges :</u> On se propose de re&#769;aliser une re&#769;gulation mixte de température.</font></td></tr>
</table>
<ol>
<!-- Fin CdC -->
<li>Rappeler le fonctionnement d'une boucle de régulation mixte.</li>
<li>Programmer le r&eacute;gulateur pour obtenir le fonctionnement en régulation mixte conformément au schéma TI ci-dessus.</li>
<li>Déterminer la valeur du coefficient k.</li>
<li>Enregistrer l'influence d'une variation du de&#769;bit d'air sur la température.</li>
<li>Expliquez l'inte&#769;re&#770;t d'une régulation mixte en vous aidant de vos enregistrements. Citez un autre exemple pratique.</li>
</ol>

<?php
  include("./Settings/bas.php");
?>
