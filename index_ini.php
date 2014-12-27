<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>CPECH</title>
	<link rel="stylesheet" href="css/style.css">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="js/jquery.countdown.min.js" type="text/javascript" charset="utf-8" async defer></script>
	<script src="js/script.js" type="text/javascript" charset="utf-8" async defer></script>
</head>
<body>
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&appId=384241271749937&version=v2.0";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
	</script>
	<div id="fangate">
		<div id="btnlike"></div>
		<div id="btnverbases"></div>
		<div id="likecanvas">
			<div class="fb-like" data-href="https://www.facebook.com/preuniversitariocpech" data-layout="button" data-action="like" data-show-faces="false" data-share="false"></div>
			<span id="close">Cerrar</span>
		</div>
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
