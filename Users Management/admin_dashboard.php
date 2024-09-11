<?php
session_start();

include '../inc/Navbar.php';

if (!isset($_SESSION['role']) || $_SESSION['role']!= 'Administrator') {
    header("Location: login.php");
    exit();
}

$servername = "localhost";
$dbusername = "root";
$password = "rehanais2cool";
$dbname = "recipes";

// Create connection
$conn = new mysqli($servername, $dbusername, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: ". $conn->connect_error);
}

$query = "SELECT * FROM tbl_users";
$result = $conn->query($query);

if (!$result) {
    die("Query failed: ". $conn->error);
}
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="../inc/Navbarstyle.css?v=1.0">
    <title>Admin Dashboard</title>
    <style>

       .button-container {
            margin-top: 20px;
            display:inline-block;
            text-align:center;
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
        h1{
            color:white;
        }
    </style>
</head>
<body>
    
<div class="welcome-message">Welcome, <?php echo ($_SESSION["username"]); ?>!</div>
   
    <h1>Admin Dashboard</h1>
  
    <div class="button-container">
        <button onclick="location.href='update.php'">Update User Details</button>
        <button onclick="location.href='users.php'">See User Details</button>
    </div>
</body>
</html>

<?php
$conn->close();
?>