<?php
include($_SERVER['DOCUMENT_ROOT'] . "/incl/init.php");
$products = new products();
$productsMen = $products->getProductsMen();
$productsWomen = $products->getProductsWomen();
$products = $products->getProducts();

$product = isset($_REQUEST["product"]) && !empty($_REQUEST["product"]) ? $_REQUEST["product"] : "";

//Insert Header
require DOCROOT . "/incl/header.php";?>

<?php
switch(strtoupper($product)) {

    default:
    case "LIST": ?>

    <section>
        <div class="product-list">
            <?php foreach ($products as $product) : ?>
                <figure class="product-list__item">
                    <img class="product-list__image" src='/assets/img/products/<?=$product['thumbnail']?>' alt='Picture of <?=$product['name']?>'>
                    <figcaption class="product-list__caption">
                        <?=$product['name']?> <br>
                        <a href="?product=men&id=<?=$product['id']?>">More ></a>
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
                            <a href="?product=details&id=<?=$product['id']?>">More ></a>
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
                            <a href="?product=details&id=<?=$product['id']?>">More ></a>
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


// DETAILS OF THE SELECTED PRODUCT
case "DETAILS":
$collectionID = isset( $_GET['collection'] ) ? $_GET['collection'] : "";
$categoryID = isset( $_GET['category'] ) ? $_GET['category'] : "";
$productID  = $_GET['id'];
$products   = new products();
$products->getProduct( $productID );
?>
<main class="alt__container">
            <!-- Banner -->
            <header>
                <!-- Left side -->
                <div>
                    <h1><?= $products->name ?></h1>
                    <small>Here you find all the details</small>
                </div>
                <!-- Right side -->
                <div>
                    <p>Collection</p>
                    <h3><?= $products->collection_name ?></h3>
                </div>
            </header>

            <!-- Product Image -->
            <img class="product__image" src="/assets/img/products/<?= $products->thumbnail ?>"
                 alt="Picture of <?= $products->name ?>">

            <!-- Product Description -->
            <article class="product__description">
                <h2><?= $products->name ?></h2>
                <p><?= $products->description ?></p>
            </article>

            <!-- Product Alternate Info -->
            <div class="product__alt"
                 <!-- Section Swich Buttons -->
                <div>
                    <button class="product__alt-button active" data-fetch="description">Description</button>
                    <button class="product__alt-button" data-fetch="review">Reviews (0)</button>
                </div>
                <!-- Sections -->
                <div class="product__alt-sections">
                    <div class="product__alt-description active">
                        <p><?= $products->description ?></p>
                    </div>
                    <div class="product__alt-review">
                        <p>No Reviews found</p>
                    </div>
                </div>
            </div>
        </main>

<?php
}
//Switch (end)?>

<!-- Alternate Info Script -->
<script>
    //Grab the element with a class
    var detailsButton = document.getElementsByClassName('product__alt-button');

    //Loop through the elements
    for (var i = 0; i < detailsButton.length; i++) {
        //Create Element variable from "current" button
        var elem = detailsButton[i];

        //On Click Function (catches .onclick event)
        elem.onclick = function(event) {
            //Create constant from onclick event
            const elem = event.target;
            //Fetch the content in the data (fetch) attribute on the button tag
            var target = elem.dataset.fetch;
            //Create variable (array) of the class to target, from the data attribute content
            var targetElem = document.getElementsByClassName('product__alt-' + target);

            /*----------------------------------------------------------------
            ---- Fetch Target siblings and remove "active" class from them ---
            ----------------------------------------------------------------*/
            //Create variable (array) of all the siblings of the target class
            var targetSiblings = targetElem[0].parentNode.childNodes;

            //Loop through siblings and remove "active" class from current active
            for (var z = 0; z < targetSiblings.length; z++) {
                //Fetch list of classes on element
                if (targetSiblings[z].classList) {
                    //If element contains "active" class, remove it
                    if (targetSiblings[z].classList.contains('active')) {
                        targetSiblings[z].classList.remove('active');
                    }
                }
            }
            /*----------------------------------------------------------------
            ----------- Fetch trigger element (button) siblings and ----------
            ----------------- remove "active" class from them ----------------
            ----------------------------------------------------------------*/
            //Create variable (array) of all the siblings of the button
            var elemSiblings = elem.parentNode.childNodes;

            //Loop through siblings and remove "active" class from current active
            for (var z = 0; z < elemSiblings.length; z++) {
                //Fetch list of classes on element
                if (elemSiblings[z].classList) {
                    //If button contains "active" class, remove it
                    if (elemSiblings[z].classList.contains('active')) {
                        elemSiblings[z].classList.remove('active');
                    }
                }
            }

            /*----------------------------------------------------------------
            -- Set "active" class on trigger and target elements if missing --
            ----------------------------------------------------------------*/
            //If target element don't contain "active" class, give it "active" class
            if (!targetElem[0].classList.contains('active')) {
                targetElem[0].classList.add('active');
            }
            //If button element don't contain "active" class, give it "active" class
            if (!elem.classList.contains('active')) {
                elem.classList.add('active');
            }

        }
    }
</script>
<?php
/* - Footer & Body (end) - */
require DOCROOT . "/incl/footer.php";
?>
