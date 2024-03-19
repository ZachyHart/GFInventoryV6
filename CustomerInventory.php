<?php
require_once 'helpers/conn_helpers.php';
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
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bowlby+One+SC&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        /* Additional CSS styles */
    </style>
</head>

<body>
    <div class="wrapper">
        <aside id="sidebar">
            <!-- Logo at the top of the sidebar -->
            <div class="sidebar-logo">
                <img src="img/CircularLogo.jpg" alt="Logo"
                    style="width: 100%; max-width: 120px; display: block; margin: 0 auto;">
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-item">
                    <a href="CustomerInventory.php" class="sidebar-link" title="Our Products">
                        <i class="lni lni-cart"></i>
                        <span><br>Our Products</span>
                    </a>
                </li>
                <!-- Second sidebar item for Feedback -->
                <li class="sidebar-item">
                    <a href="CustomerFeedback.php" class="sidebar-link" title="Feedback">
                        <i class="lni lni-comments"></i>
                        <span>Feedback</span>
                    </a>
                </li>
                <!-- Add more sidebar items here -->
            </ul>
            <div class="sidebar-footer">
                <form action="controllers/Users.php" method="post" id="logout">
                    <input type="hidden" name="type" value="logout">
                    <a href="javascript:{}" onclick="document.getElementById('logout').submit();"
                        class="sidebar-link" title="Logout" id="logout" type="submit">
                        <i class="lni lni-exit"></i>
                    </a>
                </form>
            </div>
        </aside>

        <div class="main p-3">
            <div class="text-center">
                <div class="inventory-title">PRODUCTS LIST</div>
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

            <div class="container my-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product-display">
                            <?php
                            $sql = "SELECT * FROM product_table";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '<div class="product-display-item d-flex flex-column flex-md-row align-items-md-center justify-content-between p-3 mb-3" style="border: 1px solid #dee2e6; border-radius: 5px;">';
                                    echo '<div class="d-flex align-items-center mb-2 mb-md-0">';
                                    echo '<img src="img/products/' . $row['product_image'] . '" alt="' . htmlspecialchars($row['product_name'], ENT_QUOTES, 'UTF-8') . '" style="width: 100px; height: auto; margin-right: 20px;">';
                                    echo '<div>';
                                    echo '<p class="card-text"><small class="text-category">' . htmlspecialchars($row['product_category'], ENT_QUOTES, 'UTF-8') . '</small></p>';
                                    echo '<h5 class="card-title">' . htmlspecialchars($row['product_name'], ENT_QUOTES, 'UTF-8') . '</h5>';
                                    echo '<p>₱' . htmlspecialchars($row['price'], ENT_QUOTES, 'UTF-8') . '</p>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '<div class="d-flex align-items-center">';
                                    echo '<p class="card-text"><small class="text-category">In stock x ' . htmlspecialchars($row['stock'], ENT_QUOTES, 'UTF-8') . ' </small></p>';
                                    echo '</div>';
                                    echo '</div>';
                                }
                            } else {
                                echo "<p>No products found.</p>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous">
    </script>
    <script src="WorkingSidebar.js"></script>
</body>

</html>
