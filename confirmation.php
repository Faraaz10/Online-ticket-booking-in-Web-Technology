<?php
session_start();
include 'db_connect.php';
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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

    $booking_details = $_POST;

    $pnr = 'PNR' . strtoupper(uniqid());

    
    $stmt = $conn->prepare("SELECT price FROM train_schedule WHERE depa = ? AND arrival= ? AND departure_time = ? AND arrival_time = ?");
    $stmt->bind_param("ssss", $depa, $arrival, $departure_time, $arrival_time);
    $stmt->execute();
    $stmt->bind_result($price);
    $stmt->fetch();
    $stmt->close();

    if (!$price) {
        die('Price not found for the selected train.');
    }

    
    $num_passengers = count($booking_details['passenger_name']);
    $total_amount = $num_passengers * $price;

    $dateTime = new DateTime($dat);
    $formattedDate = $dateTime->format('Y-m-d'); // Format the date

    $totalSeatsBooked = count($booking_details['passenger_name']);

    $stmt = $conn->prepare("INSERT INTO bookings (pnr_code, train_from, train_to, departure_time, arrival_time, total_amount, dat) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $pnr, $depa, $arrival, $departure_time, $arrival_time, $total_amount, $formattedDate);
    $stmt->execute();
    $booking_id = $stmt->insert_id;
    $stmt->close();

   
    $updateAvailabilityQuery = "UPDATE train_schedule SET availability = availability - ? WHERE depa = ? AND arrival = ? AND dat = ?";
    $stmt = $conn->prepare($updateAvailabilityQuery);
    $stmt->bind_param('isss', $totalSeatsBooked, $depa, $arrival, $formattedDate);
    $stmt->execute();
    $stmt->close();

    
    $stmt = $conn->prepare("INSERT INTO passengers (booking_id, name, age, berth_preference, seat_preference, food_preference) VALUES (?, ?, ?, ?, ?, ?)");
    for ($i = 0; $i < count($booking_details['passenger_name']); $i++) {
        $stmt->bind_param("isssss", $booking_id, $booking_details['passenger_name'][$i], $booking_details['passenger_age'][$i], $booking_details['berth_preference'][$i], $booking_details['seat_preference'][$i], $booking_details['food_preference'][$i]);
        $stmt->execute();
    }
    $stmt->close();
}


$stmt = $conn->prepare("SELECT * FROM bookings WHERE id = ?");
$stmt->bind_param("i", $booking_id);
$stmt->execute();
$result = $stmt->get_result();
$booking = $result->fetch_assoc();


$stmt = $conn->prepare("SELECT * FROM passengers WHERE booking_id = ?");
$stmt->bind_param("i", $booking_id);
$stmt->execute();
$passengers_result = $stmt->get_result();
$passengers = $passengers_result->fetch_all(MYSQLI_ASSOC);

$stmt->close();
$conn->close();

$mail = new PHPMailer(true);

try {
  
    $mail->SMTPDebug = 0; 
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com'; 
    $mail->SMTPAuth = true;
    $mail->Username = 'your email'; 
    $mail->Password = 'your password'; 
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );

   
    $mail->setFrom('your email', 'Faramad');
    $mail->addAddress($booking_details['email']); // Add a recipient

    
    $mail->isHTML(true);
    $mail->Subject = 'Booking Confirmation';
    $mail->Body    = '<h1>Booking Confirmation</h1>'
                    . '<p><strong>PNR Code:</strong> ' . htmlspecialchars($booking['pnr_code']) . '</p>'
                    . '<p><strong>From:</strong> ' . htmlspecialchars($depa) . '</p>'
                    . '<p><strong>To:</strong> ' . htmlspecialchars($arrival) . '</p>'
                    . '<p><strong>Departure Time:</strong> ' . htmlspecialchars($departure_time) . '</p>'
                    . '<p><strong>Arrival Time:</strong> ' . htmlspecialchars($arrival_time) . '</p>'
                    . '<p><strong>Total Amount:</strong> $' . number_format($booking['total_amount'], 2) . '</p>';

    foreach ($passengers as $passenger) {
        $mail->Body .= '<p><strong>Name:</strong> ' . htmlspecialchars($passenger['name']) . '</p>'
                     . '<p><strong>Age:</strong> ' . htmlspecialchars($passenger['age']) . '</p>'
                     . '<p><strong>Berth Preference:</strong> ' . htmlspecialchars($passenger['berth_preference']) . '</p>'
                     . '<p><strong>Seat Preference:</strong> ' . htmlspecialchars($passenger['seat_preference']) . '</p>'
                     . '<p><strong>Food Preference:</strong> ' . htmlspecialchars($passenger['food_preference']) . '</p><hr>';
    }

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Alegreya:ital,wght@0,400..900;1,400..900&display=swap');

