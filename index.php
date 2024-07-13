`<?php
include('./admin_area/includes/connection.php');
include('./functions/common_function.php');
session_start();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ecommerce Website-Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- <link rel="stylesheet" href="style.css"> -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        body {
            margin: 0;
            padding: 0;
            top: 0;
            box-sizing: border-box;
            overflow-x: hidden;
        }

        .card-img-top {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .admin_image {
            width: 100px;
            object-fit: cover;
        }

        .card {
            height: 80px;
        }

        /* Footer CSS */
        .footer {
            background-color: #000;
            color: #fff;
            padding: 30px 0;
            text-align: center;
            margin-bottom: 0;
        }

        .footer ul {
            list-style: none;
            padding: 0;
        }

        .footer ul li {
            display: inline-block;
            margin-right: 20px;
        }

        .footer ul li a,
        .contact a {
            color: #fff;
            text-decoration: none;
        }

        .footer ul li a:hover {
            color: #007bff;
        }

        .contact a:hover {
            color: blue;
        }

        .social-icons {
            font-size: 24px;
        }

        .social-icons a {
            color: #fff;
            margin-right: 15px;
        }

        .social-icons a:hover {
            color: #007bff;
        }

        .footlink {
            padding-right: 10px;
        }
    </style>
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
                    <?php
                    if (isset($_SESSION['username'])) {
                        echo "<li class='nav-item'>
                        <a class='nav-link ' aria-current='page' href='./users_area/profile.php'>My Account</a>
                    </li>";
                    } else {
                        echo "<li class='nav-item'>
                        <a class='nav-link ' aria-current='page' href='./users_area/user_registration.php'>Register</a>
                    </li>";
                    }

                    ?>
                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="contact.php">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="cart.php"><i class="fa-solid fa-cart-shopping"><sup><?php cart_item(); ?></sup></i> </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="#">Total Price:<?php total_cart_price() ?>/-</a>
                    </li>

                </ul>
                <form class="d-flex " role="search" action="search_product.php" method="get">
                    <input class="form-control me-2" name="search_data" type="search" placeholder="Search" aria-label="Search">
                    <input type="submit" value="Search" class="text-center btn btn-outline-light" name="search_data_product" id="">
                </form>
            </div>
        </div>
    </nav>
    <!-- calling cart function -->
    <?php
    cart();
    ?>
    <!-- /navbar -->
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
        <h3 class="text-center fw-bold">Online Store</h3>
        <p class="text-center fw-light text-dark">"Empower Your Shopping Experience: Where Style Meets Convenience!"
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
                getproducts();
                get_unique_categories();
                get_unique_brands();

                // $ip = getIPAddress();
                // echo 'User Real IP Address - ' . $ip;
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
                        <h4 class="p-1">Trending Brands<h4>
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
<!-- Footer -->
<footer class="footer bg-info text-dark">
        <div class="container ">
            <div class="row">
                <div class="col-md-4 footlink text-dark">
                    <h5>Quick Links</h5>
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="display.php">Products</a></li>
                        <li><a href="./users_area/user_registration.php">Register</a></li>
                        <li><a href="contact.php">Contact</a></li>
                    </ul>
                </div>
                <div class="col-md-4 contact text-dark">
                    <h5><a href="Contact_Us.php" class="text-dark">Contact Us</a></h5>
                    <p>Shop no. 310, Hinjawadi - Wakad Rd,
                        opp. Gateway hotel, Hinjawadi Village, Hinjawadi, Pune, Pimpri-Chinchwad, Maharashtra 411057
                        <br>
                        connect@homeshopee.co.in
                    </p>
                </div>
                <div class="col-md-4">
                    <h5>Follow Us</h5>
                    <div class="social-icons">
                        <a href="#" target="_blank"><i class="fab fa-facebook"></i></a>
                        <a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
                        <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
                        <!-- Add more social media icons as needed -->
                    </div>
                </div>
            </div>
            <hr style="border-color: #fff;">
            <div class="row">
                <div class="col-md-12 text-center">
                    <p>&copy; 2024 Interior Design. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>