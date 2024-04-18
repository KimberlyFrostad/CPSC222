<!DOCTYPE html>
<html>
<head>
    <h1>Login Page Chapter 13</h1>
</head>
<body>
<?php
//code is from a previous project I had in my internship over the summer, just altered to match the requirements of the assignment
session_start();

function clean_input($input) {
    return preg_replace("/[^a-zA-Z0-9]/", "", $input);
}

if (isset($_GET['logout']) && $_GET['logout'] === 'true') {
    session_destroy();
    header("Location: ".$_SERVER['PHP_SELF']);
    exit;
}

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    echo "<p>Welcome, Admin!</p>";
    echo "<p><a href='?logout=true'>Logout</a></p>";
} else {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = clean_input($_POST["username"]);
        $password = clean_input($_POST["password"]);

        if ($username === "admin" && $password === "password") {
            $_SESSION['logged_in'] = true;
            echo "<p>Welcome, Admin!</p>";
            echo "<p><a href='?logout=true'>Logout</a></p>";
        } else {
            ?>
            <p>Invalid username or password. Please try again.</p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required><br><br>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required><br><br>
                <input type="submit" value="Login">
            </form>
            <?php
        }
    } else {
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br><br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br><br>
            <input type="submit" value="Login">
        </form>
        <?php
    }
}
?>
</body>
</html>

