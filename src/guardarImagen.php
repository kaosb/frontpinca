<?php
	// $data = array();
	// $error = false;
	// $files = array();
	// $uploaddir = './uploads/';
	// foreach($_FILES as $file){
	// 	if(move_uploaded_file($file['tmp_name'], $uploaddir .basename($file['name']))){
	// 		$files[] = $uploaddir .$file['name'];
	// 	}else{
	// 		$error = true;
	// 	}
	// }
	// $data = ($error) ? array('error' => 'There was an error uploading your files') : array('files' => $files);
	// echo json_encode($data);

	require('Uploader.php');
	$upload_dir = '/img_uploads/';
	$valid_extensions = array('gif', 'png', 'jpeg', 'jpg');
	$Upload = new FileUpload('uploadfile');
	$result = $Upload->handleUpload($upload_dir, $valid_extensions);
	if(!$result){
		echo json_encode(array('success' => false, 'msg' => $Upload->getErrorMsg()));   
	}else{
		echo json_encode(array('success' => true, 'file' => $Upload->getFileName()));
	}
?>