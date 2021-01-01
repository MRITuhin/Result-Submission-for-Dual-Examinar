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
        echo '<a href="main_login.php"><button>back</button></a>';
	}

    if (isset($_POST['submit'])) {
        // username and password sent from form 
        $myusername=$_POST['teacherName']; 
        $mypassword=$_POST['password']; 

        // To protect MySQL injection (more detail about MySQL injection)
        $myusername = stripslashes($myusername);
        $mypassword = stripslashes($mypassword);

        $myusername = mysqli_real_escape_string($conn, $myusername);
        $mypassword = mysqli_real_escape_string($conn, $mypassword);

        $my_password_hash = hash('sha512', $mypassword);

        $sql="SELECT * FROM $tbl_name WHERE BINARY username='$myusername' and password='$my_password_hash'";

        $result=mysqli_query($conn, $sql);
        // Mysql_num_row is counting table row
        $count=mysqli_num_rows($result);
        
        
        // If result matched $myusername and $mypassword, table row must be 1 row
        if($count==1){
            echo '<script>alert("Welcome.");window.location.href="marks.php";</script>';
        }
        else {
            echo '<script>alert("Wrong username or password.");window.location.href="login.php";</script>';
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
    <title>Teacher Login</title>
</head>

<body>
    <div class="container bodyOfContent">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6 header">
                <h1>Teacher Login</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <form action="login.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="teacherName">User ID</label>
                        <input type="text" required="required" class="form-control" name = "teacherName" id="teacherName" placeholder="User ID">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" required="required" class="form-control" name = "password" id="password" placeholder="Password">
                    </div>
                    
                    <button type="submit" name = "submit" class="btn btn-primary">Log in</button>
                </form>
                <div class="col-md-3"></div>
                <form action="index.php" method="post" enctype="multipart/form-data" align="center">
                    <button type="submit" name = "submit" class="btn btn-primary">Back</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>

