<?php
session_start();
include '../inc/Navbar.php';

// Database connection details
$servername = "localhost";
$username = "root";
$password = "rehanais2cool";
$dbname = "recipes";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM tbl_recipe";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chef Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="../inc/Navbarstyle.css?v=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }

        h1 {
            color: white;
        }

        .recipe-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .recipe-card {
            display: flex;
            flex-direction: row;
            align-items: center;
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            overflow: hidden;
            width: 1000px;
            margin: 10px;
            transition: transform 0.2s;
        }

        .recipe-card:hover {
            transform: scale(1.05);
        }

        .recipe-image-container {
            width: 100px;
            height: 100px;
            overflow: hidden;
            margin: 10px;
        }

        .recipe-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 10px 0 0 10px;
        }

        .recipe-details {
            padding: 15px;
        }

        .recipe-details h2 {
            font-size: 1.5em;
            margin: 0 0 10px;
        }

        .recipe-details .description {
            font-size: 1em;
            color: #333;
        }

        .button-container {
            margin-top: 20px;
        }

        .button-container button {
            margin-right: 10px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            background-color: #4CAF50;
            color: white;
            border: none;
        }

        .button-container button:hover {
            background-color: #45a049;
        }

        .welcome-message {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 18px;
            font-weight: bold;
            color:white;
        }
        /*Sidebar */
        .sidebar {
            width: 250px;
            background-color: #2c3e50;
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            padding-top: 20px;
        }

        .sidebar h2 {
            color: white;
            text-align: center;
        }

        .sidebar a {
            padding: 15px 20px;
            text-decoration: none;
            font-size: 18px;
            color: white;
            display: block;
        }

        .sidebar a:hover {
            background-color: #34495e;
        }

    </style>
</head>
<body>
<link rel="stylesheet" href="../inc/Navbarstyle.css?v=1.0">
    <div class="container">
        <h1>My Recipes</h1>
        <div class="welcome-message">Welcome, <?php echo htmlspecialchars($_SESSION["username"]); ?>!</div>
        <!-- <div class="button-container">
            <button onclick="location.href='../Recipe Management/addRecipes.html'">Add Recipes</button>
            <button onclick="location.href='recipes.php'">Edit My Recipes</button>
            <button onclick="location.href='users.php'">View my Profile</button>
            <button onclick="window.location.reload();">Refresh</button>
        </div> -->

        <div class="sidebar">
        <h2>Admin Panel</h2>
        <a href="addRecipes.html"><i class="fas fa-edit"></i> Add Recipes</a>
        <a href="recipes.php"><i class="fas fa-edit"></i> Edit My Recipes</a>
        <a href="users.php"><i class="fas fa-edit"></i> View my Profile</a>
        <!-- <a href="recipes.php"><i class="fas fa-edit"></i> Edit My Recipes</a> -->
        <button onclick="window.location.reload();">Refresh</button>
    </div>

    </div>
    <div class="recipe-container">
        <?php
        // Generate recipe cards
        while ($row = $result->fetch_assoc()) {
            echo '<div class="recipe-card">';
            echo '<div class="recipe-image-container">';
            if (!empty($row["recipe_image"])) {
                echo '<img src="../upload/' . htmlspecialchars($row["recipe_image"]) . '" alt="' . htmlspecialchars($row["recipe_name"]) . '" class="recipe-image">';
            } else {
                echo '<img src="../upload/default_image.jpg" alt="Default Image" class="recipe-image">';
            }
            echo '</div>';
            echo '<div class="recipe-details">';
            echo '<h2>' . htmlspecialchars($row["recipe_name"]) . '</h2>';
            echo '<p class="description">' . htmlspecialchars($row["Description"]) . '</p>';
            echo '</div>';
            echo '</div>';
        }
        // Close connection
        $stmt->close();
        $conn->close();
        ?>
    </div>
</body>
</html>
