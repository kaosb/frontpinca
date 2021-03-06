$(document).ready(function(){
	// Constante con la URL para enviar a los referidos.
	APP_DOMAIN = 'http://milogrocpech.cl/vote.php';
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
				data: {'userID': $.participantdata.userID},
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
	// Bindeamos los botones para compartir en redes sociales.
	$('#btntwitter').on('click', function(event){
		var mensaje = 'Mi logro Cpech Vota por mi logro en: ' + APP_DOMAIN + '?id=' + $.participantdata.userID;
		var width  = 575,
		height = 400,
		left   = ($(window).width()  - width)  / 2,
		top    = ($(window).height() - height) / 2,
		url    = 'http://twitter.com/share?text=' + mensaje +'&hashtags=milogrocpech',
		opts   = 'status=1' +
				',width='  + width  +
				',height=' + height +
				',top='    + top    +
				',left='   + left;
		window.open(url, 'twitter', opts);
	});
	$('#btnfacebook').on('click', function(event){
		// FB.ui({
		// 	method: 'share',
		// 	href: APP_DOMAIN + '/?id=' + $.participantdata.userID + '&frompreview=true'
		// }, function(response){});
		openFbPopUp($.participantdata.userID);
	});
});

function openFbPopUp(userID){
	FB.ui(
	{
		method: 'feed',
		name: 'Cpech',
		link: "http://milogrocpech.cl/vote.php?id="+userID,
		picture: 'http://milogrocpech.cl/img/sharesquare.png',
		caption: 'Mi logro Cpech',
		description: 'Vota por mi #milogrocpech en: http://milogrocpech.cl/vote.php?id='+userID
	},
	function(response) {
		if (response && response.post_id) {
			alert('Tu post fue publicado en Facebook.');
		} else {
			alert('No fue posible publicar tu post en Facebook.');
		}
	}
	);
}

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

/******************* Cookies Toolbox */
/******************* funcion capaz de crear una Cookie */
function createCookie(name, value, days){
	if (days) {
		var date = new Date();
		date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
		var expires = "; expires=" + date.toGMTString();
	}
	else var expires = "";
	var fixedName = '<%= Request["formName"] %>';
	name = fixedName + name;
	document.cookie = name + "=" + value + expires + "; path=/";
}

/******************* funcion capaz de leer una Cookie */
function readCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for (var i = 0; i < ca.length; i++) {
		var c = ca[i];
		while (c.charAt(0) == ' ') c = c.substring(1, c.length);
		if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
	}
	return null;
}

/******************* funcion capaz de eliminar una Cookie */
function deleteCookie(name, path, domain){
	path = (path ? ";path=" + path : "");
	domain = (domain ? ";domain=" + domain : "");
	var expiration = "Thu, 01-Jan-1970 00:00:01 GMT";
	document.cookie = name + "=" + path + domain + ";expires=" + expiration;
}
