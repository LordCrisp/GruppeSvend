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
<section>
    <div class="product-list">

<?php
/* ---------- */
//Switch (start)
switch(strtoupper($mode)) {

// LIST OF COLLECTIONS
default:
    case "LIST": ?>

        <?php foreach ($collections as $collection) : ?>
            <figure class="product-list__item">
                <img class="product-list__image" src='/assets/img/collections/small/<?=$collection['thumbnail']?>' alt='Picture of <?=$collection['name']?>'>
                <figcaption class="product-list__caption">
                    <?=$collection['name']?> <br>
                    <a href="?mode=categories&collection=<?=$collection['id']?>">More ></a>
                </figcaption>
            </figure>
        <?php endforeach; ?>
        </div>
    </section>
    <!-- Product List (end) -->
	<?php
	/* - Sidebar (start) - */
	require DOCROOT . "/incl/sidebar.php";
	/* - Sidebar (start) - */
    break;

    // LIST OF CATEGORIES
    case "CATEGORIES":

        $collectionID = $_GET['collection'];
        ?>

            <?php foreach ($categories as $category) : ?>
                <figure class="product-list__item">
                    <img class="product-list__image" src='/assets/img/products/<?=$category['thumbnail']?>' alt='Picture of <?=$category['name']?>'>
                    <figcaption class="product-list__caption">
                        <?=$category['name']?> <br>
                        <a href="?mode=products&collection=<?=$collectionID?>&category=<?=$category['id']?>">More ></a>
                    </figcaption>
                </figure>
            <?php endforeach; ?>
            </div>
        </section>
        <!-- Product List (end) -->
	    <?php
	    /* - Sidebar (start) - */
	    require DOCROOT . "/incl/sidebar.php";
	    /* - Sidebar (start) - */

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
                            <a href="?mode=details&collection=<?=$collectionID?>&category=<?=$categoryID?>&steffen=useless&product=<?=$product['id']?>">More ></a>
                        </figcaption>
                    </figure>
                <?php endforeach; ?>
            <?php else : ?>
                <p>Der er ingen produkter i denne kategori</p>
            <?php endif;?>

            </div>
        </section>
        <!-- Product List (end) -->
        <?php
        /* - Sidebar (start) - */
        require DOCROOT . "/incl/sidebar.php";
        /* - Sidebar (start) - */

        break;

    // DETAILS OF THE SELECTED PRODUCT
    case "DETAILS":
        $collectionID = $_GET['collection'];
        $categoryID = $_GET['category'];
        $productID = $_GET['product'];
        $products = new products();
        $products->getProduct($productID);
        ?>

            <article>
                <div class="details__top">
                    <div class="details__top--left">
                        <h2><?=$products->name?></h2>
                        <p>Here you find all the details</p>
                    </div>
                    <div class="details__top--right">
                        <p>Collection</p>
                        <h3><?=$products->collection_name?></h3>
                    </div>
                </div>
                <?=$products->thumbnail?>
                <p><?=$products->description?></p>

            </article>
        <?php
    }
    //Switch (end)

    /* - Footer & Body (end) - */
    require DOCROOT . "/incl/footer.php";
    ?>