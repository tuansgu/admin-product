<?php
    include("home-admin.php");
?>
<link rel="stylesheet"href="css/insert-product.css">
<section id="insert-product" class="insert-product">
    <div class="insert-container">
        <header>
            <h3>INSERT PRODUCT</h3>
            <h6>By Admin</h6>
        </header>
        <form class="insert-form" action="insert-product.php" method="post" enctype="multipart/form-data">
            <label>Tên Sản Phẩm</label>
            <br>
            <input type="text" name="name" required>
            <br>
            <label>Loại Sản Phẩm</label>
            <br>
            <input type="text" name="category" required>
            <br>
            <label>Gía Sản Phẩm Từ Nhà Cung Cấp</label>
            <br>
            <input type="number" name="price-suplier" required>
            <br>
            <label>Gía Sản Phẩm Bán Ra</label>
            <br>
            <input type="number" name="price" required>
            <br>
            <label>Số Lượng Còn Lại</label>
            <br>
            <input type="number" name="stock" required>
            <br>
            <input type="file" name="file" required>
            <br>
            <button type="submit" value="add" name="submit" class="btn">Add</button>
        </form>
    </div>
</section>