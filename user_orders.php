<?php
include 'db_connection.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

$query = "
    SELECT b.name, b.description, b.price, bi.image_path, p.purchase_date
    FROM purchases AS p
    JOIN books AS b ON p.book_id = b.book_id
    LEFT JOIN book_images AS bi ON b.book_id = bi.book_id
    WHERE p.user_id = ?
    ORDER BY p.purchase_date DESC
";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Your Orders</title>
    <style>
        .order-card {
            transition: all 0.3s ease;
        }
        .order-card:hover {
            transform: scale(1.02);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .order-image {
            max-height: 200px;
            object-fit: cover;
        }
    </style>
</head>
<body>
<div class="container my-5">
    <h1 class="mb-4">Your Purchased Books</h1>
    <div class="row">
        <?php
        if ($result->num_rows > 0) {
            while ($order = $result->fetch_assoc()) {
                ?>
                <div class="col-md-4 mb-4">
                    <div class="card order-card">
                        <?php if (!empty($order['image_path'])) { ?>
                            <img src="<?= htmlspecialchars($order['image_path']); ?>" alt="<?= htmlspecialchars($order['name']); ?>" class="card-img-top order-image">
                        <?php } else { ?>
                            <div class="card-img-top d-flex align-items-center justify-content-center" style="height: 200px; background-color: #f8f9fa;">
                                <p class="text-muted">No image available</p>
                            </div>
                        <?php } ?>
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($order['name']); ?></h5>
                            <p class="card-text">Description: <?= htmlspecialchars($order['description']); ?></p>
                            <p class="card-text">Price: ₹<?= htmlspecialchars($order['price']); ?></p>
                            <p class="card-text"><small class="text-muted">Purchased on: <?= htmlspecialchars(date('d M Y, h:i A', strtotime($order['purchase_date']))); ?></small></p>
                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "<p class='text-center'>You haven't purchased any books yet.</p>";
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
</body>
</html>
