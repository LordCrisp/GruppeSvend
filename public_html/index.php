<?php
require "incl/init.php";
/* - Head, Header & Body (start) - */
require DOCROOT . "/incl/header.php";
?>

    <section class="home__news--main">
        <figure class="home__news--figure">
            <picture class="home__news--picture">
                <source srcset="assets/img/news1.jpg" media="(min-width: 650px)">
                <source srcset="assets/img/news1.jpg" media="(min-width: 465px)">
                <img src="assets/img/news1.jpg" alt="News picture">
            </picture>
        </figure>
        <h2>LATEST ARRIVALS</h2>
        <p>Check our latest products here</p>
        <hr style="margin-bottom: 22px">
        <?php
            $products = new products();
            $latestProducts = $products->getLatestProducts();
        ?>
        <div class="product-list">
        <?php foreach ($latestProducts as $product) : ?>
            <figure class="product-list__item">
                <img class="product-list__image" src='assets/img/products/<?=$product['thumbnail']?>' alt='Picture of <?=$product['name']?>'>
                <figcaption class="product-list__caption">
                    <?=$product['name']?> <br>
                    <a href="details.php?product=<?=$product['id']?>">More ></a>
                </figcaption>
            </figure>
        <?php endforeach ; ?>
        </div>
    </section>

<?php
/* - Sidebar (start) - */
require DOCROOT . "/incl/sidebar.php";
/* - Sidebar (start) - */

/* - Footer & Body (end) - */
require DOCROOT . "/incl/footer.php";
?>
