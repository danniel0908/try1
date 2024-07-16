<?php
session_start();
require 'config.php';

//the session will be destroy if the user go back to login
if (isset($_SESSION['username'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}


if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if($_SESSION['type'] !== 'teacher'){
        $result = $mysqli->query("SELECT * FROM student WHERE stname='$username'");
    }
    else{
        $result = $mysqli->query("SELECT * FROM teacher WHERE username='$username'");
    }

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $username;
            $_SESSION['status'] = "login";
            header("Location: dashboard.php");
        } else {
            $errorMsg = "Incorrect Username or Password";
        }
    } else {
        $errorMsg = "Incorrect Username or Password";
    }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/s.css">

</head>
<body>
    <div class="container">
        <a href="index.php">
            <img src="css/assets/user.png" style="width:80px;height:80px;" alt="logo">
        </a>
        <?php
            if($_SESSION['type'] !== 'teacher'){
                echo '<h2>Student Login</h2>';
            }else{
                echo '<h2>Teacher Login</h2>';
            }
        ?>
        
        <form action="" method="post" autocomplete="off">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required value=""><br>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required value=""><br>
            <?php if (!empty($errorMsg)) { ?>
                <p class="error-message"><?php echo $errorMsg; ?></p>
            <?php } ?>
            <button type="submit" name="submit">Login</button>
        </form>
        <h4>Don't have an account? <a href="register.php">Sign up.</a></h4>
    </div>
</body>
</html>
