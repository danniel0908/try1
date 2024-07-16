<?php
session_start();
require 'config.php';

$errorMsg = '';
$successMsg = ''; 

if (isset($_POST['submit'])) {
    $courseid = $_POST['courseid'];
    $coursename = $_POST['coursename'];
    $teacherid = $_POST['teacherid'];
    $roomnumber = $_POST['roomnumber'];

    if (empty($courseid) || empty($coursename) || empty($teacherid) || empty($roomnumber)) {
        $errorMsg = "Please fill in all fields.";
    } else {
        $checkUser = $mysqli->prepare("SELECT * FROM courses WHERE courseID=?");
        $checkUser->bind_param("s", $courseid);
        $checkUser->execute();
        $checkUser->store_result();

        if ($checkUser->num_rows > 0) {
            $errorMsg = "Course already exists.";
        } else {
            $insertCourse = $mysqli->prepare("INSERT INTO courses (courseID, courseName, teacherId, roomNumber) VALUES (?, ?, ?, ?)");
            $insertCourse->bind_param("ssss", $courseid, $coursename, $teacherid, $roomnumber);

            if ($insertCourse->execute()) {
                $successMsg = "Added successful!";
            } else {
                $errorMsg = "Error inserting course: " . $mysqli->error;
            }
        }
    }
}


?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Add Course</title>
    <link rel="stylesheet" href="css/s.css">

</head>
<body>
    <div class="container">
        <h2>Add Course</h2>
        <form action="" method="post" autocomplete="off">
            <label for="courseid">Course Id:</label>
            <input type="text" name="courseid" id="courseid" required><br>
            <label for="coursename">Course Name:</label>
            <input type="text" name="coursename" id="coursename" required><br>
            <label for="teacherid">Teacher Id:</label>
            <input type="text" name="teacherid" id="teacherid" value = "<?php echo $_SESSION['teacherId']; ?>" required><br>
            <label for="confirmpassword">Room Number:</label>
            <input type="text" name="roomnumber" id="roomnumber" required >
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