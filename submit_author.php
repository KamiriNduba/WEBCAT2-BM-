<?php
require_once "configs/constants.php"; // Adjust the path based on your actual folder structure

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $authorFullName = $_POST['AuthorFullName'] ?? '';
    $authorEmail = $_POST['AuthorEmail'] ?? '';
    $authorAddress = $_POST['AuthorAddress'] ?? '';
    $authorBiography = $_POST['AuthorBiography'] ?? '';
    $authorDateOfBirth = $_POST['AuthorDateOfBirth'] ?? '';
    $authorSuspended = isset($_POST['AuthorSuspended']) ? 1 : 0;

    try {
        $DbConn = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $userpass);
        $DbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare SQL statement to insert form data into the database
        $stmt = $DbConn->prepare("INSERT INTO authorstb (AuthorFullName, AuthorEmail, AuthorAddress, AuthorBiography, AuthorDateOfBirth, AuthorSuspended) VALUES (:fullname, :email, :address, :biography, :dob, :suspended)");

        // Bind parameters and execute the statement
        $stmt->bindParam(':fullname', $authorFullName);
        $stmt->bindParam(':email', $authorEmail);
        $stmt->bindParam(':address', $authorAddress);
        $stmt->bindParam(':biography', $authorBiography);
        $stmt->bindParam(':dob', $authorDateOfBirth);
        $stmt->bindParam(':suspended', $authorSuspended);

        $stmt->execute();

        // Provide feedback for successful insertion
        echo "Author registration successful!";
    } catch (PDOException $e) {
        // Handle database errors
        echo "Error: " . $e->getMessage();
    } finally {
        // Close the database connection
        $DbConn = null;
    }
}
?>
