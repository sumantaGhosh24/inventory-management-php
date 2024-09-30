<?php
session_start();

include 'database.php';
?>

<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta name="author" content="sumanta ghosh" />
    <meta name="description" content="inventory management website php" />
    <meta name="keywords" content="inventory, management, inventory management" />

    <!--==================== favicon ====================-->
    <link rel="icon" type="image/png" href="./assets/images/favicon-32x32.png" />

    <!--==================== canonical ====================-->
    <link rel="canonical" href="http://example.com/home" />

    <!--==================== fontawesome cdn ====================-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" />

    <!--==================== jQuery cdn ====================-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!--==================== custom css ====================-->
    <link rel="stylesheet" type="text/css" href="./assets/css/style.css" />

    <title>Inventory Management</title>
</head>

<body class="bg-white">
    <nav class="bg-blue-800 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <a href="#" class="text-2xl font-bold">Logo</a>
            <ul class="flex space-x-4">
                <?php
                if (!isset($_SESSION["USER_ID"])) {
                    ?>
                    <li><a href="login.php">Login</a></li>
                    <?php
                }
                if (isset($_SESSION["USER_ID"])) {
                    ?>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="profile.php">Profile</a></li>
                    <li><a href="category.php">Category</a></li>
                    <li><a href="product.php">Products</a></li>
                    <li><a href="customer.php">Customers</a></li>
                    <li><a href="order.php">Orders</a></li>
                    <li><a href="logout.php">Logout</a></li>
                    <?php
                }
                ?>
            </ul>
        </div>
    </nav>