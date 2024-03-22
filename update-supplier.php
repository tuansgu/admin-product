<?php
include ("home-admin.php");
$id = $_GET["id-supplier"];
$supplier = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM supplier WHERE supplier_id = $id"));
$status_id = $supplier['status_id'];
$status = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM status WHERE status_id = $status_id"));
$status_name = $status['status_name'];
$category = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM category WHERE category_id = (SELECT category_id FROM category_suplier WHERE supplier_id = $id)"));
$get_brand_id = $category['category_id'];

?>
<link rel="stylesheet" href="css/update-suplier.css">
<section id="update-supplier" class="update-supplier">
    <div class="update-container">
        <header>
            <h3>UPDATE SUPPLIER</h3>
        </header>
        <form class="update-form" action="" method="post">
            <input type="hidden" value="<?php echo $id ?>" name="id_supplier">
            <br>
            <label>Supplier Name</label>
            <br>
            <input type="text" name="name" value="<?php echo $supplier['supplier_name'] ?>">
            <br>
            <label>Supplier Address</label>
            <br>
            <input type="text" name="address" value="<?php echo $supplier['supplier_address'] ?>">
            <br>
            <label>Supplier Phone</label>
            <br>
            <input type="text" name="phone" value="<?php echo $supplier['supplier_phone'] ?>">
            <br>
            <label>Brand Supply</label>
            <select name="brand" class="select-brand">
                <option value="<?php echo $get_brand_id ?>">
                    <?php echo $category['category_name'] ?>
                </option>
                <?php
                $firstBrandSupplyDisplayed = false;
                $sql = "SELECT * FROM category";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        if (!$firstBrandSupplyDisplayed && $row["category_id"] == $get_brand_id) {
                            $firstBrandSupplyDisplayed = true;
                            continue; // Skip displaying the first customer's role again
                        }
                        ?>
                        <option value="<?php echo $row["category_id"] ?>">
                            <?php echo $row["category_name"] ?>
                        </option>
                        <?php
                    }
                }
                ?>
            </select>
            <br>
            <div class="contract_date">
                <div class="contract_start">
                    <label>Contract Start</label>
                    <input class="input_date_start" type="date" name="contract_start"
                        value="<?php echo $supplier['contract_start'] ?>">
                </div>
                <div class="contract_end">
                    <label class="lb_end">Contract End</label>
                    <input class="input_date_end" type="date" name="contract_end"
                        value="<?php echo $supplier['contract_end'] ?>">
                </div>
            </div>
            <br>
            <button type="submit" value="edit-supplier" name="submit" class="btn">Update</button>
        </form>
    </div>
</section>