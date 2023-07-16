<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home</title>
    <link rel="stylesheet" href="../style/feed.css" />
</head>

<body>
    <?php
    require('../utils/dbcon.php');
    echo "<div class='home-page'>";
    include('../utils/nav.php');
    
    // TODO : filter

    echo "<h3>Your Feed</h3>
          <table>
            <tr>
              <th>username</th>
              <th>profile_photo </th>
              <th>body</th>
              <th>date</th>
            </tr>
        </div>";
    if (!isset($_POST['filter'])) {
        $sql = "select username, profile_photo, body, date 
            from posts, user
            where posts.user_id = user.user_id
            order by date desc";
    } else {
        // $min = $_POST['min'];
        // $max = $_POST['max'];
        // $sql = "select * from books where price >= $min and price <= $max";
    }
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo    "<td> " . $row['username'] . "</td>";
        echo    "<td> <img width=50 src='".$row['profile_photo']."' alt='".$row['profile_photo']."'/></td>";
        echo    "<td> " . $row['body'] . "</td>";
        echo    "<td> " . $row['date'] . "</td>";
        echo "</tr> ";
    }
    ?>
</body>

</html>