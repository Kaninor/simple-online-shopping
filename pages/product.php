<?php

session_start();

require(__DIR__.'/../auth_validation.php');
require(__DIR__.'/../Database.php');
require(__DIR__.'/../functions.php');

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
    <title>Product</title>
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

    <main>
        <section id="card-container-section"></section>

        <div style="display: flex; justify-content: center;">
            <div class="filter-title" id="filter-title">
                <span class="show-filter" id="show-filter">Show Filter ∨</span>
            </div>
        </div>

        <hr class="hr" id="hr">

        <div class="filter-container" id="filter-container">
            <form method="POST" action="/store/pages/filter.php">
                <div class="filter-keywords-name-container">
                    <div class="filter-form-control">
                        <label class="filter-label">Keywords : </label>
                        <input type="text" name="p-keyword" id="filter-product-keywords" class="filter-input filter-500" placeholder="Type here..." value="<?= postParams('keyword', $_GET) ?>" />
                    </div>
                </div>
                <div class="filter-form-control">
                    <label class="filter-label">Price : </label>
                    <div class="filter-price-container">
                        <div>
                            <input type="number" step="0.1" name="p-price-min" min="0" id="filter-product-price-min" class="filter-input input-425" placeholder="Min..." value="<?= postParams('min', $_GET) ?>" />
                            <label class="filter-price-symbol">$</label>
                        </div>
                        <div>
                            <input type="number" step="0.1" name="p-price-max" min="0" id="filter-product-price-max" class="filter-input input-425" placeholder="Max..." value="<?= postParams('max', $_GET) ?>" />
                            <label class="filter-price-symbol">$</label>
                        </div>
                    </div>
                </div>
                <div class="filter-btn-control">
                    <input type="submit" class="filter-submit" value="Search" id="filter-submit" />
                    <input type="button" class="filter-clear" value="Clear" id="filter-clear" />
                </div>
            </form>
        </div>

        <?php if (isset($_SESSION['product']) && $_SESSION['product'] != 0): ?>
            <?php $sr = 0; ?>
            <div id="main-card-container">
                <?php while ($sr < count($_SESSION['product'])): ?>
                    <div class="card-container">
                        <?php for ($i = $sr; $i < count($_SESSION['product']); $i++ /*$_SESSION['product'] as $p*/): ?>
                            <div class="card">
                                <div class="card-img-container">
                                    <img class="card-img" src="<?= $_SESSION['product'][$i]["path"] ?>" />
                                </div>
                                <div class="card-text">
                                    <h3><?= $_SESSION['product'][$i]["name"] ?></h3>
                                    <p><?= $_SESSION['product'][$i]["description"] ?></p>
                                </div>
                                <div class="card-button-container">
                                    <h3>$<?= $_SESSION['product'][$i]["price"] ?></h3>
                                    <ul>
                                        <li>
                                            <?php if (in_array($_SESSION['product'][$i]['id'], $added_array)): ?>
                                                <button class="added-to-card-btn cart-btn-stat" id="<?= $_SESSION['product'][$i]["name"] ?>">Added</button>
                                            <?php else: ?>
                                                <button class="add-to-card-btn cart-btn-stat" id="<?= $_SESSION['product'][$i]["name"] ?>">Add To Cart</button>
                                            <?php endif; ?>
                                        </li>
                                        <li>
                                            <button class="buy-btn" id="<?= $_SESSION['product'][$i]['id'] ?>">Buy</button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <?php 
                                $sr++;
                                if ($sr % 4 == 0) {
                                    break;
                                }
                            ?>
                        <?php endfor; ?>
                    </div>
                <?php endwhile; ?>
            </div>
            <?php $_SESSION['product'] = 0; ?>
        <?php else: ?>
            <div id="main-card-container">
                <?php for ($j = 0; $j < 3; $j++): ?>
                    <div class="card-container">
                        <?php for ($i = 0; $i < 4 && ($row = $conn->fetch($result)); $i++): ?>
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
                                            <button class="buy-btn" id="<?= $row['id'] ?>">Buy</button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        <?php endfor; ?>
                    </div>
                <?php endfor; ?>
            </div>

            <div id="sec-card-container" class="d-none">
                <?php for ($j = 0; $j < 3; $j++): ?>
                    <div class="card-container">
                        <?php for ($i = 0; $i < 4 && ($row = $conn->fetch($result)); $i++): ?>
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
                                            <button class="buy-btn" id="<?= $row['id'] ?>">Buy</button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        <?php endfor; ?>
                    </div>
                <?php endfor; ?>
            </div>

            <div id="third-card-container" class="d-none">
                <div class="card-container">
                    <?php for ($i = 0; $i < 4 && ($row = $conn->fetch($result)); $i++): ?>
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
                                        <button class="buy-btn" id="<?= $row['id'] ?>">Buy</button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    <?php endfor; ?>
                </div>
                <div class="card-container">
                    <div class="card-container">
                        <?php for ($i = 0; $i < 2 && ($row = $conn->fetch($result)); $i++): ?>
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
                                            <button class="buy-btn" id="<?= $row['id'] ?>">Buy</button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        <?php endfor; ?>
                    </div>
                </div>
            </div>      

            <div class="pagination-button-container text-align-center">
                <button class="pagination-button no" id="pagination-to-left">&laquo;</button>
                <button class="pagination-button pagination-active-button">1</button>
                <button class="pagination-button">2</button>
                <button class="pagination-button">3</button>
                <button class="pagination-button no" id="pagination-to-right">&raquo;</button>
            </div>
            
            <footer>Online Shopping	&copy;</footer>
        <?php endif; ?>
    </main>

    <script src="../js/product.js"></script>
    <script src="../js/add_to_cart.js"></script>
    <script src="../js/buy.js"></script>
</body>
</html>