<?php
include('database.php');

session_start();
if (!isset($_SESSION['email'])) {
    header("location: login.php");
    exit();
}

$email = $_SESSION['email'];
$sql = "SELECT firstname FROM register WHERE email = ? ";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($row = mysqli_fetch_assoc($result)) {
 
    $_SESSION['firstname'] = $row['firstname'];
} else {
   
    $_SESSION['firstname'] = ""; 
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Start New Application</title>
    <link rel="stylesheet" href="startnew.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.html">Profile</a></li>
                <li><a href="admission.html"></a></li> 
            </ul>
        </nav>
        <a href="logout.php"><button class="btn1">Log Out</button></a>
        <h1>Arizona ICT College</h1>
    </header>
    
    <div class="con">
        <p>Welcome, <span style="color:green"><?php echo isset($_SESSION['firstname']) ? $_SESSION['firstname'] : 'Firstname'; ?>! </span><br> Welcome to Arizona ICT College as our<span style="color:green"> New Intake</span></p>
            <a href="dashboard.php"><div class="new">
                Start a new Application
            </div></a>

            <a href="#"><div class="continue">
               Continue your Applications
            </div></a>
            <div class="learn">

            <p>Learn more about our entry requirement for each Programs, if qualified for the program you will surely be accepted .<br>Note there is a <span style="color:red">#60,000 Non refundable application fee</span> and we don't waive application fee for student.</p>
            </div>
    
    
    </div>
</body>
</html>
