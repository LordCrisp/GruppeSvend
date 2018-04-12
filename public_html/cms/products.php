<?php
require "incl/cms_init.php";
?>
<?php if ($auth->auth_role == 'admin') : ?>
<?php
$product = new products();
$collections = new collections();
$collection = new collections();
$categories = new categories();
$category = new categories();

$mode = isset($_REQUEST["mode"]) && !empty($_REQUEST["mode"]) ? $_REQUEST["mode"] : "";

switch(strtoupper($mode)) {

    // LIST OF PRODUCTS
    default:
    case "LIST":
    require DOCROOT . "/cms/incl/header.php";
    $sql = "SELECT collection.name AS collectionName, gender.gender, gender.id, product.id, product.name AS productName, product.category_id, product.collection_id, product.gender, product.created_at, product.deleted, category.name AS categoryName
    FROM product
    JOIN category ON product.category_id = category.id
    JOIN collection ON product.collection_id = collection.id
    JOIN gender ON product.gender = gender.id
    WHERE deleted = 0
    ORDER BY created_at DESC";
    $products = $db->fetch_array($sql);
?>
    <div class="container">
    <a href="?mode=edit">Create Product</a>
        <table class="table">
            <thead>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Category</th>
                <th scope="col">Collection</th>
                <th scope="col">Gender</th>
            </thead>
            <?php foreach ($products as $product) : ?>
                <tbody>
                    <tr scope="row">
                        <td><?=$product['id']?></td>
                        <td><?=$product['productName']?></td>
                        <td><?=$product['categoryName']?></td>
                        <td><?=$product['collectionName']?></td>
                        <td><?=$product['gender']?></td>
                        <td><a href="?mode=edit&id=<?=$product['id']?>">Edit</a></td>
                        <td><a href="?mode=delete&id=<?=$product['id']?>"><span class="product-delete" id="<?=$product['productName']?>">Slet</span></a></td>
                    </tr>
                </tbody>
            <?php endforeach; ?>
        </table>
    </div>
<script>
    $(document).ready(function() {
        $(".product-delete").click(function() {
            return confirm("Vil du slette " + this.id + "?");
        });
    });
</script>
<?php
break;

    //EDIT OR CREATE PRODUCT
    case "EDIT":
    require DOCROOT . "/cms/incl/header.php";
?>
<!-- Form (start) -->
<?php 
    if (isset($_GET['id'])) {
        $product->getProduct($_GET['id']);
        $category->getCategory($product->category_id);
        $collection->getCollection($product->collection_id);
    }
    $collections = $collections->getCollections();
	$categories = $categories->getCategories();
?>
    <form action="?mode=save" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?=$product->id?>">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" value="<?=$product->name?>">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" rows="5" cols="40"><?=$product->description?></textarea>
        </div>
        <div class="form-group">
            <label for="collection">Collection</label>
            <select name="collection">
                <?php foreach ($collections as $arrvalue) : ?>
                    <?php if ($arrvalue['id'] !== $collection->id) : ?>
                        <option value="<?=$arrvalue['id']?>"><?=$arrvalue['name']?></option>
                    <?php else : ?>
                        <option selected value="<?=$collection->id?>"><?=$collection->name?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="gender">gender</label>
            <select name="gender">
                <option value="1">Male</option>
                <option value="2">Female</option>
            </select>
        </div>
        <div class="form-group">
            <label for="category">Category</label>
            <select name="category">
                <?php foreach ($categories as $arrvalue) : ?>
                    <?php if ($arrvalue['id'] !== $category->id) : ?>
                        <option value="<?=$arrvalue['id']?>"><?=$arrvalue['name']?></option>
                    <?php else : ?>
                        <option selected value="<?=$category->id?>"><?=$category->name?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <input type="file" name="file" accept="image/*">
        </div>
        <input type="submit" name="submit">
    </form>
<!-- Form (end) -->

<?php
break;

    //  DELETE PRODUCT
    case "DELETE":
    
    if (isset($_GET['id'])) {
        $product->delete($_GET['id']);
        header("Location: ?mode=list");
    }
break;

    //  SAVE/UPDATE PRODUCT
    case "SAVE":

    $product->id = $_POST['id'];
    $product->name = $_POST['name'];
    $product->description = $_POST['description'];
    $product->collection = $_POST['collection'];
    $product->category = $_POST['category'];
    $product->gender = $_POST['gender'];
    
    if (!empty($_POST['id'])) {
        $product->save($product->id, '/assets/img/products/');
    } else {
        $product->save(0, '/assets/img/products/');
    }

    header("Location: products.php");
}
?>

<?php else :
    header("Location: index.php");
?>
<?php endif; ?>