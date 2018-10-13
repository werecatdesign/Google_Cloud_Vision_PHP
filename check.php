<?php

        session_start();  
    
        require "vendor/autoload.php"; // Connect to autoload.php
    
        
        use Google\Cloud\Vision\VisionClient; // using the Google Cloud Vision Interface
        $vision = new VisionClient(['keyFile' => json_decode(file_get_contents("key.json"), true)]); // Getting the API key from the key file

        $photo = fopen($_FILES['image']['tmp_name'], 'r'); // Reading out the photo from the uploads directory

        $image = $vision->image($photo, ['FACE_DETECTION']); // enter the parameters that should be analysed
        $result = $vision->annotate($image); // annotate the image to the API key

        var_dump($result); // show the result on the php page
    
        if ($result) {
            $imagetoken = "yourimage";
            move_uploaded_file($_FILES['image']['tmp_name'], __DIR__ . '/uploads/' . $imagetoken . ".jpg");
        } else {
            header("location: index.php");
            die();
        }
    
        $faces = $result->faces();
        //$properties = $result->imageProperties();

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Cloud Vision Demo</title>
    <style>
         body, html {
            height: 100%;
         }
            
         .bg {
            background-color: #ffffff;
            height: 100%;
         }
    </style>
</head>    
	
    <body class = "bg">
        <div class = "container" style = "max-width: 1080px;">
            <br><br><br>
            <div class = "row" style ="background-color: #ffffff">
                <h2>Google Cloud Vision API</h2>
                <br>
                <div class ="picdiv" style = "text-align: center">
                    <img src = "uploads/yourimage.jpg" alt = "yourimage" style = "max-width: 500px">
                </div>
                <div class = "textoutput" id = "faces" style = "width: 400px; height: 200px; background-color: #ff0000; color: #000000">
                    <h1>Face Analysis</h1>
                    <?php 
                        include "faces.php";
                    ?>
                </div>
                <div class = "textoutput" id = "properties" style = "width: 400px; height: 200px; background-color: #ff0000; color: #000000">
                    <h1>Image Properties</h1>
                    <?php 
                        include "properties.php";
                    ?>
                </div>
            </div>
           
            
        
        </div>
        
    </body>
     

</html>