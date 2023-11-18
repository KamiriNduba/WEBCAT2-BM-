<?php
// Include the constants file and establish a database connection
require_once "../configs/constants.php"; // Adjust the path based on your actual folder structure

$feedbackMessage = ''; // Initialize feedback message
$author = null; // Initialize author variable

// Check if an AuthorID is provided in the query string
if (isset($_GET['AuthorID'])) {
    try {
        // Establish a PDO connection
        $DbConn = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $userpass);
        $DbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Retrieve details of the selected author
        $query = "SELECT * FROM authors WHERE AuthorID = :authorID";
        $stmt = $DbConn->prepare($query);
        $stmt->bindParam(':authorID', $_GET['AuthorID'], PDO::PARAM_INT);
        $stmt->execute();

        // Fetch the author details
        $author = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set feedback message if the author was found
        if ($author) {
            $feedbackMessage = 'Author details retrieved successfully';
        } else {
            $feedbackMessage = 'Author not found';
        }
    } catch (PDOException $e) {
        // Set feedback message for connection failure
        $feedbackMessage = 'Connection failed: ' . $e->getMessage();
    } finally {
        // Close the connection
        $DbConn = null;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Author</title>
    <!-- Bootstrap CSS link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        textarea,
        input[type="date"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        input[type="checkbox"] {
            margin-bottom: 20px;
        }

        button[type="submit"] {
            padding: 10px 20px;
            border: none;
            background-color: #007bff;
            color: #fff;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        p {
            color: #007bff;
            font-weight: bold;
        }

        p.alert {
            color: red;
        }
    </style>
</head>
<body>

    <div class="container mt-5">
        <h2 class="mb-4">Edit Author</h2>

        <!-- Display feedback message -->
        <p><?php echo $feedbackMessage; ?></p>

        <?php if ($author): ?>
            <!-- Display the author details in an edit form -->
            <form action="submit_author.php" method="POST">
    <label for="AuthorId">Author ID(PK):</label><br>
    <input type="text" name="AuthorId" id="AuthorId" placeholder="Enter the Author Id" maxlength="60" required value="<?php echo $author['AuthorID']; ?>" />

    <label for="AuthorFullName">Full Name:</label><br>
    <input type="text" name="AuthorFullName" id="AuthorFullName" placeholder="Enter Full Name" maxlength="60" /><br><br>

    <label for="AuthorEmail">Email:</label><br>
    <input type="email" name="" id="AuthorEmail" placeholder="Enter the Email" maxlength="160" required /><br><br>

    <label for="AuthorAddress">Address:</label><br>
    <input type="text" name="AuthorAddress" id="AuthorAddress" placeholder="Enter the Address"maxlength="60" required/><br><br>

    <label for="AuthorBiography">Biography:</label><br>
    <textarea id="AuthorBiography" name="AuthorBiography" rows="4" cols="50"></textarea><br><br>

    <label for="AuthorDateOfBirth">Date Of Birth:</label><br>
    <input type="date" name="AuthorDateOfBirth" id="AuthorDateOfBirth" placeholder="Enter the Date Of Birth" maxlength="60"required/><br><br>

    <label for="AuthorSuspended">Suspended:</label><br>
    <input type="checkbox" name="AuthorSuspended" id="AuthorSuspended"><br><br>
    <input type="submit" name="send_message" value="Send Message" />


                <button type="submit" class="btn btn-primary">Save Changes</button>
            </form>
        <?php else: ?>
            <p>No author details available for editing.</p>
        <?php endif; ?>
    </div>

    <!-- Bootstrap JS and Popper.js scripts (required for Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
