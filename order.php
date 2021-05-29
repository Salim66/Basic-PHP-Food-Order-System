<?php require_once('frontend/menu.php') ?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search">
    <div class="container">
        <?php
        // Check whether the session value has or not
        if (isset($_SESSION['success'])) {
            echo $_SESSION['success'];
            unset($_SESSION['success']);
        }
        if (isset($_SESSION['error'])) {
            echo $_SESSION['error'];
            unset($_SESSION['error']);
        }

        ?>
        <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" class="order">
            <fieldset>
                <legend>Selected Food</legend>

                <?php
                // Check whether the url value has or not
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];

                    // Create SQL query for select specific food
                    $sql = "SELECT * FROM tbl_food WHERE id=$id";
                    // Execute the query
                    $res = $connection->query($sql);

                    // Count the execute query
                    $count = mysqli_num_rows($res);
                    // Check data has or not
                    if ($count > 0) {
                        // Fetch data
                        $data = $res->fetch_assoc();
                    }
                }

                ?>

                <div class="food-menu-img">
                    <img src="<?php echo SITEURL; ?>admin/uploads/food/<?php echo $data['image_name']; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                </div>

                <div class="food-menu-desc">
                    <h3><?php echo $data["title"] ?></h3>
                    <input type="hidden" name="id" value="<?php echo $data['id'] ?>">
                    <input type="hidden" name="food" value="<?php echo $data['title'] ?>">
                    <p class="food-price">$<?php echo $data['price'] ?></p>
                    <input type="hidden" name="price" value="<?php echo $data['price'] ?>">

                    <div class="order-label">Quantity</div>
                    <input type="number" name="qty" class="input-responsive" value="1" required>

                </div>

            </fieldset>

            <fieldset>
                <legend>Delivery Details</legend>
                <div class="order-label">Full Name</div>
                <input type="text" name="full_name" placeholder="E.g. Vijay Thapa" class="input-responsive" required>

                <div class="order-label">Phone Number</div>
                <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                <div class="order-label">Email</div>
                <input type="email" name="email" placeholder="E.g. hi@vijaythapa.com" class="input-responsive" required>

                <div class="order-label">Address</div>
                <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
            </fieldset>

        </form>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<?php require_once('frontend/footer.php') ?>

<?php
// Check whether the form submit button press or not
if (isset($_POST['submit'])) {
    // Get all vaues from form
    // $id               = $_POST['id'];
    $food             = $_POST['food'];
    $price            = $_POST['price'];
    $qty              = $_POST['qty'];
    $total            = $price * $qty;
    $order_date       = date('Y-m-d h:i:sa');
    $status           = "Ordered";
    $customer_name    = $_POST['full_name'];
    $customer_contact = $_POST['contact'];
    $customer_email   = $_POST['email'];
    $customer_address = $_POST['address'];

    if (!empty($food) && !empty($qty) && !empty($total) && !empty($order_date) && !empty($status) && !empty($customer_name) && !empty($customer_contact) && !empty($customer_email) && !empty($customer_address)) {
        // Done
        // Create SQL query for insert order into database
        $sql = "INSERT INTO tbl_order (food, price, qty, total, order_date, status, customer_name, customer_contact, customer_email, customer_address) VALUES('$food', '$price', '$qty', '$total', '$order_date', '$status', '$customer_name', '$customer_contact', '$customer_email', '$customer_address')";
        // Execute the query
        $res = $connection->query($sql);

        // Check whether the data inserted or not into database
        if ($res == true) {
            // Insert successfull
            // Set message into session variable
            $_SESSION['success'] = '<div style="color: green;">Your order successfully submited ): </div>';
            // Redirect to page
            echo ("<script>location.href='" . SITEURL . "index.php'</script>");
            // Stop the process
            die();
        } else {
            // Failed to inserted
            // Set message into session variable
            $_SESSION['error'] = '<div style="color: red;">Failed to order data!</div>';
            // Redirect to page
            echo "<script>location.href='" . SITEURL . "order.php'</script>";
            // Stop the process
            die();
        }
    } else {
        // Failed
        // Set message into session variable
        $_SESSION['error'] = '<div style="color: red;">Please filled all the filed!</div>';
        // Redirect to page
        echo "<script>location.href='" . SITEURL . "order.php'</script>";
        // Stop the process
        die();
    }
}


?>