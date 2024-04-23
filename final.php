<?php
session_start();

// Function to clean input using preg_replace
function clean_input($input) {
    return preg_replace("/[^a-zA-Z0-9]/", "", $input);
}

// Function to display the header
function header_section() {
    echo "<h1>CPSC222 Final Exam</h1>";
}

// Function to display the footer with current date and time
function footer() {
    $currentDateTime = (new DateTime())->format('Y-m-d H:i:s');
    echo "<footer>$currentDateTime</footer>";
}

// Function to authenticate against auth.db
function authenticate($username, $password) {
    $file = fopen("auth.db", "r");
    while (($line = fgets($file)) !== false) {
        list($stored_user, $stored_password) = explode("\t", trim($line));
        if ($stored_user === $username && $stored_password === $password) {
            fclose($file);
            return true;
        }
    }
    fclose($file);
    return false;
}

// Log out if the user requests it
if (isset($_GET['logout']) && $_GET['logout'] === 'true') {
    session_destroy();
    header("Location: final.php");
    exit;
}

// If the user is not logged in, show the login form
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header_section();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = clean_input($_POST["username"]);
        $password = clean_input($_POST["password"]);

        if (authenticate($username, $password)) {
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $username;
            header("Location: final.php");
            exit;
        } else {
            echo "<p>Invalid username or password. Please try again.</p>";
        }
    }

    // Login form
    ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        <input type="submit" value="Login">
    </form>
    <?php
    footer();
    return;
}

// Dashboard for authenticated users
header_section();
echo "<p>Welcome, " . $_SESSION['username'] . "!</p>";
echo "<p><a href='final_logout.php'>Logout</a></p>";

// Handle different 'page' GET requests for reports
$page = isset($_GET['page']) ? clean_input($_GET['page']) : "";

// User list report
if ($page === "user_list") {
    echo "<h2>User List Report</h2>";
    echo "<table border='1'>";
    $passwd = file("/etc/passwd");
    foreach ($passwd as $line) {
        echo "<tr><td>$line</td></tr>";
    }
    echo "</table>";
} elseif ($page === "group_list") {
    // Group list report
    echo "<h2>Group List Report</h2>";
    echo "<table border='1'>";
    $group = file("/etc/group");
    foreach ($group as $line) {
        echo "<tr><td>$line</td></tr>";
    }
    echo "</table>";
} elseif ($page === "syslog") {
    // Syslog report
    echo "<h2>Syslog Report</h2>";
    echo "<table border='1'>";
    $syslog = file("/var/log/syslog");
    foreach ($syslog as $line) {
        echo "<tr><td>$line</td></tr>";
    }
    echo "</table>";
} else {
    if ($page !== "") {
        echo "<p>Invalid page. Please try again.</p>";
    }
}

footer();
?>
