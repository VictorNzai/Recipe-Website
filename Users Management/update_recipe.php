<?php
include '../inc/config.php';
include '../inc/Navbar.php';

// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $recipe_id = $_POST['recipe_id'];
    $recipe_name = $_POST['recipe_name'];
    $description = $_POST['description'];

    // Update recipe in the database
    $sql = "UPDATE tbl_recipe SET recipe_name = ?, Description = ? WHERE recipe_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssi', $recipe_name, $description, $recipe_id);

    if ($stmt->execute()) {
        // Redirect back to the recipes page
        header('Location: recipes.php');
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $stmt->close();
}

// Close connection
$conn->close();
?>
