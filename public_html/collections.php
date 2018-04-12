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
		$products   = $products->getProductsByCategory( $collectionID, $categoryID ); ?>
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
                                <a href="?mode=details&collection=<?= $collectionID ?>&category=<?= $categoryID ?>&product=<?= $product['id'] ?>">More
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
                    <div class="product__alt-description">
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
            //Create variable (array) of all the siblings og the target class
            var targetSiblings = targetElem[0].parentNode.childNodes;
            //Loop through siblings and remove "active" class from current active
            for (var z = 0; z < targetSiblings.length; z++) {
                //Fetch list of classes on element
                if (targetSiblings[z].classList) {
                    //If element contains "active" class, remove it
                    if (targetSiblings[z].classList.contains('active')) {
                        targetSiblings[z].classList.remove('active');
                    }
                    if (elem.classList.contains('active')) {
                        elem.classList.remove('active');
                    }
                }
            }
            //If target element don't contain "active" class, give it "active" class
            if (!targetElem[0].classList.contains('active')) {
                targetElem[0].classList.add('active');
            }

        }
    }
</script>
<?php
/* - Footer & Body (end) - */
require DOCROOT . "/incl/footer.php";
?>


