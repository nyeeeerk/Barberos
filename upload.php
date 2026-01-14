<?php
// Start the session
session_start();

// Check if the user is not logged in or is not an admin
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["status"] !== 'admin') {
    // Redirect them to the login page or another page as needed
    header("location: about.php");
    exit;
}

// Include the configuration file
include "config.php";

// Initialize an array to store error messages
$errors = [];

// Check if the form is submitted
if (isset($_POST['form_submit'])) {
    // Sanitize and get form data
    $title = mysqli_real_escape_string($link, $_POST['title']);
    $barbername = mysqli_real_escape_string($link, $_POST['barbername']);
    $workdesc = mysqli_real_escape_string($link, $_POST['workdesc']);
    $awards = mysqli_real_escape_string($link, $_POST['awards']);

    // Define the folder for uploads
    $folder = "crud/uploads/";

    // Get the image file details
    $image_file = $_FILES['image']['name'];
    $file = $_FILES['image']['tmp_name'];
    $target_file = $folder . basename($image_file);
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

    // Allow only certain file types
    $allowed_types = ["jpg", "jpeg", "png", "gif"];
    if (!in_array($imageFileType, $allowed_types)) {
        $errors[] = 'Sorry, only JPG, JPEG, PNG & GIF files are allowed';
    }

    // Set a limit for image file size
    $max_size = 1048576; // 1 MB in bytes
    if ($_FILES["image"]["size"] > $max_size) {
        $errors[] = 'Sorry, your image is too large. Upload less than 1 MB in size.';
    }

    // If there are no errors, proceed with the upload and database insertion
    if (empty($errors)) {
        // Move the uploaded file to the destination folder
        move_uploaded_file($file, $target_file);

        // Insert data into the database
        $result = mysqli_query($link, "INSERT INTO image1(image, barbername, title, workdesc, awards, status) VALUES('$image_file', '$barbername', '$title', '$workdesc', '$awards', 'active')");

        // Check if the query was successful
        if ($result) {
            header("location: about.php?image_success=1");
            exit;
        } else {
            echo 'Something went wrong with the database query: ' . mysqli_error($link);
        }
    }
}

// Display any error messages
if (!empty($errors)) {
    foreach ($errors as $error) {
        echo '<div class="message">' . $error . '</div><br>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .message {
            color: #f44336;
            margin-bottom: 10px;
        }

        label, input {
            display: block;
            margin-bottom: 10px;
        }

        input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        .btn-primary {
            padding: 8px 16px;
            font-size: 14px;
            cursor: pointer;
            border: none;
            color: #fff;
            border-radius: 4px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            background-color: #4CAF50;
        }

        .btn-back {
            padding: 8px 16px;
            font-size: 14px;
            cursor: pointer;
            border: none;
            color: #fff;
            border-radius: 4px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            background-color: #333;
        }
    </style>
    <title>Image Upload in PHP and MYSQL database</title>
</head>
<body>
    <div class="container">
        <a href="image.php" class="btn-back">Back</a>
        <form action="" method="POST" enctype="multipart/form-data">
            <label>Image</label>
            <input type="file" name="image" required>
            <label>Barber Name</label>
            <input type="text" name="barbername">
            <label>Title</label>
            <input type="text" name="title">
            <label>Work Description</label>
            <input type="text" name="workdesc">
            <label>Awards</label>
            <input type="text" name="awards">
            <br><br>
            <button name="form_submit" class="btn-primary">Upload</button>
        </form>
    </div>
</body>
</html>
