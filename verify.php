<?php
// Path to user file
$userFile = "4bc59a221e6a3cc4529810376e06db1a-geniosa-users";

// Get submitted credentials
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
$authenticated = false;

// Read and verify credentials
if (file_exists($userFile)) {
    $lines = file($userFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        list($storedUser, $storedPass) = explode(":", trim($line));
        if ($username === $storedUser && $password === $storedPass) {
            $authenticated = true;
            break;
        }
    }
}

if ($authenticated) {
    header("Location: dashboard.html");
    exit();
} else {
    echo "<h3>Invalid credentials. <a href='login.html'>Try again</a></h3>";
}
?>
