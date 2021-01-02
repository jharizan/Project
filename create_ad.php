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
    <title>Добавяне на обява</title>
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



<?php
    require_once "header.php";
    ?>
<br>
<form>
  <div class="form-group">
    <label for="user">Потребителско име:</label>
    <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="">
  </div>
  <div class="form-group">
    <label for="category">Категория на позицията :</label>
    <select class="form-control" id="category">






<?php

$query = "SET NAMES 'utf8'";
$result = mysqli_query($link, $query) or die($mysqli->error);

                    $query = "SELECT id,category FROM categories ORDER BY category DESC;";
                    $result = mysqli_query($link, $query) or die($mysqli->error);

                    while ($row = mysqli_fetch_array($result)) {
                        echo "<option value='" . $row['id'] . "'>" . $row['category'] . "</option>";
                    }
                    ?>





    </select>
  </div>
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Описание на обява:</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
    <br>
    <button type="submit" class="btn btn-success">Добави</button>
  </div>
</form> 

<?php
    require_once "footer.php";
    ?>