<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Create Post</title>
    <link rel="stylesheet" href="../style/create-post.css" />
</head>

<body>
    <?php
    require('../utils/dbcon.php');
    echo "
    <div class='create-post-page'>
        <h3>Create a Post</h3>
        <form action = $_SERVER[PHP_SELF] method = 'post'>
            <textarea 
                required 
                name='body' 
                placeholder='what would you like to share?'
                style ='width: 300px; height: 200px'
            ></textarea>
            <br />
            <a href='./feed.php'>cancel</a>
            <button type='submit' name='create-post'>post</button>
        </form>
    </div>";

    if (isset($_POST['create-post'])) {
        $user_id = $_COOKIE['user_id'];
        $body = $_POST['body'];

        $sql = "insert into posts(user_id, body, date)
                    values ('" . $user_id . "', '" . $body . "', '" . date('Y/m/d') . "')";
        $ok = mysqli_query($con, $sql);
        if ($ok) {
            header("Location: http://localhost/facebook-like-app/pages/feed.php");
            exit();
        } else {
            echo "something went wrong";
        }
    }
    ?>
</body>

</html>