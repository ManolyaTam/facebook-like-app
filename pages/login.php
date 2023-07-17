<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="stylesheet" href="../style/login.css" />
</head>

<body>
    <?php
    require('../utils/dbcon.php');
    echo "
    <div class='login-page'>
        <h3>LOGIN</h3>
        <form action = $_SERVER[PHP_SELF] method = 'post'>
            <label for='email'>email</label>        
            <input required name='email' type='email' id='email' />
            <br />
            <label for='password'>password</label>
            <input required name='password' id='password' type='password' />
            <br />
            <button type='submit' name='login-submit'>login</button>
        </form>
        <a href='./signup.php'>don't have an account?</a>
    </div>";

    if (isset($_POST['login-submit'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $sql = "select * from user where email='" . $email . "' and password='" . $password . "'";
        $result = mysqli_query($con, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            setcookie('user_id', $row['user_id'], time() + 3600, '/');
            header("Location: http://localhost/facebook-like-app/pages/feed.php");
            exit();
        } else {
            echo "email/password combination is wrong";
        }
    }
    ?>
</body>

</html>