<?php
require_once('config.php');

session_start();

$error_message = '';

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $phone = $_POST['phone'];

    $user_id = isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : null;
    $barber_id = isset($_POST['barber']) ? $_POST['barber'] : null;

    if ($user_id !== null && $barber_id !== null) {
        if (isDateTimeAvailable($link, $barber_id, $date, $time)) {
            // Handle file upload for deposit slip
            $uploadDir = 'deposit/';  // specify your upload directory
            $depositSlipName = $_FILES['deposit_slip']['name'];
            $depositSlipTmpName = $_FILES['deposit_slip']['tmp_name'];

            $depositSlipPath = $uploadDir . $depositSlipName;

            // Move the uploaded file to the specified directory
            move_uploaded_file($depositSlipTmpName, $depositSlipPath);

            $insertSql = "INSERT INTO `booking` (name, date, time, phone, user_id, barber_id, deposit_slip, bookingstatus) VALUES ('$name', '$date', '$time', '$phone', '$user_id', '$barber_id', '$depositSlipPath', 0)";

            if (mysqli_query($link, $insertSql)) {
                echo "Booking created successfully";
            } else {
                echo "Error: " . $insertSql . "<br>" . mysqli_error($link);
            }
        } else {
            $error_message = "Error: The selected date and time are not available for the chosen barber.";
        }
    } else {
        echo "Error: user_id or barber_id is not set.";
    }
}

$barberQuery = "SELECT id, barbername FROM image1";
$barberResult = mysqli_query($link, $barberQuery);

if ($barberResult) {
    $barbers = mysqli_fetch_all($barberResult, MYSQLI_ASSOC);
} else {
    echo "Error: " . $barberQuery . "<br>" . mysqli_error($link);
}

mysqli_close($link);

function isDateTimeAvailable($link, $barber_id, $date, $time)
{
    $checkSql = "SELECT * FROM `booking` WHERE barber_id = '$barber_id' AND date = '$date' AND time = '$time'";
    $result = mysqli_query($link, $checkSql);

    return mysqli_num_rows($result) === 0;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Book Now</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container mt-5">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Barberos</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="booking.php">Schedule Now!<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="view.php">View Bookings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-warning" href="about.php">Back To Barbers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-danger" href="logout.php">Sign Out</a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="d-flex justify-content-center my-4">
            <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Book Your Cut.</h1>
        </div>

        <div class="row mt-4">
            <form method="post" class="col-md-8 offset-md-2 col-lg-6 offset-lg-3" enctype="multipart/form-data">
                <h2 class="text-center mb-4">Booking Form</h2>

                <?php if ($error_message): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error_message; ?>
                    </div>
                <?php endif; ?>

                <div class="form-group">
                    <label for="inputName">Name</label>
                    <input type="text" name="name" class="form-control" id="inputName" placeholder="Enter Your Name" required>
                </div>

                <div class="form-group">
                    <label for="barberSelect">Barber</label>
                    <select name="barber" class="form-control" id="barberSelect" required>
                        <?php foreach ($barbers as $barber): ?>
                            <option value="<?php echo $barber['id']; ?>"><?php echo $barber['barbername']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="inputDate">Date</label>
                    <input type="date" name="date" class="form-control <?php echo $error_message ? 'is-invalid' : ''; ?>" id="inputDate" required>
                    <?php if ($error_message): ?>
                        <div class="invalid-feedback">
                            <?php echo $error_message; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="inputTime">Time</label>
                    <input type="time" name="time" class="form-control" id="inputTime" min="06:00" max="22:00" required>
                </div>

                <div class="form-group">
                    <label for="inputPhone">Phone</label>
                    <input type="number" name="phone" class="form-control" id="inputPhone" min="10" placeholder="Your Phone Number" required>
                </div>

                <div class="form-group">
                    <label for="deposit_slip">Gcash Deposit (100 Pesos Required: 09958679826)</label>
                    <input type="file" name="deposit_slip" accept="image/*" required>
                </div>

                <div class="form-group d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>
