<?php 
    include("home-admin.php");
?>
<link rel="stylesheet" href="css/insert-employee.css">
<section id="insert-employee" class="insert-employee">
<div class="insert-container">
        <header>
            <h3>INSERT EMPLOYEE</h3>
            <h6>By <?php echo $_SESSION['employee_name']?></h6>
        </header>
        <form class="insert-form" action="insert-employee.php" method="post" >
            <label>Employee Name</label>
            <br>
            <input type="text" name="name" required>
            <br>
            <label>Employee Address</label>
            <br>
            <input type="text" name="address" required>
            <br>
            <label>Employee Email</label>
            <br>
            <input type="email" name="email" required>
            <br>
            <label>Employee Password</label>
            <br>
            <input type="text" name="password" required>
            <br>
            <label>Employee Role</label>
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
            <button type="submit" value="add-employee" name="submit" class="btn">Add employee</button>
        </form>
    </div>
</section>