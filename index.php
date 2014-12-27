<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>CPECH</title>
	<link rel="stylesheet" href="css/style.css">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="js/jquery.countdown.min.js" type="text/javascript" charset="utf-8" async defer></script>
	<script type="text/javascript" charset="utf-8">
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
	</script>
</head>
<body>
	<div id="welcome">
		<div id="timmer"></div>
		<div id="btnverbases"></div>
	</div>
</body>
</html>
