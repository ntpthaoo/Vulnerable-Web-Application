<!DOCTYPE html>
<html>
<head>
   <title>XSS 1</title>
<link rel="shortcut icon" href="../Resources/hmbct.png" />
</head>
<body>
	
	 <div style="background-color:#c9c9c9;padding:15px;">
      <button type="button" name="homeButton" onclick="location.href='../homepage.html';">Home Page</button>
      <button type="button" name="mainButton" onclick="location.href='xssmainpage.html';">Mainnnn Page</button>
    </div>
<div align="center">
   <form method="GET" action="" name="form">
   <p>Your name:<input type="text" name="username"></p>
   <input type="submit" name="submit" value="Submit">
</form>
	</div>
<?php
   if(isset($_GET["username"]))
   // thuc hien day mot ma nguon co long xss len tren quy trinh CICD
       echo("Your name is ".$_GET["username"])

  // echo("Your name is " . htmlspecialchars($_GET["username"]) )
   ?> 
</body>
</html>

// echo("Your name is ".$_GET["username"])