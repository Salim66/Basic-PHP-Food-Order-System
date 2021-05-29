<?php

require_once('../app/db.php')

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="admin-login text-center">
        <h2>Admin Login</h2><br><br>
        <?php

        //check whether the session data has or not
        if (isset($_SESSION['error'])) {
            echo $_SESSION['error']; // Display the session value
            unset($_SESSION['error']); // Remove the session value
        }

        ?>
        <br>
        <!-- Admin login form starts -->
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
            <div class="form-group" style="width: 100%">
                <label for="" class="text-left">Username</label>
                <input type="text" name="username" class="form-control">
            </div>
            <div class="form-group" style="width: 100%">
                <label for="" class="text-left">Password</label>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="form-group" style="width: 100%;">
                <input type="submit" name="submit" class="btn btn-primary d-inline-block w-86" value="Login">
            </div>
        </form>
        <!-- Admin login form ends -->

        <br><br>
        <p>Developed by <a href="#">Salim Hasan</a></p>
    </div>
</body>

</html>

<?php


//1. check whether the admin form submit or not
if (isset($_POST['submit'])) {

    //2. get all data login form
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    //3. sql query for login user has or not
    $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";
    $res = $connection->query($sql);

    //4 count the amdin select row whether the admin has or not
    $countAdmin = mysqli_num_rows($res);

    //4. check whether value has go to admin dashboard or not go to login page
    if ($countAdmin == 1) {
        //5. Succefully to login dashboard
        $_SESSION['success'] = '<div class="success">You are successfully login ): </div>';
        // initailize the username into sission value
        $_SESSION['username'] = $username;
        //6. Redirect to admin dashboard
        header("location:" . SITEURL . 'admin/index.php');
    } else {
        //5. Failed to login dashboard
        $_SESSION['error'] = '<div class="error">Username and password did not match! </div>';
        //6. Redirect to admin dashboard
        header("location:" . SITEURL . 'admin/login.php');
    }


    //
}

?>