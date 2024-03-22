<?php
include ("home-admin.php");
$id = $_GET["id-employee"];
$employee = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM employee WHERE employee_id = $id"));
$account_id = $employee['account_id'];
$account = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM account WHERE account_id = $account_id"));
$get_role_id = $account['role_id'];
$get_role = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM role where role_id = $get_role_id"));
?>
<link rel="stylesheet" href="css/update-employee1.css">
<section id="update-employee" class="update-employee">
    <div class="update-container">
        <header>
            <h3>UPDATE EMPLOYEE</h3>
            <h6>By Admin</h6>
        </header>
        <form class="update-form" action="" method="post">
            <br>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <br>
            <label>Employee Name</label>
            <br>
            <input type="text" name="name" value="<?php echo $employee['employee_name'] ?>">
            <br>
            <label>Employee Address</label>
            <br>
            <input type="text" name="address" value="<?php echo $employee['employee_address'] ?>">
            <br>
            <label>Employee Email</label>
            <br>
            <input type="email" name="email" value="<?php echo $account['email'] ?>">
            <br>
            <label>Employee Password</label>
            <br>
            <input type="password" name="password" value="<?php echo $account['password']?>" id="password_employee">
            <input type="checkbox" onclick="showPassword()"><span>Show Password</span>
            <br>
            <label>Employee Role</label>
            <select name="role" class="select-role">
                <option value="<?php echo $get_role_id ?>">
                    <?php echo $get_role['role_name'] ?>
                </option>
                <?php
                $firstemployeeRoleDisplayed = false;
                $sql = "SELECT * FROM role";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        if (!$firstemployeeRoleDisplayed && $row["role_id"] == $get_role_id) {
                            $firstemployeeRoleDisplayed = true;
                            continue; // Skip displaying the first employee's role again
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
            <button type="submit" value="edit-employee" name="submit" class="btn">Update</button>
        </form>
    </div>
</section>
<script>
    function showPassword() {
        var x = document.getElementById("password_employee");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>