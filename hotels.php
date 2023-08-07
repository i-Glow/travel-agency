<?php 
  session_start();
  
  require('db.php');

  if(isset($_SESSION['user'])){ 
    $userid = $_SESSION['user'];
    $sql = "SELECT * FROM hotels WHERE location IN (SELECT location_to FROM reservations WHERE user_id = '$userid' ORDER BY depart_date ASC)";
    $result = mysqli_query($conn, $sql);
    $hotels = mysqli_fetch_all($result);
    
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
      $idx = $_POST['index'];

      //query to insert in db
      $reserve_sql = "INSERT INTO hotel_reservation (hotel_id, user_id) VALUES ('$idx', '$userid')";
      $result = mysqli_query($conn, $reserve_sql);
    }
  }
  
  if(!isset($_SESSION['user']) || count($hotels) == 0) {
    $sql = "SELECT * FROM hotels";
    $result = mysqli_query($conn, $sql);
    $hotels = mysqli_fetch_all($result);
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hotels - Travelious</title>
  <link rel="stylesheet" href="./styles/hotels.css">
  <?php require('./templates/head.php') ?>
</head>
<body>
  <?php require('./templates/nav.php') ?>
  <main>
    <h1 class='page-heading'>Hotels For You</h1>
    <div class="wrapper">
      <div class="filters">
        <h2>Filters</h2>
        <h4>Date</h4>
        <input id='date' type="date" />
        <h4>Destination</h4>
        <input id='destination' type="text" />
        <h4>Price</h4>
        <input id='price' type="number" />
        <h4>Number of places</h4>
        <input id='noplace' type="number" />
        <button id='filter'>Filter</button>
      </div>
      <div class="grid">
        <?php if($hotels){ foreach($hotels as $hotel) { ?>
          <form class="card" action='hotels.php' method='POST'>
            <img src="data:image/png;charset=utf8;base64,<?php echo base64_encode($hotel[6]); ?>" alt="hotel">
            <div class='info'>
              <h2><?php echo $hotel[1]; ?></h2>
              <div class='loc-date'>
                <p><?php echo $hotel[4]; ?></p>
                <h4><?php echo $hotel[2]; ?></h4>
              </div>
              <div class='book-ctn'>
                <div>
                  <h2><?php echo $hotel[3]; ?> DA</h2>
                  <p>/person</p>
                </div>
                <input style='display:none;' value='<?php echo $hotel[5]; ?>' name='noplaces' />
                <input style='display:none;' value='<?php echo $hotel[0]; ?>' name='index' />
                <button type='submit' >Book Now</button>
              </div>
            </div>
          </form>
        <?php }} ?>
      </div>
    </div>
  </div>
  </main>
  <script src="../scripts/filter.js"></script>
</body>
</html>