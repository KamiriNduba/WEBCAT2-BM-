<?php
// Include the constants file and establish a database connection
require_once "../configs/constants.php"; // Adjust the path based on your actual folder structure

$feedbackMessage = ''; // Initialize feedback message

// Check if an AuthorID is provided in the query string
if (isset($_GET['AuthorID'])) {
    try {
        // Establish a PDO connection
        $DbConn = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $userpass);
        $DbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare and execute the delete query
        $query = "DELETE FROM authorstb WHERE AuthorID = :authorID";
        $stmt = $DbConn->prepare($query);
        $stmt->bindParam(':authorID', $_GET['AuthorID'], PDO::PARAM_INT);
        $stmt->execute();

        // Check if the delete operation was successful
        if ($stmt->rowCount() > 0) {
            $feedbackMessage = 'Author deleted successfully';
        } else {
            $feedbackMessage = 'Author not found';
        }
    } catch (PDOException $e) {
        // Set feedback message for connection failure or error during deletion
        $feedbackMessage = 'Error: ' . $e->getMessage();
    } finally {
        // Close the connection
        $DbConn = null;
    }
} else {
    // Set feedback message if no AuthorID is provided
    $feedbackMessage = 'No AuthorID provided for deletion';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Author</title>
    <!-- Bootstrap CSS link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        /* Your custom styles here */
    </style>
</head>
<body>

    <div class="container mt-5">
        <h2 class="mb-4">Delete Author</h2>

        <!-- Display feedback message -->
        <p><?php echo $feedbackMessage; ?></p>

        <!-- Back button to return to the author list -->
        <a href="ViewAuthors.php" class="btn btn-primary">Back to Authors List</a>
    </div>

    <!-- Bootstrap JS and Popper.js scripts (required for Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
