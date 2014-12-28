<?php
	require('Uploader.php');
	$upload_dir = '../img_uploads/';
	$valid_extensions = array('gif', 'png', 'jpeg', 'jpg');
	$Upload = new FileUpload('uploadfile');
	$ext = $Upload->getExtension();
	// $Upload->newFileName = $_GET['userID'].'.'.$ext;
	$Upload->newFileName = $_GET['userID'].'.jpg';
	$result = $Upload->handleUpload($upload_dir, $valid_extensions);
	if(!$result){
		echo json_encode(array('success' => false, 'msg' => $Upload->getErrorMsg()));   
	}else{
		echo json_encode(array('success' => true, 'file' => $Upload->getFileName()));
	}
?>