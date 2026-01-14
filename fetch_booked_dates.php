<?php
require_once('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $barber_id = $_POST['barber_id'];

    // Fetch booked dates based on the selected barber
    $query = "SELECT date FROM booking WHERE barber_id = $barber_id";
    $result = mysqli_query($link, $query);

    if ($result) {
        $bookedDates = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $bookedDates[] = $row['date'];
        }

        echo json_encode($bookedDates);
    } else {
        echo json_encode([]);
    }
} else {
    echo "Invalid request";
}

mysqli_close($link);
?>
