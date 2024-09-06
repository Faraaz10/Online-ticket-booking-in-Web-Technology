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
    <title>Faramad Voyage</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="mainstyle.css">
    <link rel="stylesheet" href="table.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
</head>
<body>
    <header class="header1">
        <div class="div1">
            <a href="index.php" class="logo"><i class="fa-solid fa-earth-americas"></i>Faramad Voyage</a>
           
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
                                        <input type="text" id="to" name="to" required class="form-control" placeholder="To">
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
                                    <th>BUS</th>
                                    <th>FROM</th>
                                    <th>TO</th>
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

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script>
        $(document).ready(function(){
            $("#searchForm").on("submit", function(e){
                e.preventDefault();

                $.ajax({
                    type: "POST",
                    url: "search.php",
                    data: {
                        from: $("#from").val(),
                        to: $("#to").val()
                    },
                    dataType: "json",
                    success: function(response) {
                        let results = '';
                        if(response.length > 0) {
                            response.forEach(function(row) {
                                results += `<tr>
                                    <td>${row.dat}</td>
                                    <td>${row.bus}</td>
                                    <td>${row.depa}</td>
                                    <td>${row.arrival}</td>
                                    <td>${row.availability}</td>
                                    <td>${row.price}</td>
                                    <td><button class="btn-primary"><a href="bus_seat_layout.php">BOOK</a></button></td>
                                </tr>`;
                            });
                        } else {
                            results = '<tr><td colspan="7">No Records Found</td></tr>';
                        }
                        $("#resultsTable").html(results);
                    },
                    error: function() {
                        alert("An error occurred while processing the request.");
                    }
                });
            });
        });
    </script>

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

        <div
