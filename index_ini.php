<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>CPECH</title>
	<link rel="stylesheet" href="css/style.css">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="js/touche.js" ></script>
	<script src="js/script.js" type="text/javascript" charset="utf-8" async defer></script>
</head>
<body>
	<div id="fb-root"></div>
	<script>
		window.fbAsyncInit = function() {
			FB.init({appId: '384241271749937',
				channelUrl : '//coddea.com/proyectos/fb_cpech_2014/src/channel.php',
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
		<div id="btnverbases"></div>
<!-- 		<div id="likecanvas">
			<div class="fb-like" data-href="https://www.facebook.com/preuniversitariocpech" data-layout="box_count" data-action="like" data-show-faces="false" data-share="false" style="position:relative;top:40%;left:35%;"></div>
			<span id="close">Cerrar</span>
		</div> -->
	</div>
	<div id="step0">
		<div id="btnjoin"></div>
		<div id="btnverbases"></div>
	</div>
	<div id="step1">
		<div id="btntakepic"></div>
	</div>
	<div id="step2">
		<input id="score" type="text" name="" value="0">
		<div id="btnok"></div>
	</div>
	<div id="step3">
		<div id="btntwitter"></div>
		<div id="btnfacebook"></div>
	</div>	
</body>
</html>
