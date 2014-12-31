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
	<meta property="og:title" content="Mi logro Cpech" />
	<meta property="og:description" content="#MiLogroCpech participa compartiendo tu logro en: http://milogrocpech.cl" /> 
	<meta property="og:image" content="http://milogrocpech.cl/img/sharesquare.png" />
	<meta property="og:site_name" content="Cpech" />
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
		};
		(function(d){
			var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
			if (d.getElementById(id)) {return;}
			js = d.createElement('script'); js.id = id; js.async = true;
			js.src = "//connect.facebook.net/es_ES/all.js";
			ref.parentNode.insertBefore(js, ref);
		}(document));
	</script>
	<div id="fangate">
		<div id="btnlike"></div>
		<div class="btnverbases"></div>
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
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-58059235-1', 'auto');
		ga('send', 'pageview');
	</script>
</body>
</html>
