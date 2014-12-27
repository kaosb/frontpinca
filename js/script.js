$(document).ready(function(){
	$('#fangate').show();
	$('#btnverbases').click(function(event){
		verBases();
	});
	$('#btnlike').click(function(event){
		$('#likecanvas').show();
	});
});

/******************* Funcion que permite abrir las bases del concurso */
function verBases(){
	var WindowObjectReference = window.open("bases.pdf", "bases_concurso", "menubar=yes,location=yes,resizable=yes,scrollbars=yes,status=yes");
}
