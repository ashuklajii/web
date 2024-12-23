<?php
include 'db_connection.php';
session_start();

$classQuery = "SELECT DISTINCT class_level FROM books order by class_level ASC";
$classResult = mysqli_query($conn, $classQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css" integrity="sha512-dPXYcDub/aeb08c63jRq/k6GaKccl256JQy/AnOq7CAnEZ9FzSL9wSbcZkMp4R26vBsMLFYH4kQ67/bbV8XaCQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .class-card, .medium-buttons, .book-details {
            display: none;
        }
        .card:hover {
            cursor: pointer;
            transform: scale(1.05);
            transition: transform 0.3s ease-in-out;
        }
        .medium-buttons button {
            margin: 0.5rem;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-sm fixed-top bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><b>Book</b>Hives</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="shop.php">Shop</a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link" href="about.php">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contact.php">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="seller/seller_dashboard.php">sell your book</a>
        </li>
      </ul>
      <div class="d-flex">
      <a href="seller/seller_dashboard.php "><i class="bi bi-coin margin-right-6 me-4 hover-icon"></i></a>
      <a href="my_purchases.php"><i class="bi bi-bag-fill  margin-right-6 me-4 hover-icon"></i></a>
            <!-- <a href="user_signup.php"><i class="bi bi-person-circle margin-right-6 me-4 hover-icon  "> </i> </a>      -->
        <a href="user_signup.php"><i class="bi bi-person-circle margin-right-6 me-4 hover-icon  "> </i> </a>     

      </div>
    </div>
  </div>
</nav>
<div class="container mt-5 pt-3">
    <h2 class="text-center">Books</h2>
    <div class="row" id="class-cards">
        <?php while ($class = mysqli_fetch_assoc($classResult)): ?>
            <div class="col-md-3">
                <div class="card class-card" data-class="<?= htmlspecialchars($class['class_level']) ?>">
                    <div class="card-body text-center">
                        <h5 class="card-title"> Class <?= htmlspecialchars($class['class_level']) ?></h5>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>

    <div class="text-center medium-buttons mt-4" id="medium-buttons">
        <h4>Select Medium</h4>
        <button class="btn btn-primary medium-btn" data-medium="Hindi">Hindi</button>
        <button class="btn btn-primary medium-btn" data-medium="English">English</button>
        <button class="btn btn-primary medium-btn" data-medium="Gujarati">Gujarati</button>
    </div>

    <!-- Book Details -->
    <div class="row book-details mt-4" id="book-details"></div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const classCards = document.querySelectorAll('.class-card');
        const mediumButtons = document.getElementById('medium-buttons');
        const bookDetails = document.getElementById('book-details');

        let selectedClass = '';

        classCards.forEach(card => {
            card.style.display = 'block'; 
            card.addEventListener('click', () => {
                selectedClass = card.getAttribute('data-class');
                mediumButtons.style.display = 'block'; 
                bookDetails.style.display = 'none'; 
            });
        });

        const mediumBtns = document.querySelectorAll('.medium-btn');
        mediumBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                const selectedMedium = btn.getAttribute('data-medium');
                fetchBooks(selectedClass, selectedMedium);
            });
        });

        function fetchBooks(classLevel, medium) {
            fetch(`fetch_books.php?class_level=${classLevel}&medium=${medium}`)
                .then(response => response.text())
                .then(data => {
                    bookDetails.innerHTML = data;
                    bookDetails.style.display = 'flex';
                    bookDetails.style.flexWrap = 'wrap';
                });
        }
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
