<?php
include 'db_connection.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = ($_POST['password']);
    $mobile = $_POST['mobile'];
    $address = $_POST['address'];

    $query = "INSERT INTO users (username, password, mobile, address) VALUES ('$username', '$password', '$mobile', '$address')";
    mysqli_query($conn, $query);
    header("Location: user_login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Signup</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css" integrity="sha512-dPXYcDub/aeb08c63jRq/k6GaKccl256JQy/AnOq7CAnEZ9FzSL9wSbcZkMp4R26vBsMLFYH4kQ67/bbV8XaCQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center" style="min-height: 100vh;">
<nav class="navbar navbar-expand-sm fixed-top bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><b>Book</b>Hives</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="shop.php">Shop</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Features</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact</a>
        </li>
      </ul>
      <div class="d-flex">
        <i class="bi bi-search margin-right-6 me-4 hover-icon"></i>
        <i class="bi bi-cart3 margin-right-6 me-4 hover-icon"></i>
        <a href="user_signup.php"><i class="bi bi-person-circle margin-right-6 me-4 hover-icon  "> </i> </a>     
      </div>
    </div>
  </div>
</nav>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <form method="post" action="" class="bg-white p-4 rounded shadow">
                <h2 class="text-center mb-4">User Signup</h2>
                
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" id="username" name="username" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="mobile" class="form-label">Mobile</label>
                    <input type="text" id="mobile" name="mobile" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <textarea id="address" name="address" class="form-control"></textarea>
                </div>

                <button type="submit" class="btn btn-primary w-100">Sign Up</button>
                <p class="text-center mt-3">
                    <a href="user_login.php" class="text-decoration-none">Already have an account?</a>
                </p>
            </form>
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
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
