<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Signup</title>
    <link rel="stylesheet" href="../style/signup.css" />
</head>

<body>
    <?php
    require('../utils/dbcon.php');
    echo "
    <div class='signup-page'>
        <h3>Signup</h3>
        <form action = $_SERVER[PHP_SELF] method = 'post' enctype='multipart/form-data'>
        <label for='username'>username</label>        
            <input required name='username' id='username' />
            <br />
            <label for='password'>password</label>
            <input required name='password' id='password' type='password' />
            <br />
            <label for='email' >email</label>        
            <input required type='email' name='email' id='email' />
            <br />
            <br />
            <label for='picture'>picture</label>        
            <input name='picture' id='picture' type='file' />
            <br />
            <button type='submit' name='signup-submit'>signup</button>
        </form>
        <a href='./login.php'>already have an account?</a>
    </div>";

    if (isset($_POST['signup-submit'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];

        $name = $_FILES['picture']['name'];
        $tmp_path = $_FILES['picture']['tmp_name'];
        $new_path = "../img/" . $name;
        move_uploaded_file($tmp_path, $new_path);

        $sql = "select * from user where email = '$email'";
        $result = mysqli_query($con, $sql);
        if (mysqli_num_rows($result) > 0) {
            echo "email already used";
        } else {
            $sql = "insert into user(username, password, profile_photo, email)
                    values ('" . $username . "', '" . $password . "', '" . $new_path . "', '" . $email . "')";
            $ok = mysqli_query($con, $sql);
            if ($ok) {
                header("Location: http://localhost/facebook-like-app/pages/feed.php");
                exit();
            } else {
                echo "something went wrong";
            }
        }
    }
    ?>
</body>

</html>