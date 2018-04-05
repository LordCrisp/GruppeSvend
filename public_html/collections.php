<?php
include($_SERVER['DOCUMENT_ROOT'] . "/incl/init.php");
/* - Head, Header & Body (start) - */
$collections = new collections();
$collections = $collections->getCollections();
$categories = new categories();
$categories = $categories->getCategories();

$mode = isset($_REQUEST["mode"]) && !empty($_REQUEST["mode"]) ? $_REQUEST["mode"] : "";

switch(strtoupper($mode)) {
    default:
    case "LIST":
    require DOCROOT . "/incl/header.php";
?>

    <?php foreach ($collections as $collection) : ?>
        <a href="?mode=categories&collection=<?=$collection['id']?>"><?=$collection['name']?></a><br><br>
    <?php endforeach; ?>

<?php
    break;
    case "CATEGORIES":
    require DOCROOT . "/incl/header.php";
    $collectionID = $_GET['collection'];
?>  

    <?php foreach ($categories as $category) : ?>
        <a href="?mode=products&collection=<?=$collectionID?>&category=<?=$category['id']?>"><?=$category['name']?></a><br><br>
    <?php endforeach; ?>
    
<?php
    break;
    case "PRODUCTS":
    require DOCROOT . "/incl/header.php";
    $collectionID = $_GET['collection'];
    $categoryID = $_GET['category'];
    $products = new products();
    $products = $products->getCollectionProducts($collectionID, $categoryID);
?>  

    <?php foreach ($products as $product) : ?>
        <a href="?mode=details&collection=<?=$collectionID?>&category=<?=$categoryID?>&product=<?=$product['id']?>"><?=$product['name']?></a><br><br>
    <?php endforeach; ?>

<?php
break;
case "DETAILS":
require DOCROOT . "/incl/header.php";
$collectionID = $_GET['collection'];
$categoryID = $_GET['category'];
$productID = $_GET['product'];
$products = new products();
$products = $products->getProduct($productID);
?>  

<?php foreach ($products as $product) : ?>
    <p><?=$product['name']?></p>
    <?=$product['thumbnail']?>
    <p><?=$product['description']?></p>
<?php endforeach; ?>

<?php
}
?>