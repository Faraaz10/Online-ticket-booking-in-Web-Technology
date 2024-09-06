<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the basic booking details
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $numPassengers = $_POST['num_passengers'];

    // Create an array to store passenger details
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
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Booking</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .review-container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .review-container h2 {
            margin-bottom: 20px;
            font-size: 1.5rem;
            color: #333;
            text-align: center;
        }

        .review-container ul {
            list-style-type: none;
            padding: 0;
        }

        .review-container li {
            margin-bottom: 10px;
        }

        .review-container .form-group {
            margin-bottom: 10px;
        }

        .review-container button {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-size: 1rem;
        }

        .review-container button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="review-container">
    <h2>Review Booking Details</h2>
    <ul>
        <li><strong>Name:</strong> <?php echo htmlspecialchars($name); ?></li>
        <li><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></li>
        <li><strong>Phone:</strong> <?php echo htmlspecialchars($phone); ?></li>
        <li><strong>Number of Passengers:</strong> <?php echo htmlspecialchars($numPassengers); ?></li>
    </ul>
    <h3>Passenger Details:</h3>
    <ul>
        <?php foreach ($passengerDetails as $index => $passenger): ?>
            <li><strong>Passenger <?php echo $index + 1; ?>:</strong></li>
            <ul>
                <li>Name: <?php echo htmlspecialchars($passenger['name']); ?></li>
                <li>Age: <?php echo htmlspecialchars($passenger['age']); ?></li>
                <li>Berth Preference: <?php echo htmlspecialchars($passenger['berth_preference']); ?></li>
                <li>Seat Preference: <?php echo htmlspecialchars($passenger['seat_preference']); ?></li>
                <li>Food Preference: <?php echo htmlspecialchars($passenger['food_preference']); ?></li>
            </ul>
        <?php endforeach; ?>
    </ul>

    <form action="confirm_payment.php" method="POST">
        <!-- Pass the details to the payment page -->
        <input type="hidden" name="name" value="<?php echo htmlspecialchars($name); ?>">
        <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
        <input type="hidden" name="phone" value="<?php echo htmlspecialchars($phone); ?>">
        <input type="hidden" name="num_passengers" value="<?php echo htmlspecialchars($numPassengers); ?>">
        <?php foreach ($passengerDetails as $index => $passenger): ?>
            <input type="hidden" name="passenger_name[]" value="<?php echo htmlspecialchars($passenger['name']); ?>">
            <input type="hidden" name="passenger_age[]" value="<?php echo htmlspecialchars($passenger['age']); ?>">
            <input type="hidden" name="berth_preference[]" value="<?php echo htmlspecialchars($passenger['berth_preference']); ?>">
            <input type="hidden" name="seat_preference[]" value="<?php echo htmlspecialchars($passenger['seat_preference']); ?>">
            <input type="hidden" name="food_preference[]" value="<?php echo htmlspecialchars($passenger['food_preference']); ?>">
        <?php endforeach; ?>
        <button type="submit">Confirm Booking</button>
    </form>
</div>

</body>
</html>
