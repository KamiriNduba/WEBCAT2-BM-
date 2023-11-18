<?php
require_once "../configs/constants.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize data received from the form
    $authorFullName = filter_input(INPUT_POST, 'AuthorFullName', FILTER_SANITIZE_STRING);

    try {
        $DbConn = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $userpass);
        $DbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Modify the INSERT statement to include all necessary fields
        $stmt = $DbConn->prepare("INSERT INTO authorstb (AuthorFullName, AuthorEmail, AuthorAddress, AuthorBiography, AuthorDateOfBirth, AuthorSuspended) VALUES (:authorFullName, :authorEmail, :authorAddress, :authorBiography, :authorDateOfBirth, :authorSuspended)");

        // Bind parameters for all fields
        $stmt->bindParam(':authorFullName', $authorFullName);
        // Bind other parameters similarly...

        // Execute the query
        $stmt->execute();
        echo "Author registration successful!";
    } catch (PDOException $e) {
        // Log errors instead of displaying them directly
        error_log("Error: " . $e->getMessage());
        echo "Oops! Something went wrong. Please try again later.";
    } finally {
        // Close the database connection
        $DbConn = null;
    }
}
?>
