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
    <link rel="stylesheet" href="style.css">
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
                    <a href="CustomerFeedbacK.php" class="sidebar-link" title="Feedback">
                        <i class="lni lni-comments"></i>
                        <span>Feedback</span>
                    </a>
                </li>
                <!-- Add more sidebar items here -->
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
            <div class="text-center">
                <h1>Welcome to Got Funko Collections</h1>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-12">
                            <h2>Our Products</h2>
                        </div>
                    </div>
                    <div class="row">
                        <?php
                        $sql = "SELECT * FROM product_table";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                <div class="col-md-4">
                                    <div class="card product_card" style="width: 18rem;">
                                        <div class="row justify-content-start">
                                            <div class="col-12">
                                                <span class="badge bg-info">
                                                    <?php echo $row['product_category']; ?>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <img src="img/products/<?php echo $row['product_image']; ?>"
                                                    class="card-img-top product_image"
                                                    alt="<?php echo $row['product_name']; ?>">
                                            </div>
                                            <div class="col-12">
                                                <div class="card-body">
                                                    <h5 class="card-title text-center">
                                                        <?php echo $row['product_name']; ?>
                                                    </h5>
                                                    <div class="price_stock">
                                                        <h1 class="price_text">
                                                            Price: ₱
                                                            <?php echo $row['price']; ?>
                                                        </h1>
                                                        <h1 class="stock_text">
                                                            Stock:
                                                            <?php echo $row['stock']; ?>
                                                        </h1>
                                                    </div>
                                                    <hr />
                                                    <a href="CustomerProductDetails.php?product_id=<?php echo $row['product_id']; ?>"
                                                        class="btn btn-success">View Product</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        } else {
                            echo "0 results";
                        }
                        ?>
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