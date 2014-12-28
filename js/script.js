$(document).ready(function(){
	/******************************************** Objeto Global para almacenar al participante y sus datos */
	$.participantdata = {};
	/******************* Al cargar el DOM muestra el fangate */
	// $('#fangate').show();
	/******************* Al cargar el DOM muestra el step 0 */
	$('#step0').show();
	/******************* Bind para el boton ver bases que despliega las bases del concurso */
	$('.btnverbases').on('click', function(event){
		verBases();
	});
	/******************* Bind para el boton like que despliega el canvas que contiene el boton proporcionado por fb */
	// $('#btnlike').on('click', function(event){
	// 	$('#likecanvas').show();
	// });
	/******************* Bind para el boton cerrar del canvas que contiene el boton like */
	// $('#close').on('tap', function(event){
	// $('#likecanvas').hide();
	$('#btnjoin').on('click', function(event){
		
		// Creamos el objeto para almacenar dichos datos.
		// Verificamos si ya participo.
		// Actuamos conforme al paso anterior
		// 
		

		// Pedimos los datos y/o los permisos para acceder a los datos.
		FB.getLoginStatus(function(response){
			// Verifico si ya tengo los permisos y la aplicacion esta autorizada.
			if(response && response.authResponse && response.status === 'connected'){
				$.participantdata = buildParticipantObject(response);
				console.log(isEmpty($.participantdata));
				if(!isEmpty($.participantdata)){
					console.log("entro");
					checkParticipation($.participantdata.userID);
				}
			}else{
				// Me autentico y solicito los permisos respectivos.
				FB.login(function(response){
					// Verifico si ya tengo los permisos y la aplicacion esta autorizada.
					if (response && response.authResponse && response.status === 'connected'){
						$.participantdata = buildParticipantObject(response);
						console.log(isEmpty($.participantdata));
						if(!isEmpty($.participantdata)){
							console.log("entro");
							checkParticipation($.participantdata.userID);
						}
					}else{
						isFanChecknoPermisions();
					}
				},{ scope:'email, public_profile'});
			}
		});



	});
	



});

/******************* Funcion que permite crear y cargar los datos del usuario en el objeto participante. */
function buildParticipantObject(response){
	$.participantdata = {};
	$.participantdata.accessToken = response.authResponse.accessToken;
	$.participantdata.userID = response.authResponse.userID;
	FB.api('/me', function(data){
		$.participantdata.name = data.name;
		$.participantdata.first_name = data.first_name;
		$.participantdata.last_name = data.last_name;
		$.participantdata.email = data.email;
		$.participantdata.username = data.username;
	});
	return $.participantdata;
}

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

/******************* Revisa que no haya participado con anterioridad */
function checkParticipation(uid){
	$.ajax({
		url: 'src/checkParticipacion.php',
		type: 'POST',
		dataType: 'json',
		data: { uid: uid },
		success: function(data){
			if(data.code == 1){
				$('#step0').hide();
				$('#step3').show();
				return false;
			}else{
				$('#step0').hide();
				$('#step1').show();
				return false;
			}
		}
	});
}

