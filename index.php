<?php 
//the session will be destroy if the user go back to index
session_start();


if(isset($_POST["teacher"])){
    $_SESSION['type'] = "teacher";
    header("Location: login.php");
}

if(isset($_POST["student"])){
    $_SESSION['type'] = "student";
    header("Location: login.php");
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Landing Page</title>
    <link rel="stylesheet" href="css/s.css">
</head>
<body>
    <div class="welcome">
        <h1 class = "container" >Welcome to our Website!</h1>
    </div>
    <div class="button-header">
        <form method="post">
            <button type="submit" name="teacher">Teacher</button>   
            <button type="submit" name="student">Student</button>   
        </form>
    </div>
</body>
</html>
