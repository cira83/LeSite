<?php include("./Settings/haut.php");?>	

<center><img src="./img3/SAD.jpg"></center>

<h2>I. Régulation de pression simple boucle (10 pts)</h2>
<ol>
<p><font color="aqua"><b>Cahier des charges :</b> On se propose de réaliser une régulation simple boucle de pression sur la maquette SAD haut.</font></p>

<?php schemaTI(); ?>
<?php sensdaction(); ?>
<?php schemaElec(); ?>
<li>Proposer une méthode qui permette de déterminer l'étendue de mesure du capteur utilisé.</li>
<li>Paramétrer les entrées du régulateur en grandeurs physiques.</li>
<?php schemaBloc(); ?>
<li>Déterminer le modèle de Broïda H1(p) (de gain A1, de constante de temps τ1 et de retard T1) de votre procédé. On expliquera la méthode précisément, et on donnera tous les calculs et tracés nécessaires à la détermination du modèle.</li>
<li>Déterminer un correcteur PI (avec Ti = &tau;1) qui minimise le temps de réponse ainsi que le dépassement du système en boucle fermée, à l'aide du logiciel <?php easyreg();?>. On donnera la réponse théorique obtenue.</li>
<li>Donner la réponse indicielle de votre système en boucle fermée avec les réglages déterminés ci-dessus. On relevera le temps de réponse à 5%, l'erreur statique et la valeur du premier dépassement.</li>
</ol>

<h2>II. Régulation de proportion (10 pts)</h2>
<ol>
<p><font color="aqua"><b>Cahier des charges :</b> On se propose de réaliser une régulation de rapport utilisant les deux maquettes. La mesure de pression SAD haut sera égale à 1,1 fois la mesure de SAD bas. La maquette du bas sera la maquette menante.</font></p>
<!-- Fin CdC -->
<?php schemaTI(); ?>
<?php schemaElec(); ?>
<li>Déterminer le sens de fonctionnement des régulateurs.</li>
<li>Paramétrer les entrées du régulateur en grandeurs physiques.</li>
<li>Régler la boucle de régulation menante, en utilisant une méthode par approches successives, en mode de régulation PID.</li>
<li>Enregistrer la réponse du système à une variation brusque de la grandeur menante. On enregistrera les deux mesures. Expliquer ce qui se passe.</li>
<li>Relever sur cette courbe le temps de réponse, l’erreur statique et la valeur du premier dépassement.</li>
</ol>




<?php include("./Settings/bas.php");?>	
