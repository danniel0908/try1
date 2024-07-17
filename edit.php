<?php
session_start();
require 'config.php';

$errorMsg = '';
$successMsg = '';

$c_user = $_SESSION['username'];

if (isset($_POST['submit'])) {
    $newUsername = $_POST['username'];
    $newEmail = $_POST['email'];
    $age = $_POST['age'];
    $course = $_POST['course'];

    if($_SESSION['type'] !== 'teacher'){
        $checkUser = $mysqli->query("SELECT * FROM student WHERE (stname='$newUsername' OR email='$newEmail') AND stname<>'$c_user'");
    }else{
        $checkUser = $mysqli->query("SELECT * FROM teacher WHERE (username='$newUsername' OR email='$newEmail') AND username<>'$c_user'");
    }

    if ($checkUser->num_rows > 0) {
        $errorMsg = "Username or email already exists for another user.";
    } else {
        // Update the user's information
        if($_SESSION['type'] !== 'teacher'){
        $updateQuery = "UPDATE student SET stname='$newUsername', email='$newEmail',age='$age',courseID='$course' WHERE stname ='$c_user'";
        $mysqli->query($updateQuery);
        } else{
            $updateQuery = "UPDATE teacher SET username='$newUsername', email='$newEmail',age='$age',courseID='$course' WHERE username='$c_user'";
        $mysqli->query($updateQuery);
        }


        // Update the session variable if the username has changed
        if ($newUsername !== $_SESSION['username']) {
            $_SESSION['username'] = $newUsername;
        }

        $successMsg = "Update successful!";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="css/s.css">
</head>
<body>
<div class="container">
    <h2>Edit</h2>
        <form action="" method="post" autocomplete="off">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" value = "<?php echo $_SESSION['username']; ?>"><br>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value = "<?php echo $_SESSION['email']; ?>"><br>
            <label for="age">Age:</label>
            <input type="text" name="age" id="age" value="<?php echo $_SESSION['age']; ?>" required><br>
            <label for="course">Course:</label>
            <input type="text" name="course" id="course" value ="<?php echo $_SESSION['course']; ?>" required><br>
            <?php if (!empty($errorMsg)) { ?>
                <p class="error-message"><?php echo $errorMsg; ?></p>
            <?php } ?>
            <?php if (!empty($successMsg)) { ?>
                <p class="success-message"><?php echo $successMsg; ?></p>
            <?php } ?>
            <br>
            <button type="submit" name="submit">Submit</button>
            <h4>Want to go back? <a href="dashboard.php">Dashboard</a></h4>
        </form>
    </div>
</body>
</html>
