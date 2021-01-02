<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body {
            font: 14px sans-serif;
            text-align: center;
        }
    </style>
</head>

<body>
    <?php
    require_once "header.php";
    ?>
    <div class="page-header">
        <h1>Здравейте, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>.</h1>
        <?php
        $rolestr = "";

        if ($_SESSION["role"] == "1") {
            $rolestr = "Employer";
        }
        if ($_SESSION["role"] == "2") {
            $rolestr = "Employee";
        }

        if ($_SESSION["role"] == "3") {
            $rolestr = "Admin";
        }
        ?>

        <h2>Вие сте <b><?php echo $rolestr; ?></b>.</h2>
    </div>
    <p>
        <a href="reset-password.php" class="btn btn-warning">Смяна на парола</a>
        <a href="logout.php" class="btn btn-danger">Изход от профил</a>
    </p>

    <?php
    require_once "footer.php";
    ?>
</body>

</html>