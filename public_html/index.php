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
        /* - Latest Products - */
        $sql = "SELECT * FROM product LIMIT 6";
        foreach ($db->query($sql) as $key => $values){
            echo "<figure>
                <img src='$key[thumbnail]' alt='Picture of $key[name]'>
                <figcaption>$key[name]</figcaption>
            </figure>";
        }
        ?>
    </section>
</main>


<?php
/* - Footer & Body (end) - */
require DOCROOT . "/incl/footer.php";
?>
