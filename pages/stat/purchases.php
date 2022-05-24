<?php

session_start();

require(__DIR__.'/../../auth_validation.php');
require(__DIR__.'/../../Database.php');
require(__DIR__.'/../../functions.php');

auth_validator('/store/pages/auth/login.php');

$conn = new Database();

$i = 1;
$user = $conn->select('users', "username = '" . $_SESSION['username'] . "'");
$sells = $conn->join(array("sells.id as s_id", "fruit.name as f_name", "sells.address as s_address", "sells.card_id as s_card_id", "sells.bought_at as s_bought_at"), 'sells', "fruit on fruit.id = sells.fruit_id", "user_id = '" . $conn->fetch($user)['id'] . "' order by sells.id desc");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="icon" href="../../assets/logo1.png">
    <script src="/store/js/axios.min.map"></script>
    <title>Purchases</title>
</head>
<body>
    <!-- header -->
    <?php require(__DIR__."/../components/header.php") ?>
    <!-- end of header -->

    <!-- nav -->
    <nav id="navbar">
        <?php require(__DIR__."/../components/nav.php") ?>
    </nav>
    <!-- end of nav  -->

    <main>
        <div style="display: flex; flex-direction: column; text-align: center; padding: 25px">
            <div>
                <button id="cart-btn">Cart</button>
                <button id="purchases-btn">Purchases</button>
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Fruit</th>
                        <th>Address</th>
                        <th>Card Id</th>
                        <th>Bought At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $conn->fetch($sells)): ?>
                        <tr>
                            <th><?= $i ?></th>
                            <td><?= $row['f_name'] ?></td>
                            <td><?= $row['s_address'] ?></td>
                            <td><?= $row['s_card_id'] ?></td>
                            <td><?= $row['s_bought_at'] ?></td>
                            <td>
                                <a href="/store/pages/stat/info.php?user=<?= $_SESSION['username'] ?>&fruit=<?= $row['f_name'] ?>&id=<?= $row['s_id'] ?>&mode=purchases">Info</a> |
                                <a href="/store/pages/stat/delete.php?user=<?= $_SESSION['username'] ?>&fruit=<?= $row['f_name'] ?>&id=<?= $row['s_id'] ?>&mode=purchases">Delete</a>
                            </td>
                        </tr>
                    <?php $i++; endwhile; ?>
                </tbody>
            </table>
        </div>
    </main>

    <script src="/store/js/stat.js"></script>
</body>
</html>