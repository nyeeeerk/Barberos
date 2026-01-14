<?php
// Start the session
session_start();

// Check if the user is not logged in or is not an admin
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["status"] !== 'admin') {
    // Redirect them to the login page or another page as needed
    header("location: about.php");
    exit;
}

include "config.php";

$id = $_GET['id'];

if (isset($_POST['update_submit'])) {
    $barbername = mysqli_real_escape_string($link, $_POST['barbername']);
    $title = mysqli_real_escape_string($link, $_POST['title']);
    $status = mysqli_real_escape_string($link, $_POST['status']);
    $workdesc = mysqli_real_escape_string($link, $_POST['workdesc']);
    $awards = mysqli_real_escape_string($link, $_POST['awards']);

    $folder = "crud/uploads/";
    $image_file = $_FILES['image']['name'];
    $file = $_FILES['image']['tmp_name'];
    $target_file = $folder . $image_file;
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

    if ($file != '') {
        if ($_FILES["image"]["size"] > 500000) {
            $error[] = 'Sorry, your image is too large. Upload less than 500 KB in size.';
        }

        if (!in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
            $error[] = 'Sorry, only JPG, JPEG, PNG & GIF files are allowed';
        }
    }

    if (!isset($error)) {
        if ($file != '') {
            $res = mysqli_query($link, "SELECT * FROM image1 WHERE id = $id");
            if ($row = mysqli_fetch_array($res)) {
                $deleteImage = $row['image'];
            }

            move_uploaded_file($file, $target_file);
            $result = mysqli_query($link, "UPDATE image1 SET image='$image_file', barbername='$barbername', title='$title', Status='$status', workdesc='$workdesc', awards='$awards' WHERE id=$id");
        } else {
            $result = mysqli_query($link, "UPDATE image1 SET barbername='$barbername', title='$title', Status='$status', workdesc='$workdesc', awards='$awards' WHERE id=$id");
        }

        if ($result) {
            header("location: about.php?action=saved");
        } else {
            echo 'Something went wrong';
        }
    }
}

if (isset($error)) {
    foreach ($error as $error) {
        echo '<div class="message">' . $error . '</div><br>';
    }
}

$res = mysqli_query($link, "SELECT * FROM image1 WHERE id=$id limit 1");
if ($row = mysqli_fetch_array($res)) {
    $image = $row['image'];
    $barbername = $row['barbername'];
    $title = $row['title'];
    $status = $row['status'];
    $workdesc = $row['workdesc'];
    $awards = $row['awards'];
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
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 80%;
            max-width: 500px;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px 1px #888888;
            margin: auto;
        }

        form {
            padding: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input, select {
            width: 100%;
            padding: 8px;
            margin-bottom: 20px;
            box-sizing: border-box;
        }

        button {
            background-color: #4caf50;
            color: #ffffff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-back {
            background-color: #3498db;
            color: #ffffff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 20px;
            display: block;
            width: 100%;
            text-align: center;
        }

        .btn-back:hover {
            background-color: #2980b9;
        }

        .success {
            background-color: #4caf50;
            color: #ffffff;
            padding: 10px;
            margin-top: 20px;
            border-radius: 5px;
            text-align: center;
        }

        .message {
            background-color: #e74c3c;
            color: #ffffff;
            padding: 10px;
            margin-top: 20px;
            border-radius: 5px;
            text-align: center;
        }

        .status-indicator {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: inline-block;
        }

        .active {
            background-color: green;
        }

        .inactive {
            background-color: grey;
        }
    </style>
    <title>Image Upload and Edit in PHP and MYSQL database</title>
</head>
<body>
    <div class="container">
        <a href="image.php" class="btn-back">Back</a>
        <h1>Edit</h1>

        <?php if (isset($update_sucess)) : ?>
            <div class="success">Image Updated successfully</div>
        <?php endif; ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <label>Image Preview</label><br>
            <img src="crud/uploads/<?php echo $image; ?>" height="100" style="max-width: 100%;"><br>
            <label>Change Image</label>
            <input type="file" name="image" class="form-control">
            <label>Barbername</label>
            <input type="text" name="barbername" value="<?php echo $barbername; ?>" class="form-control">
            <label>Title</label>
            <input type="text" name="title" value="<?php echo $title; ?>" class="form-control">
            <label>Work Description</label>
            <input type="text" name="workdesc" value="<?php echo $workdesc; ?>" class="form-control">
            <label>Awards</label>
            <input type="text" name="awards" value="<?php echo $awards; ?>" class="form-control">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="Active" <?php echo ($status == 'Active') ? 'selected="selected"' : ''; ?>>Active</option>
                <option value="Inactive" <?php echo ($status == 'Inactive') ? 'selected="selected"' : ''; ?>>Inactive</option>
            </select>
            <br><br>
            <button name="update_submit" class="btn-primary">Update</button>
        </form>

        <label>Status Indicator</label><br>
        <div class="status-indicator <?php echo strtolower($status); ?>"></div> <?php echo ucfirst(strtolower($status)); ?>
    </div>
</body>
</html>
