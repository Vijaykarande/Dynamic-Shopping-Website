<?php
include('./admin_area/includes/connection.php');
include('./functions/common_function.php');
session_start();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Search Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-info p-3">
        <div class="container-fluid justify-content-space-around">
            <a class="navbar-brand" href="#">Online Shopee</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="display.php">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="./users_area/user_registration.php">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="contact.php">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="#"><i class="fa-solid fa-cart-shopping"><sup><?php cart_item(); ?></sup></i> </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="#">Total Price:<?php total_cart_price() ?>/-</a>
                    </li>

                </ul>
                <form class="d-flex" role="search" action="" method="get">
                    <input class="form-control me-2" name="search_data" type="search" placeholder="Search" aria-label="Search">
                    <input type="submit" value="Search" class="btn btn-outline-light" name="search_data_product" id="">
                </form>
            </div>
        </div>
    </nav>
    <!-- /navbar -->

    <!-- calling cart function -->
    <?php
    cart();
    ?>

    <!-- second child -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
        <ul class="navbar-nav me-auto">

            <?php
            if (!isset($_SESSION['username'])) {
                echo " <li class='nav-item'>
                <a class='nav-link ' aria-current='page' href='#'>Welcome Guest</a>
            </li>";
            } else {
                echo "<li class='nav-item'>
            <a class='nav-link ' aria-current='page' href=#'>Welcome " . $_SESSION['username'] . "</a>
        </li>";
            }


            if (!isset($_SESSION['username'])) {
                echo "<li class='nav-item'>
            <a class='nav-link ' aria-current='page' href='./users_area/user_login.php'>Login</a>
        </li>";
            } else {
                echo "<li class='nav-item'>
            <a class='nav-link ' aria-current='page' href='./users_area/logout.php'>Logout</a>
        </li>";
            }
            ?>
        </ul>
    </nav>

    <!-- third child -->
    <div class="bg-light">
        <h3 class="text-center">Online Store</h3>
        <p class="text-center">"Empower Your Shopping Experience: Where Style Meets Convenience!"
        </p>
    </div>
    <!-- forth child -->
    <div class="row px-3">
        <div class="col-md-10">
            <!-- products -->
            <div class="row">
                <!-- fetching products -->
                <?php
                // calling function
                search_product();
                get_unique_categories();
                get_unique_brands();
                ?>

                <!-- row end -->
            </div>
            <!-- col end -->
        </div>
        <div class="col-md-2 bg-secondary p-0 ">
            <!-- sidenav -->
            <!-- brands to be displayed -->
            <ul class="navbar-nav me-auto text-center">
                <li class="nav-item bg-info">
                    <a href="#" class="nav-link text-light">
                        <h4>Delivery Brands<h4>
                    </a>
                </li>
                <?php
                getbrands();
                ?>

            </ul>

            <!-- catagories to be displayed -->
            <ul class="navbar-nav me-auto text-center">
                <li class="nav-item bg-info">
                    <a href="#" class="nav-link text-light">
                        <h4>Catagories<h4>
                    </a>
                </li>
                <?php
                getcategories();
                ?>
            </ul>
        </div>
    </div>


    <!-- footer -->
    <?php

    include('footer.php');
    ?>
    <!-- <div class="bg-info p-3 text-center">
        <p>All reserved &copy; Designed by Mayur-2024</p>
    </div> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>