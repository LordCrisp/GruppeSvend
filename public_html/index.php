<?php
require "incl/init.php";
/* - Head, Header & Body (start) - */
require DOCROOT . "/incl/header.php";
?>

<main>
    <section class="home__news--main">
        <figure class="home__news--figure">
            <picture class="home__news--picture">
                <source srcset="assets/img/news1.jpg" media="(min-width: 650px)">
                <source srcset="assets/img/news1.jpg" media="(min-width: 465px)">
                <img src="assets/img/news1.jpg" alt="News picture">
            </picture>
        </figure>
        <h2>LATEST ARRIVALS</h2>
        <h5>Check our latest products here</h5>
        <hr>
        <?php
            $products = new products();
            $latestProducts = $products->getLatestProducts();
        ?>
        <?php foreach ($latestProducts as $product) : ?>
            <figure>
                <img src='assets/img/products/<?=$product['thumbnail']?>' alt='Picture of <?=$product['name']?>'>
                <figcaption><?=$product['name']?></figcaption>
            </figure>
        <?php endforeach ; ?>
    </section>

    <!-- Sidebar (start) -->
    <?php require DOCROOT . "/incl/sidebar.php"; ?>
    <!-- Sidebar (start) -->
</main>


<?php
/* - Footer & Body (end) - */
require DOCROOT . "/incl/footer.php";
?>
