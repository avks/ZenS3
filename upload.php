<?php
	if (isset($_FILES["s3_file"]) && is_uploaded_file($_FILES["s3_file"]["tmp_name"]) && $_FILES["s3_file"]["error"] == 0) {
		if (!class_exists('S3')) require_once 'libs/S3.php';
		require("config.php");
		
		// get bucket name
		$bucket_name = $_POST['bucket_name'];
		
		// get permission
		$perm = $_POST['perm'];
		if($perm=="public"){
			$aws_perm = S3::ACL_PUBLIC_READ;
		} else if($perm=="private"){
			$aws_perm = S3::ACL_AUTHENTICATED_READ;
		}
		
		//instantiate the class  
		$s3 = new S3(AWS_ACCESS_KEY, AWS_SECRET_KEY); 
		
		// get file info
		$file_name = $_FILES["s3_file"]["name"];
		$file_tmp_name = $_FILES["s3_file"]["tmp_name"];
		
		if($s3->putObjectFile($file_tmp_name, $bucket_name, baseName($file_name), $aws_perm)){
			if($perm=="public"){
				$url = "http://".$bucket_name.".s3.amazonaws.com/".baseName($file_name);
			} else if($perm=="private"){
				$url = $s3->getAuthenticatedURL($bucket_name, baseName($file_name), 3600);
			}
			echo $url;
		}
		
	}
?>