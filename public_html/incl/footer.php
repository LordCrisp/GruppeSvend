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
            <a href="details.php?product=<?=$product['id']?>">More ></a>
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

<!-- Scripts (start) -->
<!-- Header script (start) -->
<script>
var headerButtons = document.getElementsByClassName('header__button');
for (var z = 0; z < headerButtons.length; z++) {
  var elem = headerButtons[z];
  elem.onclick = function(e) {
    const elem = e.target;
    if (elem.dataset.menuOpen) {
      var target = elem.dataset.menuOpen;
      var menu = document.getElementById(target);
      if (!menu.classList.contains('active')) {
        menu.classList.add('active');
      }
    } else if (elem.dataset.menuClose) {
      var target = elem.dataset.menuClose;
      var menu = document.getElementById(target);
      if (menu.classList.contains('active')) {
        menu.classList.replace('active', 'closing');
        setTimeout(function() {
          menu.classList.remove('closing');
        }, 400);
      }
    }
    if (elem.dataset.searchOpen) {
      var target = elem.dataset.searchOpen;
      var search = document.getElementById(target);
      if (!search.classList.contains('active')) {
        search.classList.add('active');
      }
    } else if (elem.dataset.searchClose) {
      var target = elem.dataset.searchClose;
      var search = document.getElementById(target);
      if (search.classList.contains('active')) {
        search.classList.replace('active', 'closing');
        setTimeout(function() {
          search.classList.remove('closing');
        }, 400);
      }
    }
  }
}
</script>
<!-- Menu script (end) -->
<!-- Swiper scripts (start) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.2.2/js/swiper.min.js"></script>
<script type="text/javascript">
  var swiper = new Swiper('.swiper-container', {
    slidesPerView: 5,
    spaceBetween: 18,
    navigation: {
      nextEl: '.product-slider__button--next',
      prevEl: '.product-slider__button--prev',
    },
    breakpoints: {
      320: {
        slidesPerView: 1,
        spaceBetween: 12,
      },
      480: {
        slidesPerView: 2,
        spaceBetween: 12,
      },
      768: {
        slidesPerView: 3,
        spaceBetween: 14,
      },
      960: {
        slidesPerView: 4,
        spaceBetween: 16,
      }
    },
  });
</script>
<!-- Swiper scripts (end) -->
<!-- Scripts (end) -->
