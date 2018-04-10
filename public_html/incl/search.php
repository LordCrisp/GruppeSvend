<?php

require 'init.php';

$products = new Products();
$searchResult = $products->searchProducts($_POST['search']);
foreach ($searchResult as $product) : ?>
  <li>
    <figure>
      <img src="assets/img/products/<?=$product['thumbnail']?>" alt="Picture of <?=$product['name']?>" />
    </figure>
    <figcaption>
      <p><?=$product['name']?></p>
      <a href="details.php?product=<?=$product['id']?>">More ></a>
    </figcaption>
  </li>
<?php endforeach; ?>
