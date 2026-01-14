<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

require_once('config.php');
$id = $_GET['id'];
$SelSql = "SELECT * FROM `booking` WHERE id=$id";
$res = mysqli_query($link, $SelSql);
$r = mysqli_fetch_assoc($res);
if (isset($_POST) & !empty($_POST)) {
    $date = ($_POST['date']);
    $time = ($_POST['time']);
    $name = ($_POST['name']);
    $phone = $_POST['phone'];

    $UpdateSql = "UPDATE `booking` SET date='$date', time='$time', name='$name', phone='$phone' WHERE id='$id'";
    $res = mysqli_query($link, $UpdateSql);
    if ($res) {
        header('location: view.php');
    } else {
        $fmsg = "Failed to Update data.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Online Booking System - UPDATE</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 30px;
        }

        .form-container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .btn-submit {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="navbar-collapse collapse justify-content-between">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="booking.php">Schedule Now!<span
                                class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="view.php">View Bookings</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item mr-sm-2">
                        <a class="nav-link btn btn-warning" href="about.php">Back To barbers</a>
                    </li>
                    <li class="nav-item mr-sm-2">
                        <a class="nav-link btn btn-danger" href="logout.php">Sign Out</a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="row mt-4">
            <?php if (isset($fmsg)) { ?>
            <div class="col-md-6 offset-md-3">
                <div class="alert alert-danger" role="alert"><?php echo $fmsg; ?></div>
            </div>
            <?php } ?>
            <div class="col-md-6 offset-md-3 form-container">
                <h2>Online Booking System - UPDATE</h2>
                <form method="post">
                    <div class="form-group">
                        <label for="inputName">Name</label>
                        <input type="text" name="name" class="form-control" id="inputName"
                            value="<?php echo $r['name']; ?>" placeholder="Your Name" required>
                    </div>

                    <div class="form-group">
                        <label for="inputDate">Booked Date</label>
                        <input type="date" name="date" class="form-control" id="inputDate"
                            value="<?php echo $r['date']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="inputTime">Booked Time</label>
                        <input type="time" name="time" class="form-control" id="inputTime" min="06:00" max="22:00"
                            value="<?php echo $r['time']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="inputPhone">Phone</label>
                        <input type="number" name="phone" class="form-control" id="inputPhone" min="10"
                            value="<?php echo $r['phone']; ?>" required>
                    </div>

                    <button type="submit" class="btn btn-primary btn-submit">Update</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
