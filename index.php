<?php

    if(isset($_POST['submit'])) {
        // connection created
        $conn = new mysqli('localhost','root','','formData');

        if($conn->connect_error) {
            die("Connection Failed: ".$conn->connect_error);
        }

        // values picked
        
        $day = mysqli_real_escape_string($conn,$_POST['day']);
        $month = mysqli_real_escape_string($conn,$_POST['month']);
        $year = mysqli_real_escape_string($conn,$_POST['year']);
        $dob = $day."-".$month."-".$year;
        $gender = mysqli_real_escape_string($conn,$_POST['gender']);
        $hobbies = "";

        foreach($_POST['hobbies'] as $value) {
            $hobbies .= mysqli_real_escape_string($conn,$value.",");
        }

        //validating values

        //first name validate
        if(empty($_POST['firstName'])) {
            $nameError = "Please enter your first name";
        } else {
            $nameError = "";
            // check the name value
            if(!preg_match("/^[a-zA-Z-' ]*$/",$_POST['firstName'])) {
                $nameError = "Only letters and white space allowed";
            } else {
                $nameError = "";
                //assign value
                $firstName = mysqli_real_escape_string($conn,$_POST['firstName']);
            }
        }

        //last name validate
        if(empty($_POST['lastName'])) {
            $lastError = "Please enter your last name";
        }  else {
            $lastError = "";
            // check the last name value 
            if(!preg_match("/^[a-zA-Z-' ]*$/",$_POST['lastName'])) {
                $lastError = "Only letters and white space allowed";
            } else {
                $lastError = "";
                //assign value 
                $lastName = mysqli_real_escape_string($conn,$_POST['lastName']);
            }
        }

        // email validate
        if(empty($_POST['email'])) {
            $emailError = "Please enter your email";
        } else {
            $emailError = "";
            // check email
            if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $emailError = "Invalid Email";
            } else {
                $emailError = "";
                $email = mysqli_real_escape_string($conn,$_POST['email']);
            }
        }

        // phone validate 
        if(empty($_POST['phone'])) {
            $phoneError = "Please enter your Mobile Number";
        } else {
            $phoneError = "";
            // check phone and length
            if(!preg_match("/^[0-9]*$/",$_POST['phone'])) {
                $phoneError = "Please enter a valid Mobile Number";
            } else {
                $phoneError = "";
                $length = strlen($_POST['phone']);
                if($length < 10 || $length > 10) {
                    $phoneError = "Please enter a 10 digit number";
                } else {
                    $phoneError = "";
                    $phone = mysqli_real_escape_string($conn,$_POST['phone']);
                }
            }
        }

        //designation validate 
        if(empty($_POST['designation'])) {
            $desError = "Please enter your designation";
        } else {
            $desError = "";
            // check designation value
            if(!preg_match("/^[a-zA-Z-' ]*$/",$_POST['designation'])) {
                $desError = "Only letters and white space allowed";
            } else {
                $desError = "";
                //assign value
                $designation = mysqli_real_escape_string($conn,$_POST['designation']);
            }
        }

        //check empty variables

        if(!empty($dob || $gender || $hobbies || $firstName || $lastName || $email || $phone || $designation)) {
            $insertSql = "INSERT INTO userData(first_name,last_name,email,dob,phone,designation,gender,hobbies)VALUES('{$firstName}','{$lastName}','{$email}','{$dob}','{$phone}','{$designation}','{$gender}','{$hobbies}')";

            if($conn->query($insertSql) === TRUE) {
                header("Location: show.php");
            } else {
                echo "ERROR";
            }
        } else {
            echo "<script>alert('Enter all columns');</script>";
        }

        $conn->close();
        
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- css link -->
    <link rel="stylesheet" href="assets/css/style.css" />

    <!-- bootstrap 4.0 link -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- title -->
    <title>Form</title>
