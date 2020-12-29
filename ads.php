<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

// Include config file
require_once "config.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Обяви</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body {
            font: 14px sans-serif;
        }

        .wrapper {
            width: 350px;
            padding: 20px;
        }
    </style>
</head>

</head>

<body>
    <table class="table table-bordered table-hover">



        <tr>
            <th>
                Обява №
            </th>

            <th>
                Описание на обява </th>

            <th>
                Създадена на: </th>

        </tr>

        <?php

        $query = "SET NAMES 'utf8'";
        $result = mysqli_query($link, $query) or die($mysqli->error);

        $query = "SELECT id,ad_description,isactive,created_at FROM ads ORDER BY created_at DESC;";
        $result = mysqli_query($link, $query) or die($mysqli->error);

        while ($row = mysqli_fetch_array($result)) {
            echo "<tr><td>" . $row['id'] . "</td><td>" . $row['ad_description'] . "</td><td>" . $row['created_at'] .  "</td></tr>";
        }
        ?>

    </table>

</body>

</html>