<?php

session_start();

require(__DIR__.'/../auth_validation.php');
require(__DIR__.'/../Database.php');

auth_validator('/store/pages/auth/login.php');

$conn = new Database();
$result = $conn->select('fruit');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" href="../assets/logo1.png">
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

        <div class="filter-title" id="filter-title">
            <span class="show-filter" id="show-filter">Show Filter ∨</span>
            <select id="filter-select">
                <option value="newest">Newest</option>
                <option value="popular">Most Popular</option>
                <option value="oldest">Oldest</option>
                <option value="expensive">Most Expensive</option>
                <option value="cheapest">Cheapest</option>
            </select>
        </div>

        <hr class="hr" id="hr">

        <div class="filter-container" id="filter-container">
            <div class="filter-keywords-name-container">
                <div class="filter-form-control">
                    <label class="filter-label">Keywords : </label>
                    <input type="text" id="filter-product-keywords" class="filter-input" placeholder="Type here..." />
                </div>
                <div class="filter-form-control">
                    <label class="filter-label">Name : </label>
                    <input type="text" id="filter-product-name" class="filter-input" placeholder="Type here..." />
                </div>
            </div>
            <div class="filter-form-control">
                <label class="filter-label">Price : </label>
                <div class="filter-price-container">
                    <div>
                        <input type="number" min="0" id="filter-product-price-min" class="filter-input input-425" placeholder="Min..." />
                        <label class="filter-price-symbol">$</label>
                    </div>
                    <div>
                        <input type="number" min="0" id="filter-product-price-max" class="filter-input input-425" placeholder="Max..." />
                        <label class="filter-price-symbol">$</label>
                    </div>
                </div>
            </div>
            <div class="filter-btn-control">
                <input type="button" class="filter-submit" value="Search" id="filter-submit" />
                <input type="button" class="filter-clear" value="Clear" id="filter-clear" />
            </div>
        </div>

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
                                        <button class="add-to-card-btn">Add To Cart</button>
                                    </li>
                                    <li>
                                        <button class="buy-btn">Buy</button>
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
                                        <button class="add-to-card-btn">Add To Cart</button>
                                    </li>
                                    <li>
                                        <button class="buy-btn">Buy</button>
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
                                    <button class="add-to-card-btn">Add To Cart</button>
                                </li>
                                <li>
                                    <button class="buy-btn">Buy</button>
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
                                        <button class="add-to-card-btn">Add To Cart</button>
                                    </li>
                                    <li>
                                        <button class="buy-btn">Buy</button>
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
    </main>

    <footer>Online Shopping	&copy;</footer>

    <script src="../js/product.js"></script>
</body>
</html>