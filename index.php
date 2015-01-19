<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>CPECH</title>
	<link rel="stylesheet" href="css/style.css">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="js/jquery.countdown.min.js" ></script>
	<script src="js/touche.js" ></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#welcome').show();
			// $('#timmer').countdown('2014/12/28 10:30:00', function(event) {
			// 	$(this).text(event.strftime('%D días %H:%M:%S'));
			// });
			$('.btnverbases').on('click', function(event){
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
		<div class="btnverbases"></div>
	</div>
</body>
</html>
