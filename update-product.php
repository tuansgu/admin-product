<?php 
    include("home-admin.php");
    $id = $_GET["id"];
    $product = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM product WHERE id = $id"));
    $category_id = $product['category_id'];
    $sql_category = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM category WHERE category_id = $category_id"));
    $category_name = $sql_category['category_name'];
?>
<link rel="stylesheet"href="css/update-product.css">
<section id="update-product" class="update-product">
    <div class="update-container">
        <header>
            <h3>UPDATE PRODUCT</h3>
            <h6>By Admin</h6>
        </header>
        <form class="update-form" action="" method="post" enctype="multipart/form-data">
            <?php echo $id ?>;
            <label>Tên Sản Phẩm</label>
            <br>
            <input type="text" name="name" value="<?php echo $product['name']?>">
            <br>
            <label>Loại Sản Phẩm</label>
            <br>
            <input type="text" name="category" value="<?php echo $category_name?>">
            <br>
            <label>Gía Sản Phẩm Từ Nhà Cung Cấp</label>
            <br>
            <input type="number" name="price-suplier" value="<?php echo $product['price_suplier'] ?>">
            <br>
            <label>Gía Sản Phẩm Bán Ra</label>
            <br>
            <input type="number" name="price" value="<?php echo $product['price']?>">
            <br>
            <label>Số Lượng Còn Lại</label>
            <br>
            <input type="number" name="stock" value="<?php echo $product['stock']?>">
            <br>
            <input type="file" name="file" value="<?php echo $product['image']?>">
            <br>
            <button type="submit" value="edit" name="submit" class="btn">Update</button>
        </form>
    </div>
</section>