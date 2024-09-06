<?php
include('db_connect.php');
session_start();

if (isset($_POST['from']) && isset($_POST['to'])) {
    $from = $_POST['from'];
    $to = $_POST['to'];

    
    $query = "SELECT * FROM bus_schedule WHERE depa=? AND arrival=? AND DATE(dat) >= CURDATE()";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ss", $from, $to);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $_SESSION['depa'] = $row['depa'];
        $_SESSION['arrival'] = $row['arrival'];
        $_SESSION['dat'] = $row['dat'];
        $rows[] = $row;
    }

    echo json_encode($rows);
}
?>
