<?php
include("conexion.php");
if(isset($_POST['uid'])){
	$uid = $_POST['uid'];
	// query para verificar si ya existe en la BD.
	$query = "select * from participantes where userID = '$uid'";
	$queryExiste = mysql_query($query, $link);
	$contadorExiste = mysql_num_rows($queryExiste);
	if($contadorExiste < 1){
		echo json_encode(array("code" => "0"));
	}else{
		echo json_encode(array("code" => "1"));
	}
}else{
	echo json_encode(array("code" => "2"));
}
?>