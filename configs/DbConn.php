<?php
require_once "constants.php";

try {
    $DbConn = new PDO("mysql:host=$hostname; dbname=$dbname", $username, $userpass);
    $DbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected Successfully!! ";
} catch (PDOException $e) {
    // Log the error instead of showing the detailed error message to the user
    error_log("Connection failed: " . $e->getMessage());
    echo "Oops! Something went wrong. Please try again later.";
}
?>
