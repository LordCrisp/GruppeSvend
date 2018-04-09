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
        <p>Check our latest products here</p>
        <hr>
        <?php
            $products = new products();
            $latestProducts = $products->getLatestProducts();
        ?>
        <div class="home__latest--main">
        <?php foreach ($latestProducts as $product) : ?>
            <figure class="home__latest--item">
                <img class="home__latest--image" src='assets/img/products/<?=$product['thumbnail']?>' alt='Picture of <?=$product['name']?>'>
                <figcaption class="home__latest--caption"><?=$product['name']?></figcaption>
            </figure>
        <?php endforeach ; ?>
        </div>
    </section>

    <!-- Sidebar (start) -->
    <?php require DOCROOT . "/incl/sidebar.php"; ?>
    <!-- Sidebar (start) -->
</main>


<?php
/* - Footer & Body (end) - */
require DOCROOT . "/incl/footer.php";
?>
