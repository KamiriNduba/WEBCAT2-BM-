<?php
// Include the constants file and establish a database connection
require_once "../configs/constants.php"; // Adjust the path based on your actual folder structure
$DbConn = null;
try {
    // Establish a PDO connection
    $DbConn = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $userpass);
    $DbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // SQL query to retrieve authors in ascending order by AuthorFullName
    $query = "SELECT * FROM authorstb ORDER BY AuthorFullName ASC";

    // Prepare and execute the statement
    $stmt = $DbConn->prepare($query);
    $stmt->execute();

    // Fetch all rows from the result set
    $authors = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
} finally {
    // Close the connection
    $DbConn = null;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Author Details Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        textarea,
        input[type="date"] {
            width: calc(100% - 12px);
            padding: 8px;
            margin-bottom: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        input[type="checkbox"] {
            margin-bottom: 20px;
        }

        input[type="submit"] {
            padding: 10px 20px;
            border: none;
            background-color: #007bff;
            color: #fff;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">View Authors</h2>
        <table>
            <thead>
                <tr>
                    <th>Author ID</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Address</th>
                    <!-- Add other necessary columns -->
                </tr>
            </thead>
            <tbody>
                <?php
                require_once "configs/constants.php";

                try {
                    $DbConn = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $userpass);
                    $DbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $query = "SELECT * FROM authorstb";
                    $stmt = $DbConn->query($query);

                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td>" . $row['AuthorId'] . "</td>";
                        echo "<td>" . $row['AuthorFullName'] . "</td>";
                        echo "<td>" . $row['AuthorEmail'] . "</td>";
                        echo "<td>" . $row['AuthorAddress'] . "</td>";
                        echo "</tr>";
                    }
                } catch (PDOException $e) {
                    echo "Connection failed: " . $e->getMessage();
                } finally {
                    $DbConn = null;
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>