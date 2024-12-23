<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Books</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="index.css">

    <style>
        body {
            background-color: #f8f9fa;
        }
        .book-entry {
            background-color: #fff;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #6c757d;
            text-align: center;
            margin-top: 20px;
        }
        .navbar {
            background-color: #6c757d;
        }
        .navbar .navbar-brand {
            color: #fff;
        }
        .navbar .navbar-nav .nav-link {
            color: #f8f9fa;
        }
        .navbar .navbar-nav .nav-link:hover {
            color: #fff;
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

<div class="container mt-5 pt-5">
    <h2 class="mb-4">Add Books</h2>
    <form action="process_books.php" method="POST" enctype="multipart/form-data">
        <div id="book-container">
            <div class="book-entry">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Book Name</label>
                        <input type="text" class="form-control" name="book_name[]" placeholder="Enter Book Name" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Price</label>
                        <input type="number" class="form-control" name="price[]" placeholder="Enter Price" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea class="form-control" name="description[]" rows="2" placeholder="Enter Description" required></textarea>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Class Level</label>
                        <select class="form-select" name="class_level[]" required>
                            <option value="" disabled selected>Select Class</option>
                            <option value="9th">9th</option>
                            <option value="10th">10th</option>
                            <option value="11th">11th</option>
                            <option value="12th">12th</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Medium</label>
                        <select class="form-select" name="medium[]" required>
                            <option value="" disabled selected>Select Medium</option>
                            <option value="Hindi">Hindi</option>
                            <option value="English">English</option>
                            <option value="Gujarati">Gujarati</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Upload Images</label>
                    <input type="file" class="form-control" name="images[][file]" multiple required>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-between mt-3">
            <button type="button" class="btn btn-outline-primary" onclick="addBookEntry()">
                <i class="fas fa-plus"></i> Add Another Book
            </button>
            <button type="submit" class="btn btn-success">
                <i class="fas fa-upload"></i> Submit
            </button>
            <a href="seller_dashboard.php" class="btn btn-secondary">Back</a>
        </div>
    </form>
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
<script>
    function addBookEntry() {
        const container = document.getElementById('book-container');
        const newEntry = document.createElement('div');
        newEntry.classList.add('book-entry');
        newEntry.innerHTML = `
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Book Name</label>
                    <input type="text" class="form-control" name="book_name[]" placeholder="Enter Book Name" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Price</label>
                    <input type="number" class="form-control" name="price[]" placeholder="Enter Price" required>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea class="form-control" name="description[]" rows="2" placeholder="Enter Description" required></textarea>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Class Level</label>
                    <select class="form-select" name="class_level[]" required>
                        <option value="" disabled selected>Select Class</option>
                        <option value="9th">9th</option>
                        <option value="10th">10th</option>
                        <option value="11th">11th</option>
                        <option value="12th">12th</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Medium</label>
                    <select class="form-select" name="medium[]" required>
                        <option value="" disabled selected>Select Medium</option>
                        <option value="Hindi">Hindi</option>
                        <option value="English">English</option>
                        <option value="Gujarati">Gujarati</option>
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Upload Images</label>
                <input type="file" class="form-control" name="images[][file]" multiple required>
            </div>
        `;
        container.appendChild(newEntry);
    }
</script>
</body>
</html>
