<?php
if(isset($_POST['userID'])){
	include("conexion.php");
	$userID = $_POST['userID'];
	$queryUpdate = "UPDATE participantes SET vote=vote+1 WHERE userID = '$userID'";
	$flag = true;
	// Verificamos que no exista la cookie o si existe que sea diferente a userID
	if(isset($_COOKIE['voto_milogrocpech']) && $_COOKIE['voto_milogrocpech'] == $userID){
		$flag = false;
	}
	if(mysql_query($queryUpdate, $link) && $flag){
		// seteamos el cookie para marcar que voto.
		setcookie('voto_milogrocpech', $userID, time() + 86400, "/");
		// update exitoso
		echo json_encode(array("msj" => "Se actualizo el puntaje de forma exitosa.", "cod" => "1"));
	}else{
		// algun error en el update
		echo json_encode(array("msj" => "Ocurrio un problema al actualizar el puntaje.", "cod" => "2", "query" => $queryInsert));
	}
}else{
	// No indicaron datos a actualizar
	echo json_encode(array("msj" => "No se indicaron los datos necesarios", "cod" => "0"));
}
?>