<?php require_once('layout/menu.php') ?>
<!-- Main Content Section Starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Order</h1>
        <br>
        <?php
        // Check whether the session value has or not
        if (isset($_SESSION['success'])) {
            echo $_SESSION['success'];
            unset($_SESSION['success']);
        }

        // Check whether the session value has or not
        if (isset($_SESSION['error'])) {
            echo $_SESSION['error'];
            unset($_SESSION['error']);
        }
        ?>
        <br>
        <table>
            <tr class="thead">
                <td>#</td>
                <td>Food</td>
                <td>Price</td>
                <td>QTY</td>
                <td>Total</td>
                <td>Order_date</td>
                <td>Status</td>
                <td>Customer Name</td>
                <td>Customer Contact</td>
                <td>Customer Email</td>
                <td>Customer Address</td>
                <td>Action</td>
            </tr>
            <?php
            // Create SQL query for select all data from databaes tbl_admin tabla
            $sql = "SELECT * FROM tbl_order ORDER By id DESC";
            // Execute the query
            $res = $connection->query($sql);

            // Count the query
            $count = mysqli_num_rows($res);

            // Check whether the value has or not
            if ($count > 0) {
                // Data available
                // Fecth all data 
                $i = 1;
                while ($data = $res->fetch_assoc()) {
            ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $data['food']; ?></td>
                        <td><?php echo $data['price']; ?></td>
                        <td><?php echo $data['qty']; ?></td>
                        <td><?php echo $data['total']; ?></td>
                        <td><?php echo $data['order_date']; ?></td>
                        <td><?php echo $data['status']; ?></td>
                        <td><?php echo $data['customer_name']; ?></td>
                        <td><?php echo $data['customer_contact']; ?></td>
                        <td><?php echo $data['customer_email']; ?></td>
                        <td><?php echo $data['customer_address']; ?></td>
                        <td>
                            <a class="btn btn-info" href="<?php echo SITEURL; ?>admin/edit-order.php?id=<?php echo $data['id']; ?>">Edit Order</a>
                        </td>
                    </tr>
                <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="4" class="error text-center">Data not found!</td>
                </tr>
            <?php
            }

            ?>
        </table>
    </div>
</div>
<!-- Main Content Section Ends -->
<?php require_once('layout/footer.php') ?>