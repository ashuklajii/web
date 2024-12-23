<?php
include 'db_connection.php';

$class_level = $_GET['class_level'] ?? '';
$medium = $_GET['medium'] ?? '';

$query = "SELECT b.*, bi.image_path 
          FROM books AS b 
          LEFT JOIN book_images AS bi ON b.book_id = bi.book_id 
          WHERE b.class_level = ? AND b.medium = ?";

$stmt = $conn->prepare($query);
$stmt->bind_param('ss', $class_level, $medium);
$stmt->execute();
$result = $stmt->get_result();
?>

<?php if ($result->num_rows > 0): ?>
    <div class="row">
        <?php while ($book = $result->fetch_assoc()): ?>
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <?php if (!empty($book['image_path'])): ?>
                        <img src="<?= htmlspecialchars($book['image_path']) ?>" 
                             alt="<?= htmlspecialchars($book['name']) ?>" 
                             class="card-img-top" style="max-height: 200px; object-fit: cover;">
                    <?php else: ?>
                        <div class="card-img-top text-center bg-light d-flex align-items-center justify-content-center" 
                             style="height: 200px; color: #999;">
                            <span>No Image Available</span>
                        </div>
                    <?php endif; ?>
                    <div class="card-body">
                        <h5 class="card-title text-primary"><?= htmlspecialchars($book['name']) ?></h5>
                        <p class="card-text">
                            <strong>Price: </strong> ₹<?= htmlspecialchars($book['price']) ?>
                        </p>
                        <p class="card-text">
                            <strong>Description: </strong> <?= htmlspecialchars($book['description']) ?>
                        </p>
                        <p class="card-text">
                            <strong>Class: </strong> <?= htmlspecialchars($book['class_level']) ?>
                        </p>
                        <p class="card-text">
                            <strong>Medium: </strong> <?= htmlspecialchars($book['medium']) ?>
                        </p>
                        <button class="btn btn-outline-primary btn-sm w-100 mt-2" 
                                data-bs-toggle="modal" 
                                data-bs-target="#buyModal" 
                                data-book-id="<?= $book['book_id'] ?>" 
                                data-book-name="<?= htmlspecialchars($book['name']) ?>"
                                data-book-price="<?= htmlspecialchars($book['price']) ?>">
                            Buy Now
                        </button>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
<?php else: ?>
    <div class="text-center p-4">
        <h5 class="text-muted">No books found for Class <?= htmlspecialchars($class_level) ?> in <?= htmlspecialchars($medium) ?> medium.</h5>
    </div>
<?php endif; ?>

<!-- Modal -->
<div class="modal fade" id="buyModal" tabindex="-1" aria-labelledby="buyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="buyModalLabel">Confirm Purchase</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to buy <span id="modalBookName" class="fw-bold"></span> for ₹<span id="modalBookPrice"></span>?</p>
            </div>
            <div class="modal-footer">
                <form id="buyForm" method="POST" action="buy_book.php">
                    <input type="hidden" name="book_id" id="modalBookId">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Yes, Buy</button>
                </form>
            </div>
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
<script>
    const buyModal = document.getElementById('buyModal');
    buyModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const bookId = button.getAttribute('data-book-id');
        const bookName = button.getAttribute('data-book-name');
        const bookPrice = button.getAttribute('data-book-price');
        
        document.getElementById('modalBookName').textContent = bookName;
        document.getElementById('modalBookPrice').textContent = bookPrice;
        document.getElementById('modalBookId').value = bookId;
    });
</script>
