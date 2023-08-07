<?php 
  session_start();
  
  require('db.php');
  
  $sql = "SELECT * FROM destinations";
  $result = mysqli_query($conn, $sql);
  $destinations = mysqli_fetch_all($result);
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./styles/globals.css">
  <link rel="stylesheet" href="./styles/destinations.css">
  <?php require('./templates/head.php') ?>
  <title>Destinations - Travelious</title>
</head>
<body>
  <?php require('./templates/nav.php') ?>
  <main>
    <h1 class='page-heading'>Our Top Destinations</h1>
    <div class="container">
      <?php if($destinations){ foreach($destinations as $destination) { ?>
        <div class="card">
          <img class='card-img' src="data:image/png;charset=utf8;base64,<?php echo base64_encode($destination[3]); ?>" alt="destination">
          <div class='card-details'>
            <h2><?php echo $destination[1]; ?></h2>
            <p><?php echo $destination[2]; ?></p>
          </div>
        </div>
      <?php }} ?>
    </div>
  </main>
</body>
</html>