<?php
include('./admin_area/includes/connection.php');
include('./functions/common_function.php');
session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>

<body>
    <?php
    $username = $_SESSION['username'];
    $get_user = "Select * from `user_table` where username='$username'";
    $result = mysqli_query($connect, $get_user);
    $row_fetch = mysqli_fetch_assoc($result);
    $user_id = $row_fetch['user_id'];
    // echo $user_id;
    ?>
    <h3 class="text-primary fw-bold fs-1">All my Orders</h3>
    <table class="table table-bordered mt-5">
        <thead class="bg-info">
            <tr>
                <th>Sr. no.</th>
                <th>Total Amount </th>
                <th>Total Products</th>
                <th>Total Quantity</th>
                <th>Product Image</th>
                <th>Invoice number</th>
                <th>Date</th>
                <th>Complete/Incomplete</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody class="bg-secondary text-light">
            <?php
            $get_order_details = "Select * from `user_orders` where user_id=$user_id";
            $result_orders = mysqli_query($connect, $get_order_details);
            $number = 1;
            while ($row_orders = mysqli_fetch_assoc($result_orders)) {
                $order_id = $row_orders['order_id'];
                $amount_due = $row_orders['amount_due'];
                $total_products = $row_orders['total_products'];
                $invoice_number = $row_orders['invoice_number'];
                $order_status = $row_orders['order_status'];
                if ($order_status == 'pending') {
                    $order_status = 'Incomplete';
                } else {
                    $order_status = 'Complete';
                }
                $order_date = $row_orders['order_date'];

                echo "<tr>
            <td>$number</td>
            <td>$amount_due</td>
            <td>$total_products</td>
            <td><img src='./images/<?php echo $product_image1; ?>' class='cart_img' alt=''></td>
            <td><?php echo $quantity ?></td>          
            <td>$invoice_number</td>
            <td>$order_date</td>
            <td>$order_status</td>";
            ?>
            <?php
                if ($order_status == 'Complete') {
                    echo "<td>Paid</td>";
                } else {
                    echo "<td><a href='confirm_payment.php?order_id=$order_id' class='text-decoration-none text-dark'>Confirm</a></td>
               </tr>";
                }

                $number++;
            }
            ?>

            <?php
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
                        <td><input type="number" class="form-input w-50" name="qty"></td>
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



    </tbody>
    </table>
</body>

</html>