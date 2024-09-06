<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: main.php");
    exit;
}

if (isset($_GET['logout'])) {
    session_destroy();
    setcookie("username", "", time() - 3600, "/");
    setcookie("password", "", time() - 3600, "/");
    header("Location: main.php");
    exit;
}

$username = $_SESSION['user']['username'];
$email = $_SESSION['user']['email'];
$phone = $_SESSION['user']['phone'];
$address = $_SESSION['user']['address'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Train Booking - Faramad Voyage</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="mainstyle.css">
    <link rel="stylesheet" href="trainstyle.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
</head>
<body>
    <header class="header1">
        <div class="div1">
            <a href="main.php" class="logo"><i class="fa-solid fa-earth-americas"></i>Faramad Voyage</a>
           
            <div class="icons">
                <div id="search-btn" class="fas fa-search"></div> 
                <div id="login" class="fas fa-user"></div>
            </div>
        </div>
        <div class="div2">
            <nav class="navbar">
                <a href="index.php">HOME</a>
                <a href="ticket_details.php">YOUR TICKET</a>
                
                <a href="client.php">HELP US</a>
            </nav>
        </div>
    </header>

    <div class="form-container" id="user-details">
        <div id="close-btn" class="fas fa-times"></div>
        <center>
            <div class="one">
                <h1>Welcome, <?php echo htmlspecialchars($username); ?>!</h1>
                <p>Email: <?php echo htmlspecialchars($email); ?></p>
                <p>Address: <?php echo htmlspecialchars($address); ?></p>
                <a href="?logout=true" class="logout-btn">Logout</a>
            </div>
        </center>
        <div class="two">
            <img src="symbol.jpg" alt="logo" width="60%" height="60%">
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-7">
                                <form id="searchForm">
                                    <div class="input-group mb-3">
                                        <input type="text" id="from" name="from" required class="form-control" placeholder="From">
                                        <input type="text" id="to" name="to" required class="form-control" placeholder="To"><br>
                                        <input type="date" id="date" name="date" required class="form-control">
                                        <button type="submit" class="btn-primary">Search</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card mt-4">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>DATE</th>
                                    <th>TRAIN</th>
                                    <th>FROM</th>
                                    <th>TO</th>
                                    <th>DEPARTURE TIME</th>
                                    <th>ARRIVAL TIME</th>
                                    <th>AVAILABILITY</th>
                                    <th>PRICE</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody id="resultsTable">
                                <!-- Results will be appended here by jQuery -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
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
                <a href="index.php"><i class="fas fa-arrow-right"></i>Home</a>
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

    <!--<div class="loader-container">
        <img src="compass.jpg" alt="">
    </div>-->

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script>
        $(document).ready(function(){
            $("#searchForm").on("submit", function(e){
                e.preventDefault();

                var from = $("#from").val();
                var to = $("#to").val();
                var date = $("#date").val();

                $.ajax({
                    type: "POST",
                    url: "search_train.php",
                    data: {from: from, to: to, date: date},
                    dataType: "json",
                    success: function(response){
                        var resultsTable = $("#resultsTable");
                        resultsTable.empty();

                        if (response.length > 0) {
                            $.each(response, function(index, train){
                                var row = "<tr>" +
                                    "<td>" + train.dat + "</td>" +
                                    "<td>" + train.train + "</td>" +
                                    "<td>" + train.depa + "</td>" +
                                    "<td>" + train.arrival + "</td>" +
                                    "<td>" + train.departure_time + "</td>" +
                                    "<td>" + train.arrival_time + "</td>" +
                                    "<td>" + train.availability + "</td>" +
                                    "<td>" + train.price + "</td>" +
                                    "<td><button class='btn1'><a href='train_pass.php'>BOOK</a></button></td>" +
                                    "</tr>";
                                resultsTable.append(row);
                            });
                        } else {
                            var row = "<tr><td colspan='9'>No Records Found</td></tr>";
                            resultsTable.append(row);
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>
