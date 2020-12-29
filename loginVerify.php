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

        // Register $myusername, $mypassword and redirect to file "login_success.php"
        session_start();
        $_SESSION['myusername'] = $myusername;
        $_SESSION['mypassword'] = $my_password_hash;
        echo"<h1> Welcome $myusername </h1>";
        header("location:index.php");
	}
	else {
        echo "<h1> Wrong username and password </h1>";
        echo '<a href="login.php"><button>back</button></a>';
	}
?>