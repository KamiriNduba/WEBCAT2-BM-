CREATE TABLE IF NOT EXISTS authorstb (
    AuthorId INT AUTO_INCREMENT PRIMARY KEY,
    AuthorFullName VARCHAR(100) NOT NULL,
    AuthorEmail VARCHAR(100) NOT NULL,
    AuthorAddress VARCHAR(255),
    AuthorBiography TEXT,
    AuthorDateOfBirth DATE,
    AuthorSuspended BOOLEAN
);
