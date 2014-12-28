<?php
if(isset($_POST['img'])){
	require 'fb/facebook.php';
	$facebook = new Facebook(array(
		'appId' => '279229738900814',
		'secret' => '95fbc7cb3aa9b04a2553478aa6829c7a',
		'cookie' => true
		));
	$facebook->setFileUploadSupport(true);
	switch($_POST['img']){
		case "img001":
			$img = "../src/base/001.jpg";
		break;
		case "img002":
			$img = "../src/base/002.jpg";
		break;
		case "img003":
			$img = "../src/base/003.jpg";
		break;
		case "img004":
			$img = "../src/base/004.jpg";
		break;
		case "img005":
			$img = "../src/base/005.jpg";
		break;
		case "img006":
			$img = "../src/base/006.jpg";
		break;
		default:
			$img = "../src/base/001.jpg";
		break;
	}
	$photo = $facebook->api('/me/photos', 'POST',
		array(
			'access_token' => $_POST['accessToken'],
			'source' => '@'.$img,
			'message' => 'Feliz día internacional de la mujer!!.'
			));
	echo json_encode($photo);
}else{
	echo json_encode(array("msj" => "Falto indicar la imagen"));
}
?>