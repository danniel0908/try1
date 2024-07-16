<?php
session_start();
include ('config.php');

//check if the user is already login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
//logout function
if(isset($_POST["logout"])){
    session_destroy();
    header("Location: index.php");
}

//edit profile function
if(isset($_POST["edit"])){
    header("Location: edit.php");
}

//addcourse function
if(isset($_POST["addcourse"])){
    header("Location: addCourse.php");
}


$c_user=$_SESSION['username'];

if($_SESSION['type'] !== 'teacher'){
$checkUser = $mysqli->query("SELECT * FROM student WHERE stname='$c_user'");
}else{
    $checkUser = $mysqli->query("SELECT * FROM teacher WHERE username='$c_user'");

}
while($result =mysqli_fetch_assoc($checkUser)){
    $_SESSION['email'] = $result['email'];
    $_SESSION['age'] = $result['age'];
    $_SESSION['course'] = $result['courseID'];

    if($_SESSION['type'] == 'teacher'){
    $_SESSION['teacherId'] = $result['teacherId'];
    }
}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/s.css">
    <style>
        .button-header button {
            background-color: red;
        }
        .button-header button:hover {
            background-color: darkred;
        }
        
    </style>
</head>
<body>
    <div>
        <div class="container">
            <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
            <p>Congratulations and warm greetings as you come aboard!</p><br><br>
            <button onclick="window.location.href='students.php'">Show all students</button>
            <button onclick="window.location.href='teachers.php'">Show all teachers</button>
            <button onclick="window.location.href='courses.php'">Show all courses</button>


            <button onclick="window.location.href='union.php'">Show all users (Union)</button>
            <button onclick="window.location.href='join.php'">Show records (Join)</button>
        </div>
        <form class= "button-header" method="post">
            <button type="submit" name="edit">Edit Profile</button> 
            <?php 
                if ($_SESSION['type'] == 'teacher') {
                    echo '<button type="submit" name="addcourse">Add Course</button>';
                }
            ?>
            <button type="submit" name="logout">Logout</button>      
        </form>
    </div>
</body>
</html>