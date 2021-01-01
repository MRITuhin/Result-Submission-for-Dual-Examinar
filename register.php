<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "test";
	$tbl_name="user"; // Table name 

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	if (!$conn) {
		echo "Database Connection failed ";
        echo '<a href="index.php"><button>back</button></a>';
	}

   // echo '<script>alert("Invalid Room Number.")</script>';
   // echo '<script>alert("Line paise")</script>';
	if (isset($_POST['submit'])) {
        
        $teacherName = $_POST["teacherName"];
        $teacherID = $_POST["teacherID"];
        $password = $_POST["password"];

        $sql="SELECT * FROM $tbl_name WHERE BINARY username='$teacherID'";
        $result=mysqli_query($conn, $sql);
        $count=mysqli_num_rows($result);

        if ($count) {
            echo '<script>alert("User ID already exists.")</script>';
            header("register.php");
        }
        else {
            $password = hash('sha512', $password);
            $sql = "INSERT INTO $tbl_name (username, password, full_name)
                    VALUES ('$teacherID', '$password', '$teacherName')";
            $sql_verify = mysqli_query($conn, $sql);
            if ($sql_verify == true) {
                //echo '<script>alert("Registered")</script>';
                //header("location:index.php");
                echo '<script>alert("Registered.");window.location.href="index.php";</script>';
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/AddTeachers.css">
    <title>Teacher Register</title>
</head>

<body>
    <div class="container bodyOfContent">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6 header">
                <h1>Teacher Register</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <form name="myForm" action="register.php" method="post" onsubmit="return validateForm()">
                    <div class="form-group">
                        <label for="teacherName">User Name</label>
                        <input type="text" required="required" class="form-control" name = "teacherName" id="teacherName" placeholder="User Name">
                    </div>
                    <div class="form-group">
                        <label for="teacherID">User ID</label>
                        <input type="text" required="required" class="form-control" name = "teacherID" id="teacherID" placeholder="User ID">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" required="required" class="form-control" name = "password" id="password" placeholder="Password">
                    </div>
                    
                    <button type="submit" name = "submit" class="btn btn-primary">Register</button>
                </form>
                <div class="col-md-3"></div>
                <form action="index.php" method="post" enctype="multipart/form-data" align="center">
                    <button name = "back" class="btn btn-primary">Back</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>

<script>
    function validateForm() {
        var x = document.forms["myForm"]["teacherName"].value;
        x = x.charAt(0);
        if (x != x.toUpperCase()) {
            alert("Please give proper name.");
            return false;
        }
        x = document.forms["myForm"]["teacherID"].value;
        if (x.length < 3) {
            alert("User ID length should be at least 3.");
            return false;
        }
        x = document.forms["myForm"]["password"].value;
        if (x.length < 3) {
            alert("Password length should be at least 3.");
            return false;
        }
    }
</script>