:root {
    --green: rgb(156, 175, 136);
    --dark-color: rgb(249, 248, 235);
    --black: #444;
    --light-color: #666;
    --border: .1rem solid rgba(0,0,0,.1);
    --box-shadow: 0 .5rem 1rem rgba(0,0,0,.1);
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

body {
    font-size: 75%;
    text-align: center;
    padding: 20px;
    background-color: #f0f0f0;
}

.confirmation-container {
    max-width: 800px;
    margin: 50px auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: var(--box-shadow);
}

.confirmation-container h2 {
    text-align: center;
    color: var(--black);
    font-size: 2.5rem;
    margin-bottom: 20px;
}

.details {
    margin-bottom: 20px;
}

.details h3 {
    color: var(--light-color);
    font-size: 1.8rem;
    margin-bottom: 10px;
}

.details p {
    margin-bottom: 5px;
    font-size: 1.4rem;
    color: var(--black);
}

.details strong {
    font-weight: bold;
}

hr {
    border: none;
    border-top: 1px solid #eee;
    margin: 20px 0;
}
button {
                padding: 15px 30px;
                background-color: var(--black);
                color: var(--dark-color);
                border: none;
                border-radius: 5px;
                cursor: pointer;
                font-size: 1.6rem;
                margin: 10px;
                transition: background-color 0.3s;
            }

            button:hover {
                background-color: var(--dark-color);
                color: var(--black);
            }
    </style>
</head>
<body>

<div class="confirmation-container">
    <h2>Booking Confirmation</h2>

    <div class="details">
        <h3>Booking Details</h3>
        <p><strong>PNR Code:</strong> <?= htmlspecialchars($booking['pnr_code']); ?></p>
        <p><strong>From:</strong> <?= htmlspecialchars($depa); ?></p>
        <p><strong>To:</strong> <?= htmlspecialchars($arrival); ?></p>
        <p><strong>Departure Time:</strong> <?= htmlspecialchars($departure_time); ?></p>
        <p><strong>Arrival Time:</strong> <?= htmlspecialchars($arrival_time); ?></p>
        <p><strong>Total Amount:</strong> $<?= number_format($booking['total_amount'], 2); ?></p>
    </div>

    <div class="details">
        <h3>Passenger Details</h3>
        <?php foreach ($passengers as $passenger): ?>
            <p><strong>Name:</strong> <?= htmlspecialchars($passenger['name']); ?></p>
            <p><strong>Age:</strong> <?= htmlspecialchars($passenger['age']); ?></p>
            <p><strong>Berth Preference:</strong> <?= htmlspecialchars($passenger['berth_preference']); ?></p>
            <p><strong>Seat Preference:</strong> <?= htmlspecialchars($passenger['seat_preference']); ?></p>
            <p><strong>Food Preference:</strong> <?= htmlspecialchars($passenger['food_preference']); ?></p>
            <hr>
        <?php endforeach; ?>
        
        <button onclick="window.location.href='index.php'">HOME</button>
    </div>
</div>

</body>
</html>
