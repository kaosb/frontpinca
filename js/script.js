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

	// Acciones asociadas al boton participar.
	$('#btnjoin').on('click', function(event){
		// Pedimos los datos y/o los permisos para acceder a los datos.
		FB.getLoginStatus(function(response){
			// Verifico si ya tengo los permisos y la aplicacion esta autorizada.
			if(response && response.authResponse && response.status === 'connected'){
				console.log(response);
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
		console.log(score);
		if(typeof score === 'number' && (score % 1) === 0 && score > 0){
			$.participantdata.score = score;
			console.log($.participantdata);
			$('#step2').hide();
			$('#step1').show();



			var uploader = new ss.SimpleUpload({
				button: 'btntakepic',
				url: 'src/guardarImagen.php',
				name: 'uploadfile',
				responseType: 'json',
				allowedExtensions: ['jpg', 'jpeg', 'png', 'gif'],
				maxSize: 1500,
				onSubmit: function(filename, extension){
					console.log(filename);
					console.log(extension);
					console.log("submit");
					$('#loader').show();
				},
				onComplete: function(filename, response){
					if(!response){
						$('#loader').hide();
						alert(filename + 'upload failed');
						return false;
					}
					console.log(filename);
					console.log(response);
					console.log("uploaded");
					$.post('src/guardarParticipante.php', { userID: $.participantdata.userID, accessToken: $.participantdata.accessToken, first_name: $.participantdata.first_name, last_name: $.participantdata.last_name, name: $.participantdata.name, email: $.participantdata.email, score: $.participantdata.score },function(data){
						$('#step1').hide();
						$('#step3').show();
						$('#loader').hide();
					});
				}
			});  


			// Uploader y post para los datos del concurso.
			// Bindeamos el file imput para el preload del archivo.
			// $('#imageform').fileUpload({
			// 	uploadData    : { userID: $.participantdata.userID }, // Append POST data to the upload
			// 	submitData    : { userID: $.participantdata.userID, accessToken: $.participantdata.accessToken, first_name: $.participantdata.first_name, last_name: $.participantdata.last_name, name: $.participantdata.name, email: $.participantdata.email, score: $.participantdata.score }, // Append POST data to the form submit
			// 	uploadOptions : { dataType : 'json' }, // Customise the parameters passed to the $.ajax() call on uploads. You can use any of the normal $.ajax() params
			// 	submitOptions : { dataType : 'json' }, // Customise the parameters passed to the $.ajax() call on the form submit. You can use any of the normal $.ajax() params
			// 	before        : function(){}, // Run stuff before the upload happens
			// 	beforeSubmit  : function(uploadData){ console.log(uploadData); return true; }, // access the data returned by the upload return false to stop the submit ajax call
			// 	success       : function(data, textStatus, jqXHR){ console.log(data); }, // Callback for the submit success ajax call
			// 	error         : function(jqXHR, textStatus, errorThrown){ console.log(jqXHR); }, // Callback if an error happens with your upload call or the submit call
			// 	complete      : function(jqXHR, textStatus){ console.log(jqXHR); } // Callback on completion
			// });
			// Acciones asociadas al boton subir foto trigger del action del file uploader.
			$('#btntakepic').on('click', function(event){
				$('#imageinput').click();
				// $('#imageinput').trigger('click');
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
				$('#step2').show();
				return false;
			}
		}
	});
}
