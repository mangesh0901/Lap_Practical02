<?php
include 'config.php'; // Ensure this is at the very top!

if (!isset($conn)) {
    die("Database connection failed. Please check config.php.");
}

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['message'])) {
        // Get form data and trim it
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $message = trim($_POST['message']);

        // Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            die("Invalid email format. <a href='index.html'>Go Back</a>");
        }

        // Prepare SQL statement
        $stmt = $conn->prepare("INSERT INTO contacts (name, email, message) VALUES (?, ?, ?)");
        if ($stmt === false) {
            die("Error in preparing statement: " . $conn->error);
        }

        // Bind parameters
        $stmt->bind_param("sss", $name, $email, $message);

        // Execute and check success
        if ($stmt->execute()) {
            echo "Message submitted successfully. <a href='index.html'>Go Back</a>";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close statement
        $stmt->close();
    } else {
        echo "All fields are required. <a href='index.html'>Go Back</a>";
    }
} else {
    http_response_code(405); // Method Not Allowed
    echo "Method Not Allowed. Please submit the form. <a href='index.html'>Go Back</a>";
}

// Close the database connection
$conn->close();
?>
