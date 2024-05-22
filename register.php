<?php 
$conn=require_once("config.php");

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $username=mysqli_real_escape_string($conn, $_POST["username"]);
    $password=password_hash($_POST["password"], PASSWORD_DEFAULT);
    
    $check="SELECT * FROM users WHERE username='".$username."'";
    $result = mysqli_query($conn,$check);
    if(!$result){
        die("Error executing query: " . mysqli_error($conn));
    }
    if(mysqli_num_rows($result)==0){
        $sql="INSERT INTO users (id,username, password)
            VALUES(NULL,'".$username."','".$password."')";
        
        if(mysqli_query($conn, $sql)){
            echo "<script>alert('Registration successful!');</script>";
            header("refresh:3;url=index.php");
            exit;
        }else{
            echo "Error creating table: " . mysqli_error($conn);
        }
    }
    else{
        echo "This account is already in use!<br>Redirecting in 3 seconds<br>";
        echo "<a href='register.html'>Click here if not redirected</a>";
        header('HTTP/1.0 302 Found');
        
        exit;
    }
}

mysqli_close($conn);
?>
