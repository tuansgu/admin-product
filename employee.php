<?php
include("home-admin.php");
?>
<link rel="stylesheet" href="css/employee.css">
<section id="employee" class="employee">
    <div class="container">
        <header>
            <h2>MANAGEMENT OF EMPLOYEE</h2>
        </header>
    </div>
    <div class="operate">
        <div class="operate-search">
            <input type="text" name="input-search" placeholder="Search In Here">
            <button class="btn-search">Search</button>
        </div>
        <div class="operate-add">
            <a class="btn-add" href="insert-employee.php#insert-employee">Insert Employee</a>
        </div>
    </div>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Employee Name</th>
                <th>Employee Address</th>   
                <th>Employee Email</th>
                <th>Role</th>
                <th>Operate</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT * FROM employee";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) > 0) {
                foreach ($result as $employee) {
                    $account_id = $employee['account_id'];
                    $query = "SELECT * FROM account WHERE account_id = $account_id";
                    $result_accountid = mysqli_query($conn, $query);
                    if (mysqli_num_rows($result_accountid) > 0) {
                        $row = mysqli_fetch_assoc($result_accountid);
                        $employee_email = $row['email'];
                        $employee_role_id = $row['role_id'];
                        $sql = "SELECT * FROM role WHERE role_id = $employee_role_id";
                        $result_role = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result_role) > 0) {
                            $row = mysqli_fetch_assoc($result_role);
                            $row_name = $row['role_name'];
                        }

                    }
                    ?>
                    <tr>
                        <td>
                            <?php echo $employee['employee_id']; ?>
                        </td>
                        <td>
                            <?php echo $employee['employee_name']; ?>
                        </td>
                        <td>
                            <?php echo $employee['employee_address']; ?>
                        </td>
                        <td>
                            <?php echo $employee_email ?>
                        </td>
                        <td>
                            <?php echo $row_name ?>
                        </td>
                        <td>
                            <div>
                                <a class="btn-edit" href="update-employee.php?id-employee=<?php echo $employee['employee_id'] ?>">Update</a>
                                    
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