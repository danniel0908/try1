<?php
    session_start();

    if (!isset($_SESSION['status']) || $_SESSION['status'] !== 'login') {
        header("Location: login.php");
        exit();
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses list</title>
    <link rel="stylesheet" href="css/table.css">


</head>
<body>
<div class="container">
    <a class="dashboard" href="dashboard.php">Dashboard</a>
        <?php
        include('config.php');

        $display = "SELECT * FROM user.courses;";

        $result = $mysqli->query($display);
        if ($result->num_rows > 0) {
            echo "
                <table>
                  <tr>
                    <th>Course Id</th>
                    <th>Course Name</th>
                    <th>Prof. Id</th>
                    <th>Room Number</th>
                  </tr>";
            while ($row = $result->fetch_assoc()) {
            echo    "<tr>
                        <td>" . $row["courseID"] . "</td>
                        <td>" . $row["courseName"] . "</td>
                        <td>" . $row["teacherId"] . "</td>
                        <td>" . $row["roomNumber"] . "</td>
                    </tr>";
            }
            echo "</table>";
        }
        ?>
        
    </div>
</body>
</html>