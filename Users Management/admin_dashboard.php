<?php
session_start();
include '../inc/config.php';
include'../inc/Navbar.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'Administrator') {
    header("Location: login.php");
    exit();
}

$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';

// Fetch the total number of users and recipes
$userCountQuery = "SELECT COUNT(*) as total_users FROM tbl_users";
$resultUsers = $conn->query($userCountQuery);
$rowUsers = $resultUsers->fetch_assoc();
$totalUsers = $rowUsers['total_users'];

$recipeCountQuery = "SELECT COUNT(*) as total_recipes FROM tbl_recipe";
$resultRecipes = $conn->query($recipeCountQuery);
$rowRecipes = $resultRecipes->fetch_assoc();
$totalRecipes = $rowRecipes['total_recipes'];

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        /* Sidebar */
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

        /* Top Navbar */
        .top-navbar {
            margin-left: 250px;
            padding: 10px 20px;
            background-color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #ddd;
        }

        .search-bar {
            width: 400px;
            padding: 8px;
            font-size: 16px;
            border-radius: 20px;
            border: 1px solid #ddd;
        }

        .navbar-icons {
            display: flex;
            align-items: center;
        }

        .navbar-icons i {
            font-size: 20px;
            margin-right: 15px;
            cursor: pointer;
        }

        .profile-pic {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }

        /* Dashboard Content */
        .dashboard-cards {
            margin-left: 270px;
            margin-top: 30px;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            padding: 20px;
        }

        .card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
        }

        .card h3 {
            font-size: 20px;
            margin-bottom: 15px;
        }

        .card p {
            font-size: 30px;
            font-weight: bold;
            color: #3498db;
        }

        /* Welcome Message */
        .welcome-message {
            position: absolute;
            top: 10px;
            right: 20px;
            font-size: 18px;
            font-weight: bold;
            color: white;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <a href="update.php"><i class="fas fa-edit"></i> Update User Details</a>
        <a href="users.php"><i class="fas fa-users"></i> See User Details</a>
    </div>

    <!-- Top Navbar -->
    <!-- <div class="top-navbar">
        <input type="text" class="search-bar" placeholder="Search...">
        <div class="navbar-icons">
            <i class="fas fa-bell"></i>
            <i class="fas fa-envelope"></i> -->
            <img src="profile-pic.jpg" alt="Profile Picture" class="profile-pic">
        </div>
    </div>

    <!-- Dashboard Cards -->
    <div class="dashboard-cards">
        <div class="card">
            <h3>Total Users</h3>
            <p><?php echo $totalUsers; ?></p>
        </div>
        <div class="card">
            <h3>Total Recipes</h3>
            <p><?php echo $totalRecipes; ?></p>
        </div>
        <!-- Add more cards here for other statistics -->
    </div>

    <!-- Welcome Message -->
    <div class="welcome-message">
        Welcome, <?php echo $username; ?>!
    </div>

</body>
</html>
