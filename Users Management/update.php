<?php
$servername = "localhost";
$username = "root";
$password = "rehanais2cool";
$dbname = "recipes";
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Run the query to select all users
$sql = "SELECT * FROM tbl_users";
$result = $conn->query($sql);

// Check if there are any users
if ($result->num_rows > 0) {
    // Display users on an HTML table
    echo "<table style='border-collapse: collapse;'>";
    echo "<tr><th>Role</th><th>Email</th><th>Password</th><th>Image</th><th>Name</th><th>Edit</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<form method='post' enctype='multipart/form-data'>";
        echo "<input type='hidden' name='email' value='" . $row["email"] . "'>";
        echo "<tr>";
        echo "<td><input type='text' name='role' value='" . $row["role"] . "'></td>";
        echo "<td><input type='email' value='" . $row["email"] . "' readonly></td>";
        echo "<td><input type='password' name='password' value='" . $row["password"] . "'></td>";
        echo "<td><input type='file' name='image' value='" . $row["image"] . "'></td>";
        echo "<td><input type='text' name='name' value='" . $row["name"] . "'></td>";
        echo "<td><button type='submit' name='edit' value='edit'>Edit</button></td>";
        echo "</tr>";
        echo "</form>";
    }
    echo "</table>";
} else {
    echo "No users found";
}

// Check if the edit button was clicked
if (isset($_POST["edit"])) {
    $email = $_POST["email"];
    $role = $_POST["role"];
    $password = $_POST["password"];
    $image = $_FILES["image"]["name"];
    $name = $_POST["name"];

    // Update the user's information in the database
    $sql = "UPDATE tbl_users SET role=?, password=?, image=?, name=? WHERE email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $role, $password, $image, $name, $email);
    $stmt->execute();

    // Upload the new image
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    // Redirect to the same page to display the updated user list
    header("Location: " . $_SERVER["PHP_SELF"]);
    exit;
}

$conn->close();
?>