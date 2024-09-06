<?php
session_start();
include 'db_connect.php';
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $bookedSeats = isset($_POST['selectedSeats']) ? $_POST['selectedSeats'] : '';

    if (isset($_SESSION['depa']) && isset($_SESSION['arrival']) && isset($_SESSION['dat'])) {
        $depa = $_SESSION['depa'];
        $arrival = $_SESSION['arrival'];
        $dat = $_SESSION['dat'];
    } else {
        echo "No session variables are set.";
        exit();
    }

    $selectedSeatsArray = explode(',', $bookedSeats);
    $totalSeatsBooked = count($selectedSeatsArray);

    $pnr = 'PNR' . strtoupper(uniqid());

    $booking_date = date('Y-m-d');
    $insertBookingQuery = "INSERT INTO user_booked (name, age, email, phone, depa, arrival, seats, booking_date, total_seats, pnr) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $insertBookingQuery);
    mysqli_stmt_bind_param($stmt, 'sisssssiss', $name, $age, $email, $phone, $depa, $arrival, $bookedSeats, $booking_date, $totalSeatsBooked, $pnr);
    mysqli_stmt_execute($stmt);

    $updateAvailabilityQuery = "UPDATE bus_schedule SET availability = availability - ? WHERE depa = ? AND arrival = ? AND dat = ?";
    $stmt = mysqli_prepare($conn, $updateAvailabilityQuery);
    mysqli_stmt_bind_param($stmt, 'isss', $totalSeatsBooked, $depa, $arrival, $dat);
    mysqli_stmt_execute($stmt);

    foreach ($selectedSeatsArray as $seatId) {
        $insertSeatQuery = "INSERT INTO booked_seats (seat_id, depa, arrival) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $insertSeatQuery);
        mysqli_stmt_bind_param($stmt, 'sss', $seatId, $depa, $arrival);
        mysqli_stmt_execute($stmt);
    }

    $mail = new PHPMailer(true);

    try {
       
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; 
        $mail->SMTPAuth = true;
        $mail->Username = 'faraazmohammed2003@gmail.com'; 
        $mail->Password = 'abaf dbpw cuod wauz'; 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('faraazmohammed2003@gmail.com', 'Faramad');
        $mail->addAddress($email); // Add a recipient
       
        $mail->isHTML(true);
        $mail->Subject = 'Booking Confirmation';
        $mail->Body    = '<h1>Booking Confirmation</h1>'
                        . '<p><strong>PNR Code:</strong> ' . htmlspecialchars($pnr) . '</p>'
                        . '<p><strong>From:</strong> ' . htmlspecialchars($depa) . '</p>'
                        . '<p><strong>To:</strong> ' . htmlspecialchars($arrival) . '</p>'
                        . '<p><strong>Total Seats:</strong> ' . htmlspecialchars($totalSeatsBooked) . '</p>'
                        . '<p><strong>Booked Seats:</strong> ' . htmlspecialchars($bookedSeats) . '</p>'
                        . '<p><strong>Name:</strong> ' . htmlspecialchars($name) . '</p>'
                        . '<p><strong>Age:</strong> ' . htmlspecialchars($age) . '</p>'
                        . '<p><strong>Phone:</strong> ' . htmlspecialchars($phone) . '</p>';

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
        <title>Booked Successfully</title>
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

            .success-message {
                background-color: var(--green);
                color: var(--dark-color);
                padding: 30px;
                border-radius: 10px;
                margin: 20px auto;
                max-width: 600px;
                box-shadow: var(--box-shadow);
            }

            h2 {
                font-size: 3rem;
                margin-bottom: 20px;
            }

            p {
                font-size: 1.6rem;
                margin: 10px 0;
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
        <div class="success-message">
            <h2>Seats Booked Successfully!</h2>
            <p>Thank you for booking with us.</p>
            <p>Booked Seats: <?php echo htmlspecialchars($bookedSeats); ?></p>
            <p>Total Seats Booked: <?php echo $totalSeatsBooked; ?></p>
            <p>Passenger Details:</p>
            <p>Name: <?php echo htmlspecialchars($name); ?></p>
            <p>Age: <?php echo htmlspecialchars($age); ?></p>
            <p>Email: <?php echo htmlspecialchars($email); ?></p>
            <p>Phone: <?php echo htmlspecialchars($phone); ?></p>
            <p>Starting Point: <?= htmlspecialchars($depa); ?></p>
            <p>Destination Point: <?= htmlspecialchars($arrival); ?></p>
            <p>PNR: <?= htmlspecialchars($pnr); ?></p>
            
            <button onclick="window.location.href='index.php'">HOME</button>
        </div>
    </body>
    </html>

    <?php
} else {
    echo "Invalid request.";
}
?>
