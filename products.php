<style>
.carousel-img {
    max-height: 480px;
    object-fit: cover;
}

/* Category cards */
.cat-card {
    background: white;
    border-radius: 12px;
    transition: 0.25s;
    box-shadow: 0 2px 10px rgba(0,0,0,0.08);
}
.cat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
}
.cat-icon {
    height: 60px;
    width: 60px;
    object-fit: contain;
}

/* Product cards */
.product-card {
    border: none;
    border-radius: 12px;
    box-shadow: 0 3px 12px rgba(0,0,0,0.08);
    transition: 0.3s;
}
.product-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 10px 28px rgba(0,0,0,0.15);
}

.product-img {
    height: 200px;
    object-fit: contain;
    background: #f9f9f9;
}
</style>

<?php
require_once "db.php";
require_once "header.php";

// filters
$search     = $_GET['search'] ?? '';
$category   = $_GET['category'] ?? '';
$brand      = $_GET['brand'] ?? '';
$min_price  = $_GET['min_price'] ?? '';
$max_price  = $_GET['max_price'] ?? '';

/* ==================================
   FETCH DISTINCT BRANDS FROM DB
==================================== */
$brandsResult = $conn->query("
    SELECT DISTINCT brand 
    FROM products 
    WHERE brand IS NOT NULL AND brand <> '' 
    ORDER BY brand ASC
");

/* ==================================
   BUILD SQL QUERY
==================================== */
$sql = "SELECT * FROM products WHERE 1=1";
$params = [];
$types = "";

// Search
if (!empty($search)) {
    $sql .= " AND (name LIKE ? OR brand LIKE ? OR description LIKE ?)";
    $like = "%$search%";
    $params[] = $like; $params[] = $like; $params[] = $like;
    $types .= "sss";
}

// Category filter
if (!empty($category)) {
    $sql .= " AND LOWER(category) = LOWER(?)";
    $params[] = $category;
    $types .= "s";
}

// Brand filter
if (!empty($brand)) {
    $sql .= " AND LOWER(brand) = LOWER(?)";
    $params[] = $brand;
    $types .= "s";
}

// Min price
if (!empty($min_price)) {
    $sql .= " AND price >= ?";
    $params[] = $min_price;
    $types .= "d";
}

// Max price
if (!empty($max_price)) {
    $sql .= " AND price <= ?";
    $params[] = $max_price;
    $types .= "d";
}

$sql .= " ORDER BY price ASC";

// prepare and execute
$stmt = $conn->prepare($sql);

if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();
?>

<!-- Custom UI CSS -->
<style>
    .filter-container {
        background: white;
        border-radius: 10px;
        padding: 20px;
        height: fit-content;
        box-shadow: 0 3px 12px rgba(0,0,0,0.08);
    }

    .product-card {
        border-radius: 12px;
        border: none;
        overflow: hidden;
        transition: all 0.25s ease-in-out;
        box-shadow: 0 2px 6px rgba(0,0,0,0.08);
    }

    .product-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.18);
    }

    .product-img {
        height: 200px;
        object-fit: contain;
        background: #f9f9f9;
    }

    .price {
        font-size: 20px;
        font-weight: 600;
        color: #0cad00;
    }

    .filter-title {
        font-weight: 600;
        margin-bottom: 10px;
    }

    .search-bar {
        border-radius: 30px;
    }
</style>

<!-- SEARCH SECTION -->
<div class="card shadow-sm p-3 mb-4" style="border-radius:12px;">
    <form class="row g-2">

        <!-- Search -->
        <div class="col-md-4">
            <input type="text" name="search" placeholder="Search products..."
                   value="<?= $search ?>"
                   class="form-control search-bar">
        </div>

        <!-- Category Filter -->
        <div class="col-md-2">
            <select name="category" class="form-select">
                <option value="">All Categories</option>
                <option value="laptop"  <?= ($category=="laptop")?"selected":"" ?>>Laptop</option>
                <option value="gpu"     <?= ($category=="gpu")?"selected":"" ?>>Graphics Cards</option>
                <option value="memory"  <?= ($category=="memory")?"selected":"" ?>>Memory</option>
                <option value="storage" <?= ($category=="storage")?"selected":"" ?>>Storage</option>
                <option value="cpu"     <?= ($category=="cpu")?"selected":"" ?>>CPU</option>
                <option value="monitor" <?= ($category=="monitor")?"selected":"" ?>>Monitor</option>
            </select>
        </div>

        <!-- BRAND FILTER (DYNAMIC) -->
        <div class="col-md-2">
            <select name="brand" class="form-select">
                <option value="">All Brands</option>

                <?php while ($b = $brandsResult->fetch_assoc()): 
                    $value = htmlspecialchars($b['brand']);
                ?>
                    <option value="<?= $value ?>"
                        <?= ($brand == $value) ? "selected" : "" ?>>
                        <?= $value ?>
                    </option>
                <?php endwhile; ?>

            </select>
        </div>

        <!-- Search button -->
        <div class="col-md-2">
            <button class="btn btn-dark w-100">Search</button>
        </div>

    </form>
</div>

<div class="row">

    <!-- FILTERS SIDEBAR -->
    <div class="col-md-3">
        <div class="filter-container">

            <div class="filter-title">Price Range</div>

            <form>

                <div class="mb-2">
                    <input type="number" step="0.01" name="min_price"
                           class="form-control" placeholder="Min" value="<?= $min_price ?>">
                </div>

                <div class="mb-3">
                    <input type="number" step="0.01" name="max_price"
                           class="form-control" placeholder="Max" value="<?= $max_price ?>">
                </div>

                <button class="btn btn-dark w-100">Apply Filter</button>
            </form>

        </div>
    </div>

    <!-- PRODUCT GRID -->
    <div class="col-md-9">

        <h4 class="mb-3">Products (<?= $result->num_rows ?>)</h4>

        <div class="row g-4">
            <?php while ($row = $result->fetch_assoc()): ?>

                <div class="col-md-4">
                    <div class="card product-card">

                        <img src="<?= $row['image_url'] ?>" class="product-img">

                        <div class="card-body">
                            <h6 class="fw-bold"><?= $row['name'] ?></h6>

                            <!-- Brand -->
                            <p class="text-muted small mb-1"><?= $row['brand'] ?></p>

                            <!-- Price -->
                            <div class="price mb-2">$<?= $row['price'] ?></div>

                            <a href="product.php?id=<?= $row['id'] ?>"
                               class="btn btn-dark w-100">View Details</a>
                        </div>

                    </div>
                </div>

            <?php endwhile; ?>
        </div>

    </div>

</div>

<?php require_once "footer.php"; ?>
