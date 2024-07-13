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
    <title>Contact</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- <link rel="stylesheet" href="style.css"> -->
    <style>
        img {
            position: absolute;
            left: 0;
            width: 500px;
            height: 500px;
            padding: 25px;
            margin-top: 25px;
        }

        body {
            overflow-x: hidden;
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

        /* Help section */

        .help-section {
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 20px;
            border-radius: 8px;
        }

        .help-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .help-link {
            margin-bottom: 10px;
        }

        .help-link a {
            text-decoration: none;
            color: #333;
            display: block;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: #f9f9f9;
            transition: background-color 0.3s ease;
        }

        .help-link a:hover {
            background-color: #e0e0e0;
        }

        .help-link {
            width: 700px;
        }

        iframe {
            margin-left: 20px;
            height: 300px;
            width: 600px;

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
                        <a class="nav-link " aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="display.php">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="./users_area/user_registration.php">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="contact.php">Contact</a>
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
                search_product();
                get_unique_categories();
                get_unique_brands();
                ?>

                <!-- row end -->
            </div>
            <!-- col end -->
        </div>
        <!-- form -->
        <div class="container-fluid m-3">
            <h2 class="text-center mb-5 fw-bold fs- text-primary">Contact Us</h2>
            <div class="row d-flex justify-content-center">
                <div class="col-lg-6 col-xl-5">
                    <img class="mt-2 mb-5" src="./contact.jpg" alt="">
                </div>
                <div class="col-lg-6 col-xl-5">
                    <form action="" method="post">
                        <div class="form-outline mb-4">
                            <label for="email" class="form-label">Username</label>
                            <input type="text" name="username" id="username" placeholder="Enter your username" class="form-control">
                        </div>
                        <div class="form-outline mb-4">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" placeholder="Enter your email" class="form-control">
                        </div>

                        <div class="form-floating mb-5">
                            <textarea class="form-control " name="feedback" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 300px"></textarea>
                            <label for="floatingTextarea2">Feedback</label>
                        </div>

                        <div>
                            <input type="submit" name="send" value="Send" class="bg-primary text-light   py-2 px-3 border-0">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Help section -->
        <div class="help-section">
            <h2 class="text-primary fw-bold fs-1">How I Help You</h2>

        </div>

        <script>
            // You can add JavaScript functionality here if needed
            // For example, handling click events on the links
            document.addEventListener('DOMContentLoaded', function() {
                var helpLinks = document.querySelectorAll('.help-link a');

                helpLinks.forEach(function(link) {
                    link.addEventListener('click', function(event) {
                        // You can add specific actions for each link click here
                        alert('You clicked: ' + event.target.textContent);
                    });
                });
            });
        </script>


        <div class="container-fluid">
            <div class="col-lg-6 w-50 d-flex">
                <ul class="help-links ">
                    <li class="help-link"><a href="#">Ordering Process</a></li>
                    <li class="help-link"><a href="#">Payment Options</a></li>
                    <li class="help-link"><a href="#">Shipping Information</a></li>
                    <li class="help-link"><a href="#">Returns and Refunds</a></li>
                    <li class="help-link"><a href="#">Product Information</a></li>
                </ul>
                <div class="">
                    <iframe class="" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15132.902430964845!2d73.9341999!3d18.5187043!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bc2c112a2e6836d%3A0xdf293a5408bc72bc!2sAmanora%20Mall!5e0!3m2!1sen!2sin!4v1708485731179!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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



<?php

if (isset($_POST['send'])) {

    $username         =            $_POST['username'];
    $email             =            $_POST['email'];
    $feedback           =            $_POST['feedback'];

    $query = "INSERT INTO `contact_feedback`(`userid`,`username`, `email`, `feedback`) VALUES('', '$username', '$email', '$feedback')";

    $data = mysqli_query($connect, $query);
    if ($data) {
        echo "<script>
            alert('Data Inserted');
            window.location.replace('contact.php');
            </script>";
    } else {
        echo "Data not inserted!";
    }
}

?>