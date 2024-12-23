<?php
// process_books.php

// Database connection
require "db_connection.php";

// Start the session
session_start();
$seller_id = $_SESSION['seller_id']; // Ensure this is set when the seller logs in

// Check if the form has been submitted and the expected data is present
if (isset($_POST['book_name']) && is_array($_POST['book_name'])) {
    // Loop through each book entry
    for ($i = 0; $i < count($_POST['book_name']); $i++) {
        $book_name = $_POST['book_name'][$i];
        $description = $_POST['description'][$i];
        $price = $_POST['price'][$i];
        $class_level = $_POST['class_level'][$i];
        $medium = $_POST['medium'][$i];

        // Prepare the statement including seller_id, class_level, and medium
        $stmt = $conn->prepare("INSERT INTO books (name, description, price, seller_id, class_level, medium) VALUES (?, ?, ?, ?, ?, ?)");
        if ($stmt === false) {
            die("Error preparing statement: " . $conn->error);
        }

        // Bind parameters
        $stmt->bind_param("ssdiss", $book_name, $description, $price, $seller_id, $class_level, $medium);
        $stmt->execute();

        // Check for execution errors
        if ($stmt->error) {
            echo "Error executing query: " . $stmt->error;
            continue; // Skip to the next book if there's an error
        }

        $book_id = $stmt->insert_id; // Get the last inserted book ID

        // Handle file uploads
        if (isset($_FILES['images']) && isset($_FILES['images']['name'][$i]) && !empty($_FILES['images']['name'][$i])) {
            foreach ($_FILES['images']['name'][$i] as $key => $image_name) {
                if ($_FILES['images']['error'][$i][$key] === UPLOAD_ERR_OK) {
                    $targetDir = "uploads/";
                    $targetFile = $targetDir . basename($image_name);

                    // Move the uploaded file
                    if (move_uploaded_file($_FILES['images']['tmp_name'][$i][$key], $targetFile)) {
                        $stmt = $conn->prepare("INSERT INTO book_images (book_id, image_path) VALUES (?, ?)");
                        if ($stmt === false) {
                            die("Error preparing image statement: " . $conn->error);
                        }

                        $stmt->bind_param("is", $book_id, $targetFile);
                        $stmt->execute();
                        if ($stmt->error) {
                            echo "Error executing image query: " . $stmt->error;
                        } else {
                            echo "Image uploaded and path stored for book ID: " . $book_id . "<br>";
                        }
                    } else {
                        echo "Failed to move uploaded file " . $image_name . "<br>";
                    }
                } else {
                    echo "Error uploading file " . $image_name . ": " . $_FILES['images']['error'][$i][$key] . "<br>";
                }
            }
        }
    }

    echo "Books added successfully!";
} else {
    echo "No books were submitted. Please go back and fill out the form.";
}

$conn->close();
?>
