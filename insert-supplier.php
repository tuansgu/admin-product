<?php 
    include("home-admin.php");
?>
<link rel="stylesheet" href="css/insert-suplier.css">
<section id="insert-supplier" class="insert-supplier">
<div class="insert-container">
        <header>
            <h3>INSERT SUPPLIER</h3>
            <h6>By <?php echo $_SESSION['employee_name']?></h6>
        </header>
        <form class="insert-form"  method="post" >
            <label>Supplier Name</label>
            <br>
            <input type="text" name="name" required>
            <br>
            <label>Supplier Address</label>
            <br>
            <input type="text" name="address" required>
            <br>
            <label>Supplier Phone</label>
            <br>
            <input type="text" name="phone" required>
            <br>
            <label>Supply Category</label>
            <select name="category" class="select-category">
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
            <label class="lb_start">Contract Start</label>
            <input type="date" name="contract_start" class="input_date_start">
            <label class="lb_end">Contract End</label>
            <input type="date" name="contract_end" class="input_date_end ">
            <br>
            <button type="submit" value="add-supplier" name="submit" class="btn">Add supplier</button>

        </form>
    </div>
</section>