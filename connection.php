<?php

DEFINE('host', '127.0.0.1');
DEFINE('user', 'root');
DEFINE('password', 'testSQL2020');
//DEFINE('database', 'clockify');

$database = "clockify";

$conn = new mysqli(host, user, password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "<p>Connection successful</p>";

$clock_conn = mysqli_connect(host, user, password, $database);








?>
