<?php
session_start();

// cleaning the input
function clean_input($input) {
    return preg_replace("/[^a-zA-Z0-9]/", "", $input);
}

function header_section() {
    echo "<h1>CPSC222 Final Exam</h1>";
}

function footer() {
    $currentDateTime = (new DateTime())->format('Y-m-d H:i:s');
echo "<hr>";   
 echo "<footer>$currentDateTime</footer>";
}

//authentication with  auth.db
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

// logout
if (isset($_GET['logout']) && $_GET['logout'] === 'true') {
    session_destroy();
    header("Location: final.php");
    exit;
}

// showing the login form if user is not yet logged in
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

    ?>
//login
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

// add the header for the whole thing and welcome the user
header_section();
echo "<h3>Welcome, " . $_SESSION['username'] . "! (<a href='final_logout.php'>logout</a>) </h3>";

//display the dashboard function
function display_dashboard() {
echo "<p>Dashboard: </p>";
echo "<ul>";
echo "<li><a href='final.php?page=1'>User List</a></li>";
echo "<li><a href='final.php?page=2'>Group List</a></li>";
echo "<li><a href='final.php?page=3'>Syslog</a></li>";
echo "</ul>";
}

// handling the page and GET requests
$page = isset($_GET['page']) ? trim(clean_input($_GET['page'])) : "";

if ($page === "1") {
    // User list report
echo "<p><a href='final.php'>Return to Dashboard</a></p>";    
echo "<h4>User List Report</h4>";
    echo "<table border='1'>";
    echo "<tr><th>Username</th><th>Password</th><th>UID</th><th>GID</th><th>Display Name</th><th>Home Directory</th><th>Default Shell</th></tr>"; // Header row
    $passwd = file("/etc/passwd");
    foreach ($passwd as $line) {
        $fields = explode(":", $line);
        echo "<tr>";
        foreach ($fields as $field) {
            echo "<td>$field</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
} elseif ($page === "2") {
    // Group list report
echo "<p><a href='final.php'>Return to Dashboard</a></p>"; 
    echo "<h4>Group List Report</h4>";
    echo "<table border='1'>";
    echo "<tr><th>Group Name</th><th>Password</th><th>GID</th><th>Members</th>";
    $group = file("/etc/group");
    foreach ($group as $line) {
        $fields = explode(":", $line);
        echo "<tr>";
        foreach ($fields as $field) {
            echo "<td>$field</td>";
        }
        echo "</tr>";
    }
    echo "</table>";

} elseif ($page === "3") {
    // Syslog report
echo "<p><a href='final.php'>Return to Dashboard</a></p>"; 
    echo "<h4>Syslog Report</h4>";
    $syslog_lines = file("/var/log/syslog");
echo "<table border='1'>";
echo "<tr><th>Date</th><th>Host Name</th><th>Application[PDI]</th><th>Message</th></tr>";
foreach ($syslog_lines as $line) {
    $parts = explode(' ', $line, 5);
    if (count($parts) === 5) {
        $date_time = $parts[0] . ' ' . $parts[1] . ' ' . $parts[2];
        $host_name = $parts[3];
        $rest = explode(':', $parts[4], 2);
        $application = $rest[0];
        $message = $rest[1];
        echo "<tr><td>$date_time</td><td>$host_name</td><td>$application</td><td>$message</td></tr>";
    }
}
echo "</table>";
} else {
display_dashboard();
    if ($page !== "") {
        echo "<p>Invalid page. Please try again.</p>";
    }
}

//footer for the whole thing, just calling the function I made earlier
footer();
?>

