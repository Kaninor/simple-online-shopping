<?php

session_start();

require(__DIR__.'/../auth_validation.php');
require(__DIR__.'/../Database.php');
require(__DIR__.'/../functions.php');

auth_validator('/store/pages/auth/login.php');

$conn = new Database();

$keyword = postParams('p-keyword', $_POST);
$min = postParams('p-price-min', $_POST);
$max = postParams('p-price-max', $_POST);

$search = postParams('search', $_POST);
$search_txt = postParams('search-txt', $_POST);

$product = array();
$c = true;

if ($search != null && $search_txt != null) {
    $result = $conn->select('fruit', "name LIKE '%$search_txt%' ORDER BY price DESC");
    while ($row = $conn->fetch($result))
    {
        array_push($product, $row);
    }
    $_SESSION['product'] = $product;
    header("location: /store/pages/product.php?search=$search_txt");
    exit();
}
else if ($search != null && $search_txt == null) {
    $_SESSION['product'] = 0;
    header("location: /store/pages/product.php");
    exit();
}

if ($keyword != null && $min != null && $max != null)
    $result = $conn->select('fruit', "(name LIKE '%$keyword%' OR description LIKE '%$keyword%') OR (price >= '$min' AND price <= '$max') ORDER BY price DESC");
else if ($keyword != null && $min == null && $max == null)
    $result = $conn->select('fruit', "(name LIKE '%$keyword%' OR description LIKE '%$keyword%') ORDER BY price DESC");
else if ($keyword == null && $min != null && $max == null) {
    $max = 100;
    $result = $conn->select('fruit', "(price >= '$min' AND price <= '$max') ORDER BY price DESC");
    $max = null;
}
else if ($keyword == null && $min == null && $max != null) {
    $min = 0;
    $result = $conn->select('fruit', "(price >= '$min' AND price <= '$max') ORDER BY price DESC");
    $min = null;
}
else if ($keyword != null && $min != null && $max == null) {
    $max = 100;
    $result = $conn->select('fruit', "(name LIKE '%$keyword%' OR description LIKE '%$keyword%') OR (price >= '$min' AND price <= '$max') ORDER BY price DESC");
    $max = null;
}
else if ($keyword == null && $min != null && $max != null)
    $result = $conn->select('fruit', "(price >= '$min' AND price <= '$max') ORDER BY price DESC");
else if ($keyword != null && $min == null && $max != null) {
    $min = 0;
    $result = $conn->select('fruit', "(name LIKE '%$keyword%' OR description LIKE '%$keyword%') OR (price >= '$min' AND price <= '$max') ORDER BY price DESC");
    $min = null;
}
else if ($keyword == null && $min == null && $max == null) {
    $c = false;
}

while ($c && ($row = $conn->fetch($result)))
{
    array_push($product, $row);
}

$_SESSION['product'] = $c ? $product : 0;
// echo "<pre>";
// echo var_dump($_SESSION['product']);
// echo "</pre>";
if ($c)
    header("location: /store/pages/product.php?keyword=$keyword&min=$min&max=$max");
else
    header("location: /store/pages/product.php");