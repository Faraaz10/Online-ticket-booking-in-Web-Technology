<?php
session_start();


if (isset($_SESSION['depa']) && isset($_SESSION['arrival']) && isset($_SESSION['departure_time']) && isset($_SESSION['arrival_time'])) {
    $depa = $_SESSION['depa'];
    $arrival = $_SESSION['arrival'];
    $departure_time = $_SESSION['departure_time'];
    $arrival_time = $_SESSION['arrival_time'];
    $dat=$_SESSION['dat'];
} else {
    echo "No session variables are set.";
    exit();
}


if (!isset($_SESSION['booking_details'])) {
    $_SESSION['booking_details'] = array(
        'name' => '',
        'email' => '',
        'phone' => '',
        'num_passengers' => 0,
        'passenger_names' => array(),
        'passenger_ages' => array(),
        'berth_preferences' => array(),
        'seat_preferences' => array(),
        'food_preferences' => array()
    );
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $phone = filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT);
    $num_passengers = (int)$_POST['num_passengers'];

    
    $_SESSION['booking_details']['name'] = $name;
    $_SESSION['booking_details']['email'] = $email;
    $_SESSION['booking_details']['phone'] = $phone;
    $_SESSION['booking_details']['num_passengers'] = $num_passengers;

   
    $passenger_names = $_POST['passenger_name'];
    $passenger_ages = $_POST['passenger_age'];
    $berth_preferences = $_POST['berth_preference'];
    $seat_preferences = $_POST['seat_preference'];
    $food_preferences = $_POST['food_preference'];

    
    for ($i = 0; $i < $num_passengers; $i++) {
        $_SESSION['booking_details']['passenger_names'][] = filter_var($passenger_names[$i], FILTER_SANITIZE_STRING);
        $_SESSION['booking_details']['passenger_ages'][] = (int)$passenger_ages[$i];
        $_SESSION['booking_details']['berth_preferences'][] = filter_var($berth_preferences[$i], FILTER_SANITIZE_STRING);
        $_SESSION['booking_details']['seat_preferences'][] = filter_var($seat_preferences[$i], FILTER_SANITIZE_STRING);
        $_SESSION['booking_details']['food_preferences'][] = filter_var($food_preferences[$i], FILTER_SANITIZE_STRING);
    }

   
    header('Location: confirmation.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Passenger Detail Entry</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Alegreya:ital,wght@0,400..900;1,400..900&display=swap');

:root {
    --green: rgb(156, 175, 136);
    --dark-color: rgb(249, 248, 235);
    --black: #444;
    --light-color: #666;
    --border: .1rem solid rgba(0,0,0,.1);
    --border-hover: .1rem solid var(--black);
    --box-shadow: 0 .5rem 1rem rgba(0,0,0,.1);
    --outline: #666;
}

* {
    font-family: 'Alegreya', serif;
    margin: 0;
    padding: 0;
    outline: none;
    border: none;
    box-sizing: border-box;
    text-decoration: none;
    text-transform: capitalize;
    transition: all 0.3s linear;
}

html {
    font-size: 100%;
    overflow-x: hidden; 
    scroll-padding-top: 5rem;
    scroll-behavior: smooth;
}

body {
    background-color: #f9f9f9;
}

.booking-form {
    max-width: 800px;
    margin: 50px auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: var(--box-shadow);
}

.booking-form h2 {
    margin-bottom: 20px;
    font-size: 2rem;
    color: var(--black);
    text-align: center;
}

