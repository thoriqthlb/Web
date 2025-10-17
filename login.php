<?php
session_start(); // start the session at the top

// valid credentials
$username_valid = "admin";
$password_valid = "secret";

// redirect if form not submitted properly
if (!isset($_POST['username']) || !isset($_POST['password'])) {
    header("Location: login.html");
    exit;
}

$username = $_POST['username'];
$password = $_POST['password'];

// authentication
if ($username === $username_valid && $password === $password_valid) {
    
    // initialize login tracking if not exist
    if (!isset($_SESSION['login_history'])) {
        $_SESSION['login_history'] = [];
    }

    // record this login
    $_SESSION['login_history'][] = [
        'username' => $username,
        'login_dt' => date("Y-m-d H:i:s")
    ];

    // count number of logins
    $login_count = count($_SESSION['login_history']);

    echo "Welcome, <strong>" . htmlspecialchars($username) . "</strong>!<br>";
    echo "You have logged in <strong>" . $login_count . "</strong> time(s).<br><br>";
    echo "<a href='logout.php'>Logout</a><br><br>";

    echo "<pre>";
    print_r($_SESSION['login_history']);
    echo "</pre>";

} else {
    echo "Invalid username or password. <a href='web.html'>Back</a>";
}
?>