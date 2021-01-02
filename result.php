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
    
    function func($in)
    {
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

        $m1 = $in."P1";
        $m2 = $in."P2";

        $ma1 = -100;
        $ma2 = -50;

        $sql="SELECT * FROM $tbl_name WHERE BINARY hashID='$m1'";
        $result=mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_array($result)) {
            $ma1 = $row['number'];
        }

        $sql="SELECT * FROM $tbl_name WHERE BINARY hashID='$m2'";
        $result=mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_array($result)) {
            $ma2 = $row['number'];
        }
        if ($ma1 < 0 || $ma2 < 0) {
            return "TBD";
        }
        if (abs($ma1 - $ma2) >= 20) {
            return "Deviated";
        }
        return ($ma1 + $ma2) / 2.0;
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
    <title>Result</title>
</head>
<body>

    <div class="container bodyOfContent">
        <div class="row">
            <div class="col-md-5"></div>
            <div class="col-md-6 header">
                <h1>Result</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10"></div>
            <div class="col-md-12">
                <table class="table table-striped table-dark">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Course 1</th>
                        <th scope="col">Course 2</th>
                        <th scope="col">Course 3</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            for ($i = 1; $i <= 5; $i++) {
                        ?>
                        <tr>
                            <td> Student <?php echo $i; ?> </td>
                            <?php for ($j = 1; $j <= 3; $j++) {  ?>
                            <td> <?php echo func("S".$i."C".$j); } ?> </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                    </table>
            </div>
            <div class="col-md-5"></div>
            <form action="index.php" method="post" enctype="multipart/form-data" align="center">
                <button class="btn btn-primary">Back</button>
            </form>
        </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>