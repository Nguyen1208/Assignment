<!DOCTYPE html>
<html>
<script>
    function CheckClass() {
        var CheckSupplierName = document.getElementById("Supplier1").value;
        var checkProductName = document.getElementById("Name1").value;
        var checkPrice = document.getElementById("price1").value;
        if (CheckSupplierName == "ToyCompany") {
            return true;
        } else if (checkProductName == "") {
            alert("Name should have Data");
            return false;
        } else if (checkEmail == "") {
            alert("price should have Data");
            return false;
        } else {
            alert("Supplier Name should equal ToyCompany ");
            return false;
        }
    }
</script>

<head>
    <title>Insert data to PostgreSQL with php - creating a simple web application</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="style.css">
    <style>
        li {
            list-style: none;
        }
    </style>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style type="text/css">
    body {
        width: 100%;
        height: 100%;
        background: url(background3.jpg) no-repeat;
        background-size: cover;
    }

    p {
        text-align: center;
    }
</style>

</head>

<body>
    <h1>INSERT DATA TO DATABASE's Store</h1>
    <h2>Enter data into product table</h2>
    <ul>
        <form name="InsertData" action="InsertData.php" method="POST">
            <li>Product ID:</li>
            <li><input type="text" name="productid" /></li>
            <li>Full Name:</li>
            <li><input type="text" name="name" id="Name1" /></li>
            <li>Price:</li>
            <li><input type="text" name="price" id="Price1" /></li>
            <li>Supplier:</li>
            <li><input type="text" name="supplier" id="Supplier1" /></li>
            <li><input type="submit" name="Submit" onclick="CheckSupplier()" /></li>
        </form>
    </ul>
    <div class="row">
        <div class="col-12">
            <a href="ConnectToDB.php" class="myButton pl-3">View Data's ATN</a>

            <a href="UpdateData.php" class="myButton pl-3">Update data to the database's ATN</a>

            <a href="DeleteData.php" class="myButton pl-3">Delete data to the database's ATN</a>
        </div>
    </div>
    <?php

    if (empty(getenv("DATABASE_URL"))) {
        echo '<p>The DB does not exist</p>';
        $pdo = new PDO('pgsql:host=localhost;port=5432;dbname=mydb', 'postgres', '123456');
    } else {

        $db = parse_url(getenv("DATABASE_URL"));
        $pdo = new PDO("pgsql:" . sprintf(
         "host=ec2-23-23-92-204.compute-1.amazonaws.com;
	  port=5432;
      user=wyzrqnbkiuwncx;
      password=24d31f16b50e6442ad43f27539406f82166b2ae356fcaa9e08dc2bfe2cf1ca4b;
      dbname=dflmee16l6qp3i",
            $db["host"],
            $db["port"],
            $db["user"],
            $db["pass"],
            ltrim($db["path"], "/")
        ));
    }

    if ($pdo === false) {
        echo "ERROR: Could not connect Database's ATN";
    }

    
    $sql = "INSERT INTO product(productid, name, price, supplier)"
        . " VALUES('$_POST[productid]','$_POST[name]','$_POST[price]','$_POST[supplier]')";
    $stmt = $pdo->prepare($sql);
    
    if (is_null($_POST[productid])) {
        echo "productID must be not null";
    } else {
        if ($stmt->execute() == TRUE) {
            echo "Record inserted successfully.";
        } else {
            echo "Error inserting record: ";
        }
    }
    ?>
</body>

</html>