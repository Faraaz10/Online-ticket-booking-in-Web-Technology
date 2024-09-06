<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $numPassengers = $_POST['num_passengers'];

    $passengerDetails = [];

    for ($i = 0; $i < $numPassengers; $i++) {
        $passengerDetails[] = [
            'name' => $_POST['passenger_name'][$i],
            'age' => $_POST['passenger_age'][$i],
            'berth_preference' => $_POST['berth_preference'][$i],
            'seat_preference' => $_POST['seat_preference'][$i],
            'food_preference' => $_POST['food_preference'][$i]
        ];
    }

   
    $bookingID = uniqid();
    echo "<h1>Booking Successful</h1>";
    echo "<p>Thank you, <strong>$name</strong>! Your booking has been confirmed.</p>";
    echo "<p>A confirmation email has been sent to <strong>$email</strong>.</p>";
    echo "<p>Booking ID: <strong>$bookingID</strong></p>";
    echo "<p>Booking Details:</p>";
    echo "<ul>";
    echo "<li>Name: $name</li>";
    echo "<li>Email: $email</li>";
    echo "<li>Phone: $phone</li>";
    echo "<li>Number of Passengers: $numPassengers</li>";
    echo "</ul>";
    echo "<h2>Passenger Details:</h2>";
    echo "<ul>";
    foreach ($passengerDetails as $index => $passenger) {
        echo "<li><strong>Passenger " . ($index + 1) . ":</strong></li>";
        echo "<ul>";
        echo "<li>Name: " . htmlspecialchars($passenger['name']) . "</li>";
        echo "<li>Age: " . htmlspecialchars($passenger['age']) . "</li>";
        echo "<li>Berth Preference: " . htmlspecialchars($passenger['berth_preference']) . "</li>";
        echo "<li>Seat Preference: " . htmlspecialchars($passenger['seat_preference']) . "</li>";
        echo "<li>Food Preference: " . htmlspecialchars($passenger['food_preference']) . "</li>";
        echo "</ul>";
    }
    echo "</ul>";
}
?>
