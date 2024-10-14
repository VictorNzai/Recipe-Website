<div class="nav">
    <div class="logo"><h1>My Food</h1></div>

    <div class="nav-links">
        <ul>
            <li><a class="navborder" href="../index.php">Home</a></li>
            <li><a class="navborder" href="../index.php#Recipes">Back To Recipes</a></li>
            <li><a class="navborder" href="">Blog</a></li>
            <li><a class="navborder" href="">Privacy Policy</a></li>
            <!-- <li><a href="dashboard.html">Dashboard</a></li>
            <li><a href="my-courses.html">My Courses</a></li> -->
        </ul>
    </div>

    <div class="nav-right">
        <i class="fas fa-bell"></i>
        <img src="profile-pic.jpg" alt="Profile Picture">
    </div>
</div>

<style>
body {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
    background-image: url('../images/Background image 1.jpg');
    background-size: cover; /* Ensures the image covers the entire body */
    background-position: center; /* Centers the image */
    background-repeat: no-repeat;
    background-attachment: fixed; /* Keeps the background image fixed in place */
}

.nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px;
    background: transparent; /* Make the nav bar background transparent */
}

.logo {
    margin-right: 20px;
    color: white;
}

.nav-links ul {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
}

.nav-links li {
    margin-right: 20px;
}

.nav-links a {
    text-decoration: none;
    color: white;
    font-weight:bold;
}

.nav-right {
    display: flex;
    align-items: center;
    gap: 10px; /* Adjust gap as needed */
}

.nav-right img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
}
</style>
