<?php
if (isset($_POST['submit'])) {
    if ($_POST['submit'] == "add-supplier") {
        add_supplier();
    } else if ($_POST['submit'] == "edit-supplier") {
        edit_supplier();
    }
}

function add_supplier()
{
    global $conn;
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $category_id = $_POST['category'];
    $contract_start = $_POST['contract_start'];
    $contract_end = $_POST['contract_end']; 

    // Thực hiện truy vấn để xác định trạng thái dựa trên contract_end
    $status_id = ($contract_end > date('Y-m-d')) ? 1 : 2;

    // Truy vấn SQL để chèn dữ liệu vào bảng supplier
    $sql_insert = "INSERT INTO supplier (supplier_name, supplier_address, supplier_phone, contract_start, contract_end, status_id) 
                   VALUES ('$name', '$address', '$phone', '$contract_start', '$contract_end', $status_id)";
    mysqli_query($conn, $sql_insert);
    $supplier_id = mysqli_insert_id($conn);
    $sql = "INSERT INTO category_suplier(category_id, supplier_id) VALUE('$category_id', '$supplier_id')";
    mysqli_query($conn, $sql);
    echo "<script>alert('Supplier Added Successfully'); document.location.href = 'supplier.php';</script>";
}

function edit_supplier()
{
    global $conn;
    $id = $_POST['id_supplier'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $brand_id = $_POST['brand'];
    $contract_start = $_POST['contract_start'];
    $contract_end = $_POST['contract_end'];

    $status_id = ($contract_end > date('Y-m-d')) ? 1 : 2;
    //Update data in table supplier
    $sql_update = "UPDATE supplier SET supplier_name = '$name', supplier_address = '$address', supplier_phone = '$phone', contract_start = '$contract_start', contract_end = '$contract_end', status_id = '$status_id' WHERE supplier_id = '$id'";

    mysqli_query($conn, $sql_update);
    //Update data in table category_supplier
    $sql_update_category_suplier = "UPDATE category_suplier SET category_id = '$brand_id' WHERE supplier_id = '$id'";
    mysqli_query($conn, $sql_update_category_suplier);

    echo 
    "
        <script>
            alert('Supplier Updated Successfully'); document.location.href='supplier.php#supplier.php';
        </script>
    ";
}

?>