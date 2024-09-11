<?php
include '../inc/Navbar.php';


session_start();

//$_SESSION["username"] = $name;
//$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>User Profile</title>
    <style>
       .button-container {
            margin-top: 20px;
        }
       .button-container button {
            margin-right: 10px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }
       .welcome-message {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 18px;
            font-weight: bold;
            color:white;
        }
        
ul li ul.dropdown li{
    display: block;
   }
   ul li ul.dropdown{
    width: 100%;
    background:  #ff004f;
    position: absolute;
    z-index: 999;
    display: none;
    opacity: 0; /* Initially hide the dropdown */
    transition: opacity 0.3s ease;
   }

   ul li a:hover{
    background:  #ff004f;
   }
ul li:hover ul.dropdown{
  display: block;
  opacity: 1;
}
ul li a:hover {
  background: none; /* Remove background color on hover for main links */
}
    </style>
     
     <link rel="stylesheet" href="../style.css?v=1.0">
     <link rel="stylesheet" href="../inc/Navbarstyle.css">
     <link rel="stylesheet" href="../inc/Navbarstyle.css?v=1.0">
     
</head>
<body>
    <br>
    <h1>User Profile</h1>
  
    <div class="button-container">
        <button onclick="location.href='../Recipe Management/addRecipes.html'">Add Recipes</button>
        <button onclick="location.href='recipes.php'">Edit My Recipes</button>
        <button onclick="location.href='users.php'">View my Profile</button>
        <div class="welcome-message">Welcome, <?php echo ($_SESSION["username"]);?>!</div>
    </div>
</body>
</html>