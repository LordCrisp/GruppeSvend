<?php
include($_SERVER['DOCUMENT_ROOT'] . "/incl/init.php");
$products = new products();
$productsMen = $products->getProductsMen();
$productsWomen = $products->getProductsWomen();
$products = $products->getProducts();

$gender = isset($_REQUEST["gender"]) && !empty($_REQUEST["gender"]) ? $_REQUEST["gender"] : "";

//Insert Header
require DOCROOT . "/incl/header.php";?>

<?php
switch(strtoupper($gender)) {

    default:
    case "LIST": ?>

    <section>
        <div class="product-list">
            <?php foreach ($products as $product) : ?>
                <figure class="product-list__item">
                    <img class="product-list__image" src='/assets/img/products/<?=$product['thumbnail']?>' alt='Picture of <?=$product['name']?>'>
                    <figcaption class="product-list__caption">
                        <?=$product['name']?> <br>
                        <a href="?mode=categories&collection=<?=$product['id']?>">More ></a>
                    </figcaption>
                </figure>
            <?php endforeach; ?>
        </div>
    </section>

<?php 
/* - Sidebar (start) - */
require DOCROOT . "/incl/sidebar.php";
/* - Sidebar (start) - */
break;

    case "MEN": ?>
    <main>
        <section>
            <div class="product-list">
                <?php foreach ($productsMen as $product) : ?>
                    <figure class="product-list__item">
                        <img class="product-list__image" src='/assets/img/products/<?=$product['thumbnail']?>' alt='Picture of <?=$product['name']?>'>
                        <figcaption class="product-list__caption">
                            <?=$product['name']?> <br>
                            <a href="?mode=categories&collection=<?=$product['id']?>">More ></a>
                        </figcaption>
                    </figure>
                <?php endforeach; ?>
            </div>
        </section>

<?php
/* - Sidebar (start) - */
require DOCROOT . "/incl/sidebar.php";
/* - Sidebar (start) - */
?>
</main>
<?php
break;

    case "WOMEN": ?>
    <main>
        <section>
            <div class="product-list">
                <?php foreach ($productsWomen as $product) : ?>
                    <figure class="product-list__item">
                        <img class="product-list__image" src='/assets/img/products/<?=$product['thumbnail']?>' alt='Picture of <?=$product['name']?>'>
                        <figcaption class="product-list__caption">
                            <?=$product['name']?> <br>
                            <a href="/collections.php?mode=categories&collection=<?=$product['id']?>">More ></a>
                        </figcaption>
                    </figure>
                <?php endforeach; ?>
            </div>
        </section>

<?php
/* - Sidebar (start) - */
require DOCROOT . "/incl/sidebar.php";
/* - Sidebar (start) - */
?>
</main>
<?php
break;
}
?>
