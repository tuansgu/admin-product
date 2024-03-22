<?php
session_start();
$conn = new mysqli("localhost", "root", "", "e-commercial");
if ($conn->connect_error) {
    die("Connection failed" . $conn->connect_error);
}
include("handle-login.php");
include("handle-product.php");
include("handle-customer.php");
include("handle-employee.php");
include("handle-supplier.php");
?>