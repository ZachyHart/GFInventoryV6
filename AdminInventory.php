<?php
require_once 'helpers/conn_helpers.php';

// check if user is logged in, and check if user is an admin
session_start();
if (!isset($_SESSION["usersName"]) || $_SESSION["role"] !== "admin") {
    header("Location: login.php");
    exit();
}

// Define error messages
$errorMessages = [
    "emptyfields" => "Please fill in all fields.",
    "sqlerror" => "There is an error in the database.",
    "productnametaken" => "Product name is already taken.",
    "notanimage" => "The file is not an image.",
    "fileexists" => "The file already exists.",
    "filetoolarge" => "The file is too large.",
    "invalidfiletype" => "Invalid file type."
];

// Display error message if error parameter is set
if (isset($_GET['error']) && isset($errorMessages[$_GET['error']])) {
    echo "<script>alert('" . $errorMessages[$_GET['error']] . "')</script>";
    echo "<script>window.location.href = window.location.href.split('?')[0];</script>";
}

// Display success message if addproduct parameter is set
if (isset($_GET["addproduct"])) {
    echo "<script>alert('Product added successfully.')</script>";
    echo "<script>window.location.href = window.location.href.split('?')[0];</script>";
}

// Display success message if deleteproduct parameter is set
if (isset($_GET["deleteproduct"])) {
    echo "<script>alert('Product deleted successfully.')</script>";
    echo "<script>window.location.href = window.location.href.split('?')[0];</script>";
}

