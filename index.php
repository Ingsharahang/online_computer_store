

<?php
require_once "db.php";
require_once "header.php";

// Featured products (latest 8)
$sql = "SELECT * FROM products ORDER BY id DESC LIMIT 8";
$result = $conn->query($sql);
?>

<!-- ===== HERO CAROUSEL ===== -->
<div id="heroCarousel" class="carousel slide mb-5" data-bs-ride="carousel">

  <div class="carousel-indicators">
    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
  </div>

  <div class="carousel-inner">

    <div class="carousel-item active">
      <img src="https://images.unsplash.com/photo-1518770660439-4636190af475?q=80&w=2000"
           class="d-block w-100 carousel-img">
      <div class="carousel-caption d-none d-md-block">
        <h2 class="fw-bold">Build Your Dream PC</h2>
        <p>Top hardware from the best brands worldwide.</p>
        <a href="products.php" class="btn btn-dark btn-lg px-4">Shop Now</a>
      </div>
    </div>

    <div class="carousel-item">
      <img src="https://images.unsplash.com/photo-1517336714731-489689fd1ca8?q=80&w=2000"
           class="d-block w-100 carousel-img">
      <div class="carousel-caption d-none d-md-block">
        <h2 class="fw-bold">Gaming Gear Sale</h2>
        <p>Save big on keyboards, mice, and headsets.</p>
        <a href="products.php?category=accessories" class="btn btn-dark btn-lg px-4">Browse Deals</a>
      </div>
    </div>

    <div class="carousel-item">
      <img src="https://images.unsplash.com/photo-1518773553398-650c184e0bb3?q=80&w=2000"
           class="d-block w-100 carousel-img">
      <div class="carousel-caption d-none d-md-block">
        <h2 class="fw-bold">Top Brand Components</h2>
        <p>ASUS, MSI, NVIDIA, AMD, Razer, and more.</p>
        <a href="products.php" class="btn btn-dark btn-lg px-4">Explore Now</a>
      </div>
    </div>

  </div>

  <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </button>

  <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
  </button>

</div>


<!-- ===== CATEGORY HIGHLIGHTS ===== -->
<div class="container mb-5">
  <h3 class="text-center fw-bold mb-4">Shop By Category</h3>

  <div class="row g-4 text-center justify-content-center">

    <?php
    $categories = [
      ["laptop", "Laptops", "https://cdn-icons-png.flaticon.com/512/1055/1055687.png"],
      ["gpu", "GPUs", "https://cdn-icons-png.flaticon.com/512/2920/2920181.png"],
      ["cpu", "CPUs", "https://cdn-icons-png.flaticon.com/512/2920/2920171.png"],
      ["memory", "Memory", "https://cdn-icons-png.flaticon.com/512/1250/1250895.png"],
      ["storage", "Storage", "https://cdn-icons-png.flaticon.com/512/4272/4272388.png"],
      ["monitor", "Monitors", "https://cdn-icons-png.flaticon.com/512/6333/6333731.png"],
    ];

    foreach ($categories as $c): ?>
      <div class="col-6 col-md-2">
        <a href="products.php?category=<?= $c[0] ?>" class="text-decoration-none text-dark">
          <div class="cat-card p-3">
            <img src="<?= $c[2] ?>" class="cat-icon mb-2">
            <p class="fw-semibold small"><?= $c[1] ?></p>
          </div>
        </a>
      </div>
    <?php endforeach; ?>

  </div>
</div>


<!-- ===== FEATURED PRODUCTS ===== -->
<div class="container mb-5">

  <div class="text-center mb-4">
    <h3 class="fw-bold">Featured Products</h3>
    <p class="text-muted">Top selling hardware and gaming accessories</p>
  </div>

  <div class="row">
    <?php while ($row = $result->fetch_assoc()): ?>
      <div class="col-md-3 mb-4">
        <div class="card h-100 product-card">

          <img src="<?= $row['image_url']; ?>" class="card-img-top product-img">

          <div class="card-body">
            <h6 class="fw-bold"><?= $row['name']; ?></h6>
            <p class="text-success fw-bold">$<?= $row['price']; ?></p>

            <a href="product.php?id=<?= $row['id']; ?>"
               class="btn btn-dark w-100">
              View Details
            </a>
          </div>

        </div>
      </div>
    <?php endwhile; ?>
  </div>

</div>


<?php require_once "footer.php"; ?>
