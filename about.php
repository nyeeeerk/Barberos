<?php
// Start the session
session_start();

// Check if the user is not logged in
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    // Redirect them to the login page
    header("location: login.php");
    exit;
}
$is_admin = isset($_SESSION["status"]) && $_SESSION["status"] === "admin";
?>
<!-- The rest of your HTML and PHP code for the respective pages goes here -->




<!DOCTYPE html>
<html lang="en-US">

<head>
	<meta charset="UTF-8">
	<title>Barberos</title>
	<meta name="robots" content="index, follow" />
	<meta name="description" content="Best Barbers In town" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="canonical" href="Replace_with_your_PAGE_URL" />

	<!-- Stylesheets -->
	<link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">

	<!-- Open Graph (OG) meta tags are snippets of code that control how URLs are displayed when shared on social media  -->
	<!-- <meta property="og:locale" content="en_US" />
	<meta property="og:type" content="website" />
	<meta property="og:title" content="Barbero - HTML Bootstrap Template" />
	<meta property="og:url" content="PAGE_URL" />
	<meta property="og:site_name" content="SITE_NAME" /> -->
	<!-- For the og:image content, replace the # with a link of an image -->
	<!-- <meta property="og:image" content="#" />
	<meta property="og:description" content="Barbero HTML Bootstrap Template" /> -->

	<!-- Fonts -->
	<link
		href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Karla:wght@400;700&family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
		rel="stylesheet">

	<!-- Add site Favicon -->
	<link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
	<link rel="icon" href="images/favicon.png" type="image/x-icon">
	<meta name="msapplication-TileImage" content="images/favicon.png" />
</head>

