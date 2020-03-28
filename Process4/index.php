<html>
<script>
	
	function premier_ordre(a, En, Sn_1) { // a = Tau/Te
		Sn = (En+a*Sn_1)/(a+1);
		return(Sn);
	}
	
	function ordonne2string(Sn) {
		echelY = -3;
		Yn =  330 + Sn*echelY ;
		Yn_string = Yn.toString();
		return(Yn_string);
	}

	function abscisse2string(X,echelX) {
		echelX = 5;
		Xn =  25 + X*echelX ;
		Xn_string = Xn.toString();
		return(Xn_string);
	}

	
	function dessiner() {//Dessine la courbe
		var boucle = document.getElementById("boucle");
		var svg = document.getElementById("graphe");
		var courbe = document.getElementById("courbe");
		var id10 = document.getElementById("X10");
		var cartouche = document.getElementById("cartouche");
		
		X10 = "1";
		info = "";
		Sn = 0;
		Tn = 0;
		points = "25,330"; //Premier point à 0 0 
		if(boucle.value=="BO21") {
			//alert("Boucle Esclave Ouverte");
			X10 = "100"; // 1 case = 10 sur X = +50
			echelX = 5;
			info = "X en réponse à ΔY2=100%";
			Te = 0.2;
			Tn = Te + Tn;
			for(i=0;i<650;i++) {
				Sn = premier_ordre(100, 100, Sn);
				Yn_string = ordonne2string(Sn);	
				Xn_string = abscisse2string(Tn,echelX);	//alert(Xn_string);	
				points = points + " " + Xn_string + "," + Yn_string; 
				Tn = Te + Tn;
			}
			
		}
		
		
		cartouche.innerHTML = info;
		id10.innerHTML = X10;
		courbe.setAttribute("points", points);
	}
	
	
	function change_image(limage) {
    	var image = document.getElementById("image");
    	newimage = limage + ".svg";
		image.setAttribute("src", newimage);
    }

</script>
	
	
	<head>
		<link rel="stylesheet" type="text/css" media="screen" href="styles_sujet.css">
		<link rel="stylesheet" type="text/css" href="print.css" media="print">
		<title>Process 4</title>
	</head>
	<body>
<!--
	taille tableau = 800 x 400
	taille image = 700 x 350
