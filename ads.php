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
    <?php
    require_once "header.php";
    ?>

    <?php

    $keyword="";
    
// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate keyword
    if (empty(trim($_POST["keyword"]))) {
        echo  "   Моля , въведете ключова дума";
    } 
    else {
        $keyword=trim($_POST["keyword"]);
        echo " Вие търсите по следната ключова дума : " . trim($_POST["keyword"]);
    }
}
    ?>

<form action="ads.php" method="post" role="form">
  <div class="form-group">
    <label for="keyword">Ключова дума</label>
    <input type="text" class="form-control" name=keyword id="keyword" placeholder="Въведете ключова дума">
  </div>
  
  <button type="submit" class="btn btn-success">Търси</button>

</form>
<br>

    <table class="table table-bordered table-hover">



        <tr>
            <th>
                Обява №
            </th>

            <th>
                Описание на обява </th>

            <th>
                Създадена на: </th>
            <th>
                Създадена от: </th>
            <th>
                Действия </th>



        </tr>

        <?php

        $query = "SET NAMES 'utf8'";
        $result = mysqli_query($link, $query) or die($mysqli->error);

        $query = "
        
        SELECT ads.id,ads.ad_description,isactive,users.username,ads.created_at
        FROM ads 
        LEFT OUTER JOIN users on ads.created_by=users.id
        WHERE ads.ad_description LIKE '%". $keyword ."%'
        ORDER BY ads.created_at DESC;
        
        ";
        $result = mysqli_query($link, $query) or die($mysqli->error);

        while ($row = mysqli_fetch_array($result)) {
            echo "<tr><td>" . $row['id'] . "</td>" .

                "<td>" . $row['ad_description'] . "</td>" .
                "<td>" . $row['created_at'] .  "</td>" .
                "<td>" . $row['username'] . "</td>";



            if ($_SESSION["role"] == "3") {
                echo "<td>Редактиране</td>";
            }
            if ($_SESSION["role"] == "2") {
                echo "<td>Кандидастване</td>";
            }
            if ($_SESSION["role"] == "1") {
                echo "<td>Преглед на кандидатури</td>";
            }
            echo "</tr>";
        }

        ?>

    </table>
    <?php if ($_SESSION["role"] == "3") {
        echo "   <p> <a href=\"create_ad.php\" class=\"btn btn-success\">Добави Обява</a> </p>";
    }
    ?>


    <?php
    require_once "footer.php";
    ?>

</body>

</html>