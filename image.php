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

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    if ($action == 'deleted') {
        echo '<div class="success">Image Deleted Successfully ... </div>';
    }
}

if (isset($_POST['delete_image'])) {
    $deleteId = $_POST['delete_id'];

    // Fetch image name to be deleted
    $result = mysqli_query($link, "SELECT image FROM image1 WHERE id = $deleteId LIMIT 1");
    $row = mysqli_fetch_assoc($result);
    $deleteImage = $row['image'];

    // Delete the image record from the database
    $deleteQuery = mysqli_query($link, "DELETE FROM image1 WHERE id = $deleteId");

    if ($deleteQuery) {
        // Delete the actual image file
        unlink("crud/uploads/$deleteImage");
        header("Location: about.php?action=deleted");
        exit;
    } else {
        echo '<div class="error">Error deleting image. Please try again.</div>';
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
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .success {
            color: #4CAF50;
            margin-bottom: 10px;
        }

        .error {
            color: #f44336;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        img {
            max-width: 100%;
            height: auto;
        }

        .btn-primary, .btn-danger {
            padding: 8px 16px;
            font-size: 14px;
            cursor: pointer;
            border: none;
            color: #fff;
            border-radius: 4px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary {
            background-color: #4CAF50;
        }

        .btn-danger {
            background-color: #f44336;
        }

        .back-btn {
            margin-bottom: 20px;
            display: inline-block;
            padding: 8px 16px;
            font-size: 14px;
            cursor: pointer;
            border: none;
            color: #fff;
            background-color: #333;
            border-radius: 4px;
            text-align: center;
            text-decoration: none;
        }
    </style>
    <title>Upload image, display, edit and delete in PHP</title>
</head>
<body>
    <div class="container">
        <a href="upload.php" class="btn-primary">Upload New Image</a>

        <?php
        if (isset($_GET['image_success'])) {
            echo '<div class="success">Image Uploaded successfully</div>';
        }
        ?>

        <a href="about.php" class="back-btn">Back</a>

        <table>
            <tr>
                <th> Image</th>
                <th>Title</th>
                <th>Action</th>
            </tr>

            <?php
            $result = mysqli_query($link, "SELECT * FROM image1 ORDER BY id DESC");

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr> 
                          <td><img src="crud/uploads/' . $row['image'] . '" alt="Image" /></td> 
                          <td>' . $row['title'] . '</td> 
                          <td>
                              <a href="edit.php?id=' . $row['id'] . '" class="btn-primary">Edit </a>
                              <form method="post" style="display:inline;">
                                <input type="hidden" name="delete_id" value="' . $row['id'] . '">
                                <button class="btn-danger" type="submit" name="delete_image">Delete</button>
                              </form>
                          </td> 
                        </tr>';
                }
            } else {
                echo '<tr><td colspan="3">No records found</td></tr>';
            }
            ?>
        </table>
    </div>
</body>
</html>
