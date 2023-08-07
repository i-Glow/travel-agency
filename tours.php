<?php 
  session_start();

  require('db.php');
  
  if(isset($_SESSION['user'])){ 
    $userid = $_SESSION['user'];
    
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
      $idx = $_POST['index'];

      //query to insert in db
      $reserve_sql = "INSERT INTO tour_reservation (tour_id, user_id) VALUES ('$idx', '$userid')";
      $result = mysqli_query($conn, $reserve_sql);
    }
  }

  $sql = "SELECT * FROM tours";
  $result = mysqli_query($conn, $sql);
  $tours = mysqli_fetch_all($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./styles/globals.css">
  <link rel="stylesheet" href="./styles/tours.css">
  <title>Tours - Travelious</title>
  <?php require('./templates/head.php') ?>
</head>
<body>
  <?php require('./templates/nav.php') ?>
  <main>
    <h1 class='page-heading'>Our Tours</h1>
    <div class="container">
      <?php if($tours){ foreach($tours as $tour) { ?>
        <form class="card" action='tours.php' method='POST'>
        <img src="data:image/png;charset=utf8;base64,<?php echo base64_encode($tour[7]); ?>" alt="tour">
          <div class='card-details'>
            <h2 style='color: var(--blue)' ><?php echo $tour[1]; ?></h2>
            <div class='duration'>
              <h4>Duration: </h4>
              <p><?php echo $tour[2]; ?> Days,</p>
              <p>From </p>
              <h4><?php echo DateTime::createFromFormat('Y-m-d', $tour[3])->format('j M'); ?></h4>
              <p>to </p>
              <h4><?php echo DateTime::createFromFormat('Y-m-d', $tour[4])->format('j M'); ?></h4>
            </div>
            <div class="hotel">
              <h4>Hotel: </h4>
              <p><?php echo $tour[5]; ?></p>
            </div>
            <h3><?php echo $tour[6]; ?> DZD</h3>
            <input style='display:none;' value='<?php echo $tour[0]; ?>' name='index' />
            <button class='reserve' type='submit' >Reserve Now</button>
          </div>  
        </form>
      <?php }} ?>
    </div>
  </main>
</body>
</html>