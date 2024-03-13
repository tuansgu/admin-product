<?php
if (isset($_POST['submit'])) {
    if ($_POST['submit'] == "add-customer") {
        add_customer();
    } else if ($_POST['submit'] == "edit") {
        edit();
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
        
        echo "<script>alert('Customer Added Successfully');</script>";
    } else {
        echo "Failured!";
    }
}
?>
