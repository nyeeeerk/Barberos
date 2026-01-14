<?php
// Start the session
session_start();

// Check if the user is not logged in
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    // Redirect them to the login page
    header("location: login.php");
    exit;
}

?>
<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
   <title> deets </title>
    <link rel="stylesheet" href="style2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>

    </div>
    
 <div class="container">
 <div class="back">
 <?php

?>
<?php
      include "config.php";
$arnold = $_GET['artistId'];
$sql = "Select * from image1 where id = $arnold";
$result = mysqli_query($link, $sql);
					if (mysqli_num_rows($result) > 0) {
						// output data of each row
						while($row = mysqli_fetch_assoc($result)) {
?>
   <input type="checkbox" id="switch">
  <div class="outer">
 
    <div class="content">
      <label for="switch">
        <span class="toggle">
          <span class="circle"></span>
        </span>
      </label>
      <div class="image-box">
       <img src="crud/uploads/<?php echo $row["image"]?>" alt="">
      </div>
      <div class="details">
      
        <div class="name"><?php echo $row["barbername"]?></div>
        <div class="job"><?php echo $row["title"]?></div>
        <div class="buttons">
          <p><?php echo $row["workdesc"]?></p>
          <p>Trophies won in an event:</p>
          <p><b><?php echo $row["awards"]?></b></p>
          
          <a href="booking.php"><button>Book me</button></a>
          <a href="about.php">
         <button>Back</button>
    </a>
        </div>
      </div>
      <div class="media-icons">
        <i class="fab fa-facebook-f"></i>
        <i class="fab fa-twitter"></i>
        <i class="fab fa-instagram"></i>
      </div>
    </div>
  </div>
 </div>
 <?php } }?>
</body>
</html>