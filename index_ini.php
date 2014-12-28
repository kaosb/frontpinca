<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>CPECH</title>
	<link rel="stylesheet" href="css/style.css">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" ></script>
	<script src="js/touche.js" ></script>
	<script src="js/SimpleAjaxUploader.min.js" ></script>
	<script src="js/script.js" ></script>
</head>
<body>
	<div id="fb-root"></div>
	<script>
		window.fbAsyncInit = function() {
			FB.init({appId: '384241271749937',
				channelUrl : 'src/channel.php',
				status     : true, // check login status
				cookie     : true, // enable cookies to allow the server to access the session
				xfbml      : true  // parse XFBML
			});
			// fanGateIni();
		};
		(function(d){
			var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
			if (d.getElementById(id)) {return;}
			js = d.createElement('script'); js.id = id; js.async = true;
			js.src = "//connect.facebook.net/es_ES/all.js";
			ref.parentNode.insertBefore(js, ref);
		}(document));
		// (function(d, s, id) {
		// 	var js, fjs = d.getElementsByTagName(s)[0];
		// 	if (d.getElementById(id)) return;
		// 	js = d.createElement(s); js.id = id;
		// 	js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&appId=384241271749937&version=v2.0";
		// 	fjs.parentNode.insertBefore(js, fjs);
		// }(document, 'script', 'facebook-jssdk'));
	</script>
	<div id="fangate">
		<div id="btnlike"></div>
		<div class="btnverbases"></div>
		<!-- <div id="likecanvas">
			<div class="fb-like" data-href="https://www.facebook.com/preuniversitariocpech" data-layout="box_count" data-action="like" data-show-faces="false" data-share="false" style="position:relative;top:40%;left:35%;"></div>
			<span id="close">Cerrar</span>
		</div> -->
	</div>
	<div id="step0">
		<div id="btnjoin"></div>
		<div class="btnverbases"></div>
	</div>
	<div id="step1">
		<div id="btntakepic"></div>
		<form id="imageform" uploadurl="src/guardarImagen.php" posturl="src/guardarParticipante.php" >
			<input id="imageinput" name="imageinput" type="file" accept="image/*;capture=camera" style="display:none;" capture/>
		</form>
		<!-- <a href="#" id="btnenviar">Enviar</a> -->
	</div>
	<div id="step2">
		<input id="score" name="score" type="number" value="0">
		<div id="btnok"></div>
	</div>
	<div id="step3">
		<div id="btntwitter"></div>
		<div id="btnfacebook"></div>
	</div>

	<div id="loader">
		<div class="spinner">
			<div class="cube1"></div>
			<div class="cube2"></div>
		</div>
	</div>

</body>
</html>
