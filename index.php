

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
$address=$_SESSION['user']['address'];



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
            <a href="#index.php" class="logo"><i class="fa-solid fa-earth-americas"></i>Faramad Voyage</a>
            <form action="" class="search">
                <input type="search" name="search" placeholder="Search here..." id="search-box">
                <label for="search-box" class="fas fa-search"></label>
            </form>
         <div class="icons">
            <div id="search-btn" class="fas fa-search"></div> 
                      
            <div id="login" class="fas fa-user"></div>
         </div>
        </div>

        <div class="div2">
            <nav class="navbar">
                <a href="index.php">HOME</a>
                <a href="ticket_details.php">YOUT TICKET</a>
                
                <a href="client.php">HELP US</a>
                
            </nav>
    
        </div>

    </header>

    
    <div class="form-container" id="user-details">
    <div id="close-btn" class="fas fa-times"></div>
    <center>
        <div class="one">
            <form >
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
                <a href="train.php" class="btn">Book Now</a>
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



    <div class="loader-container">
        <img src="compass.jpg" alt="">
    </div>

 
















    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="index.js"></script>


    
</body>
</html>