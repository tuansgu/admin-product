<?php
include("home-admin.php");
?>
<link rel="stylesheet" href="css/product1.css">
<section id="product" class="product">
    <div class="container">
        <header>
            <h2>MANAGEMENT OF PRODUCT</h2>
        </header>
    </div>
    <div class="operate">
        <div class="operate-search">
            <input type="text" name="input-search" placeholder="Search In Here">
            <button class="btn-search">Search</button>
        </div>
        <div class="operate-add">
            <a class="btn-add" href="insert-product.php#insert-product">Insert Product</a>
            <a class="btn-add" href="insert-product.php#insert-category">Insert Category</a>
        </div>
    </div>
    <div class="product">
        <?php 
            $products = mysqli_query($conn, "SELECT * FROM product");
            foreach ($products as $product) :
        ?>

        <div class="card">
            <img src="upload/<?php echo $product['image']; ?>" width="100" alt="Card image">
            <div class="card-content">
                <h3><?php echo $product['name']?></h3>
                <p><?php echo $product['price']?>$</p>
                <div class="operator-card">
                <a class="btn-edit" href="update-product.php?id=<?php echo $product['id']?>">Update</a>
                <form>
                    <button class="btn-detail" >Detail</button>
                </form>
                </div>
            </div>
            
        </div>
        <?php endforeach; ?>
    </div>
</section>