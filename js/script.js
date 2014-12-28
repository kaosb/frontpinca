$(document).ready(function(){
	/******************* Al cargar el DOM muestra el fangate */
	// $('#fangate').show();
	/******************* Bind para el boton ver bases que despliega las bases del concurso */
	$('#btnverbases').on('click', function(event){
		verBases();
	});
	/******************* Bind para el boton like que despliega el canvas que contiene el boton proporcionado por fb */
	$('#btnlike').on('click', function(event){
		$('#likecanvas').show();
	});
	/******************* Bind para el boton cerrar del canvas que contiene el boton like */
	// $('#close').on('tap', function(event){
	// $('#likecanvas').hide();
	
});

/******************* Funcion que permite abrir las bases del concurso */
function verBases(){
	var WindowObjectReference = window.open("bases.pdf", "bases_concurso", "menubar=yes,location=yes,resizable=yes,scrollbars=yes,status=yes");
}

/******************* Revisa que este logeado y chequea los permisos asi tambien los solicita de ser necesario */
function fanGateIni(){
	/* isFanCheck("211627285577705"); -> Felipe I. González G. */
	/* isFanCheck("99723704300"); -> Maternidad Clinica Alemana */
	FB.getLoginStatus(function(response){
		if(response && response.authResponse && response.status === 'connected'){
			isFanCheck("256475461058960");
		}else{
			FB.login(function(response){
				if (response && response.authResponse && response.status === 'connected'){
					isFanCheck("256475461058960");
				}else{
					isFanChecknoPermisions();
				}
			},{scope:'user_likes, email'});
		}
	});
}

/******************* Verifica que el usuario sea fan de la pagina indicada. */
function isFanCheck(page_id){
	FB.api('/me/likes/'+page_id,function(response) {
		if(response.data){
			if(!isEmpty(response.data)){
				$('#step0').show();
			}else{
				$('#fangate').show();
			}
		}
	});
}

/******************* Que despliega mensaje indicando que es necesario los permisos para usar la aplicacion */
function isFanChecknoPermisions(){
	alert("Para usar esta aplicación, es necesario concedas los permisos necesarios para corroborar si ya eres fan de esta pagina.");
	location.reload();
}

/******************* Virifica si un objeto esta vacio */
function isEmpty(obj){
	for(var prop in obj){
		if(obj.hasOwnProperty(prop)){
			return false;
		}
	}
	return true;
}