// Display success message if editproduct parameter is set
if (isset($_GET["editproduct"])) {
    echo "<script>alert('Product edited successfully.')</script>";
    echo "<script>window.location.href = window.location.href.split('?')[0];</script>";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Got Funko Collections</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bowlby+One+SC&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="wrapper">
        <aside id="sidebar">
            <!-- Sidebar content goes here -->
            <div class="sidebar-logo">
                <img src="img/CircularLogo.jpg" alt="Logo"
                    style="width: 100%; max-width: 120px; display: block; margin: 0 auto;">
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-item">
                    <a href="AdminInventory.php" class="sidebar-link" data-page="products" title="Our Products">
                        <i class="lni lni-cart"></i>
                        <span>Our Products</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="AdminFeedback.php" class="sidebar-link" data-page="feedback" title="Feedback">
                      
                        <i class="lni lni-comments"></i>
                        <span>Feedback</span>
                    </a>
                </li>
            </ul>
            <div class="sidebar-footer">
                <form action="controllers/Users.php" method="post" id="logout">
                    <input type="hidden" name="type" value="logout">
                    <a href="javascript:{}" onclick="document.getElementById('logout').submit();" class="sidebar-link"
                        title="Logout" id="logout" type="submit">
                        <i class="lni lni-exit"></i>
                    </a>
                </form>
            </div>
        </aside>

        <div class="main p-3">
            <div class="text-center mb-4">
                <h1 class="inventory-title">Inventory</h1>
            </div>

            <!-- Sort by Category dropdown -->
            <div class="dropdown mx-auto">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="sortCategoryDropdown"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    Sort by Category
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="sortCategoryDropdown">

                    <li><a class="dropdown-item" href="#">Category 1</a></li>
                    <li><a class="dropdown-item" href="#">Category 2</a></li>
                    <li><a class="dropdown-item" href="#">Category 3</a></li>

                </ul>
            </div>


            <button class="btn btn-primary btn-custom-position" type="button" data-bs-toggle="modal"
                data-bs-target="#addProductModal">ADD PRODUCT</button>
            <div class="container">
                <div class="row">
                    <!-- Product Cards -->
                    <?php
                    $sql = 'SELECT * FROM product_table';
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $product_id = $row['product_id'];
                        $product_image = $row['product_image'];
                        $product_name = $row['product_name'];
                        $product_category = $row['product_category'];
                        $price = $row['price'];
                        $stock = $row['stock'];

                        ?>
                        <div class="col-12">
                            <div class="card mb-3">
                                <div class="row g-0 align-items-center">
                                    <div class="col-md-3 col-lg-2">
                                        <input type="hidden" id="product_id" name="product_id"
                                            value="<?php echo $product_id; ?>">
                                        <img src=" img/products/<?php echo $product_image; ?>"
                                            class="img-fluid rounded-start product-img-custom" alt="Product Image">
                                    </div>
                                    <div class="col-md-9 col-lg-10">
                                        <div class="card-body">
                                            <p class="card-text"><small class="text-category">
                                                    <?php echo $product_category; ?>
                                                </small></p>
                                            <h5 class="card-title">
                                                <?php echo $product_name; ?>
                                            </h5>
                                            <p class="card-text">₱
                                                <?php echo $price; ?>
                                            </p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <p class="card-text"><small class="text-category">In stock x
                                                        <?php echo $stock; ?>
                                                    </small></p>
                                                <!-- Edit button with data attributes -->
                                                <div class="d-flex gap-3">
                                                    <button class="btn btn-edit" type="button" data-bs-toggle="modal"
                                                        data-bs-target="#editProductModal"
                                                        data-product-name="<?php echo $product_name; ?>"
                                                        data-product-id=" <?php echo $product_id; ?>"
                                                        data-product-category="<?php echo $product_category; ?>"
                                                        data-price=" <?php echo $price; ?>" data-stock="<?php echo $stock;
                                                           ?>">
                                                        Edit
                                                    </button>
                                                    <button class="btn btn-delete" type="button" data-bs-toggle="modal"
                                                        data-product-id="<?php echo $product_id; ?>"
                                                        data-bs-target=" #deleteProductModal">
                                                        Delete
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>

        </div>
    </div>

    <!-- Add Product Modal -->
    <div class=" modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h5 class="modal-title w-100" id="addProductModalLabel">Add
                        New Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form id="addProductForm" method="post" action="./controllers/addProduct.php"
                        enctype="multipart/form-data">
                        <div class=" mb-3">
                            <label for="productImage" class="form-label">Product
                                Image</label>
                            <input type="file" class="form-control" id="product_image" required accept="image/*"
                                name="product_image">
                        </div>
                        <div class="mb-3">
                            <label for="productCategory" class="form-label">Product Category</label>
                            <input type="text" class="form-control" id="product_category" name="product_category"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="productName" class="form-label">Product
                                Name</label>
                            <input type="text" class="form-control" id="product_name" name="product_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="productPrice" class="form-label">Price</label>
                            <input type="number" class="form-control" id="price" name="price" required>
                        </div>
                        <div class="mb-3">
                            <label for="productStock" class="form-label">Stock
                                Level</label>
                            <input type="number" class="form-control" id="stock" name="stock" required>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-save-product">Save
                                Product</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit modal -->
    <div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title w-100" id="editProductModalLabel">Edit Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editProductForm" method="post" action="./controllers/editProduct.php"
                    enctype="multipart/form-data">
                    <input type="hidden" id="product_id" name="product_id">
                    <div class=" mb-3">
                        <label for="productImage" class="form-label">Product Image</label>
                        <input type="file" class="form-control" id="product_image_edit" accept="image/*"
                            name="product_image" disabled>
                    </div>
                    <div class="mb-3">
                        <input type="checkbox" id="changeImage" name="changeImage" value="changeImage">
                        <label for="changeImage">Change Image</label>
                    </div>
                    <input type="hidden" id="product_image_old" name="product_image_old">
                    <div class="mb-3">
                        <label for="productCategory" class="form-label">Product Category</label>
                        <input type="text" class="form-control" id="product_category" name="product_category">
                    </div>
                    <div class="mb-3">
                        <label for="productName" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="product_name" name="product_name">
                    </div>
                    <div class="mb-3">
                        <label for="productPrice" class="form-label">Price</label>
                        <input type="number" class="form-control" id="price" name="price">
                    </div>
                    <div class="mb-3">
                        <label for="productStock" class="form-label">Stock Level</label>
                        <input type="number" class="form-control" id="stock" name="stock">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-save-product">Save Product</button>
                    </div>
                   
                    
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete modal -->
<div class="modal fade" id="deleteProductModal" tabindex="-1" aria-labelledby="deleteProductModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title w-100" id="deleteProductModalLabel">Delete Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="deleteProductForm" method="post" action="./controllers/deleteProduct.php">
                    <input type="hidden" id="delete_product_id" name="product_id">
                    <p class="text-center">Are you sure you want to delete this product?</p>
                    <div class="text-center">
                        <button type="submit" class="btn btn-danger btn-delete-product">Delete Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


    <!-- Delete modal -->
    <div class="modal fade" id="deleteProductModal" tabindex="-1" aria-labelledby="deleteProductModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h5 class="modal-title w-100" id="deleteProductModalLabel">Delete
                        Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form id="deleteProductForm" method="post" action="./controllers/deleteProduct.php">
                        <input type="hidden" id="delete_product_id" name="product_id">
                        <p class="text-center">Are you sure you want to delete this product?</p>
                        <div class="text-center">
                            <button type="submit" class="btn btn-danger btn-delete-product">Delete
                                Product</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
        </script>
    <script src="AdminInventory.js"></script>
</body>

</html>