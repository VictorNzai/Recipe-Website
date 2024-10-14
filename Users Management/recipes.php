<?php

include '../inc/config.php';
include '../inc/Navbar.php';
// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Assume $username is set after a successful login
$username = $_SESSION['username']; 

// Query to fetch recipes owned by the current chef
$sql = "SELECT recipe_id, recipe_name, recipe_owner, Description, recipe_image FROM tbl_recipe ";
$result = $conn->query($sql);

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
            flex-direction: column;
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            overflow: hidden;
            width: 300px;
            margin: 10px;
            padding: 15px;
            transition: transform 0.2s;
        }

        .recipe-card:hover {
            transform: scale(1.05);
        }

        .recipe-image-container {
            width: 100%;
            height: 200px;
            overflow: hidden;
            margin-bottom: 15px;
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
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>My Recipes</h1>
        <div class="button-container">
            <button onclick="location.href='../Recipe Management/addRecipes.html'">Add Recipes</button>
           <!-- <button onclick="location.href='recipes.php'">Edit My Recipes</button>
            <button onclick="location.href='users.php'">View my Profile</button>-->
            <button onclick="window.location.reload();">Refresh</button>
        </div>
        <div class="recipe-container">
            <?php
            // Generate recipe cards with edit forms
            while ($row = $result->fetch_assoc()) {
                echo '<div class="recipe-card">';
                echo '<div class="recipe-image-container">';
                if (!empty($row["recipe_image"])) {
                    echo '<img src="../upload/'. htmlspecialchars($row["recipe_image"]). '" alt="'. htmlspecialchars($row["recipe_name"]). '" class="recipe-image">';
                } else {
                    echo '<img src="../upload/default_image.jpg" alt="Default Image" class="recipe-image">';
                }
                echo '</div>';
                echo '<div class="recipe-details">';
                echo '<form method="POST" action="update_recipe.php">';
                echo '<input type="hidden" name="recipe_id" value="'. htmlspecialchars($row["recipe_id"]). '">';
                echo '<h2><input type="text" name="recipe_name" value="'. htmlspecialchars($row["recipe_name"]). '"></h2>';
                echo '<p class="description"><textarea name="description">'. htmlspecialchars($row["Description"]). '</textarea></p>';
                echo '<button type="submit">Save Changes</button>';
                echo '</form>';
                echo '</div>';
                echo '</div>';
            }
            // Close connection
            $conn->close();
            ?>
        </div>
        <div class="welcome-message">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</div>
       
    </div>
</body>
</html>
