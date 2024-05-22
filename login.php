<?php

$conn = require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE username = ?";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $param_username);
        $param_username = $username;

        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_store_result($stmt);
            if (mysqli_stmt_num_rows($stmt) == 1) {
                mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                if (mysqli_stmt_fetch($stmt)) {
                    if (password_verify($password, $hashed_password)) {
                        session_start();
                        $_SESSION["loggedin"] = true;
                        $_SESSION["id"] = $id;
                        $_SESSION["username"] = $username;
                        header("location: welcome.php");
                    } else {
                        function_alert("Incorrect password.");
                    }
                }
            } else {
                function_alert("No account found with that username.");
            }
        } else {
            function_alert("Oops! Something went wrong. Please try again later.");
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}

function function_alert($message) {
    echo "<script>alert('$message');
    window.location.href='index.php';
    </script>";
    return false;
}
?>
