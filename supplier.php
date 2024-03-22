<?php
include("home-admin.php");
?>
<link rel="stylesheet" href="css/supplier.css">
<section id="supplier" class="supplier">
    <div class="container">
        <header>
            <h2>MANAGEMENT OF SUPPLIER</h2>
        </header>
    </div>
    <div class="operate">
        <div class="operate-search">
            <input type="text" name="input-search" placeholder="Search In Here">
            <button class="btn-search">Search</button>
        </div>
        <div class="operate-add">
            <a class="btn-add" href="insert-supplier.php#insert-supplier">Insert Supplier</a>
        </div>
    </div>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Supplier Name</th>
                <th>Supplier Address</th>
                <th>Supplier Phone</th>
                <th>Brand Supply</th>
                <th>Contract Start</th>
                <th>Contract End</th>
                <th>Status</th>
                <th>Operate</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Update status based on contract end date
            $sql_status_update = "UPDATE supplier
                SET status_id = 
                    CASE 
                        WHEN contract_end < CURDATE() THEN 2
                        WHEN contract_end > CURDATE() THEN 1
                    END";
            mysqli_query($conn, $sql_status_update);

            // Fetch supplier data
            $sql_supplier = "SELECT * FROM supplier";
            $result_supplier = mysqli_query($conn, $sql_supplier);
            if (mysqli_num_rows($result_supplier) > 0) {
                foreach ($result_supplier as $supplier) {
                    $status_id = $supplier['status_id'];
                    $sql_status = "SELECT * FROM status WHERE status_id = $status_id";
                    $result_status = mysqli_query($conn, $sql_status);
                    $row_status = mysqli_fetch_assoc($result_status);
                    $status_name = $row_status['status_name'];
                    $supplier_id = $supplier['supplier_id'];
                    $sql = "SELECT category_name FROM category WHERE category_id = ( SELECT category_id FROM category_suplier WHERE supplier_id = $supplier_id);";
                    $row = mysqli_fetch_assoc(mysqli_query($conn, $sql));
                    $category_name = $row['category_name'];
                    ?>
                    <tr>
                        <td><?php echo $supplier['supplier_id']; ?></td>
                        <td><?php echo $supplier['supplier_name']; ?></td>
                        <td><?php echo $supplier['supplier_address']; ?></td>
                        <td><?php echo $supplier['supplier_phone']; ?></td>
                        <td><?php echo $category_name?></td>
                        <td><?php echo $supplier['contract_start']; ?></td>
                        <td><?php echo $supplier['contract_end']; ?></td>
                        <td><?php echo $status_name; ?></td>
                        <td>
                            <div>
                                <a class="btn-edit" href="update-supplier.php?id-supplier=<?php echo $supplier['supplier_id']; ?>">Update</a>
                            </div>
                        </td>
                    </tr>
                <?php
                }
            }
            ?>
        </tbody>
    </table>
</section>
