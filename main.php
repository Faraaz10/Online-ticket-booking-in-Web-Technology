<?php
session_start();
include 'db_connect.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        $hashed_password = $user['password'];

        if (password_verify($password, $hashed_password)) {
            $_SESSION['user'] = array(
                'username' => $user['username'],
                'email' => $user['email'],
                'phone' => $user['phone'],
                'address' => $user['address']
            );

            // Set cookies for username and hashed password (for simplicity)
            setcookie("username", $user['username'], time() + (86400 * 30), "/"); // 86400 = 1 day
            setcookie("password", $user['password'], time() + (86400 * 30), "/");

            header("Location: index.php");
            exit;
        } else {
            $error = "Invalid username or password";
        }
    } else {
        $error = "Invalid username or password";
    }
}


if (!isset($_SESSION['user']) && isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
    $query = "SELECT * FROM users WHERE username = '" . $_COOKIE['username'] . "'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);

        // Verify the hashed password stored in the cookie
        if ($user['password'] === $_COOKIE['password']) {
            $_SESSION['user'] = array(
                'username' => $user['username'],
                'email' => $user['email'],
                'phone' => $user['phone'],
                'address' => $user['address']
            );

            header("Location: index.php");
            exit;
        }
    }
}

if (isset($_GET['logout'])) {
    session_destroy();
    setcookie("username", "", time() - 3600, "/");
    setcookie("password", "", time() - 3600, "/");
    header("Location: main.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="mainstyle.css">
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
            <a href="main.php">HOME</a>
            <a href="ticket_details.php">YOUR TICKETS</a>
            
            <a href="client.php">HELP US</a>
            
        </nav>
    </div>
</header>

<div class="form-container" id="login-form">
    <div id="close-btn" class="fas fa-times"></div>
    <center>
        <div class="one">
            <form method="POST">
                <h1>SIGN IN</h1>
                <label>Username:</label><input type="text" name="username" placeholder="Enter Username" required><br><br>
                <label>Password:</label><input type="password" name="password" placeholder="Enter Password" required><br>
                <button type="submit"><span>Submit</span></button>
                <hr>
                <p>Didn't have an account?<a href="Signup.php">Signup</a></p>
                <?php if (isset($error)) { echo "<p style='color: red;'>$error</p>"; } ?>
            </form>
        </div>
    </center>
    <div class="two">
        <img src="symbol.jpg" alt="logo" width="60%" height="60%">
    </div>
</div>


<div class="form-container" id="login-form">
    <div id="close-btn" class="fas fa-times"></div>
    <center>
        <div class="one">
            <form method="POST" action="index.php">
                <h1>SIGN IN</h1>
                <label>Username:</label><input type="text" name="username" placeholder="Enter Username"><br><br>  
                <label>Password:</label><input type="password" name="password" placeholder="Enter Password"><br>
                <button type="submit"><span>Submit</span></button>
                <hr>
                <p>Didn't have an account?<a href="Signup.php">Signup</a></p>
                <?php if (isset($error)) { echo "<p style='color: red;'>$error</p>"; } ?>
            </form>
        </div>
    </center>
    <div class="two">
        <img src="symbol.jpg" alt="logo" width="60%" height="60%">
    </div>
</div>
   

    <section class="top" id="top">
        <div class="row">
        <div class="content">
            <h3>Welcome To Faramad Voyage</h3>
            <p>Faramad Voyage is a comprehensive booking platform for bus, train, car, and airplane journeys. It offers a user-friendly interface for searching, comparing, and booking transportation options tailored to travelers' needs.
                 Whether for business trips, family vacations, or adventures, Faramad Voyage provides detailed schedules, pricing, and availability to ensure a seamless booking experience. With a focus on convenience and reliability,
                 Faramad Voyage makes travel planning efficient and hassle-free, allowing travelers to embark on their journeys with ease.</p>

        </div>
        <div class="swiper slider">
            <div class="swiper-wrapper"> 
            <a href="#" class="swiper-slide"><img src="pic1.jpg" alt="pic"></a>
            <a href="#" class="swiper-slide"><img src="pic2.jpg" alt="pic"></a>
            <a href="#" class="swiper-slide"><img src="pic3.jpg" alt="pic"></a>
            <a href="#" class="swiper-slide"><img src="pic4.jpg" alt="pic"></a>
            <a href="#" class="swiper-slide"><img src="pic5.jpg" alt="pic"></a>
            <a href="#" class="swiper-slide"><img src="pic6.jpg" alt="pic"></a>
            </div>
            
        </div>
        </div>
    </section>




    <section class="icon-container">
        <div class="icons">
            <i class="fas fa-lock"></i>
            <div class="content">
                <h3>Secure</h3>
                <p>100% Secure Payment</p>
            </div>
        </div>

        <div class="icons">
            <i class="fas fa-redo-alt"></i>
            <div class="content">
                <h3>Easy Refund</h3>
                <p>Before 24hr easy refund</p>
            </div>
        </div>
        
        <div class="icons">
            <i class="fas fa-headset"></i>
            <div class="content">
                <h3>24/7 Support</h3>
                <p>Call us anytime</p>
            </div>
        </div>

        <div class="icons">
            <i class="fa-solid fa-heart"></i>
            <div class="content">
                <h3>Liked</h3>
                <p>Liked by many people.</p>
            </div>
        </div>
    </section>



    
    <section class="features" id="features">
        <div class="box-container">
            <div class="box">
                <i class="fa-solid fa-bus"></i>
                <h3>Bus</h3>
                <a href="Bus.php" class="btn">Book Now</a>
            </div>
            <div class="box">
                <i class="fa-solid fa-train"></i>
                <h3>Train</h3>
                <a href="#" class="btn">Book Now</a>
            </div>
           

        </div>       
  
    </section>


    





    <section class="featured" id="featured">
        
        <h1 class="heading">Our Agency</h1>

        <div class="swiper featured-slider">

            <div class="swiper-wrapper">

                <div class="swiper-slide  box">
                    <div class="image">
                        <img src="agency.jpg" alt="pic">
                    </div>
                    <div class="content">
                        <h3>agency1</h3>
                    </div>
                </div>

                <div class="swiper-slide  box">
                    <div class="image">
                        <img src="agency.jpg" alt="pic">
                    </div>
                    <div class="content">
                        <h3>agency2</h3>
                    </div>
                </div>

                <div class="swiper-slide  box">
                    <div class="image">
                        <img src="agency.jpg" alt="pic">
                    </div>
                    <div class="content">
                        <h3>agency3</h3>
                    </div>
                </div>

                <div class="swiper-slide  box">
                    <div class="image">
                        <img src="agency.jpg" alt="pic">
                    </div>
                    <div class="content">
                        <h3>agency4</h3>
                    </div>
                </div>

                <div class="swiper-slide  box">
                    <div class="image">
                        <img src="agency.jpg" alt="pic">
                    </div>
                    <div class="content">
                        <h3>agency5</h3>
                    </div>
                </div>

                <div class="swiper-slide  box">
                    <div class="image">
                        <img src="agency.jpg" alt="pic">
                    </div>
                    <div class="content">
                        <h3>agency6</h3>
                    </div>
                </div>
                 
            </div>

            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </section>


    


    <section class="newsletter">

        <form action="">
            <h3>Subscribe For Latest Updates</h3>
            <input type="email" name="" placeholder="Enter your email" id="" class="box"/>
            <a href="#" class="btn">Submit</a>
        </form>        

    </section>





    <section class="arrivals" id="arrivals">

        <h1 class="heading">Offers</h1>

        <div class="swiper arrivals-slider">

            <div class="swiper-wrapper">

                <a href="#" class="swiper-slide box">
                    <div class="image">
                        <img src="coupons.jpg" alt="pic">
                    </div>
                    <div class="content">
                        <h3>Discount</h3>
                        <div class="price">50% off</div>
                    </div>
                </a>

                <a href="#" class="swiper-slide box">
                    <div class="image">
                        <img src="coupons.jpg" alt="pic">
                    </div>
                    <div class="content">
                        <h3>Discount</h3>
                        <div class="price">50% off</div>
                    </div>
                </a>

                <a href="#" class="swiper-slide box">
                    <div class="image">
                        <img src="coupons.jpg" alt="pic">
                    </div>
                    <div class="content">
                        <h3>Discount</h3>
                        <div class="price">50% off</div>
                    </div>
                </a>

                <a href="#" class="swiper-slide box">
                    <div class="image">
                        <img src="coupons.jpg" alt="pic">
                    </div>
                    <div class="content">
                        <h3>Discount</h3>
                        <div class="price">50% off</div>
                    </div>
                </a>

                <a href="#" class="swiper-slide box">
                    <div class="image">
                        <img src="coupons.jpg" alt="pic">
                    </div>
                    <div class="content">
                        <h3>Discount</h3>
                        <div class="price">50% off</div>
                    </div>
                </a>

            </div>

        </div>


        <div class="swiper arrivals-slider">

            <div class="swiper-wrapper">

                <a href="#" class="swiper-slide box">
                    <div class="image">
                        <img src="coupons.jpg" alt="pic">
                    </div>
                    <div class="content">
                        <h3>Discount</h3>
                        <div class="price">50% off</div>
                    </div>
                </a>

                <a href="#" class="swiper-slide box">
                    <div class="image">
                        <img src="coupons.jpg" alt="pic">
                    </div>
                    <div class="content">
                        <h3>Discount</h3>
                        <div class="price">50% off</div>
                    </div>
                </a>

                <a href="#" class="swiper-slide box">
                    <div class="image">
                        <img src="coupons.jpg" alt="pic">
                    </div>
                    <div class="content">
                        <h3>Discount</h3>
                        <div class="price">50% off</div>
                    </div>
                </a>

                <a href="#" class="swiper-slide box">
                    <div class="image">
                        <img src="coupons.jpg" alt="pic">
                    </div>
                    <div class="content">
                        <h3>Discount</h3>
                        <div class="price">50% off</div>
                    </div>
                </a>

                <a href="#" class="swiper-slide box">
                    <div class="image">
                        <img src="coupons.jpg" alt="pic">
                    </div>
                    <div class="content">
                        <h3>Discount</h3>
                        <div class="price">50% off</div>
                    </div>
                </a>

            </div>

        </div>
    </section>





    <section class="reviews" id="reviews">

        <h1 class="heading">Customer's Reviews</h1>

        <div class="swiper reviews-slider">

            <div class="swiper-wrapper">

                <div class="swiper-slide box">
                    <img src="p1.jpg" alt="">
                    <h3>Gojo</h3>
                    <p>Booking tickets online for bus, train, car, or airplane travel is convenient and efficient. Users can compare prices, secure payments, and receive instant confirmations, all from the comfort of their homes.</p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>

                </div>

                <div class="swiper-slide box">
                    <img src="p2.jpg" alt="">
                    <h3>Gojo</h3>
                    <p>Booking tickets online for bus, train, car, or airplane travel is convenient and efficient. Users can compare prices, secure payments, and receive instant confirmations, all from the comfort of their homes.</p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>

                </div>

                <div class="swiper-slide box">
                    <img src="p3.jpg" alt="">
                    <h3>Gojo</h3>
                    <p>Booking tickets online for bus, train, car, or airplane travel is convenient and efficient. Users can compare prices, secure payments, and receive instant confirmations, all from the comfort of their homes.</p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>

                </div>

                <div class="swiper-slide box">
                    <img src="p4.jpg" alt="">
                    <h3>Gojo</h3>
                    <p>Booking tickets online for bus, train, car, or airplane travel is convenient and efficient. Users can compare prices, secure payments, and receive instant confirmations, all from the comfort of their homes.</p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>

                </div>

                <div class="swiper-slide box">
                    <img src="p5.jpg" alt="">
                    <h3>Gojo</h3>
                    <p>Booking tickets online for bus, train, car, or airplane travel is convenient and efficient. Users can compare prices, secure payments, and receive instant confirmations, all from the comfort of their homes.</p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>

                </div>

                <div class="swiper-slide box">
                    <img src="p5.jpg" alt="">
                    <h3>Gojo</h3>
                    <p>Booking tickets online for bus, train, car, or airplane travel is convenient and efficient. Users can compare prices, secure payments, and receive instant confirmations, all from the comfort of their homes.</p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>

                </div>

                <div class="swiper-slide box">
                    <img src="p5.jpg" alt="">
                    <h3>Gojo</h3>
                    <p>Booking tickets online for bus, train, car, or airplane travel is convenient and efficient. Users can compare prices, secure payments, and receive instant confirmations, all from the comfort of their homes.</p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>

                </div>


            </div>

        </div>
    </section>





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
                <a href="main.php"><i class="fas fa-arrow-right"></i>Home</a>
                <a href="ticket_details.php"><i class="fas fa-arrow-right"></i>Your Ticket</a>
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



    <div class="loader-container">
        <img src="compass.jpg" alt="">
    </div>

 
















    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="mainjs.js"></script>


    

    
</body>
</html>