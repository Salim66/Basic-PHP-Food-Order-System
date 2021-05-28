<?php require_once('layout/menu.php') ?>
<!-- Main Content Section Starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Admin</h1>
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
        <a class="btn btn-primary" href="<?php echo SITEURL; ?>admin/add-admin.php">Add Admin</a>
        <br><br>
        <table>
            <tr class="thead">
                <td>#</td>
                <td>Full Name</td>
                <td>Username</td>
                <td>Active</td>
            </tr>
            <tr>
                <td>1</td>
                <td>Salim Hasan</td>
                <td>salim66</td>
                <td>
                    <a class="btn btn-info" href="">Edit Admin</a>
                    <a class="btn btn-danger" href="">Delete Admin</a>
                </td>
            </tr>
        </table>
    </div>
</div>
<!-- Main Content Section Ends -->
<?php require_once('layout/footer.php') ?>