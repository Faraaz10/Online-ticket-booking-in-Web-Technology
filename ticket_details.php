<?php
include 'db_connect.php';

session_start();

if (!isset($_SESSION['user'])) {
    header("Location: main.php");
    exit;
}

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: main.php");
    exit;
}

$username = $_SESSION['user']['username'];
$email = $_SESSION['user']['email'];
$phone = $_SESSION['user']['phone'];
$address = $_SESSION['user']['address'];

$ticketDetails = null;
$error = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $pnr = $_POST['pnr'];

    if (empty($name) || empty($pnr)) {
        $error = "Please enter both name and PNR.";
    } else {
        $query = "SELECT * FROM user_booked WHERE name = ? AND pnr = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 'ss', $name, $pnr);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) == 1) {
            $ticketDetails = mysqli_fetch_assoc($result);
        } else {
            $error = "No ticket found with the given name and PNR.";
        }

        mysqli_stmt_close($stmt);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Get Ticket Details</title>
    <link rel="stylesheet" href="abc.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
</head>
<body>
<header class="header1">
    <div class="div1">
        <a href="#" class="logo"><i class="fa-solid fa-earth-americas"></i>Faramad Voyage</a>
        <form action="" class="search">
            <input type="search" name="search" placeholder="Search here..." id="search-box">
            <label for="search-box" class="fas fa-search"></label>
        </form>
        <div class="icons">
            <div id="login" class="fas fa-user"></div>
        </div>
    </div>
    <div class="div2">
        <nav class="navbar">
            <a href="index.php">HOME</a>
            <a href="ticket_details.php">YOUR TICKETS</a>
            <a href="#">ABOUT</a>
            <a href="#">BLOG</a>
            <a href="#">REVIEW</a>
        </nav>
    </div>
</header>

<div class="form-container" id="user-details">
    <div id="close-btn" class="fas fa-times"></div>
    <center>
        <div class="one">
            <form>
                <h1>Welcome, <?php echo $_SESSION['user']['username']; ?>!</h1>
                <p>Email: <?php echo $_SESSION['user']['email']; ?></p>
                <p>Address: <?php echo $_SESSION['user']['address']; ?></p>
                <a href="?logout=true" class="logout-btn">Logout</a>
            </form>
        </div>
    </center>
    <div class="two">
        <img src="symbol.jpg" alt="logo" width="60%" height="60%">
    </div>
</div>

<div class="container">
    <form action="ticket_details.php" method="post">
        <input type="text" name="name" placeholder="Enter your name" required>
        <input type="text" name="pnr" placeholder="Enter your PNR" required>
        <button type="submit">Get Details</button>
    </form>
    <?php
    if ($error) {
        echo "<p class='error'>$error</p>";
    }
    if ($ticketDetails) {
        ?>
        <div class="ticket-details">
            <h2>Ticket Details</h2>
            <p>Name: <?php echo htmlspecialchars($ticketDetails['name']); ?></p>
            <p>Age: <?php echo htmlspecialchars($ticketDetails['age']); ?></p>
            <p>Email: <?php echo htmlspecialchars($ticketDetails['email']); ?></p>
            <p>Phone: <?php echo htmlspecialchars($ticketDetails['phone']); ?></p>
            <p>PNR: <?php echo htmlspecialchars($ticketDetails['pnr']); ?></p>
            <p>Starting Point: <?php echo htmlspecialchars($ticketDetails['depa']); ?></p>
            <p>Destination Point: <?php echo htmlspecialchars($ticketDetails['arrival']); ?></p>
            <p>Booked Seats: <?php echo htmlspecialchars($ticketDetails['seats']); ?></p>
            <p>Total Seats Booked: <?php echo htmlspecialchars($ticketDetails['total_seats']); ?></p>
            <p>Booking Date: <?php echo htmlspecialchars($ticketDetails['booking_date']); ?></p>
        </div>
        <?php
    }
    ?>
</div>

<section class="footer">
    <div class="box-container">
        <div class="box">
            <h3>Our Location</h3>
            <a href="#"><i class="fas fa-map-marker-alt"></i>India</a>
            <a href="#"><i class="fas fa-map-marker-alt"></i>Sri Lanka</a>
            <a href="#"><i class="fas fa-map-marker-alt"></i>Canada</a>
            <a href="#"><i class="fas fa-map-marker-alt"></i>Australia</a>
            <a href="#"><i class="fas fa-map-marker-alt"></i>USA</a>
            <a href="#"><i class="fas fa-map-marker-alt"></i>Saudi Arabia</a>
            <a href="#"><i class="fas fa-map-marker-alt"></i>UAE</a>
        </div>

        <div class="box">
            <h3>Quick links</h3>
            <a href="#"><i class="fas fa-arrow-right"></i>Home</a>
            <a href="#"><i class="fas fa-arrow-right"></i>Book</a>
            <a href="#"><i class="fas fa-arrow-right"></i>Agency</a>
            <a href="#"><i class="fas fa-arrow-right"></i>Offers</a>
            <a href="#"><i class="fas fa-arrow-right"></i>Reviews</a>
        </div>

        <div class="box">
            <h3>Contact Info</h3>
            <a href="#"><i class="fas fa-phone"></i>+91 7598123662</a>
            <a href="#"><i class="fas fa-phone"></i>+91 9080645312</a>
            <a href="#"><i class="fas fa-envelope"></i>faraazmohammed03@ptuniv.edu.in</a>
            <a href="#"><i class="fas fa-envelope"></i>cmadavamoorthi@ptuniv.edu.in</a>
            <img src="worldmap.jpg" class="map" alt="">
        </div>
    </div>

    <div class="share">
        <a href="#"><i class="fab fa-instagram"></i></a>
        <a href="#"><i class="fab fa-facebook-f"></i></a>
        <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
        <a href="#"><i class="fab fa-linkedin"></i></a>
    </div>

    <div class="credit">Created By Mr.Faraaz Mohammed And Mr.C.Madavamoorthi | all rights reserved!</div>
</section>

<!-- Moved JavaScript to the end of the body -->
<script src="ticket.js"></script>
</body>
</html>
