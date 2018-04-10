<?php
include($_SERVER['DOCUMENT_ROOT'] . "/incl/init.php");
$collections = new collections();
$collections = $collections->getCollections();
$categories = new categories();
$categories = $categories->getCategories();

$mode = isset($_REQUEST["mode"]) && !empty($_REQUEST["mode"]) ? $_REQUEST["mode"] : "";


//Insert Header
require DOCROOT . "/incl/header.php";?>
<!-- Product List (start) -->
<section class="product-list">

<?php
/* ---------- */
//Switch (start)
switch(strtoupper($mode)) {

// LIST OF COLLECTIONS
default:
    case "LIST": ?>

        <?php foreach ($collections as $collection) : ?>
            <a href="?mode=categories&collection=<?=$collection['id']?>"><?=$collection['name']?></a><br><br>
        <?php endforeach; ?>

    <?php
    break;

    // LIST OF CATEGORIES
    case "CATEGORIES":

        $collectionID = $_GET['collection'];
        ?>

            <?php foreach ($categories as $category) : ?>
                <a href="?mode=products&collection=<?=$collectionID?>&category=<?=$category['id']?>"><?=$category['name']?></a><br><br>

                <figure class="product-list__item">
                    <img class="product-list__image" src='assets/img/products/<?=$category['thumbnail']?>' alt='Picture of <?=$category['name']?>'>
                    <figcaption class="product-list__caption">
                        <?=$category['name']?> <br>
                        <a href="details.php?product=<?=$category['id']?>">More ></a>
                    </figcaption>
                </figure>
            <?php endforeach; ?>

        <?php

        break;

    // LIST OF PRODUCTS UNDER THE SELECTED CATEGORY
    case "PRODUCTS":
        $collectionID = $_GET['collection'];
        $categoryID = $_GET['category'];
        $products = new products();
        $products = $products->getCollectionProducts($collectionID, $categoryID);
        ?>
            <?php if (!empty($products)) : ?>
                <?php foreach ($products as $product) : ?>
                    <figure class="product-list__item">
                        <img class="product-list__image" src='assets/img/products/<?=$product['thumbnail']?>' alt='Picture of <?=$product['name']?>'>
                        <figcaption class="product-list__caption">
                            <?=$product['name']?> <br>
                            <a href="details.php?product=<?=$product['id']?>">More ></a>
                        </figcaption>
                    </figure>
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
    //Switch (end)
    ?>
    </section>
    <!-- Product List (end) -->

    <?php
    /* - Sidebar (start) - */
    require DOCROOT . "/incl/sidebar.php";
    /* - Sidebar (start) - */
    /* - Footer & Body (end) - */
    require DOCROOT . "/incl/footer.php";
    ?>