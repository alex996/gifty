<?php

trait ImageTrait {
    
	public static function upload($img, $category) {

		$status = 1;
		$errors = [];

		$path = IMG_PATH ."$category/".  basename($img["name"]);
		$rel_path = "/img/$category/".  basename($img["name"]);
		$ext = pathinfo($path,PATHINFO_EXTENSION);

		// Check if image file is a actual image or fake image
	    $check = getimagesize($img["tmp_name"]);
	    if($check !== false)
	        $status = 1;
	    else {
	        $errors[] = 'File is not an image';
	        $status = 0;
	    }

		// Check if file already exists
		if (file_exists($path)) {
		    $errors[] = "File already exists at $path.";
		    $status = 0;
		}
		// Check file size
		if ($img["size"] > 5000000) { // 5 MB
		    $errors[] = "File size is too large.";
		    $status = 0;
		}

		// Allow certain file formats
		if($ext != "jpg" && $ext != "png" && $ext != "jpeg" && $ext != "gif" ) {
		    $errors[] = "Only JPG, JPEG, PNG & GIF files are allowed.";
		    $status = 0;
		}

		// Check if $status is set to 0 by an error
		if ($status) {
		    if (!move_uploaded_file($img["tmp_name"], $path)) {
		    	$errors[] = 'File upload filed.';
		    }
		}

		return ['status' => $status, 'errors' => $errors, 'path' => $rel_path];

	}

}