<?php
session_start();  
$username=$_SESSION["username"];
echo "<h1>hi there ".$username."</h1>";
echo "<a href='logout.php'>logut</a>";
    
?>