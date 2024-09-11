<?php

include '../inc/config.php';

// Assume $chef_id or $chef_name is set when the chef logs in
$chef_name = $_SESSION['chef_name']; // or $chef_id, depending on your login system

// Query to fetch recipes owned by the current chef
$sql = "SELECT recipe_name, recipe_owner, Description, recipe_image FROM tbl_recipe WHERE recipe_owner = '$chef_name'";
$result = $conn->query($sql);

?>

<!-- HTML code remains the same -->

<div class="recipe-container">
    <?php
    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo '<div class="recipe-card">';
            echo '<div class="recipe-image-container">';
            if (!empty($row["recipe_image"])) {
                echo '<img src="../upload/'. $row["recipe_image"]. '" alt="'. $row["recipe_name"]. '" class="recipe-image">';
            } else {
                echo '<img src="../upload/default_image.jpg" alt="Default Image" class="recipe-image">';
            }
            echo '</div>';
            echo '<div class="recipe-details">';
            echo '<h2>'. $row["recipe_name"]. '</h2>';
            echo '<p class="owner">By: '. $row["recipe_owner"]. '</p>';
            echo '<p class="description">'. $row["Description"]. '</p>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo "0 results";
    }
    $conn->close();
   ?>
</div>