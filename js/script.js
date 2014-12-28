$(document).ready(function(){
	/******************************************** Objeto Global para almacenar al participante y sus datos */
	$.participantdata = {};
	/******************* Al cargar el DOM muestra el step 0 */
	$('#step0').show();
	/******************* Bind para el boton ver bases que despliega las bases del concurso */
	$('.btnverbases').on('click', function(event){
		verBases();
	});
	// Acciones asociadas al boton participar.
	$('#btnjoin').on('click', function(event){
		// Pedimos los datos y/o los permisos para acceder a los datos.
		FB.getLoginStatus(function(response){
			// Verifico si ya tengo los permisos y la aplicacion esta autorizada.
			if(response && response.authResponse && response.status === 'connected'){
				$.participantdata = buildParticipantObject(response);
				// Verificamos si ya participo.
				if(!isEmpty($.participantdata)){
					checkParticipation($.participantdata.userID);
				}
			}else{
				// Me autentico y solicito los permisos respectivos.
				FB.login(function(response){
					// Verifico si ya tengo los permisos y la aplicacion esta autorizada.
					if (response && response.authResponse && response.status === 'connected'){
						$.participantdata = buildParticipantObject(response);
						// Verificamos si ya participo.
						if(!isEmpty($.participantdata)){
							checkParticipation($.participantdata.userID);
						}
					}else{
						isFanChecknoPermisions();
					}
				},{ scope:'email, public_profile'});
			}
		});
	});
	// Bindeamos el input y la validacion para capturar el puntaje.
	$('#btnok').on('click', function(event){
		var score = parseInt($('#score').val(), 10);
		if(typeof score === 'number' && (score % 1) === 0 && score > 0){
			$.participantdata.score = score;
			$('#step2').hide();
			$('#step1').show();
			// Plugin para hacer el file upload con jquery
			var uploader = new ss.SimpleUpload({
				button: 'btntakepic',
				url: 'src/guardarImagen.php',
				name: 'uploadfile',
				responseType: 'json',
				allowedExtensions: ['jpg', 'jpeg', 'png', 'gif'],
				maxSize: 1500,
				onSubmit: function(filename, extension){
					$('#loader').show();
				},
				onComplete: function(filename, response){
					if(!response){
						$('#loader').hide();
						alert(filename + 'upload failed');
						return false;
					}
					$.post('src/guardarParticipante.php', { userID: $.participantdata.userID, accessToken: $.participantdata.accessToken, first_name: $.participantdata.first_name, last_name: $.participantdata.last_name, name: $.participantdata.name, email: $.participantdata.email, score: $.participantdata.score },function(data){
						$('#step1').hide();
						$('#step3').show();
						$('#loader').hide();
					});
				}
			});  
		}else{
			alert("Es necesario ingresar un puntaje valido.");
		}
	});

});

/******************* Funcion que permite crear y cargar los datos del usuario en el objeto participante. */
function buildParticipantObject(response){
	$.participantdata = {};
	$.participantdata.accessToken = response.authResponse.accessToken;
	$.participantdata.userID = response.authResponse.userID;
	FB.api('/me', function(data){
		console.log(data);
		$.participantdata.name = data.name;
		$.participantdata.first_name = data.first_name;
		$.participantdata.last_name = data.last_name;
		$.participantdata.email = data.email;
	});
	return $.participantdata;
}

/******************* Funcion que permite abrir las bases del concurso */
function verBases(){
	var WindowObjectReference = window.open("bases.pdf", "bases_concurso", "menubar=yes,location=yes,resizable=yes,scrollbars=yes,status=yes");
}

/******************* Que despliega mensaje indicando que es necesario los permisos para usar la aplicacion */
function isFanChecknoPermisions(){
	alert("Para usar esta aplicación, es necesario concedas los permisos necesarios.");
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
				$('#step2').show();
				return false;
			}
		}
	});
}
