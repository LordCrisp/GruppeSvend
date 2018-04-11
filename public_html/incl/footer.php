</main>
<!-- Main Content (end) -->

<!-- Product slider (start) -->
<section class="product-slider__container">
  <h1>Other products</h1>
  <p>Check out some of our other products.</p>
  <div class="swiper-container">
    <div class="swiper-wrapper">
      <?php $products = new Products();
      $latestProducts = $products->getRandomProducts();
      foreach ($latestProducts as $product) : ?>
      <div class="swiper-slide">
        <div class="product-list__item">
          <img class="product-list__image" src="assets/img/products/<?=$product['thumbnail']?>" alt="Picture of <?=$product['name']?>">
          <figcaption class="product-list__caption">
            <?=$product['name']?><br />
            <a href="collections.php?mode=details&collection=<?=$product['collection_id']?>&category=<?=$product['category_id']?>&product=<?=$product['id']?>">More ></a>
          </figcaption>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
  <button type="button" class="product-slider__button--prev"><i class="material-icons">chevron_left</i></button>
  <button type="button" class="product-slider__button--next"><i class="material-icons">chevron_right</i></button>
</section>
<!-- Product slider (end) -->

<!-- Footer (start) -->
<footer>
    <nav>
        <ul>
            <li><a href="/index.php">Home</a></li>
            <li><a href="/collections.php?mens">Mens</a></li>
            <li><a href="/collections.php?women">Women</a></li>
            <li><a href="/collections.php?collections">Collections</a></li>
            <li><a href="/news.php">News</a></li>
            <li><a href="/contact.php">Contact</a></li>
        </ul>
        <p>Copyright &copy; 2014. All Rights Reserved by <a href="/index.php">Fashion Online</a>.</p>
    </nav>
    <img class="footer__logo" src="/assets/img/logo-inverted.jpg">
</footer>
<!-- Footer (end) -->

<!-------- Scripts (start) -------->

<!-- Menu script -->
<script src="/assets/js/menu.js"></script>

<!-- Swiper scripts (CDN & Setup) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.2.2/js/swiper.min.js"></script>
<script src="/assets/js/swiper_setup.js"></script>

<!-- Search script -->
<script src="/assets/js/searchbar.js"></script>

<!--------- Scripts (end) --------->
