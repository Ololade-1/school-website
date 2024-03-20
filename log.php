<?php
session_start();
include("database.php");

if (isset($_POST['email']) && isset($_POST['password'])) {
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $email = validate($_POST['email']);
    $password = validate($_POST['password']);

    if (empty($email) || empty($password)) {
        $_SESSION['error'] = "<span style='color:red'>Email and password are required</span>";
        header("location: login.php");
        exit();
    } else {
        $sql = "SELECT * FROM register WHERE email=?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            if (password_verify($password, $row['password'])) {
                $_SESSION['id'] = $row['id']; 
                $_SESSION['email'] = $row['email'];
                header("location: startnew.php");
                exit();
            } else {
                $_SESSION['error'] = "<span style='color:red'>Incorrect email or password</span>";
                header("location: login.php");
                exit();
            }
        } else {
            $_SESSION['error'] = "<span style='color:red'>User not found</span>";
            header("location: login.php");
            exit();
        }
    }
} else {
    header("location: login.php");
    exit();
}
?>
