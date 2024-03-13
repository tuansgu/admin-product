<?php
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Truy vấn xử lý đăng nhập
    $sql = "SELECT * FROM account WHERE email='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    // Kiểm tra số dòng kết quả trả về
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $account_id = $row['account_id'];
        $sql_employee = "SELECT * FROM `employee` WHERE account_id = $account_id;";
        $result_employee = mysqli_query($conn, $sql_employee);
        if (mysqli_num_rows($result_employee) > 0) {
            $employee_data = mysqli_fetch_assoc($result_employee);
            $_SESSION['employee_name'] = $employee_data['employee_name'];
            header("Location: index.php");
            exit();
        }

    } else {
        echo "Log in failed";
    }
}
?>