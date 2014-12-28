<?php
if(isset($_POST['token'])){
	require 'fb/facebook.php';
	$facebook = new Facebook(array(
		'appId' => '279229738900814',
		'secret' => '95fbc7cb3aa9b04a2553478aa6829c7a',
		'cookie' => true
		));
	if(isset($_POST['token'])){
		$wallpost = $facebook->api("/me/feed", "post", array(
			access_token => $_POST['token'],
			picture => "https://fbcdn-photos-h-a.akamaihd.net/hphotos-ak-prn1/t39.2081/p128x128/851590_279271232229998_1851362449_n.png",
			link => "http://www.facebook.com/pages/Maternidad-Clínica-Alemana/99723704300",
			name => "Celebra el día internacional de la mujer con Maternidad Clínica Alemana.",
			description => "y participa en el sorteo de 3 Day Spa en Novotel y 10 set de productos para el baño."
			));
	}
	echo json_encode(array("msj" => "OK","response" => $wallpost));
}else{
	echo json_encode(array("msj" => "Falto indicar la imagen"));
}
?>