<?php require_once('layout/menu.php') ?>

<?php

//1. Get value from url 
$id = $_GET['id'];

//2. Create SQL query for selected specifi food
$sql = "SELECT * FROM tbl_order WHERE id=$id";
//3. Execute the query
$res = $connection->query($sql);

//4. Check whether the execute value has or not in database
$count = mysqli_num_rows($res);

//5. Fetch the select query
$data = $res->fetch_assoc();

?>

<div class="main-content">
    <div class="wrapper">
        <h1>Edit Order</h1>
        <br><br>
        <!-- Session value get -->
        <?php
        if (isset($_SESSION['error'])) {
            echo $_SESSION['error'];
            unset($_SESSION['error']);
        }
        ?>
        <br>
        <a href="<?php echo SITEURL; ?>admin/manage-order.php" class="btn-primary">Food List</a>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group" style="width: 50%;">
                <label for="">Food</label>
                <input type="hidden" name="id" value="<?php echo $data['id'] ?>">
                <input type="hidden" name="food" class="form-control" value="<?php echo $data['food'] ?>">
                <input disabled type="text" name="food" class="form-control" value="<?php echo $data['food'] ?>" readonly>
            </div>

            <div class="form-group" style="width: 50%;">
                <label for="">Price</label><br>
                <input type="hidden" name="price" class="form-control" value="<?php echo $data['price'] ?>">
                <input disabled type="number" name="price" class="form-control" value="<?php echo $data['price'] ?>" readonly>
            </div>
            <div class="form-group" style="width: 50%;">
                <label for="">Quantity</label>
                <input type="number" name="quantity" class="form-control" value="<?php echo $data['qty'] ?>">
            </div>
            <div class="form-group" style="width: 50%;">
                <label for="">Order Date</label>
                <input readonly type="text" name="order_date" class="form-control" value="<?php echo $data['order_date'] ?>">
            </div>
            <div class="form-group" style="width: 50%;">
                <label for="">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="Ordered" <?php if ($data['status'] == "Ordered") {
                                                echo "selected";
                                            } ?>>Ordered</option>
                    <option value="On Delivared" <?php if ($data['status'] == "On Delivared") {
                                                        echo "selected";
                                                    } ?>>On Delivared</option>
                    <option value="Delivared" <?php if ($data['status'] == "Delivared") {
                                                    echo "selected";
                                                } ?>>Delivared</option>
                    <option value="Cancel" <?php if ($data['status'] == "Cancel") {
                                                echo "selected";
                                            } ?>>Cancel</option>
                </select>
            </div>
            <div class="form-group" style="width: 50%;">
                <label for="">Customer Name</label>
                <input type="text" name="customer_name" class="form-control" value="<?php echo $data['customer_name'] ?>">
            </div>
            <div class="form-group" style="width: 50%;">
                <label for="">Customer Contact</label>
                <input type="text" name="customer_contact" class="form-control" value="<?php echo $data['customer_contact'] ?>">
            </div>
            <div class="form-group" style="width: 50%;">
                <label for="">Customer Email</label>
                <input type="email" name="customer_email" class="form-control" value="<?php echo $data['customer_email'] ?>">
            </div>
            <div class="form-group" style="width: 50%;">
                <label for="">Customer Address</label><br>
                <div class="d-inline-block text-center" style="display: inline-flex;">
                    <textarea name="customer_address" rows="2" class="form-control" style="width: 420px;"><?php echo $data['customer_address'] ?></textarea>
                </div>
            </div>
            <div class="form-group" style="width: 50%;">
                <input type="submit" name="submit" class="btn btn-primary" value="Add new">
            </div>
        </form>
    </div>
</div>

<?php require_once('layout/footer.php') ?>

<?php

// Check whether the submit button press or not
if (isset($_POST['submit'])) {
    //Get all values from form
    $id = $_POST['id'];
    $food = $_POST['food'];
    $price = $_POST['price'];
    $qty = $_POST['quantity'];
    $total = $price * $qty; // $total = price * quantity
    $order_date = date('Y-m-d h:i:sa');
    $status = $_POST['status'];
    $customer_name = $_POST['customer_name'];
    $customer_contact = $_POST['customer_contact'];
    $customer_email = $_POST['customer_email'];
    $customer_address = $_POST['customer_address'];

    // Create SQL query for update order table in database
    $sql = "UPDATE tbl_order SET food='$food', price='$price', qty='$qty', total='$total', order_date='$order_date', status='$status', customer_name='$customer_name', customer_contact='$customer_contact', customer_email='$customer_email', customer_address='$customer_address' WHERE id=$id";
    // Execute the query 
    $res = $connection->query($sql);

    // Check whether the data is update databse or not
    if ($res == true) {
        // Successfully inserted data
        $_SESSION['success'] =  '<div style="color: green; text-align: center;">Your order has been updated successfully ): </div>';
        // Redirect to page
        // header('location:' . SITEURL . 'admin/manage-order.php');
        echo ("<script>location.href = '" . SITEURL . "admin/manage-order.php'</script>");
    } else {
        // Failed inserted data
        $_SESSION['error'] = '<div style="color: red; text-align: center;">Failed your order! </div>';
        // Redirect to page
        // header('location:' . SITEURL . 'admin/manage-order.php');
        echo ("<script>location.href = '" . SITEURL . "admin/manage-order.php'</script>");
    }
}



?>