.booking-form form {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.booking-form label {
    font-weight: bold;
    margin-top: 10px;
    display: block;
    text-align: left;
    font-size: 1.5rem;
}

.booking-form input[type="text"],
.booking-form input[type="email"],
.booking-form input[type="tel"],
.booking-form input[type="number"],
.booking-form select,
.booking-form textarea {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
    font-size: 1.2rem;
    background-color: var(--dark-color);
    box-shadow: var(--box-shadow);
}

.booking-form textarea {
    height: 100px;
    resize: vertical;
}

.booking-form button {
    margin-top: 20px;
    padding: 15px 30px;
    background-color: var(--green);
    color: var(--dark-color);
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    font-size: 1.5rem;
    box-shadow: var(--box-shadow);
}

.booking-form button:hover {
    background-color: var(--black);
    color: var(--green);
}

.passenger-details {
    border-top: 1px solid #ccc;
    margin-top: 20px;
    padding-top: 20px;
    width: 100%;
}

.passenger-details:not(:first-of-type) {
    margin-top: 20px;
}

.form-group {
    margin-bottom: 10px;
}

.passenger-details h3 {
    font-size: 1.5rem;
    color: var(--green);
    margin-bottom: 10px;
    text-align: center;
}

.form-group select,
.form-group input {
    width: calc(100% - 22px);
    padding: 10px;
    margin-left: 10px;
}

.train-details {
    margin-top: 20px;
    padding-top: 20px;
    border-top: 1px solid #ccc;
    text-align: center;
}

.train-details h3 {
    font-size: 2rem;
    color: var(--green);
}

.train-details p {
    font-size: 1.2rem;
    color: var(--black);
    margin: 5px 0;
}
    </style>
</head>
<body>

<div class="booking-form">
    <h2>Passenger Details</h2>
    <form id="passengerForm" action="confirmation.php" method="POST">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" placeholder="Enter your name" required>
        </div>
        
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>
        </div>
        
        <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" pattern="[0-9]{10}" title="Phone number should be 10 digits" required>
        </div>

        <div class="form-group">
            <label for="numPassengers">Number of Passengers:</label>
            <input type="number" id="numPassengers" name="num_passengers" min="1" max="10" required>
        </div>

        <div id="passengerDetailsContainer"></div>
        
        <div class="train-details">
            <h3>Train Details</h3>
            <p><strong>From:</strong> <?= htmlspecialchars($depa); ?></p>
            <p><strong>To:</strong> <?= htmlspecialchars($arrival); ?></p>
            <p><strong>Date:</strong> <?= htmlspecialchars($dat); ?></p>
            <p><strong>Departure Time:</strong> <?= htmlspecialchars($departure_time); ?></p>
            <p><strong>Arrival Time:</strong> <?= htmlspecialchars($arrival_time); ?></p>
        </div>

        <button type="submit">Confirm Booking</button>
    </form>
</div>

<script>
    document.getElementById('numPassengers').addEventListener('input', function() {
        const numPassengers = parseInt(this.value);
        const container = document.getElementById('passengerDetailsContainer');
        container.innerHTML = '';

        for (let i = 1; i <= numPassengers; i++) {
            const passengerDetails = document.createElement('div');
            passengerDetails.className = 'passenger-details';
            passengerDetails.innerHTML = `
                <h3>Passenger ${i}</h3>
                
                <div class="form-group">
                    <label for="passengerName${i}">Name:</label>
                    <input type="text" id="passengerName${i}" name="passenger_name[]" placeholder="Enter passenger name" required>
                </div>

                <div class="form-group">
                    <label for="passengerAge${i}">Age:</label>
                    <input type="number" id="passengerAge${i}" name="passenger_age[]" min="18" placeholder="Enter passenger age" required>
                </div>

                <div class="form-group">
                    <label for="berthPreference${i}">Berth Preference:</label>
                    <select id="berthPreference${i}" name="berth_preference[]" required>
                        <option value="lower">Lower</option>
                        <option value="middle">Middle</option>
                        <option value="upper">Upper</option>
                        <option value="side_lower">Side Lower</option>
                        <option value="side_upper">Side Upper</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="seatPreference${i}">Seat Preference:</label>
                    <select id="seatPreference${i}" name="seat_preference[]" required>
                        <option value="window">Window</option>
                        <option value="middle">Middle</option>
                        <option value="aisle">Aisle</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="foodPreference${i}">Food Preference:</label>
                    <select id="foodPreference${i}" name="food_preference[]" required>
                        <option value="veg">Veg</option>
                        <option value="non-veg">Non-Veg</option>
                    </select>
                </div>
            `;
            container.appendChild(passengerDetails);
        }
    });
</script>

</body>
</html>
