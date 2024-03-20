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
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <header>
       
        <a href="logout.php"><button class="btn1">Log Out</button></a>
        <h1>Arizona ICT College</h1> 
        <h2>Hello, <span style="color:green">
        <?php echo isset($_SESSION['firstname']) ? $_SESSION['firstname'] : 'Firstname'; ?>!</span></h2>
        </header>
       <p><span style="color:green">Fill out the required information </span></p>
       <div class="head">
  <div id="sidebar">
    <ul>
      <li onclick="displayInfo('personal')">Personal Details</li>
      <li onclick="displayInfo('address')">Address</li>
      <li onclick="displayInfo('education')">Education</li>
      <li onclick="displayInfo('documents')">Programs</li>
      <li onclick="displayInfo('documents')">Upload Documents</li>
      <li onclick="displayInfo('documents')">Entry term</li>

    </ul>
  </div>

  <div id="content">
   
  </div>
  </div>

  <script>
  function displayInfo(section) {
    var contentDiv = document.getElementById('content');
    var content = '';

    switch (section) {
      case 'personal':
        content = '<h2>Personal Details</h2>';
        content += '<form id="personalForm">';

        content += '<label for="name">Firstname:</label>';
        content += '<input type="text" id="name" name="firstname"><br>';

        content += '<label for="name">MIDDLENAME:</label>';
        content += '<input type="text" id="name" name="middlename"><br>';

        content += '<label for="name">LASTNAME:</label>';
        content += '<input type="text" id="name" name="lastname"><br>';
      
        content += '<label for="name">DATE OF BIRTH:</label>';
        content += '<input type="date" id="name" name="lastname"><br><br>';

        
        content += '<label for="name">GENDER:</label>';
        content += '<input type="checkbox" id="male" name="gender" value="male"><label for="name">MALE:</label>';
        content += '<input type="checkbox" id="female" name="female"value="female><label for="name">FEMALE:</label><br><br>';

        
        content += '<label for="name">MOBILE NUMBER:</label>';
        content += '<input type="number" id="name" name="mobile"><br>';

        content += '<label for="email">Email:</label>';
        content += '<input type="email" id="email" name="email"><br>';


        content += '<div class="btn-group">';
        content += '<input type="button" value="Previous" onclick="goBack()"> ';
        content += '<input type="button" value="Next" onclick="goNext()">';
        content += '</div>';
        content += '</form>';
        break;
      case 'address':
        content = '<h2>Address</h2><p>123 Main Street</p><p>City: Anytown</p><p>Country: USA</p>';
        break;
      case 'education':
        content = '<h2>Education</h2><p>Degree: Bachelor of Science</p><p>School: University XYZ</p>';
        break;
      case 'documents':
        content = '<h2>Upload Documents</h2>';
        content += '<form id="uploadForm">';
        content += '<label for="file">Choose File:</label>';
        content += '<input type="file" id="file" name="file">';
        content += '<input type="button" value="Previous" onclick="goBack()"> ';
        content += '<input type="button" value="Next" onclick="goNext()">';
        content += '</form>';
        break;
      default:
        content = '<h2>Content Not Found</h2>';
    }

    contentDiv.innerHTML = content;
    contentDiv.style.display = 'block';
  }

  function goNext() {
   
  }

  function goBack() {
    
  }
</script>
</body>
</html>

