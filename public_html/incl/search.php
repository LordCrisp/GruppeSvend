<?php

require 'init.php';

$products = new Products();
$searchResult = $products->searchProducts($_POST['search']);
$searchResultCategory = $products->searchCategories($_POST['search']);
$searchResultCollection = $products->searchCollections($_POST['search']);
?>
<?php foreach ($searchResultCollection as $collection) : ?>
  <li>
    <figure>
      <img src="assets/img/collections/big/<?=$collection['thumbnail']?>" alt="Picture of <?=$collection['name']?>" />
    </figure>
    <figcaption>
      <p><?=$collection['name']?></p>
      <a href="details.php?product=<?=$collection['id']?>">More ></a>
    </figcaption>
  </li>
<?php endforeach; ?>
<?php foreach ($searchResultCategory as $category) : ?>
  <li>
    <figure>
      <img src="assets/img/categories/<?=$category['thumbnail']?>" alt="Picture of <?=$category['name']?>" />
    </figure>
    <figcaption>
      <p><?=$category['name']?></p>
      <a href="details.php?product=<?=$category['id']?>">More ></a>
    </figcaption>
  </li>
<?php endforeach; ?>
<?php foreach ($searchResult as $product) : ?>
  <li>
    <figure>
      <img src="assets/img/products/<?=$product['thumbnail']?>" alt="Picture of <?=$product['name']?>" />
    </figure>
    <figcaption>
      <p><?=$product['name']?></p>
      <a href="collection.php?mode=details&product=<?=$product['id']?>">More ></a>
    </figcaption>
  </li>
<?php endforeach; ?>
