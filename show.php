<?php

    $conn = new mysqli('localhost','root','','formData');

    if($conn->connect_error) {
        die("Connection Failure: ".$conn->connect_error);
    }

    $selectSql = "SELECT * FROM userData";

    $selectResult = $conn->query($selectSql);

    if($selectResult === TRUE) {
        echo "ERROR";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- css link -->
    <link rel="stylesheet" href="assets/css/style.css" />

    <title>Document</title>
</head>
<body>
    <table class="showTable">
        <thead>
            <tr>
                <th>Id</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>DOB</th>
                <th>Mobile</th>
                <th>Designation</th>
                <th>Gender</th>
                <th>Hobbies</th>
            </tr>
        </thead>
        <tbody>
            <?php
            
                if ($selectResult->num_rows>0) {
                    while ($row = $selectResult->fetch_assoc()) {
            ?>
            <tr>
                <td><?php echo $row['user_id'];?></td>
                <td><?php echo $row['first_name']." ".$row['last_name'];?></td>
                <td><?php echo $row['email'];?></td>
                <td><?php echo $row['dob'];?></td>
                <td><?php echo $row['phone'];?></td>
                <td><?php echo $row['designation'];?></td>
                <td><?php echo $row['gender'];?></td>
                <td><?php echo $row['hobbies'];?></td>
            </tr>
            <?php
                    }
                }    
            
            ?>
        </tbody>
    </table>
</body>
</html>