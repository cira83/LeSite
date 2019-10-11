<?
	include("./include.php");
	$titre = "Fiche Broida";
	 tete("CIRA83 - $titre");
	 pageHeader("CIRA83", "$titre");
?>
<!-- contenu -->
<FONT face=Times size=3 color=black>
<form method="post" action="">
<center>
<img src="./Broida.png"/>
<table width="655px" Border=1>
<tr>
<td bgcolor="#ffdddd" width="50%">
<p>x0=<input type="text" name="x0" value="0" /></p>
<p>xinf=<input type="text" name="xinf" value="100" /></p>
<p>y0=<input type="text" name="y0" value="0" /></p>
<p>yinf=<input type="text" name="yinf" value="100" /></p>
</td>
<td bgcolor="#ffdddd">
<p><input type="button" name="" value="Calcul 1"
onclick='Gc.value=eval((xinf.value-x0.value)/(yinf.value-y0.value));
x40.value=eval(x0.value)+0.40*eval(xinf.value-x0.value);
x28.value=eval(x0.value)+0.28*eval(xinf.value-x0.value);
'/>
</p>
<p>K=<input type="text" name="Gc" value="" /></p><hr/>
<p>x28=<input type="text" name="x28" value="" /></p>
<p>x40=<input type="text" name="x40" value=""/></p>
</td>
</tr><tr>
<td bgcolor="#ddffdd">
<p>t0<input type="text" name="t0" value="0" /></p>
<p>t1=<input type="text" name="t1" value="10" /></p>
<p>t2=<input type="text" name="t2" value="12" /></p>
</td>
<td bgcolor="#ddffdd">
<p><input type="button" name=""  value="Calcul 2"
onclick='Tc.value=eval(5.5*(t2.value-t1.value));
Rc.value=eval(2.8*(t1.value-t0.value)-1.8*(t2.value-t0.value));'/>
</p>
<p>T=<input type="text" name="Rc" value="" /></p>
<p>&tau;=<input type="text" name="Tc" value="" /> </p>
</td>
</tr>
<tr>
<td bgcolor="#ddddff">
<input type="button" name="" value="Copie les valeurs"
onclick='G.value=Gc.value;T.value=Tc.value;R.value=Rc.value;'/>
</p>
<p>K=<input type="text" name="G" value="0.33" /></p>
<p>T=<input type="text" name="R" value="1.1" /></p>
<p>&tau;=<input type="text" name="T" value="2.75" /></p>

</td>
<td bgcolor="#ddddff">
<input type="button" name="" value="Calcul 3"
onclick='
TR.value=eval(T.value/R.value);
RT.value=eval(R.value/T.value);

XPID.value=eval(120*G.value/(0.4+T.value/R.value));
XPID2.value=eval(100*RT.value/0.9);
TiPID.value=eval(eval(0.4*R.value)+eval(T.value));
TiPID2.value=eval(5.2*R.value);
TdPID.value=eval(T.value*R.value)/eval(2.5*T.value+eval(R.value));
TdPID2.value=eval(0.4*R.value);

XPI.value=eval(100*G.value*R.value)/eval(0.8*T.value);
XPI2.value=eval(100*RT.value/0.8);
TiPI.value=T.value;
TiPI2.value=eval(5*R.value);

XP.value=XPI.value;
XP2.value=XPI2.value

PID.value = "TOR";
if (10 <20 ) {PID.value = "P";}
if (TR.value <10) {PID.value = "PI";}
if (TR.value <5) {PID.value = "PID";}
if (TR.value <2) {PID.value = "autre";}
'/>
</p>
<input type="hidden" name="TR" value="" />
<p>k<sub>r</sub>=T/&tau;=<input type="text" name="RT" value="" /></p>
<p>0,05 - P - 0,1 - PI - 0,2 - PID - 0,5 <input type="text" name="PID" value="" size="10"/></p>
</td></tr><tr bgcolor="#dddddd"><td align="center">
Stable</td><td align="center">Instable</td></tr>
<tr>
	<td>
		<p>R&eacute;glage du PID Mixte</p>
		<p>Xp=<input type="text" name="XPID" value="" /></p>
		<p>Ti=<input type="text" name="TiPID" value="" /></p>
		<p>Td=<input type="text" name="TdPID" value="" /></p><hr/>
		<p>R&eacute;glage du PI S&eacute;rie</p>
		<p>Xp=<input type="text" name="XPI" value="" /></p>
		<p>Ti=<input type="text" name="TiPI" value="" /></p><hr/>
		<p>R&eacute;glage du P</p>
		<p>Xp=<input type="text" name="XP" value="" /></p>
	</td>
	<td>
		<p>R&eacute;glage du PID Mixte</p>
		<p>Xp=<input type="text" name="XPID2" value="" /></p>
		<p>Ti=<input type="text" name="TiPID2" value="" /></p>
		<p>Td=<input type="text" name="TdPID2" value="" /></p><hr/>
		<p>R&eacute;glage du PI S&eacute;rie</p>
		<p>Xp=<input type="text" name="XPI2" value="" /></p>
		<p>Ti=<input type="text" name="TiPI2" value="" /></p><hr/>
		<p>R&eacute;glage du P</p>
		<p>Xp=<input type="text" name="XP2" value="" /></p>
	</td>
</tr>
</table></center></form></font>
<!-- fin de contenu -->
<? pied(); ?>
