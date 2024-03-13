<?php
if (isset($_POST['submit'])) {
    if ($_POST['submit'] == "add") {
        add();
    } else if ($_POST['submit'] == "edit") {
        edit();
    }
}

function add()
{
    global $conn;
    $name = $_POST["name"];
    $category = $_POST["category"];
    $price_supplier = $_POST["price-suplier"];
    $price = $_POST["price"];
    $stock = $_POST["stock"];
    // handle upload file product
    $namefile = $_FILES["file"]["name"];
    $tmpfile = $_FILES["file"]["tmp_name"];
    $new_filename = uniqid() . "-" . $namefile;

    // Fetching category_id from the category table
    $sql_categoryID = "SELECT category_id FROM category WHERE category_name = '$category'";
    $result_categoryID = mysqli_query($conn, $sql_categoryID);

    // Check if the category exists
    if (mysqli_num_rows($result_categoryID) > 0) {
        $row = mysqli_fetch_assoc($result_categoryID);
        $category_id = $row['category_id'];

        move_uploaded_file($tmpfile, 'upload/' . $new_filename);
        $query = "INSERT INTO product (id, name, category_id, price_suplier, price, stock, image) VALUES ('','$name', '$category_id', '$price_supplier', '$price', '$stock', '$new_filename')";
        mysqli_query($conn, $query);

        echo "
                <script>alert('Product Added Successfully'); document.location.href = 'index.php';</script>
            ";
    } else {
        echo "Category not found!";
    }
}



function edit()
{
    global $conn;

    $id = $_GET["id"];
    $name = $_POST["name"];
    $category = $_POST["category"];
    $price_suplier = $_POST["price-suplier"];
    $price = $_POST["price"];
    $stock = $_POST["stock"];

    if ($_FILES["file"]["error"] != 4) {
        $filename = $_FILES["file"]["name"];
        $tmpName = $_FILES["file"]["tmp_name"];

        $newFilename = uniqid() . "-" . $filename;
        $sql_categoryID = "SELECT category_id FROM category WHERE category_name = '$category'";
        $result_categoryID = mysqli_query($conn, $sql_categoryID);
        if (mysqli_num_rows($result_categoryID) > 0) {
            $row = mysqli_fetch_assoc($result_categoryID);
            $category_id = $row['category_id'];

            move_uploaded_file($tmpName, 'upload/' . $newFilename);
            $query = "UPDATE product SET image ='$newFilename' WHERE id = $id";
            mysqli_query($conn, $query);

            $query = "UPDATE product SET name = '$name', category_id = '$category_id', price_suplier = '$price_suplier', price = '$price', stock = '$stock' WHERE id = $id";
            mysqli_query($conn, $query);
            echo 
            "
                <script> alert('Product Updated Sussessfully'); document.location.href = 'index.php';</script>
            ";
        };
    }
}

?>