-->	
	
																									<!-- GRAPHIQUE -->
	<table class="blanc">
		<tr><td height="30px"><b>Réponse indicielle</b></td></tr>
		<tr><td>
			<svg id="graphe" width="700" height="350">
				<!-- 	
					(0,0) = 25,330 
					(delta 1 case,delta 1 case) = (+50,-30)
				-->
				<line x1="25" y1="330" x2="25" y2="20" style="stroke:rgb(0,0,0);stroke-width:2" id="axe_y"/>
				<line x1="20" y1="30" x2="680" y2="30" style="stroke:rgb(128,128,128);stroke-width:1" />
				<line x1="20" y1="60" x2="680" y2="60" style="stroke:rgb(128,128,128);stroke-width:1" />
				<line x1="20" y1="90" x2="680" y2="90" style="stroke:rgb(128,128,128);stroke-width:1" />
				<line x1="20" y1="120" x2="680" y2="120" style="stroke:rgb(128,128,128);stroke-width:1" />
				<line x1="20" y1="150" x2="680" y2="150" style="stroke:rgb(128,128,128);stroke-width:1" />
				<line x1="20" y1="180" x2="680" y2="180" style="stroke:rgb(128,128,128);stroke-width:1" />
				<line x1="20" y1="210" x2="680" y2="210" style="stroke:rgb(128,128,128);stroke-width:1" />
				<line x1="20" y1="240" x2="680" y2="240" style="stroke:rgb(128,128,128);stroke-width:1" />
				<line x1="20" y1="270" x2="680" y2="270" style="stroke:rgb(128,128,128);stroke-width:1" />
				<line x1="20" y1="300" x2="680" y2="300" style="stroke:rgb(128,128,128);stroke-width:1" />
				
				<line x1="25" y1="330" x2="680" y2="330" style="stroke:rgb(0,0,0);stroke-width:2" id="axe_x"/>
				<line x1="75" y1="330" x2="75" y2="20" style="stroke:rgb(128,128,128);stroke-width:1"/>
				<line x1="125" y1="330" x2="125" y2="20" style="stroke:rgb(128,128,128);stroke-width:1"/>
				<line x1="175" y1="330" x2="175" y2="20" style="stroke:rgb(128,128,128);stroke-width:1"/>
				<line x1="225" y1="330" x2="225" y2="20" style="stroke:rgb(128,128,128);stroke-width:1"/>
				<line x1="275" y1="330" x2="275" y2="20" style="stroke:rgb(128,128,128);stroke-width:1"/>
				<line x1="325" y1="330" x2="325" y2="20" style="stroke:rgb(128,128,128);stroke-width:1"/>
				<line x1="375" y1="330" x2="375" y2="20" style="stroke:rgb(128,128,128);stroke-width:1"/>				
				<line x1="425" y1="330" x2="425" y2="20" style="stroke:rgb(128,128,128);stroke-width:1"/>
				<line x1="475" y1="330" x2="475" y2="20" style="stroke:rgb(128,128,128);stroke-width:1"/>
				<line x1="525" y1="330" x2="525" y2="20" style="stroke:rgb(128,128,128);stroke-width:1"/>
				<line x1="575" y1="330" x2="575" y2="20" style="stroke:rgb(128,128,128);stroke-width:1"/>
				<line x1="625" y1="330" x2="625" y2="20" style="stroke:rgb(128,128,128);stroke-width:1"/>
				<line x1="675" y1="330" x2="675" y2="20" style="stroke:rgb(128,128,128);stroke-width:1"/>


				<text x="10" y="335" fill="black">0</text>
				<text x="0" y="245" fill="black">30</text>
				<text x="0" y="155" fill="black">60</text>
				<text x="0" y="65" fill="black">90</text>
			
				<text x="20" y="345" fill="black">0</text>
				<text x="518" y="345" fill="black" id="X10">10</text>
				
				<text x="220" y="345" fill="black" id="cartouche"></text>
			
				<polyline points="" style="fill:none;stroke:red;stroke-width:1" id="courbe"/>
			
			</svg>
		</td></tr>
		<tr><td><font size="-1">Temps en s</font></td></tr>
	</table>
	<table>
		<tr><td><hr></td></tr>
	</table>	
																											<!-- SCHEMA -->	
	<table class="blanc2">	
		<tr height="30px"><td>
				<b>Process : </b>
				<select id="boucle" onchange="change_image(this.value);">
					<option value="BO1">Boucle Simple Ouverte</option>
					<option value="BF1">Boucle Simple Fermée</option>
					<option value="BO21" selected>Boucle Esclave Ouverte</option>
					<option value="BO2">Boucle Maitre Ouverte</option>
					<option value="BF2">Boucle Cascade Fermée</option>
				</select>
				<input type="button" onclick="dessiner();" value="Calculer" />
			</td></tr>
		<tr><td>
			<img src="BO21.svg" id="image"/>
		</td></tr>
	</table>
																											<!-- REGLAGES -->	

	<table class="blanc3">
		<tr>
			<td colspan="3">
				PID1
			</td>
			<td colspan="3">
				PID2
			</td>		
		</tr><tr>
			<td>
				XP1 (en %)
			</td>
			<td>
				Td1 (en s)
			</td>
			<td>
				Ti1 (en s)
			</td>
			<td>
				Xp2 (en %)
			</td>
			<td>
				Td2 (en s)
			</td>
			<td>
				Ti2 (en s)
			</td>
		</tr><tr>
			<td>
				<input type="text" id="XP1" value="10" size="10px"/>
			</td>
			<td>
				<input type="text" id="TD1" value="0" size="10px"/>
			</td>
			<td>
				<input type="text" id="TI1" value="999" size="10px"/>
			</td>
			<td>
				<input type="text" id="XP2" value="10" size="10px"/>
			</td>
			<td>
				<input type="text" id="TD2" value="0" size="10px"/>
			</td>
			<td>
				<input type="text" id="TI2" value="999" size="10px"/>
			</td>
		</tr>
	</table>



		
	</body>
</html>




