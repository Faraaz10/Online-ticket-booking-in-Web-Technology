<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include('db_connect.php');

    $from = $_POST['from'];
    $to = $_POST['to'];
    $date = $_POST['date'];

    
    $query = "SELECT * FROM train_schedule WHERE depa = ? AND arrival = ? AND DATE(dat) >= CURDATE()";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ss", $from, $to);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $trains = [];
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $_SESSION['depa'] = $row['depa'];
            $_SESSION['arrival'] = $row['arrival'];
            $_SESSION['departure_time'] = $row['departure_time'];
            $_SESSION['arrival_time'] = $row['arrival_time'];
            $_SESSION['dat'] = $row['dat'];
            $trains[] = $row;
        }
    }

    echo json_encode($trains);
}
?>
