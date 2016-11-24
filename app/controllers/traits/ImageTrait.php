<?php

trait ImageTrait {
    
	public static function upload($img, $index, $category) {

		$status = 1;
		$errors = [];

		$path = IMG_PATH ."$category/".  basename($img["name"][$index]);
		$rel_path = "/img/$category/".  basename($img["name"][$index]);
		$ext = pathinfo($path,PATHINFO_EXTENSION);

		// Check if image file is a actual image or fake image
	    $check = getimagesize($img["tmp_name"][$index]);
	    if($check !== false)
	        $status = 1;
	    else {
	        $errors[] = "File (" . basename($img["name"][$index]) . ") is not an image";
	        $status = 0;
	    }

		// Check if file already exists
		if (file_exists($path)) {
		    $errors[] = "File (" . basename($img["name"][$index]) . ") already exists at $path.";
		    $status = 0;
		}
		// Check file size
		if ($img["size"][$index] > 5000000) { // 5 MB
		    $errors[] = "File size (" . basename($img["name"][$index]) . ", " . $img["size"][$index] . "B) is too large.";
		    $status = 0;
		}

		// Allow certain file formats
		if($ext != "jpg" && $ext != "png" && $ext != "jpeg" && $ext != "gif" ) {
		    $errors[] = "File extension (" . basename($img["name"][$index]) . ") is $ext. Only JPG, JPEG, PNG & GIF files are allowed.";
		    $status = 0;
		}

		// Check if $status is set to 0 by an error
		if ($status) {
		    if (!move_uploaded_file($img['tmp_name'][$index], $path)) {
		    	$errors[] = "File upload (" . basename($img["name"][$index]) . ") failed.";
		    }
		}

		return ['status' => $status, 'errors' => $errors, 'path' => $rel_path];

	}

}