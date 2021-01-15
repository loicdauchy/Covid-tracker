var main = document.getElementById('CT');
var selectElmt = document.getElementById("chooseOption");
document.getElementById('submit2').classList.add('none');
document.getElementById('submit').disabled = true;

// Function AJAX  who call's views
function mainShow(){
	var xml = new XMLHttpRequest();
	xml.onreadystatechange = function (){
		if(xml.readyState === 4){
			document.getElementById('tbody').innerHTML = xml.responseText;
		}
	}
	var all = document.getElementById('all').value;
	xml.open('GET', all, true);
	xml.send();	
}
mainShow();

function showRegionQty(){
	var xml = new XMLHttpRequest();
	xml.onreadystatechange = function (){
		if(xml.readyState === 4){
			document.getElementById('tbody').innerHTML = xml.responseText;
		}
	}
	var direction = document.getElementById('direction').value;
	xml.open('GET', direction, true);
	xml.send();
}

function showDepartementQty(){
	var xml = new XMLHttpRequest();
	xml.onreadystatechange = function (){
		if(xml.readyState === 4){
			document.getElementById('tbody').innerHTML = xml.responseText;
		}
	}
	var direction2 = document.getElementById('direction2').value;
	xml.open('GET', direction2, true);
	xml.send();
}

function mainShowQty(){
	var xml = new XMLHttpRequest();
	xml.onreadystatechange = function (){
		if(xml.readyState === 4){
			document.getElementById('tbody').innerHTML = xml.responseText;
		}
	}
	var direction3 = document.getElementById('direction3').value;
	xml.open('GET', direction3, true);
	xml.send();
}


function showData(){
	var xml = new XMLHttpRequest();
	xml.onreadystatechange = function (){
		if(xml.readyState === 4){
			document.getElementById('tbody').innerHTML = xml.responseText;
		}
	}
	var dir = document.getElementById('dir').value;
	xml.open('GET', dir, true);
	xml.send();
}

function showRegion(){
	var xml = new XMLHttpRequest();
	xml.onreadystatechange = function (){
		if(xml.readyState === 4){
			document.getElementById('tbody').innerHTML = xml.responseText;
		}
	}
	var reg = document.getElementById('reg').value;
	xml.open('GET', reg, true);
	xml.send();	
}
function showDepartements(){
var xml = new XMLHttpRequest();
xml.onreadystatechange = function (){
	if(xml.readyState === 4){
		document.getElementById('tbody').innerHTML = xml.responseText;
	}
}
var dep = document.getElementById('dep').value;
xml.open('GET', dep, true);
xml.send();	
}


// EVENT

document.getElementById('search').addEventListener('keypress', function(){
	document.getElementById('submit').disabled = false;
})
	 
document.getElementById('submit').addEventListener('click', function(){
	sendSearch();
	document.getElementById('search').value = "";
	document.getElementById('submit').disabled = true;
	setTimeout(showData, 100);
})

document.getElementById('submit3').addEventListener('click', function(){
	sendChoice()
	sendInfSup()
	sendNbr()
	if(selectElmt.value == 'Regions'){
		setTimeout(showRegionQty, 100);	
	}else if(selectElmt.value == 'Departements'){
		setTimeout(showDepartementQty, 100);			
	}else{
		setTimeout(mainShowQty, 100);
	}
})

document.getElementById("chooseOption").addEventListener('click', function(){
	var int = setInterval(interval, 100);
	document.getElementById('submit3').classList.add('none');
	document.getElementById('submit2').classList.remove('none');
	document.getElementById('submit').addEventListener('click', function(){
		clearInterval(int)
	})
	document.getElementById('submit2').addEventListener('click', function(){
		sendChoice()
		sendInfSup()
		sendNbr()
		if(selectElmt.value == 'Regions'){
			clearInterval(int);
			setTimeout(showRegionQty, 100);		
		}else if(selectElmt.value == 'Departements'){
			clearInterval(int);
			setTimeout(showDepartementQty, 100);			
		}else{
			clearInterval(int);
			setTimeout(mainShowQty, 100);
		}
	})
})
	

// Another functions
function interval(){
	if(selectElmt.value == 'Regions'){
		 showRegion();
	}else if(selectElmt.value == 'Departements'){
		showDepartements();
	}else if(selectElmt.value == 'all'){
		mainShow();
	}
}










	

