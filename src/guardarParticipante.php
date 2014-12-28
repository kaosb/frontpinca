<?php
if(isset($_POST['userID'])){
	include("conexion.php");
	$userID = $_POST['userID'];
	$accessToken = $_POST['accessToken'];
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$name = $_POST['name'];
	$email = $_POST['email'];
	$score = $_POST['score'];
	$queryInsert = "INSERT INTO participantes (userID, accessToken, first_name, last_name, name, email, score)
					VALUES ('$userID', '$accessToken', '$first_name', '$last_name', '$name', '$email', '$score')";
	$queryInsert = utf8_decode($queryInsert);
	if(mysql_query($queryInsert,$link)){
		// insert exitoso
		echo json_encode(array("msj" => "Se guardaron los datos de forma exitosa.", "cod" => "1"));
	}else{
		// algun error en la insert
		echo json_encode(array("msj" => "Ocurrio un problema al intentar guardar los datos.", "cod" => "2", "query" => $queryInsert));
	}
}else{
	// No indicaron datos a insertar
	echo json_encode(array("msj" => "No se indicaron los datos a insertar", "cod" => "0"));
}
?>