<body>

	<div class="page-wrapper">

		<!-- Main Header-->
		<header class="main-header">
		
			<!--Header-Upper-->
			<div class="header-upper">
				<div class="auto-container">
					<div class="clearfix">
						
						<div class="pull-left logo-box">
							<div class="logo"><a href="index.php"><img src="images/logo.png" alt="" title=""></a></div>
						</div>
						
						<div class="nav-outer clearfix">
							<!-- Mobile Navigation Toggler -->
							<div class="mobile-nav-toggler"><span class="icon flaticon-menu"></span></div>
							<!-- Main Menu -->
							<nav class="main-menu navbar-expand-md">
								<div class="navbar-header">
									<button class="navbar-toggler" type="button" data-toggle="collapse"
										data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
										aria-label="Toggle navigation">
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
									</button>
								</div>
								<div class="navbar-collapse show collapse clearfix" id="navbarSupportedContent">
									<ul class="navigation left-nav clearfix">
										

									
										<ul class="navigation right-nav clearfix">
											<li><a href="logout.php">Log Out</a></li>
											
										</ul>
									</ul>

								</div>

						

							</nav>

							<!-- Social Box -->
							<ul class="social-box">
								<li><a href="https://twitter.com/"><span class="icofont-twitter"></span></a></li>
								
								<li><a href="https://www.instagram.com/"><span class="icofont-instagram"></span></a></li>
							</ul>

								
			<!--End Header Upper-->

			<!-- Mobile Menu  -->
			<div class="mobile-menu">
				<div class="menu-backdrop"></div>
				<div class="close-btn"><span class="icon lnr lnr-cross"></span></div>

				<nav class="menu-box">
					<div class="nav-logo"><a href="index.html"><img src="images/logo-2.png" alt="" title=""></a></div>
					<div class="menu-outer">
						<!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
					</div>
				</nav>
			</div><!-- End Mobile Menu -->

		</header>
		<!--End Main Header -->

		<!-- Page Banner Section -->
		<section class="page-banner-section" style="background-image: url(images/background/3.jpg)">
			<div class="auto-container">
				<div class="title">Since 2023</div>
				<h1>About</h1>
				<h2>BARBEROS</h2>
			</div>
		</section>
		<!-- End Page Banner Section -->

		<!-- Reserve Section -->
		<section class="reserve-section">
			<div class="auto-container">
				<div class="inner-container">
					<div class="row clearfix">

						<!-- Logo Column -->
						<div class="logo-column col-lg-5 col-md-12 col-sm-12">
							<div class="inner-column">
								<div class="image">
									<img src="images/resource/reserve.png" alt="" />
								</div>
							</div>
						</div>

						<!-- Content Column -->
						<div class="content-column col-lg-7 col-md-12 col-sm-12">
							<div class="inner-column">
								<h2>Haircut & Shaving <br> Barbershop</h2>
								<p>Let your hair do the talking.<br>
									Fast fades in no time.</p>
								<div class="reserve">Book Now</div>
								<a href="welcome.php" class="phone">Pick Your Poison</a>
							</div>
						</div>

					</div>
				</div>
			</div>
		</section>
		<!-- End Reserve Section -->

		
		<!-- Team Section -->
		<section class="team-section">
			<div class="auto-container">
				<div class="section-title centered light">
					<h2>Our Barbers</h2>
				</div>
				<div class="row clearfix">

					<!-- Team Block -->
					<?php
    include "config.php";
    $sql = "SELECT * FROM image1";
    $result = mysqli_query($link, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
    ?>

    <div class="team-block col-lg-4 col-md-6 col-sm-12">
        <div class="inner-box wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
            <div class="image">
                <a href="barberdets.php?artistId=<?php echo $row["id"]?>" id="a" ><img src="crud/uploads/<?php echo $row["image"]?>" alt="" /></a>
                <ul class="social-icons">
                    <li><a href="https://twitter.com/" class="icofont-twitter"></a></li>
                    <li><a href="https://m.facebook.com/lander.agustin/" class="icofont-facebook"></a></li>
                    <?php
                   
                    if ($is_admin) {
                        echo '<a href="image.php">ADD</a>';
						  echo '<a href="edit.php?id=' . $row["id"] . '">  EDIT</a>';
						
                    }
					
                    ?>
                </ul>
            </div>
            <div class="lower-content">
                <h4><a href="booking.php"><?php echo $row["barbername"]?></a></h4>
                <div class="designation"><?php echo $row["title"]?></div>
            </div>
        </div>
    </div>

    <?php
        }
    } else {
        echo "0 results";
    }
    ?>
					<!-- Team Block -->
				
		</section>
		<!-- End Team Section -->

		<!-- Main Footer -->
		<footer class="main-footer style-two" style="background-image: url(images/background/2.jpg)">
			<div class="auto-container">
				<!--Widgets Section-->
				<div class="widgets-section">
					<div class="row clearfix">

						<!-- Footer Column -->
						<div class="footer-column col-lg-4 col-md-6 col-sm-12">
							<div class="footer-widget office-widget">
								<h4>office</h4>
								<ul class="location-list">
									<li>Sample address<br> SAMPLE STATE</li>
									<li><a href="marty@gmail.com">barberos@gmail.com</a></li>
									<li><a href="tel:+0085-346-2188">0000000000000</a></li>
								</ul>
								<!-- Social Box -->
								<ul class="social-box">
									
									<li class="facebook"><a href="https://www.facebook.com/alfonso1brandyph/" class="icofont-facebook"></a></li>
									
									<li class="instagram"><a href="https://www.instagram.com/onlyfans/?hl=en" class="icofont-instagram"></a></li>
								</ul>
							</div>
						</div>

						<!-- Footer Column -->
						<div class="footer-column col-lg-4 col-md-12 col-sm-12">
							<div class="footer-widget logo-widget">
								<div class="logo">
									<a href="index.html"><img src="images/footer-logo.png" alt="" /></a>
								</div>
							</div>
						</div>

						<!-- Footer Column -->
						<div class="footer-column col-lg-4 col-md-6 col-sm-12">
							<div class="footer-widget twitter-widget">
								<h4>BARBEROS</h4>
								
	<!--End pagewrapper-->

	<!-- Search Popup -->
	<div class="search-popup">
		<button class="close-search style-two"><span class="icofont-brand-nexus"></span></button>
		<button class="close-search"><span class="icofont-arrow-up"></span></button>
		<form method="post" action="blog.html">
			<div class="form-group">
				<input type="search" name="search-field" value="" placeholder="Search Here" required="">
				<button type="submit"><i class="fa fa-search"></i></button>
			</div>
		</form>
	</div>
	<!-- End Header Search -->

	<!-- Scroll To Top -->
	<div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-arrow-circle-up"></span></div>

	<script src="js/jquery.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
	<script src="js/jquery.fancybox.js"></script>
	<script src="js/appear.js"></script>
	<script src="js/owl.js"></script>
	<script src="js/wow.js"></script>
	<script src="js/isotope.js"></script>
	<script src="js/jquery-ui.js"></script>
	<script src="js/script.js"></script>

</body>

</html>