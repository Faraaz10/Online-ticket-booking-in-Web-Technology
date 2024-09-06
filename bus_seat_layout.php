<?php
session_start(); 

if (isset($_SESSION['depa']) && isset($_SESSION['arrival']) && isset($_SESSION['dat'])) {
    $depa = $_SESSION['depa'];
    $arrival = $_SESSION['arrival'];
    $dat=$_SESSION['dat'];
} else {
    echo "No session variables are set.";
    exit();
}

$bookedSeats = [];

include('db_connect.php');
$query = "SELECT seat_id FROM booked_seats WHERE depa = ? AND arrival = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "ss", $depa, $arrival);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

while ($row = mysqli_fetch_assoc($result)) {
    $bookedSeats[] = $row['seat_id'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus Seat Layout</title>
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
            --booked-color: rgb(255, 99, 71); /* Tomato color for booked seats */
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
            font-size: 75%;
            overflow-x: hidden; 
            scroll-padding-top: 5rem;
            scroll-behavior: smooth;
        }

        .container {
            display: flex;
            justify-content: space-between;
            margin: 20px;
            flex-wrap: wrap;
        }

        .form-container, .bus-container {
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
        }

        .bus-container {
            display: grid;
            grid-template-columns: repeat(2, 60px) 20px repeat(2, 60px);
            gap: 15px;
            justify-content: center;
        }

        .seat {
            width: 60px;
            height: 60px;
            background-color: var(--dark-color);
            display: flex;
            align-items: center;
            justify-content: center;
            border: var(--border);
            cursor: pointer;
            border-radius: 5px;
            box-shadow: var(--box-shadow);
            transition: background-color 0.3s, transform 0.3s;
            font-size: 1.4rem;
        }

        .seat:hover:not(.booked) {
            background-color: var(--green);
            transform: scale(1.1);
        }

        .aisle {
            width: 20px;
        }

        .selected {
            background-color: var(--green);
        }

        .booked {
            background-color: var(--booked-color);
            cursor: not-allowed;
        }

        .reserve-button {
            text-align: center;
            margin-top: 20px;
        }

        .reserve-button button {
            padding: 15px 30px;
            background-color: var(--green);
            color: var(--dark-color);
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1.8rem;
            transition: background-color 0.3s;
        }

        .reserve-button button:hover {
            background-color: var(--black);
            color: var(--green);
        }

        h1 {
            color: var(--green);
            font-weight: bold;
            font-size: 3.5rem;
            text-align: center;
            margin: 20px 0;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin: 10px 0 5px;
            font-size: 1.6rem;
        }

        input, select {
            padding: 12px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1.6rem;
        }

        p {
            font-size: 1.6rem;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <h1>Bus Seat Layout</h1>
    <div class="container">
        <div class="form-container">
            <form id="reserveForm" action="reserve.php" method="post">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required>

                <label for="age">Age</label>
                <input type="number" id="age" name="age" required>

                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>

                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone" required>

                <label for="depa"></label>
                <p>Departure: <?= htmlspecialchars($depa); ?></p>
                

                <label for="arrival"></label>
                <p>Arrival: <?= htmlspecialchars($arrival); ?></p>

                <label for="date"></label>
                <p>Date And Timing: <?= htmlspecialchars($dat); ?></p>

                <input type="hidden" name="selectedSeats" id="selectedSeats">
                <div class="reserve-button">
                    <button type="submit">Reserve Seats</button>
                </div>
            </form>
        </div>

        <div class="bus-container">
            <?php
            $rows = 8; 
            $cols = 2; 

            for ($i = 1; $i <= $rows; $i++) {
                for ($j = 1; $j <= $cols; $j++) {
                    $seatId = "L$i$j";
                    $bookedClass = in_array($seatId, $bookedSeats) ? 'booked' : '';
                    echo "<div class='seat $bookedClass' id='$seatId'>$seatId</div>";
                }
                echo "<div class='aisle'></div>";
                for ($j = 1; $j <= $cols; $j++) {
                    $seatId = "R$i$j";
                    $bookedClass = in_array($seatId, $bookedSeats) ? 'booked' : '';
                    echo "<div class='seat $bookedClass' id='$seatId'>$seatId</div>";
                }
            }
            ?>
        </div>
    </div>

    <script>
        document.querySelectorAll('.seat').forEach(seat => {
            seat.addEventListener('click', () => {
                if (!seat.classList.contains('booked')) {
                    seat.classList.toggle('selected');
                }
            });
        });

        document.getElementById('reserveForm').addEventListener('submit', function(event) {
            event.preventDefault();
            let selectedSeats = [];
            document.querySelectorAll('.seat.selected').forEach(seat => {
                selectedSeats.push(seat.id);
            });

            if (selectedSeats.length === 0) {
                alert('Please select at least one seat.');
                return; 
            }

            document.getElementById('selectedSeats').value = selectedSeats.join(',');
            this.submit();
        });
    </script>
</body>
</html>
