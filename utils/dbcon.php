<?php
$con = mysqli_connect("localhost:3306", "root", "", "facebook-like-app");
if (isset($con)) {
    echo "<h4 
        style='
            background-color:green;
            color: white; 
            display: inline
            '
        >
            connected to database!
        </h4>
        ";
}
