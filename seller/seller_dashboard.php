<?php
session_start();
include 'db_connection.php';

if (!isset($_SESSION['seller_id'])) {
    header("Location: seller_login.php");
    exit;
}

$seller_id = $_SESSION['seller_id'];

$query = "SELECT purchases.purchase_date, books.name, book_images.image_path, 
                 users.username AS buyer_name, users.mobile AS buyer_mobile, users.address AS buyer_address 
          FROM purchases
          JOIN books ON purchases.book_id = books.book_id
          LEFT JOIN book_images ON books.book_id = book_images.book_id
          JOIN users ON purchases.user_id = users.user_id
          WHERE books.seller_id = '$seller_id'";

$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query Failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            font-family: 'Raleway', sans-serif;
            background-color: #f8f9fa;
            color: #343a40;
        }
        .navbar-brand {
            font-weight: 600;
            font-size: 1.5rem;
        }
        .card {
            border: none;
            border-radius: 10px;
            transition: transform 0.2s ease-in-out, box-shadow 0.3s ease;
        }
        .card:hover {
            transform: scale(1.03);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
        }
        .card-img-top {
            height: 200px;
            object-fit: cover;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        .footer {
            background-color: #343a40;
            color: #ffffff;
            text-align: center;
            padding: 10px 0;
            margin-top: 50px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"><b>Book</b>Hives</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="seller_dashboard.php">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="about.html">About</a></li>
                <li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li>
            </ul>
            <a href="../index.php" class="btn btn-outline-dark btn-sm">Back to Home</a>
        </div>
    </div>
</nav>

<div class="container text-center my-5">
    <h2 class="display-6 fw-bold">Welcome, Seller</h2>
    <p class="text-muted">Here are the books purchased by buyers:</p>
</div>

<div class="container">
    <div class="row g-4">
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($order = mysqli_fetch_assoc($result)) {
                echo "
                <div class='col-lg-4 col-md-6 col-sm-12'>
                    <div class='card shadow-sm'>
                        <img src='" . (!empty($order['image_path']) ? $order['image_path'] : "default_image.jpg") . "' class='card-img-top' alt='{$order['name']}'>
                        <div class='card-body'>
                            <h5 class='card-title'>{$order['name']}</h5>
                            <p><strong>Purchase Date:</strong> {$order['purchase_date']}</p>
                            <p><strong>Buyer:</strong> {$order['buyer_name']}</p>
                            <p><strong>Mobile:</strong> {$order['buyer_mobile']}</p>
                            <p><strong>Address:</strong> {$order['buyer_address']}</p>
                        </div>
                    </div>
                </div>";
            }
        } else {
            echo "<p class='text-center'>No purchases found.</p>";
        }
        ?>
    </div>
</div>
<!-- footer -->
<footer class="bg-dark text-center text-lg-start mt-4">
  <div class="container p-4">
    <div class="row">
      <div class="col-lg-6 col-md-12 mb-4">
        <h5 class="text-uppercase text-light">About Us</h5>
        <p class="text-light">
          We are a company dedicated to providing the best services to our customers. Our mission is to deliver quality and excellence in everything we do.
        </p>
      </div>

      <div class="col-lg-3 col-md-6 mb-4 text-light">
        <h5 class="text-uppercase">Links</h5>
        <ul class="list-unstyled">
          <li>
            <a href="#" class="text-light">Home</a>
          </li>
          <li>
            <a href="#" class="text-light">Features</a>
          </li>
          <li>
            <a href="#" class="text-light">Contact</a>
          </li>
          <li>
            <a href="#" class="text-light">Privacy Policy</a>
          </li>
        </ul>
      </div>

      <div class="col-lg-3 col-md-6 mb-4 text-light">
        <h5 class="text-uppercase ">Follow Us</h5>
        <a href="#" class="text-light me-3 "><i class="bi bi-facebook  hover-icon"></i></a>
        <a href="#" class="text-light me-3"><i class="bi bi-twitter hover-icon"></i></a>
        <a href="#" class="text-light me-3"><i class="bi bi-instagram hover-icon"></i></a>
        <a href="#" class="text-light"><i class="bi bi-linkedin hover-icon"></i></a>
      </div>
    </div>
  </div>

  <div class="text-center p-3 bg-light">
    © 2024 <b>Book</b>Hives. All rights reserved.
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
