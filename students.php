<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students list</title>
    <link rel="stylesheet" href="css/table.css">


</head>
<body>
<div class="container">
    <a class="dashboard" href="dashboard.php">Dashboard</a>
        <?php
        include('config.php');

        $display = "SELECT * FROM user.student;";

        $result = $mysqli->query($display);
        if ($result->num_rows > 0) {
            echo "
                <table>
                  <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Age</th>
                    <th>Course Id</th>
                  </tr>";
            while ($row = $result->fetch_assoc()) {
            echo    "<tr>
                        <td>" . $row["stname"] . "</td>
                        <td>" . $row["email"] . "</td>
                        <td>" . $row["age"] . "</td>
                        <td>" . $row["courseID"] . "</td>
                    </tr>";
            }
            echo "</table>";
        }
        ?>
        
    </div>
</body>
</html>