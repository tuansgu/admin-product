<?php
if (isset($_POST['submit'])) {
    if ($_POST['submit'] == "add-customer") {
        add_customer();
    } else if ($_POST['submit'] == "edit-customer") {
        edit_customer();
    }
}

function add_customer()
{
    global $conn;
    $name = $_POST['name'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Kiểm tra xem email đã tồn tại trong cơ sở dữ liệu chưa
    $sql = "SELECT * FROM account WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('That email is taken. Try another.'); document.location.href='insert-customer.php';</script>";
        return; // Dừng hàm nếu email đã tồn tại
    }

    // Lấy role_id từ role_name
    $sql_role = "SELECT * FROM role WHERE role_id = '$role'";
    $result = mysqli_query($conn, $sql_role);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $role_id = $row['role_id'];

        // Thêm tài khoản vào bảng account
        $sql_account = "INSERT INTO account (account_id, email, password, role_id) VALUES('', '$email', '$password', '$role_id')";
        $result = mysqli_query($conn, $sql_account);

        // Lấy account_id mới thêm vào
        $account_id = mysqli_insert_id($conn);

        // Thêm khách hàng vào bảng customer
        $sql_customer = "INSERT INTO customer (customer_id, customer_name, customer_address, account_id) VALUES('', '$name', '$address', '$account_id')";
        $result = mysqli_query($conn, $sql_customer);

        echo "<script>alert('Customer Added Successfully') document.location.href='customer.php';;</script>";
    } else {
        echo "Failured!";
    }
}
function edit_customer()
{
    global $conn;
    $id = $_POST['id_customer'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Check if email has changed

    $customer = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM customer WHERE customer_id = $id"));
    $account_id = $customer['account_id'];
    $sql_email_current = "SELECT email FROM account WHERE account_id = $account_id";
    $result_email_current = mysqli_query($conn, $sql_email_current);
    $row = mysqli_fetch_assoc($result_email_current);
    $account_email_current = $row['email'];

    if ($email != $account_email_current) {
        $sql_check_email = "SELECT * FROM account WHERE email = '$email'";
        $result_check_email = mysqli_query($conn, $sql_check_email);
        if (mysqli_num_rows($result_check_email) > 0) {
            echo "<script>alert('That email is taken. Try another.'); document.location.href='update-customer.php?id-customer=$id';</script>";
            return;
        }
    }
    // Check if the new role exists
    $sql_check_role = "SELECT * FROM role WHERE role_id = '$role'";
    $result_check_role = mysqli_query($conn, $sql_check_role);
    if (mysqli_num_rows($result_check_role) > 0) {
        $row_check_role = mysqli_fetch_assoc($result_check_role);
        $role_id = $row_check_role['role_id'];

        // Update customer
        $sql_update_customer = "UPDATE customer SET customer_name = '$name', customer_address = '$address' WHERE customer_id = $id";
        $result_update_customer = mysqli_query($conn, $sql_update_customer);

        //get account_id
        $sql_account_id = "SELECT * FROM customer WHERE customer_id = $id";
        $result = mysqli_query($conn, $sql_account_id);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $account_id = $row["account_id"];
        }
        // Update account
        $sql_update_account = "UPDATE account SET email = '$email', password= '$password', role_id = '$role_id' WHERE account_id = $account_id";
        $result_update_account = mysqli_query($conn, $sql_update_account);

        if ($result_update_customer && $result_update_account) {
            echo "<script>alert('Customer Updated Successfully')</script>";
        } else {
            echo "Update failed!";
        }
    } else {
        echo "Role does not exist!";
    }
}

?>