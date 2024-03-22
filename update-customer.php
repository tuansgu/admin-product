<?php
include("home-admin.php");
$id = $_GET["id-customer"];
$customer = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM customer WHERE customer_id = $id"));
$account_id = $customer['account_id'];
$account = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM account WHERE account_id = $account_id"));
$get_role_id = $account['role_id'];
$get_role = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM role where role_id = $get_role_id"));
?>
<link rel="stylesheet" href="css/update-customer.css">
<section id="update-customer" class="update-customer">
    <div class="update-container">
        <header>
            <h3>UPDATE CUSTOMER</h3>
            <h6>By Admin</h6>
        </header>
        <form class="update-form" action="" method="post">
            <input type="hidden" value="<?php echo $id ?>" name="id_customer">
            <br>
            <label>Customer Name</label>
            <br>
            <input type="text" name="name" value="<?php echo $customer['customer_name'] ?>">
            <br>
            <label>Customer Address</label>
            <br>
            <input type="text" name="address" value="<?php echo $customer['customer_address'] ?>">
            <br>
            <label>Customer Email</label>
            <br>
            <input type="email" name="email" value="<?php echo $account['email'] ?>">
            <br>
            <label>Customer Password</label>
            <br>
            <input type="password" name="password" value="<?php echo $account['password'] ?>">
            <br>
            <label>Customer Role</label>
            <select name="role" class="select-role">
                <option value="<?php echo $get_role_id ?>">
                    <?php echo $get_role['role_name'] ?>
                </option>
                <?php
                $firstCustomerRoleDisplayed = false;
                $sql = "SELECT * FROM role";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        if (!$firstCustomerRoleDisplayed && $row["role_id"] == $get_role_id) {
                            $firstCustomerRoleDisplayed = true;
                            continue; // Skip displaying the first customer's role again
                        }
                        ?>
                        <option value="<?php echo $row["role_id"] ?>">
                            <?php echo $row["role_name"] ?>
                        </option>
                        <?php
                    }
                }
                ?>
            </select>

            <br>
            <button type="submit" value="edit-customer" name="submit" class="btn">Update</button>
        </form>
    </div>
</section>