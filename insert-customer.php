<?php 
    include("home-admin.php");
?>
<link rel="stylesheet" href="css/insert-customer.css">
<section id="insert-customer" class="insert-customer">
<div class="insert-container">
        <header>
            <h3>INSERT CUSTOMER</h3>
            <h6>By Admin</h6>
        </header>
        <form class="insert-form" action="insert-customer.php" method="post" >
            <label>Customer Name</label>
            <br>
            <input type="text" name="name" required>
            
            <br>
            <label>Customer Address</label>
            <br>
            <input type="text" name="address" required>
            <br>
            <label>Customer Email</label>
            <br>
            <input type="email" name="email" required>
            <br>
            <label>Customer Password</label>
            <br>
            <input type="text" name="password" required>
            <br>
            <label>Customer Role</label>
            <select name="role" class="select-role">
                <?php 
                    $sql = "SELECT * FROM role";
                    $result = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($result) > 0)
                    {
                        while($row = mysqli_fetch_assoc($result))
                        {
                            ?>
                            <option name = "role_name" value=<?php echo $row["role_id"]?>>
                                <?php echo $row["role_name"] ?>
                            </option>
                            <?php
                        }
                    }
                    
                ?>

            </select>
            <br>
            <button type="submit" value="add-customer" name="submit" class="btn">Add Customer</button>
        </form>
    </div>
</section>