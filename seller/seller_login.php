<?php
session_start();
include 'db_connection.php';
if (isset($_SESSION['seller_id'])) {
    unset($_SESSION['seller_id']);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sellername = $_POST['sellername'];
    $password = $_POST['password'];

    $query = "SELECT * FROM sellers WHERE sellername='$sellername'";
    $result = mysqli_query($conn, $query);
    $seller = mysqli_fetch_assoc($result);

    if ($seller && password_verify($password, $seller['password'])) {
        $_SESSION['seller_id'] = $seller['seller_id'];
        header("Location: seller_dashboard.php");
        exit;
    } else {
        $error_message = "Invalid seller name or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
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

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card shadow-lg" style="width: 100%; max-width: 400px;">
        <div class="card-body">
            <h5 class="card-title text-center mb-4">Seller Login</h5>
            <?php if (!empty($error_message)): ?>
                <div class="alert alert-danger text-center"><?= $error_message; ?></div>
            <?php endif; ?>
            <form method="POST" action="">
                <div class="mb-3">
                    <label for="sellername" class="form-label">Seller Name</label>
                    <input type="text" class="form-control" id="sellername" name="sellername" placeholder="Enter your name" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Log In</button>
            </form>
            <p class="mt-3 text-center">
                <a href="seller_signup.php" class="link-primary">Create New Account</a>
            </p>
        </div>
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
</footer><script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
