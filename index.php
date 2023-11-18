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
    <h2>Author Details</h2>
    <form action="submit_author.php" method="POST">
        <label for="AuthorFullName">Full Name:</label><br>
        <input type="text" name="AuthorFullName" id="AuthorFullName" placeholder="Enter Full Name" maxlength="60" /><br><br>

        <label for="AuthorEmail">Email:</label><br>
        <input type="email" name="AuthorEmail" id="AuthorEmail" placeholder="Enter the Email" maxlength="160" required /><br><br>

        <label for="AuthorAddress">Address:</label><br>
        <input type="text" name="AuthorAddress" id="AuthorAddress" placeholder="Enter the Address" maxlength="60" required/><br><br>

        <label for="AuthorBiography">Biography:</label><br>
        <textarea id="AuthorBiography" name="AuthorBiography" rows="4" cols="50"></textarea><br><br>

        <label for="AuthorDateOfBirth">Date Of Birth:</label><br>
        <input type="date" name="AuthorDateOfBirth" id="AuthorDateOfBirth" placeholder="Enter the Date Of Birth" maxlength="60" required/><br><br>

        <label for="AuthorSuspended">Suspended:</label><br>
        <input type="checkbox" name="AuthorSuspended" id="AuthorSuspended"><br><br>

        <input type="submit" name="send_message" value="Send Message" />
    </form>
</body>
</html>