</head>
<body>


    <form class="container" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
        <p class="error">* required field</p>
        <!-- first name -->
        <div class="form-group row">
            <label for="firstName" class="col-sm-2 col-form-label">First Name:</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="firstName" placeholder="Enter your First Name">
            </div>
            <div class="col-sm-4 error">*<?php if(!empty($nameError)) {
                                                    $n_error = $nameError;
                                                } else {
                                                    $n_error = " ";
                                                }  
                                               echo " ".$n_error; ?></div>
        </div>
        <!-- last name -->
        <div class="form-group row">
            <label for="lastName" class="col-sm-2 col-form-label">Last Name:</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="lastName" placeholder="Enter your Last Name">
            </div>
            <div class="col-sm-4 error">*<?php if(!empty($lastError)) {
                                                    $l_error = $lastError;
                                                } else {
                                                    $l_error = " ";
                                                }
                                                echo " ".$l_error; ?></div>
        </div>
        <!-- email -->
        <div class="form-group row">
            <label for="email" class="col-sm-2 col-form-label">Email:</label>
            <div class="col-sm-6">
                <input type="email" class="form-control" name="email" placeholder="Enter your email">
            </div>
            <div class="col-sm-4 error">*<?php if(!empty($emailError)) {
                                                    $e_error = $emailError;
                                                } else {
                                                    $e_error = " ";
                                                }
                                                echo " ".$e_error; ?></div>
        </div>
        <!-- date of birth -->
        <div class="form-group row">
            <label for="dob" class="col-sm-2 col-form-label">Date of Birth:</label>
            <!-- day select -->
            <div class="col-sm-1">
                <select name="day" class="form-control">
                    <option disabled>Day</option>

                    <?php
                    
                        for($i=1;$i<=31;$i++) {
                            echo "<option value=".$i.">$i</option>";
                        }

                    ?>
                </select>
            </div>
            <!-- month select -->
            <div class="col-sm-3">
                <select name="month" class="form-control">
                    <option disabled>Month</option>

                    <?php
                        $monthArray = ["January","February","March","April","May","June","July","August","September","October","November","December"];  
                        for($i=0;$i<count($monthArray);$i++) {
                            echo "<option value=".$monthArray[$i].">$monthArray[$i]</option>";
                        }

                    ?>
                </select>
            </div>
            <!-- year select -->
            <div class="col-sm-2">
                <select name="year" class="form-control">
                    <option disabled>Year</option>
                    <?php
                    
                        for($i=2020;$i>=1905;$i--) {
                            echo "<option value=".$i.">$i</option>";
                        }

                    ?>
                </select>
            </div>
        </div>
        <!-- mobile/telephone -->
        <div class="form-group row">
            <label for="phone" class="col-sm-2 col-form-label">Mobile No:</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="phone" placeholder="Enter your Mobile Number">
            </div>
            <div class="col-sm-4 error">*<?php if(!empty($phoneError)) {
                                                    $p_error = $phoneError;
                                                } else {
                                                    $p_error = " ";
                                                }
                                                echo " ".$p_error;?></div>
        </div>
        <!-- designation -->
        <div class="form-group row">
            <label for="designation" class="col-sm-2 col-form-label">Designation:</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="designation" placeholder="Enter your Designation">
            </div>
            <div class="col-sm-4 error">*<?php if(!empty($desError)) {
                                                    $d_error = $desError;
                                                } else {
                                                    $d_error = " ";
                                                }
                                                echo " ".$d_error;?></div>
        </div>
        <!-- gender -->
        <div class="form-group row">
            <label for="gender" class="col-sm-2 col-sm-label">Gender:</label>
            <div class="col-sm-6">
                <div class="form-check form-check-inline">
                    <input type="radio" class="form-check-input" name="gender" value="male" />
                    <label class="form-check-label" for="male">Male</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" class="form-check-input" name="gender" value="female" />
                    <label class="form-check-label" for="female">Female</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" class="form-check-input" name="gender" value="custom" />
                    <label class="form-check-label" for="custom">Custom</label>
                </div>
            </div>
        </div>
        <!-- hobbies -->
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label" for="hobbies">Hobbies</label>
            <div class="col-sm-6">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" value="singing" name="hobbies[]" />
                    <label class="form-check-label" for="singing">Singing</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" value="reading" name="hobbies[]" />
                    <label class="form-check-label" for="reading">Reading</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" value="writing" name="hobbies[]" />
                    <label class="form-check-label" for="writing">Writing</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" value="dancing" name="hobbies[]" />
                    <label class="form-check-label" for="dancing">Dancing</label>
                </div>
            </div>
        </div>
        <!-- submit button -->
        <div class="col-sm-8 text-right">
            <input type="submit" class="btn btn-primary" value="Submit" name="submit" />
        </div>
    </form>


    <!-- bootstrap js files -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>