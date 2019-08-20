<!DOCTYPE html>
<html>

<body>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
  <style type="text/css">
  body {
    width: 100%;
    height: 100%;
    background: url(background1.jpg) no-repeat;
    background-size: cover;
  }

  p {
    text-align: center;
  }
</style>
  <h1>DATABASE's ATN CONNECTION</h1>

  <?php
  ini_set('display_errors', 1);
  echo "HELLO CLOUD COMPUTING ATN Shop";

  ?>

  <?php


  if (empty(getenv("DATABASE_URL"))) {
    echo '<p>The DB does not exist</p>';
    $pdo = new PDO('pgsql:host=localhost;port=5432;dbname=mydb', 'postgres', '123456');
  } else {
    echo '<p>The DB exists</p>';
    echo getenv("dbname");
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

  $sql = "SELECT * FROM product ORDER BY productid";
  $stmt = $pdo->prepare($sql);
  //Thiết lập kiểu dữ liệu trả về
  $stmt->setFetchMode(PDO::FETCH_ASSOC);
  $stmt->execute();
  $resultSet = $stmt->fetchAll();
  echo '<p>products information:</p>';
  // foreach ($resultSet as $row) {
  // 	echo $row['product'];
  //         echo "    ";
  //         echo $row['fname'];
  //         echo "    ";
  //         echo $row['email'];
  //         echo "    ";
  //         echo $row['classname'];
  //         echo "<br/>";
  // }

  ?>

  <div class="widget-content nopadding">
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Product ID</th>
          <th>Name</th>
          <th>Price</th>
          <th>Supplier</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($resultSet as $key => $value) : ?>
          <tr class="odd gradeX">
            <td><?php echo $value['productid']; ?></td>
            <td><?php echo $value['name']; ?></td>
            <td><?php echo $value['price']; ?></td>
            <td><?php echo $value['supplier']; ?></td>
          </tr>
        <?php endforeach; ?>

      </tbody>
    </table>
  </div>
  <div class="row">
    <div class="col-12">
      <a href="InsertData.php" class="myButton pl-3">Insert data to the database's ATN</a>

      <a href="UpdateData.php" class="myButton pl-3">Update data to the database's ATN</a>

      <a href="DeleteData.php" class="myButton pl-3">Delete data to the database's ATN</a>
    </div>
  </div>
</body>

</html>