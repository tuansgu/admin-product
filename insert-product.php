<?php
    include("home-admin.php");
?>
<link rel="stylesheet"href="css/insert-product4.css">
<section id="insert-product" class="insert-product">
    <div class="insert-container">
        <header>
            <h3>INSERT PRODUCT</h3>
            <h6>By Admin</h6>
        </header>
        <form class="insert-form" action="insert-product.php" method="post" enctype="multipart/form-data">
            <label>Product Name</label>
            <br>
            <input type="text" name="name" required>
            <br>
            <label>Product Category</label>   
            <select name="role" class="select-category">
                <?php 
                    $sql = "SELECT * FROM category";
                    $result = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($result) > 0)
                    {
                        while($row = mysqli_fetch_assoc($result))
                        {
                            ?>
                            <option name = "category_name" value=<?php echo $row["category_id"]?>>
                                <?php echo $row["category_name"] ?>
                            </option>
                            <?php
                        }
                    }
                ?>
            </select>
            <br>
            <label>Price From Suplier</label>
            <br>
            <input type="number" name="price-suplier" required>
            <br>
            <label>Pirce</label>
            <br>
            <input type="number" name="price" required>
            <br>
            <label>Stock</label>
            <br>
            <input type="number" name="stock" required>
            <br>
            <input type="file" name="file" required>
            <br>
            <button type="submit" value="add" name="submit" class="btn">Add Product</button>
        </form>
    </div>
</section>