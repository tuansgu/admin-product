    <?php
    include("config.php");
    if (isset($_SESSION['employee_name'])) {
        $employee_name = $_SESSION['employee_name'];
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/home-admin.css">
        <title>Admin</title>
    </head>

    <body>
        <div class="container">
            <aside class="content-admin">
                <div class="logo">
                    <h2>
                        T-Product
                    </h2>
                </div>
                <div class="user">
                    <h3><?php echo "Welcome, $employee_name";?></h3>
                </div>
                <ul>
                    <li><a href="product.php#product">Product</a></li>
                    <li><a href="customer.php#customer">Customer</a></li>
                    <li><a>Employee</a></li>
                    <li><a>Suplier</a></li>
                    <li><a>Import & Export</a></li>
                    <li><a>Dashboard</a></li>
                </ul>
                <div>
                    <button class="btn">
                        Log Out
                    </button>
                </div>
            </aside>
        </div>
    </body>

    </html>