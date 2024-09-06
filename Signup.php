<?php
include 'db_connect.php';


error_reporting(E_ALL);
ini_set('display_errors', 1);

$error = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $date_of_birth = $_POST['date_of_birth'];

    if ($password !== $password2) {
        $error = "Passwords do not match.";
    } else {
        
        $query = "SELECT id FROM users WHERE username = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 's', $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) > 0) {
            $error = "Username already exists. Please choose another username.";
        } else {
            
            $hashed_password = password_hash($password, PASSWORD_DEFAULT); 

            $insert_query = "INSERT INTO users (name, username, password, email, phone, gender, address, date_of_birth) 
                             VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $insert_stmt = mysqli_prepare($conn, $insert_query);
            mysqli_stmt_bind_param($insert_stmt, 'ssssssss', $name, $username, $hashed_password, $email, $phone, $gender, $address, $date_of_birth);

            if (mysqli_stmt_execute($insert_stmt)) {
                
                header('Location: main.php'); 
                exit();
            } else {
                $error = "Error inserting user: " . mysqli_error($conn);
            }

            mysqli_stmt_close($insert_stmt);
        }

        mysqli_stmt_close($stmt);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Yusafir</title>
    <link rel="stylesheet" href="Signupcss.css">
</head>
<body>
    <div class="container2">
        <div class="two">
            <img src="symbol.jpg" alt="Logo" width="60%" height="60%">
        </div>
        <div class="one">
            <center>
                <form method="POST" action="#">
                    <h1>SIGN UP</h1>
                    <label>Name</label>
                    <input type="text" id="name" name="name" placeholder="Enter The Name" required><br><br>
                    <label>Username</label>
                    <input type="text" id="username" name="username" placeholder="Enter The Username" required><br><br>
                    <label>Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter The Password" required><br><br>
                    <label>Confirm Password</label>
                    <input type="password" id="password2" name="password2" placeholder="Enter The Password" required><br><br>
                    <label>Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter The Email" required><br><br>
                    <label>Phone Number</label>
                    <input type="text" id="phone" name="phone" placeholder="Enter The Phone" min="10"><br><br>
                    <label>Gender</label><br>
                    <input type="radio" id="male" name="gender" value="Male">
                    <label for="male">Male</label>
                    <input type="radio" id="female" name="gender" value="Female">
                    <label for="Female">Female</label>
                    <input type="radio" id="other" name="gender" value="Other">
                    <label for="other">Other</label><br><br>
                    <label>Address</label><br>
                    <textarea rows="5" cols="30" name="address"></textarea><br><br>
                    <label>Date Of Birth</label>
                    <input type="date" id="birth" name="date_of_birth"> <br><br>     
                    <button name="save"><span>SUBMIT</span></button>
                </form>
                <?php if ($error): ?>
                    <p style="color:red;"><?php echo $error; ?></p>
                <?php endif; ?>
            </center>
        </div>
    </div>
</body>
</html>
