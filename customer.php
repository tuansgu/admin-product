<?php
include("home-admin.php");
?>
<link rel="stylesheet" href="css/customer1.css">
<section id="customer" class="customer">
    <div class="container">
        <header>
            <h2>MANAGEMENT OF CUSTOMER</h2>
        </header>
    </div>
    <div class="operate">
        <div class="operate-search">
            <input type="text" name="input-search" placeholder="Search In Here">
            <button class="btn-search">Search</button>
        </div>
        <div class="operate-add">
            <a class="btn-add" href="insert-customer.php#insert-customer">Insert Product</a>
        </div>
    </div>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Customer Name</th>
                <th>Customer Address</th>
                <th>Customer Email</th>
                <th>Role</th>
                <th>Operate</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $query = "SELECT * FROM customer";
                $result = mysqli_query($conn, $query);
                if(mysqli_num_rows($result) > 0)
                {
                    foreach($result as $customer)
                    {
                            $account_id = $customer['account_id'];
                            $query = "SELECT * FROM account WHERE account_id = $account_id";
                            $result_accountid = mysqli_query($conn, $query);
                            if(mysqli_num_rows($result_accountid) > 0)
                            {
                                $row = mysqli_fetch_assoc($result_accountid);
                                $customer_email = $row['email'];
                                $customer_role_id = $row['role_id'];
                                $sql = "SELECT * FROM role WHERE role_id = $customer_role_id";
                                $result_role = mysqli_query($conn, $sql);
                                if(mysqli_num_rows($result_role) > 0)
                                {
                                    $row = mysqli_fetch_assoc($result_role);
                                    $row_name = $row['role_name'];
                                }

                            }
                        ?>
                        <tr>
                            <td><?php echo $customer['customer_id'];?></td>
                            <td><?php echo $customer['customer_name'];?></td>
                            <td><?php echo $customer['customer_address'];?></td>
                            <td><?php echo $customer_email?></td>
                            <td><?php echo $row_name?></td>
                            <td>
                                <div>
                                <a class="btn-edit" href="update-customer.php?id=<?php echo $customer['customer_id']?>">Update</a>
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