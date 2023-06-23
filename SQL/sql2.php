<!DOCTYPE html>
<html>
<head>
	<title>SQL Injection Vunerablity</title>
	<link rel="shortcut icon" href="../Resources/hmbct.png" />
</head>
<body>

	<div style="background-color:#c9c9c9;padding:15px;">
      <button type="button" name="homeButton" onclick="location.href='../homepage.html';">Home Page</button>
      <button type="button" name="mainButton" onclick="location.href='sqlmainpage.html';">Main Page</button>
	</div>

	<div align="center">
	<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" >
		<p>Hello Give me book's number and I give you book's name in my library.</p>
		Book's number : <input type="text" name="number">
		<input type="submit" name="submit" value="Submit">
	</form>
	</div>
	
<?php
	require_once 'config.php';
	// $servername = "localhost:3307";
	// $username = "root";
	// $password = "";
	// $db = "1ccb8097d0e9ce9f154608be60224c7c";

	// Create connection
	$conn = new mysqli($dbConfig['host'], $dbConfig['username'], $dbConfig['password'], $dbConfig['database']);

	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 
	//echo "Connected successfully";
	if(isset($_POST["submit"])){
		$number = $_POST['number'];
		$query = "SELECT bookname, authorname FROM books WHERE number = ?";
		// myqli_prepare: hàm sử dụng để tạo một đối tượng cho câu lệnh
		$stmt = mysqli_prepare($conn, $query);
		//mysqli_stmt_bind_param() dùng để liên kết các tham số đầu vào với câu lệnh SQL đã được biên dịch. 
		// tham số "i" xác định rằng đầu vào là một số nguyên.
		mysqli_stmt_bind_param($stmt, "i", $number);

		// Execute the prepared statement
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		// $query = "SELECT bookname,authorname FROM books WHERE number = $number"; //Int
		// $result = mysqli_query($conn,$query);

		if (!$result) { //Check result
		    $message  = 'Invalid query: ' . mysqli_error($conn) . "\n";
		    $message .= 'Whole query: ' . $query;
		    die($message);
		}

		while ($row = mysqli_fetch_assoc($result)) {
			echo "<hr>";
		    echo $row['bookname']." ----> ".$row['authorname'];    
		}

		if(mysqli_num_rows($result) <= 0)
			echo "0 result";
	}

?> 

</body>
</html>
