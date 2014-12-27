$(document).ready(function(){
	$('#welcome').show();
	$('#timmer').countdown('2014/12/29', function(event) {
		$(this).text(event.strftime('%D días %H:%M:%S'));
	});
	$('#btnverbases').click(function(event){
		verBases();
	});
});

/******************* Funcion que permite abrir las bases del concurso */
function verBases(){
	var WindowObjectReference = window.open("bases.pdf", "bases_concurso", "menubar=yes,location=yes,resizable=yes,scrollbars=yes,status=yes");
}
