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
    <title>Ecommerce Website-Cart Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .cart_img {
            width: 100px;
            height: 100px;
            object-fit: cover;
        }

        form {
            margin: 0 80px;
            overflow-x: hidden;
        }

        /* .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
        } */
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
                        <a class="nav-link " aria-current="page" href="contact.php">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active " aria-current="page" href="cart.php"><i class="fa-solid fa-cart-shopping"><sup><?php cart_item(); ?></sup></i> </a>
                    </li>


                </ul>

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
        <h3 class="text-center">Online Store</h3>
        <p class="text-center">"Empower Your Shopping Experience: Where Style Meets Convenience!"
        </p>
    </div>

    <!-- fourth child -->
    <div class="container">
        <div class="row">
            <form action="" method="post">
                <table class="table table-bordered border-primary text-center">

                    <!-- php code to display dynamic data -->
                    <?php
                    global $connect;
                    $get_ip_add = getIPAddress();
                    $total_price = 0;
                    $cart_query = "Select * from `cart_details` where ip_address='$get_ip_add'";
                    $result = mysqli_query($connect, $cart_query);
                    $result_count = mysqli_num_rows($result);
                    if ($result_count > 0) {
                        echo "<thead>
                                <tr>
                                    <th>Product Title</th>
                                    <th>Product Image</th>
                                    <th>Quantity</th>
                                    <th>Total Price</th>
                                    <th>Remove</th>
                                    <th colspan='2'>Operations</th>
                                </tr>
                            </thead>
                            <tbody>";

                        while ($row = mysqli_fetch_array($result)) {
                            $product_id = $row['product_id'];
                            $select_products = "Select * from `products` where product_id='$product_id'";
                            $result_products = mysqli_query($connect, $select_products);
                            while ($row_product_price = mysqli_fetch_array($result_products)) {
                                $product_price = array($row_product_price['product_price']);
                                $price_table = $row_product_price['product_price'];
                                $product_title = $row_product_price['product_title'];
                                $product_image1 = $row_product_price['product_image1'];
                                $product_values = array_sum($product_price);
                                $total_price += $product_values;


                    ?>
                                <tr>
                                    <td><?php echo $product_title ?></td>
                                    <td><img src="./images/<?php echo $product_image1; ?>" class="cart_img" alt=""></td>
                                    <td><input type="number"  class="form-input w-50" name="qty"></td>
                                    <?php
                                    $get_ip_add = getIPAddress();
                                    if (isset($_POST['update_cart'])) {
                                        $quantities = $_POST['qty'];
                                        $update_cart = "update `cart_details` set quantity=$quantities where ip_address='$get_ip_add'";
                                        $result_products_quantity = mysqli_query($connect, $update_cart);
                                        $total_price = $total_price * $quantities;
                                    }
                                    ?>

                                    <td><?php echo $price_table ?>/-</td>
                                    <td><input type="checkbox" name="removeitem[]" value="<?php echo $product_id ?>"></td>
                                    <td>
                                        <!-- <button class="bg-primary text-light px-3 py-2 border-0 my-1 mx-3">Update</button> -->
                                        <input type="submit" value="Update Cart" class="bg-primary text-light px-3 py-2 border-0 my-1 mx-3" name="update_cart">
                                        <!-- <button class="bg-danger text-light px-3 py-2 border-0 my-1 mx-3">Remove</button> -->
                                        <input type="submit" value="Remove" class="bg-primary text-light px-3 py-2 border-0 my-1 mx-3" name="remove_cart">
                                    </td>
                                </tr>
                    <?php
                            }
                        }
                    } else {
                        echo "<h2 class='text-danger text-center'>Cart is empty! </h2>";
                    }
                    ?>
                    </tbody>
                </table>

                <!-- subtotal -->


                <div class="d-flex mb-3">
                    <?php
                    $get_ip_add = getIPAddress();
                    $cart_query = "Select * from `cart_details` where ip_address='$get_ip_add'";
                    $result = mysqli_query($connect, $cart_query);
                    $result_count = mysqli_num_rows($result);
                    if ($result_count > 0) {
                        echo "<h4 class='px-3 m-1'>Subtotal:<strong class='text-info'>$total_price/-</strong></h4>
                    <input type='submit' value='Continue Shopping' class='bg-primary text-light px-3 py-2 border-0 my-1 mx-3' name='continue_shopping'>
                    <button class='bg-secondary text-light text-center px-3 py-2 border-0 my-1 mx-3'><a class='text-light text-decoration-none' href='./users_area/checkout.php'>Checkout</a></button>";
                    // <button class='bg-secondary text-light text-center px-3 py-2 border-0 my-1 mx-3'><a class='text-light text-decoration-none' href='./users_area/checkout.php'>Checkout</a></button>";

                    } else {
                        echo " <input type='submit' value='Continue Shopping' class='bg-primary text-light px-3 py-2 border-0 my-1 mx-3' name='continue_shopping'>";
                    }
                    if (isset($_POST['continue_shopping'])) {
                        echo "<script>window.open('index.php','_self')</script>";
                    }

                    ?>

                </div>
        </div>
    </div>
    </form>
    <!-- function to remove item -->
    <?php
    function remove_cart_item()
    {
        global $connect;
        if (isset($_POST['remove_cart'])) {
            foreach ($_POST['removeitem'] as $remove_id) {
                echo $remove_id;
                $delete_query = "Delete from `cart_details` where product_id = $remove_id";
                $run_delete = mysqli_query($connect, $delete_query);
                if ($run_delete) {
                    echo "<script>window.open('cart.php', '_self')</script>";
                }
            }
        }
    }
    echo $remove_item = remove_cart_item();


    ?>

    <!-- footer -->
    <?php

    include('footer.php');
    ?>
    <!-- <div class="bg-info p-3 text-center footer">
        <p>All reserved &copy; Designed by Mayur-2024</p>
    </div> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>