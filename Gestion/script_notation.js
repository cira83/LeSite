function noter(quest){
	var image1 = document.getElementById("N"+quest[1]);
	var image2 = document.getElementById("M"+quest[1]);
    newimage = "./icon/" + quest[0] + ".gif";
	image1.setAttribute("src", newimage);
	image2.setAttribute("src", newimage);
	
	save_note(quest[1],quest[0]);
}

function save_note(numero,note) {
	var nom_input = document.getElementById("nom_elv");
	var nom_elv = nom_input.value;
	var classe_input = document.getElementById("classe");
	var classe_elv = classe_input.value;    
	var xhr = null;
    var xhr = new XMLHttpRequest();	
    
    chemin = "./noter.php?nota="+classe_elv+":"+nom_elv+":"+note+":"+numero;	
	xhr.open("GET", chemin, true);
	xhr.send(null);
}

function miseajour(id_name) {
    var ip = document.getElementById(id_name);
    var etat = document.getElementById("etat_"+id_name);
     
    var xhr = null;
    var xhr = new XMLHttpRequest();
    var tab;
     
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
            tab = xhr.responseText.split(":");
            ip.innerHTML = tab[0];
            etat.innerHTML = tab[1];
        }
    };
     
    //xhr.open("GET", "./chatES.php", true);
    chemin = "./DSReponses.php?elv="+id_name;
    xhr.open("GET", chemin, true);
    xhr.send(null);         
}








