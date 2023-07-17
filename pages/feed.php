<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home</title>
    <link rel="stylesheet" href="../style/style.css" />
    <link rel="stylesheet" href="../style/feed.css" />
</head>

<body>
    <?php
    if (!isset($_COOKIE['user_id']) || empty($_COOKIE['user_id'])) {
        header("Location: http://localhost/facebook-like-app/pages/login.php");
        exit();
    }

    require('../utils/dbcon.php');
    echo "<div class='home-page'>";
    include('../utils/nav.php');

    // TODO : filter

    echo "
    <h3>Your Feed</h3>
        <form method='post'>
            <button type='submit' name='logout'>log out</button>
        </form>
        <table>
            <tr>
                <th>username</th>
                <th>profile_photo </th>
                <th>body</th>
                <th>date</th>
            </tr>
        ";
    if (isset($_POST['create-post'])) {
        header("Location: http://localhost/facebook-like-app/pages/create-post.php");
        exit();
    }
    if (isset($_POST['logout'])) {
        setcookie('user_id', '', time() - 3600, '/');
        header("Location: http://localhost/facebook-like-app/pages/login.php");
        exit();
    }
    if (!isset($_POST['filter'])) {
        $sql = "
            select username, profile_photo, body, date
            from posts, user
            where posts.user_id = user.user_id
            order by date desc
        ";
    }
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo    "<td> " . $row['username'] . "</td>";
        echo    "<td> <img width=50 src='" . $row['profile_photo'] . "' alt='" . $row['profile_photo'] . "'/></td>";
        echo    "<td> " . $row['body'] . "</td>";
        echo    "<td> " . $row['date'] . "</td>";
        echo "</tr> ";
    }
    echo "
    </table>
    <form method='post'>
        <button type='submit' name='create-post'>create a post</button>
    </form>
    </div>"
    ?>
</body>

</html>