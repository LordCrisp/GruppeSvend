<?php
include( $_SERVER['DOCUMENT_ROOT'] . "/incl/init.php" );
$collections = new collections();
$collections = $collections->getCollections();
$categories  = new categories();
$categories  = $categories->getCategories();

$mode               = isset( $_REQUEST["mode"] ) && ! empty( $_REQUEST["mode"] ) ? $_REQUEST["mode"] : "";


//Insert Header
require DOCROOT . "/incl/header.php"; ?>


<?php
/* ---------- */
//Switch (start)
switch ( strtoupper( $mode ) ) {

// LIST OF COLLECTIONS
	default:
	case "LIST": ?>
        <!-- Main Content (start) -->
        <main>
            <!-- Product List (start) -->
            <section>
                <div class="product-list">
					<?php foreach ( $collections as $collection ) : ?>
                        <figure class="product-list__item">
                            <img class="product-list__image"
                                 src='/assets/img/collections/small/<?= $collection['thumbnail'] ?>'
                                 alt='Picture of <?= $collection['name'] ?>'>
                            <figcaption class="product-list__caption">
								<?= $collection['name'] ?> <br>
                                <a href="?mode=categories&collection=<?= $collection['id'] ?>">More ></a>
                            </figcaption>
                        </figure>
					<?php endforeach; ?>
                </div>
            </section>
            <!-- Product List (end) -->
			<?php
			/* - Sidebar (start) - */
			require DOCROOT . "/incl/sidebar.php";
			/* - Sidebar (start) - */ ?>
        </main>
        <!-- Main Content (end) -->
		<?php break;

	// LIST OF CATEGORIES
	case "CATEGORIES":

		$collectionID = isset( $_GET['collection'] ) ? $_GET['collection'] : "";
		?>
        <!-- Main Content (start) -->
        <main>
            <!-- Product List (start) -->
            <section>
                <div class="product-list">
					<?php foreach ( $categories as $category ) : ?>
                        <figure class="product-list__item">
                            <img class="product-list__image" src='/assets/img/products/<?= $category['thumbnail'] ?>'
                                 alt='Picture of <?= $category['name'] ?>'>
                            <figcaption class="product-list__caption">
								<?= $category['name'] ?> <br>
                                <a href="?mode=products&collection=<?= $collectionID ?>&category=<?= $category['id'] ?>">More
                                    ></a>
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
			?>
        </main>
        <!-- Main Content (end) -->
		<?php break;

	// LIST OF PRODUCTS UNDER THE SELECTED CATEGORY
	case "PRODUCTS":
		$collectionID = isset( $_GET['collection'] ) ? $_GET['collection'] : "";
		$categoryID = isset( $_GET['category'] ) ? $_GET['category'] : "";
		$products   = new products();
		$products   = $products->getProductsByCategory( $collectionID, $categoryID );?>
        <!-- Main Content (start) -->
        <main>
            <!-- Product List (start) -->
            <section>

            <!-- If products are returned -->
		    <?php if ( ! empty( $products ) ) : ?>
                <div class="product-list">
                <?php foreach ( $products as $product ) : ?>
                    <figure class="product-list__item">
                        <img class="product-list__image" src='assets/img/products/<?= $product['thumbnail'] ?>'
                             alt='Picture of <?= $product['name'] ?>'>
                        <figcaption class="product-list__caption">
                            <?= $product['name'] ?> <br>
                            <a href="?mode=details&collection=<?= $collectionID ?>&category=<?= $categoryID ?>&steffen=useless&product=<?= $product['id'] ?>">More
                                ></a>
                        </figcaption>
                    </figure>
                <?php endforeach; ?>
        <!-- If no Products -->
                <?php else : ?>
                    <p>Der er ingen produkter i denne kategori</p>
                <?php endif; ?>

                </div>
            </section>
        <!-- Product List (end) -->
		<?php
		/* - Sidebar (start) - */
		require DOCROOT . "/incl/sidebar.php";
		/* - Sidebar (start) - */
		?>
        </main>
        <!-- Main Content (end) -->
		<?php break;

	// DETAILS OF THE SELECTED PRODUCT
	case "DETAILS":
		$collectionID = isset( $_GET['collection'] ) ? $_GET['collection'] : "";
		$categoryID = isset( $_GET['category'] ) ? $_GET['category'] : "";
		$productID  = $_GET['product'];
		$products   = new products();
		$products->getProduct( $productID );
		?>
        <main class="alt__container">
            <header>
                <div>
                    <h1><?= $products->name ?></h1>
                    <small>Here you find all the details</small>
                </div>
                <div>
                    <p>Collection</p>
                    <h3><?= $products->collection_name ?></h3>
                </div>

            </header>
        </main>

        <article class="details__main">
            <div class="details__top">
                <div class="details__top--left">
                    <h2><?= $products->name ?></h2>
                    <p>Here you find all the details</p>
                </div>
            </div>
			<?= $products->thumbnail ?>
            <p><?= $products->description ?></p>

        </article>
	<?php
}
//Switch (end)

/* - Footer & Body (end) - */
require DOCROOT . "/incl/footer.php";
?>