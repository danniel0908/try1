<?php
session_start();
require 'config.php';


if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $courseid = $_POST['courseid'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmpassword'];


    if ($password !== $confirmPassword) {
        $errorMsg = "Password does not match.";
    } else {
        if($_SESSION['type'] == 'teacher'){
            $checkUser = $mysqli->query("SELECT * FROM teacher WHERE username='$username'");
        }
        else{
            $checkUser = $mysqli->query("SELECT * FROM student WHERE stname='$username'");
        }

        if ($checkUser->num_rows > 0) {
            $errorMsg = "Username or email already exists.";
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Use password_hash to securely hash passwords
            if($_SESSION['type'] == 'teacher'){
                $mysqli->query("INSERT INTO teacher (username, email,age,courseID, password) VALUES ('$username', '$email','$age','$courseid', '$hashedPassword')");

            }else{
                $mysqli->query("INSERT INTO student  (stname, email, age ,courseID, password) VALUES ('$username', '$email','$age','$courseid', '$hashedPassword')");
            }
            $successMsg = "Registration successful!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Registration</title>
    <link rel="stylesheet" href="css/s.css">

</head>
<body>
    <div class="container">
        <a href="index.php">
            <img src="css/assets/user.png" style="width:80px;height:80px;" alt="logo">
        </a>
        <?php
            if($_SESSION['type'] !== 'teacher'){
                echo '<h2>Student Registration</h2>';
            }else{
                echo '<h2>Teacher Registration</h2>';
            }
        ?>
        <form action="" method="post" autocomplete="off">
            <label for="username">Name:</label>
            <input type="text" name="username" id="username" required><br>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required><br>
            <label for="age">Age:</label>
            <input type="text" name="age" id="age" required><br>
            <label for="courseid">Course Id:</label>
            <input type="text" name="courseid" id="courseid" required><br>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required><br>
            <label for="confirmpassword">Confirm Password:</label>
            <input type="password" name="confirmpassword" id="confirmpassword" required >
            <?php if (!empty($errorMsg)) { ?>
                <p class="error-message"><?php echo $errorMsg; ?></p>
            <?php } ?>
            <?php if (!empty($successMsg)) { ?>
                <p class="success-message"><?php echo $successMsg; ?></p>
            <?php } ?>
            <br>
            <button type="submit" name="submit">Register</button>
            <h4>Already have an account? <a href="login.php">Login.</a></h4>
        </form>
    </div>
</body>
</html>