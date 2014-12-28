<?php
	// Verificamos que vengan los datos.
	// Corroboramos que no venga la cookie, y la comparamos con el parametro ID.
	// Vienen y coinciden, les damos un mensaje que de ya voto por ese usuario y que lo intente en los proximos dias.
	// Si no lo tiene o no coindicen, pasan a votar por el usuario que los refirio.
	// 
	// 
	// Con el parametro ID, consulto la BD para obtener la informacion necesaria para desplegar.
	// La imagen.
	// El puntaje.
	// Y parametrizar el voto.
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
	<meta property="og:description" content="#MyLogroCpech vota por mi logro en: http://milogrocpech.cl/vote.php?id=" /> 
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
				include("conexion.php");
				$id = $_GET['id'];
				$query = "select * from participantes where userID = '$id'";
				$queryData = mysql_query($query, $link);
				$row = mysql_fetch_row($queryData);
				echo "<pre>";
				print_r($row);
				echo "</pre>";
				?>
				<div id="imagenpersona">
					<img src="http://lorempixel.com/300/300/sports/1/">
				</div>
				<span id="milagropunto">#milogrocpech fue 900 puntos :)</span>
				<a href="#" id="btnvotar">Votar</a>
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
		});
	</script>
</body>
</html>
