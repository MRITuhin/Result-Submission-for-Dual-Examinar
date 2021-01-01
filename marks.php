<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "test";
	$tbl_name="student"; // Table name 

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	if (!$conn) {
		echo "Database Connection failed ";
        echo '<a href="main_login.php"><button>back</button></a>';
	}

	if (isset($_POST['submit'])) {
       // if ($_POST['student'] == "") {
       //     echo '<script>alert("Please select a student.")</script>';
      //  }
	    $hashID = $_POST['student'].$_POST['course'].$_POST['part'];
        $sql="SELECT * FROM $tbl_name WHERE BINARY hashID='$hashID'";
        $result=mysqli_query($conn, $sql);
        $count=mysqli_num_rows($result);
        
        $value = $_POST['final'] + $_POST['ct'];

        $total = $_POST['final'];
        if ($count) {
            $sql = "UPDATE $tbl_name SET number = '$value' WHERE hashID = '$hashID'";
            $sql_verify = mysqli_query($conn, $sql);
            if ($sql_verify == true) {
                header("Location: marks.php");
            }
        }
        else {
            $sql = "INSERT INTO $tbl_name (hashID, number)
                    VALUES ('$hashID', '$value')";
            $sql_verify = mysqli_query($conn, $sql);
            if ($sql_verify == true) {
                header("Location: marks.php");
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
    <title>Input Marks</title>
</head>

<body>
    <div class="container bodyOfContent">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6 header">
                <h1>Input Marks</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <form name="myForm" action="marks.php" method="post" onsubmit="return validateForm()">
                    <div class="form-group">
                        <label for="SID">Select student</label>
                        <select class="form-control" id="type" name="student">
                            <option value="">select one</option>
                            <option value="S1">Student 1</option>
                            <option value="S2">Student 2</option>
                            <option value="S3">Student 3</option>
                            <option value="S3">Student 4</option>
                            <option value="S3">Student 5</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="Course">Select Course</label>
                        <select class="form-control" id="type" name="course">
                            <option value="">select one</option>
                            <option value="C1">Course 1</option>
                            <option value="C2">Course 2</option>
                            <option value="C3">Course 3</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="Part">Select Course</label>
                        <select class="form-control" id="type" name="part">
                            <option value="">select one</option>
                            <option value="P1">Part 1</option>
                            <option value="P2">Part 2</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="teacherName">Final Exam</label>
                        <input type="number" class="form-control" name = "final" id="final" min="0" max="60" placeholder="Final Exam">
                    </div>
                    <div class="form-group">
                        <label for="teacherId">Class Test</label>
                        <input type="number" class="form-control" name = "ct" id="ct" min="0" max="40" placeholder="Class Test">
                    </div>
                    <button type="submit" name = "submit" class="btn btn-primary">Submit</button>
                </form>
                <form action="index.php" method="post" enctype="multipart/form-data" align="center">
                    <button class="btn btn-primary">Back</button>
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
        var x = document.forms["myForm"]["ct"].value;
        if (x == "") {
            alert("Class test must be filled out");
            return false;
        }
        x = document.forms["myForm"]["final"].value;
        if (x == "") {
            alert("Final marks should be filled out");
            return false;
        }
        x = document.forms["myForm"]["student"].value;
        if (x == "") {
            alert("Student should be selected");
            return false;
        }
        x = document.forms["myForm"]["course"].value;
        if (x == "") {
            alert("Course should be selected");
            return false;
        }
        x = document.forms["myForm"]["part"].value;
        if (x == "") {
            alert("Part test be filled out");
            return false;
        }
    }
</script>