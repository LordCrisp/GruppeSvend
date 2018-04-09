<?php
include($_SERVER['DOCUMENT_ROOT'] . "/incl/init.php");
$collections = new collections();
$collections = $collections->getCollections();
$categories = new categories();
$categories = $categories->getCategories();

$mode = isset($_REQUEST["mode"]) && !empty($_REQUEST["mode"]) ? $_REQUEST["mode"] : "";

switch(strtoupper($mode)) {

// LIST OF COLLECTIONS
default:
case "LIST":
require DOCROOT . "/incl/header.php";
?>

    <?php foreach ($collections as $collection) : ?>
        <a href="?mode=categories&collection=<?=$collection['id']?>"><?=$collection['name']?></a><br><br>
    <?php endforeach; ?>

<?php
break;

// LIST OF CATEGORIES
case "CATEGORIES":
require DOCROOT . "/incl/header.php";
$collectionID = $_GET['collection'];
?>  

    <?php foreach ($categories as $category) : ?>
        <a href="?mode=products&collection=<?=$collectionID?>&category=<?=$category['id']?>"><?=$category['name']?></a><br><br>
    <?php endforeach; ?>
    
<?php
break;

// LIST OF PRODUCTS UNDER THE SELECTED CATEGORY
case "PRODUCTS":
require DOCROOT . "/incl/header.php";
$collectionID = $_GET['collection'];
$categoryID = $_GET['category'];
$products = new products();
$products = $products->getCollectionProducts($collectionID, $categoryID);
?>  
    <?php if (!empty($products)) : ?>
        <?php foreach ($products as $product) : ?>
            <a href="?mode=details&collection=<?=$collectionID?>&category=<?=$categoryID?>&product=<?=$product['id']?>"><?=$product['name']?></a><br><br>
        <?php endforeach; ?>
    <?php else : ?>
        <p>Der er ingen produkter i denne kategori</p>
    <?php endif; ?>

<?php
break;

// DETAILS OF THE SELECTED PRODUCT
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