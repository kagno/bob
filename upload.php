<?php
// Directory where videos will be stored
$target_dir = "video/";

// Get the uploaded file
$target_file = $target_dir . basename($_FILES["video-file"]["name"]);
$uploadOk = 1;
$videoFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if the file is a video
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["video-file"]["tmp_name"]);
    if($check !== false) {
        echo "File is a valid video file - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not a video.";
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, video already exists.";
    $uploadOk = 0;
}

// Check file size (limit to 50MB for example)
if ($_FILES["video-file"]["size"] > 50000000) {
    echo "Sorry, your video is too large.";
    $uploadOk = 0;
}

// Allow only certain file formats (mp4 for this example)
if($videoFileType != "mp4" && $videoFileType != "avi" && $videoFileType != "mov") {
    echo "Sorry, only MP4, AVI, and MOV files are allowed.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your video was not uploaded.";
} else {
    if (move_uploaded_file($_FILES["video-file"]["tmp_name"], $target_file)) {
        echo "The video ". basename( $_FILES["video-file"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your video.";
    }
}
?>
