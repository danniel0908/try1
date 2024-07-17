<?php include('config.php');?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join</title>
    <link rel="stylesheet" href="css/table.css">


</head>
<body>
<div class="container">
   <a class="dashboard" href="dashboard.php">Dashboard</a>
    <h2>Inner Join</h2>
      <?php
         $display = "SELECT student.studentID, student.stname, courses.courseName,courses.roomNumber,teacher.username
         FROM courses
         INNER JOIN student
         ON student.courseID=courses.courseID
         INNER JOIN teacher on teacher.teacherId =courses.teacherId
         ORDER BY student.studentID;";

         $result = $mysqli->query($display);
         if ($result->num_rows > 0){
            echo "<table>
                  <tr>
                     <th>Student Id</th>
                     <th>Username</th>
                     <th>Course</th>
                     <th>Room Number</th>
                     <th>Professor</th>
                  </tr>";
                  while ($row = $result->fetch_assoc()) {
                     echo "<tr>
                             <td>" . $row["studentID"] . "</td>
                             <td>" . $row["stname"] . "</td>
                             <td>" . $row["courseName"] . "</td>
                             <td>" . $row["roomNumber"] . "</td>
                             <td>" . $row["username"] . "</td>
                           </tr>";
                 }
           }  echo "</table>";
         ?>

         <h2>Left Join</h2>
         <?php
         $display = "SELECT student.stname, courses.courseID
         FROM student
         LEFT JOIN courses
         ON student.courseID=courses.courseID
         ORDER BY student.stname;";

         $result = $mysqli->query($display);
         if ($result->num_rows > 0){
            echo "<table>
                  <tr>
                     <th>Student Name</th>
                     <th>Course Id</th>

                  </tr>";
                  while ($row = $result->fetch_assoc()) {
                     echo "<tr>
                             <td>" . $row["stname"] . "</td>
                             <td>" . $row["courseID"] . "</td>
                           </tr>";
                 }
           }  echo "</table>";
         ?>  

         <h2>Right Join</h2>
         <?php
         $display = "SELECT courses.courseID, teacher.username, teacher.email
         FROM courses
         RIGHT JOIN teacher
         ON courses.teacherId = teacher.teacherId;";

         $result = $mysqli->query($display);
         if ($result->num_rows > 0){
            echo "<table>
                  <tr>
                     <th>Course Id</th>
                     <th>Teacher Name</th>
                     <th>Email</th>
                  </tr>";
                  while ($row = $result->fetch_assoc()) {
                     echo "<tr>
                             <td>" . $row["courseID"] . "</td>
                             <td>" . $row["username"] . "</td>
                             <td>" . $row["email"] . "</td>
                           </tr>";
                 }
           }  echo "</table>";
         ?>  
    </div>
</body>
</html>