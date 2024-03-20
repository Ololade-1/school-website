<?php
session_start();
if(isset($_SESSION['register'])){
header("location:login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="register.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li>
                    <div class="dropdown">
                        <a href="#" class="dropbtn">Programs</a>
                        <div class="dropdown-content">
                            <a href="undergraduate.html">Undergraduate Programs</a>
                            <a href="postgraduate.html">Graduate Programs</a>
                        </div>
                    </div>
                </li>
                <li><a href="admission.html">Admission</a></li>
                <li><a href="course.html">Contact</a></li>
            </ul>
        </nav>
        <a href="apply.html"><button class="btn1">Back</button></a>
        <h1>Arizona ICT College</h1>
    </header>
    <h2>Register with us Today....</h2>
    <div class="con">
        <?php
       if (isset($_POST["submit"])) {
           $firstname = $_POST['firstname'];
           $lastname = $_POST['lastname'];
           $middlename = $_POST['middlename'];
           $email = $_POST['email'];
           $password = $_POST['password'];
           $cpassword = $_POST["cpassword"];
           $passwordhash = password_hash($password, PASSWORD_DEFAULT);
           $errors = array();
       
           if (empty($firstname) || empty($lastname) || empty($middlename) || empty($email) || empty($password) || empty($cpassword)) {
               array_push($errors, "Please input all fields");
           }
           if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
               array_push($errors, "Email is not valid");
           }
           if (strlen($password) < 8) {
               array_push($errors, "Password must be at least 8 characters");
           }
           if ($password !== $cpassword) {
               array_push($errors, "Passwords do not match");
           }
           require_once "database.php"; 
           $sql=" SELECT * FROM register WHERE email='$email'";
           $result = mysqli_query($conn, $sql);
           $rowcount= mysqli_num_rows($result);
           if($rowcount>0){
            array_push($errors, "Email already exist");
           }
           
           if (count($errors) > 0) {
               foreach ($errors as $error) {
                   echo "<div class='alert alert-danger' style='padding: 5px; 
                   margin-bottom: 5px; color: red;'>$error</div>";
               }
           } else {
              
               $sql = "INSERT INTO register (firstname, lastname, middlename, email, password) VALUES (?, ?, ?, ?, ?)";
               $stmt = mysqli_stmt_init($conn);
               if ($stmt) {
                   $preparestmt = mysqli_stmt_prepare($stmt, $sql);
                   if ($preparestmt) {
                       mysqli_stmt_bind_param($stmt, "sssss", $firstname, $lastname, $middlename, $email, $passwordhash);
                       mysqli_stmt_execute($stmt);
                       echo "<div class='alert alert-success' style='padding: 5px; margin-bottom: 5px; color: green;'>Your Account has been created successfully</div>";
                   } else {
                       echo "something went wrong";
                   }
               }
           }
       }
       ?>
       
        <p><span style="color:red">Create an Account</span></p>
        <form action="register.php" method="post">
            <label for="firstname">First Name:</label>
            <input type="text" id="firstname" name="firstname" >

            <label for="lastname">Last Name:</label>
            <input type="text" id="lastname" name="lastname" >

            <label for="mdname">Middle Name:</label>
            <input type="text" id="mdname" name="middlename" >

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" >

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" >

            <label for="cpassword">Confirm Password:</label>
            <input type="password" id="cpassword" name="cpassword">

            <button type="submit" name="submit">Register</button>
        </form>
        <p><span style="color:green">Already have an  Account,</span><span style="color:red"> LogIn Here. </span> </p>
           <a href="login.php"><button class="btn1">log In</button></a>
    </div>
</body>
</html>
