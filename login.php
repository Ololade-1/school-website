<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Login Form</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
<div class="container">
<p><span style="color:green">Login Here </span></p>
        <form action="log.php" method="post">
        <?php
if(isset($_GET['error'])) {
    ?>
    <p class="error"><?php echo $_GET['error']; ?></p>
    <?php
}
?>
           
            <label for="email">Email:</label>
            <input type="email" id="email" name="email">

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" >  
            <button type="submit" name="submit">Log In</button>
        </form>
        <p><span style="color:red">If you don't have and account , Register as a New User</span> </p>
        <a href="register.php"><button class="btn1">Create Account</button></a>
</div>
</body>
</html>