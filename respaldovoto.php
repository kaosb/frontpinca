<?php
	if(isset($_GET['id'])){
		// Marcamos el open
		include("src/conexion.php");
		$id = $_GET['id'];
		mysql_query("UPDATE participantes SET open = open + 1 WHERE userID = '$id'", $link);
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>CPECH</title>
	<link rel="stylesheet" href="css/style.css">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js" type="text/javascript" charset="utf-8"></script>
	<meta property="og:title" content="Mi logro Cpech" />
	<meta property="og:description" content="#MiLogroCpech vota por mi logro en: http://milogrocpech.cl/vote.php?id=<?php echo $_GET['id']; ?>" /> 
	<meta property="og:image" content="http://milogrocpech.cl/img/sharesquare.png" />
	<meta property="og:site_name" content="Cpech" />
</head>
<body>
	<div id="vote0">
		<?php
		// Verifico que venga el parametro
		if(isset($_GET['id']) && !empty($_GET['id'])){
			// Si viene el parametro verifico si viene una cookie.
			if(isset($_COOKIE['voto_milogrocpech']) && $_COOKIE['voto_milogrocpech'] == $_GET['id']){
				// Si viene la cookie y la cookie contiene el valor del usuario que referencio, no es posible votar por el hasta que la cookie desaparesca.
				?>
				<span id="milagropunto">Ya votaste por esta persona, vuelve a intentarlo en otro momento.</span>
				<?php
			}else{
				// Pasar al flujo normal de voto.
				include("src/conexion.php");
				$id = $_GET['id'];
				$query = "select * from participantes where userID = '$id'";
				$queryData = mysql_query($query, $link);
				$objecto = mysql_fetch_assoc($queryData);
				?>
				<div id="imagenpersona">
					<img width="300" src="img_uploads/<?php echo $objecto['userID']; ?>.jpg">
				</div>
				<span id="milagropunto">#milogrocpech fue <?php echo $objecto['score']; ?> puntos :)</span>
				<a href="#" vote="<?php echo $objecto['userID']; ?>" id="btnvotar">Votar</a>
				<span id="graciasvoto" style="display: none;">¡¡Gracias por tu voto!!</span>
				<?php
			}
		}else{
			// Si no viene no tengo informacion suficiente para ejecutar alguna accion.
			?>
			<span id="milagropunto">La informacion que proporcionaste, no es suficiente para ejecutar alguna accion.</span>
			<?php
		}
		?>
	</div>
	<script type="text/javascript" >
		$(document).ready(function(){
			// Desplegamos la vista.
			$('#vote0').show();
			// Bindeamos el boton para votar.
			$('#btnvotar').on('click', function(event){
				// console.log(readCookie('voto_milogrocpech'));
				$.post('src/makeVote.php', { userID: $(this).attr('vote') },function(data){
					// console.log(obj);
					var obj = jQuery.parseJSON(data);
					if(obj.cod == 1){
						alert("Gracias por votar.");
					}else{
						alert("No fue posible registrar tu voto.")
					}
					window.location.replace("http://www.facebook.com/preuniversitariocpech");
				});
				event.preventDefault();
			});
		});
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
	</script>
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
