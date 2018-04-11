<?php

require 'init.php';

$products = new Products();
$searchResult = $products->searchProducts($_POST['search']);
$searchResultCategory = $products->searchCategories($_POST['search']);
$searchResultCollection = $products->searchCollections($_POST['search']);
?>
<li><ul class="search__result--collections">
  <p>Collections</p>
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
</ul></li>
<li><ul class="search__result--categories"> 
  <p>Categories</p>
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
</ul></li>
<li><ul class="search__result--products">
  <p>Products</p>
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
</ul></li>