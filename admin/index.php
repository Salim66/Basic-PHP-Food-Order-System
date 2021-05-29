<?php require_once('layout/menu.php') ?>
<!-- Main Content Section Starts -->
<?php
// Check whether the session variable set or not
if (isset($_SESSION['success'])) {
    echo $_SESSION['success'];
    unset($_SESSION['success']);
}

?>
<div class="main-content">
    <div class="wrapper">
        <h1>DASHBOARD</h1>
        <br>
        <br>
        <div class="col-4 text-center">
            <h1>5</h1><br>
            Categories
        </div>
        <div class="col-4 text-center">
            <h1>5</h1><br>
            Foods
        </div>
        <div class="col-4 text-center">
            <h1>5</h1><br>
            Orders
        </div>
        <div class="col-4 text-center">
            <h1>5</h1><br>
            Review Generate
        </div>
    </div>
</div>
<!-- Main Content Section Ends -->
<?php require_once('layout/footer.php') ?>