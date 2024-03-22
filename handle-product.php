<?php
if (isset ($_POST['submit'])) {
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
    $category_id = $_POST["role"];
    $price_supplier = $_POST["price-suplier"];
    $price = $_POST["price"];
    $stock = $_POST["stock"];
    // handle upload file product
    $namefile = $_FILES["file"]["name"];
    $tmpfile = $_FILES["file"]["tmp_name"];
    $new_filename = uniqid() . "-" . $namefile;

    // Fetching category_id from the category table


    // Check if the category exists

    move_uploaded_file($tmpfile, 'upload/' . $new_filename);
    $query = "INSERT INTO product (id, name, category_id, price_suplier, price, stock, image) VALUES ('','$name', '$category_id', '$price_supplier', '$price', '$stock', '$new_filename')";
    mysqli_query($conn, $query);

    echo "
                <script>alert('Product Added Successfully'); document.location.href = 'index.php';</script>
    ";

}



function edit()
{
    global $conn;

    $id = $_GET["id"];
    $name = $_POST["name"];
    $category_id = $_POST["role"];
    $price_suplier = $_POST["price-suplier"];
    $price = $_POST["price"];
    $stock = $_POST["stock"];

    if ($_FILES["file"]["error"] != 4) {
        $filename = $_FILES["file"]["name"];
        $tmpName = $_FILES["file"]["tmp_name"];

        $newFilename = uniqid() . "-" . $filename;

        move_uploaded_file($tmpName, 'upload/' . $newFilename);
        $query = "UPDATE product SET image ='$newFilename' WHERE id = $id";
        mysqli_query($conn, $query);

        $query = "UPDATE product SET name = '$name', category_id = '$category_id', price_suplier = '$price_suplier', price = '$price', stock = '$stock' WHERE id = $id";
        mysqli_query($conn, $query);
        echo
            "
                <script> alert('Product Updated Sussessfully'); document.location.href = 'index.php';</script>
            ";

    }
}

?>