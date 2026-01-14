<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

require_once('config.php');

// Set the timezone to your desired timezone
date_default_timezone_set('Asia/Manila');

// Get the current date in the format 'YYYY-MM-DD'
$currentDate = date('Y-m-d');

// Modify the SQL query to filter out past bookings
$ReadSql = "SELECT booking.*, users.username AS booked_by_username, image1.barbername
             FROM `booking` 
             INNER JOIN `users` ON booking.user_id = users.id
             LEFT JOIN `image1` ON booking.barber_id = image1.id
             WHERE booking.date >= '$currentDate'";
$res = mysqli_query($link, $ReadSql);

// Check if the query was successful
if (!$res) {
    die("Error: " . mysqli_error($link));
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Online Booking System - View</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <style>
        /* Style for confirmed status */
        .confirmed {
            color: green;
            font-weight: bold; /* You can adjust styling as needed */
        }

        /* Style for not confirmed status */
        .not-confirmed {
            color: grey;
            font-weight: normal; /* You can adjust styling as needed */
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Barberos</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                <ul class="navbar-nav">
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
                        <a class="nav-link btn btn-warning" href="about.php">Back To Barbers</a>
                    </li>
                    <li class="nav-item mr-sm-2">
                        <a class="nav-link btn btn-danger" href="logout.php">Sign Out</a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="row mt-4">
            <div class="col-12">
                <h2 class="text-center">Current Bookings</h2>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Phone Number</th>
                                <th>Booked By</th>
                                <th>Barber</th>
                                <th>Status</th>
                                <th>Action</th>
                                <?php if ($_SESSION["status"] == "admin") : ?>
                                    <th>Deposit Slip</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($r = mysqli_fetch_assoc($res)) {
                                ?>
                            <tr>
                                <th scope="row"><?php echo $r['id']; ?></th>
                                <td><?php echo $r['name']; ?></td>
                                <td><?php echo $r['date']; ?></td>
                                <td><?php echo $r['time']; ?></td>
                                <td><?php echo $r['phone']; ?></td>
                                <td><?php echo $r['booked_by_username']; ?></td>
                                <td><?php echo $r['barbername']; ?></td>
                                <td class="<?php echo $r['bookingstatus'] == 1 ? 'confirmed' : 'not-confirmed'; ?>">
                                    <?php echo $r['bookingstatus'] == 1 ? 'Confirmed' : 'Not Confirmed'; ?>
                                </td>
                                <td>
                                    <?php
                                    if ($_SESSION["user_id"] == $r["user_id"] || $_SESSION["status"] == "admin") {
                                        ?>
                                        <a href="update.php?id=<?php echo $r['id']; ?>"><button type="button"
                                                class="btn btn-info btn-sm">Edit</button></a>

                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                            data-target="#myModal<?php echo $r['id']; ?>">Delete</button>

                                        <?php
                                        if ($_SESSION["status"] == "admin" && $r['status'] == 0) {
                                            ?>
                                        <a href="confirm.php?id=<?php echo $r['id']; ?>"><button type="button"
                                                class="btn btn-success btn-sm">Confirm</button></a>
                                        <?php
                                        }
                                        ?>
                                    <?php
                                    } else {
                                        echo "Cannot edit or delete. Not booked by the current user.";
                                    }
                                    ?>
                                </td>
                                <?php if ($_SESSION["status"] == "admin") : ?>
                                    <td>
                                        <?php
                                        if ($_SESSION["status"] == "admin" && !empty($r['deposit_slip'])) {
                                            // Output the image tag inside a modal
                                            echo '<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#depositSlipModal' . $r['id'] . '">View Deposit Slip</button>';
                                            echo '<div class="modal fade" id="depositSlipModal' . $r['id'] . '" tabindex="-1" role="dialog" aria-labelledby="depositSlipModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Deposit Slip Image</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <img src="' . $r['deposit_slip'] . '" class="img-fluid" alt="Deposit Slip">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>';
                                        } 
                                    ?>
                                    </td>
                                <?php endif; ?>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
