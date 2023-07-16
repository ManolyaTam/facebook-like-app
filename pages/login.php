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
            <label for='username'>username</label>        
            <input name='username' id='username' />
            <br />
            <label for='password'>password</label>
            <input name='password' id='password' type='password' />
            <br />
            <button type='submit' name='login-submit'>login</button>
        </form>
    </div>";

    if(isset($_POST['login-submit'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $sql = "select * from user where username='$username' and password='$password'";
        $result = mysqli_query($con, $sql);
        
        //$row = mysqli_fetch_array($result);??

        if(mysqli_num_rows($result) > 0){
            header("Location: http://localhost/facebook-like-app/pages/feed.php");
        }
        else {
            echo "username/password combination is wrong";
        }
    }
    ?>
</body>

</html>