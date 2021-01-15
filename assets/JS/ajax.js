var adminAjaxDir =  document.getElementById('adminAjaxDir').value;
function sendSearch(){
	var search = document.getElementById('search').value;
	jQuery(document).ready(function($) {
		$.ajax({
			url: adminAjaxDir,
			method : 'POST',
			data:{
				'action':'doAjax',
				'value': search
			},
			success: function(data){
                // alert('ça fonctionne !');              
			},
			error: function(errorThrown){
				alert('error');
				console.log(errorThrown);
			}
		});
	});
	
}

function sendChoice(){
	var choice = document.getElementById("chooseOptionNb").value;
	jQuery(document).ready(function($) {
		$.ajax({
			url: adminAjaxDir,
			method : 'POST',
			data:{
				'action':'doAjax2',
				'value2': choice
			},
			success: function(data){
                // alert('ça fonctionne !');              
			},
			error: function(errorThrown){
				alert('error');
				console.log(errorThrown);
			}
		});
	});
	
}

function sendInfSup(){
	var infSup = document.getElementById('infsup').value;
	jQuery(document).ready(function($) {
		$.ajax({
			url: adminAjaxDir,
			method : 'POST',
			data:{
				'action':'doAjax3',
				'value3': infSup
			},
			success: function(data){
                // alert('ça fonctionne !');              
			},
			error: function(errorThrown){
				alert('error');
				console.log(errorThrown);
			}
		});
	});
	
}

function sendNbr(){
	var nbChoice = document.getElementById('nbChoice').value;
	jQuery(document).ready(function($) {
		$.ajax({
			url: adminAjaxDir,
			method : 'POST',
			data:{
				'action':'doAjax4',
				'value4': nbChoice
			},
			success: function(data){
                // alert('ça fonctionne !');              
			},
			error: function(errorThrown){
				alert('error');
				console.log(errorThrown);
			}
		});
	});
	
}

