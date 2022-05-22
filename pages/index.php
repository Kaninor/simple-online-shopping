<?php

session_start();

require(__DIR__.'/../auth_validation.php');
require(__DIR__.'/../Database.php');

auth_validator('/store/pages/auth/login.php');

$conn = new Database();
$result = $conn->select('fruit');

$user_id = $conn->select('users', "username = '" . $_SESSION['username'] . "'");
$user_id = $conn->fetch($user_id)['id'];

$added_array = [];
$added = $conn->select('cart', "user_id = '$user_id'");
while ($row = $conn->fetch($added))
{
    array_push($added_array, $row['fruit_id']);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" href="../assets/logo1.png">
    <script src="../js/axios.min.map"></script>
    <title>Home</title>
</head>
<body>
    <!-- header -->
    <?php require(__DIR__."/components/header.php") ?>
    <!-- end of header -->

    <!-- nav -->
    <nav id="navbar">
        <?php require(__DIR__."/components/nav.php") ?>
    </nav>
    <!-- end of nav  -->

    <!-- main -->
    <main>
        <h2 class="component-heading">Recommended</h2>
        <div class="card-container">
            <?php for ($i = 0; ($row = $conn->fetch($result)) && $i < 4; $i++): ?>
                <div class="card">
                    <div class="card-img-container">
                        <img class="card-img" src="<?= $row["path"] ?>" />
                    </div>
                    <div class="card-text">
                        <h3><?= $row["name"] ?></h3>
                        <p><?= $row["description"] ?></p>
                    </div>
                    <div class="card-button-container">
                        <h3>$<?= $row["price"] ?></h3>
                        <ul>
                            <li>
                                <?php if (in_array($row['id'], $added_array)): ?>
                                    <button class="added-to-card-btn cart-btn-stat" id="<?= $row["name"] ?>">Added</button>
                                <?php else: ?>
                                    <button class="add-to-card-btn cart-btn-stat" id="<?= $row["name"] ?>">Add To Cart</button>
                                <?php endif; ?>
                            </li>
                            <li>
                                <button class="buy-btn">Buy</button>
                            </li>
                        </ul>
                    </div>
                </div>
            <?php endfor; ?>
        </div>

        <div class="pagination-container">
            <div class="pagination">
                <img id="pagination-img" src="../assets/card-images/Grapes.jpg" />
            </div>

            <div class="pagination-button-container">
                <button class="pagination-button no" id="pagination-to-left">&laquo;</button>
                <button class="pagination-button pagination-active-button">1</button>
                <button class="pagination-button">2</button>
                <button class="pagination-button">3</button>
                <button class="pagination-button">4</button>
                <button class="pagination-button no" id="pagination-to-right">&raquo;</button>
            </div>
        </div>
    </main>
    <!-- end of main -->

    <footer>Online Shopping	&copy;</footer>

    <script src="../js/index.js"></script>
    <script src="../js/add_to_cart.js"></script>
</body>
</html>