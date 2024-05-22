<?php

session_start();
 

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: welcome.php");
    exit;  
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>login page</title>
</head>
<body>
    <h1>Log In</h1>
    
<form method="post" action="login.php">
account：
<input type="text" name="username"><br/><br/>
password：
<input type="password" name="password"><br><br>
<input type="submit" value="login" name="submit"><br><br>
<a href="register.html">register now！</a>
</form>
</body>
</html>