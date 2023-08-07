<?php
  session_start();
  $conn = new mysqli('localhost', 'travel', '12travel3', 'travelious');
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  if(isset($_SESSION['user'])){ 
    $userid = $_SESSION['user'];
    
    $user_sql = "SELECT username, phone FROM users WHERE id = '$userid'";
    $result = mysqli_query($conn, $user_sql);
    $user = mysqli_fetch_assoc($result);

    $hotel_sql = "SELECT hr_id, name, price, date, location, capacity, image FROM hotel_reservation JOIN hotels ON id = hotel_id WHERE user_id = '$userid'";
    $tour_sql = "SELECT tr_id, location, duration, start_date, end_date, hotel, price, image FROM tour_reservation JOIN tours ON id = tour_id WHERE user_id = '$userid'";
    $flight_sql = "SELECT * FROM reservations WHERE user_id = '$userid'";

    $hotel_result = mysqli_query($conn, $hotel_sql);
    $tour_result = mysqli_query($conn, $tour_sql);
    $flight_result = mysqli_query($conn, $flight_sql);

    $hotel_reservation = [];
    while ($row = mysqli_fetch_assoc($hotel_result)) {
      array_push($hotel_reservation, $row);
    }
    $tour_reservation = [];
    while ($row = mysqli_fetch_assoc($tour_result)) {
      array_push($tour_reservation, $row);
    }
    $flight_reservation = [];
    while ($row = mysqli_fetch_assoc($flight_result)) {
      array_push($flight_reservation, $row);
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
      if(isset($_POST['cancel-hotel'])) {
        $id = $_POST['cancel-hotel'];
        
        $hotel_cancel_sql = "DELETE FROM hotel_reservation WHERE hr_id = '$id'";
        mysqli_query($conn, $hotel_cancel_sql);

        header('Location: ' . $_SERVER['PHP_SELF']);
      } else
      if(isset($_POST['cancel-tour'])) {
        $id = $_POST['cancel-tour'];

        $tour_cancel_sql = "DELETE FROM tour_reservation WHERE tr_id = '$id'";
        mysqli_query($conn, $tour_cancel_sql);

        header('Location: ' . $_SERVER['PHP_SELF']);
      } else 
      if(isset($_POST['cancel-flight'])) {
        $id = $_POST['cancel-flight'];
        
        $flight_cancel_sql = "DELETE FROM reservations WHERE id = '$id'";
        mysqli_query($conn, $flight_cancel_sql);

        header('Location: ' . $_SERVER['PHP_SELF']);
      }
    }
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Account</title>
  <?php require('./templates/head.php') ?>
  <link rel="stylesheet" href="styles/account.css">
</head>
<body>
  <?php require('./templates/nav.php') ?>
  <main>
    <div>
      <div class='contact'>
        <?php if(isset($user)){ ?>
          <div><span>name: </span><strong><?php echo $user['username'] ?></strong></div>
          <div><span>phone: </span><strong><?php echo $user['phone'] ?></strong></div>
        <?php } ?>
      </div>
    </div>
    <div>
      <h2 class='heading' >Reserved Hotels:</h2>
      <div class="card-container">
        <?php if($hotel_reservation){ foreach($hotel_reservation as $hotel) { ?>
          <form class="card" action='account.php' method='POST'>
            <img src="data:image/png;charset=utf8;base64,<?php echo base64_encode($hotel['image']); ?>" alt="hotel">
            <div class='info'>
              <h2><?php echo $hotel['name']; ?></h2>
              <div class='loc-date'>
                <p><?php echo $hotel['location']; ?></p>
                <h4><?php echo $hotel['date']; ?></h4>
              </div>
              <div class='book-ctn'>
                <div>
                  <h2><?php echo $hotel['price']; ?> DA</h2>
                  <p>/person</p>
                </div>
                <button class='cancel-btn' type='submit' value='<?php echo $hotel['hr_id']; ?>' name='cancel-hotel' >Cancel reservation</button>
              </div>
            </div>
          </form>
        <?php }} ?>
      </div>
      <br />
      <h2 class='heading' >Reserved Tours:</h2>
      <div class="card-container">
        <?php if($tour_reservation){ foreach($tour_reservation as $tour) { ?>
          <form class="card-tour" action='account.php' method='POST'>
              <img src="data:image/png;charset=utf8;base64,<?php echo base64_encode($tour['image']); ?>" alt="tour">
              <div class='card-details-tour'>
                <h2 style='color: var(--blue)' ><?php echo $tour['location']; ?></h2>
                <div class='duration-tour'>
                  <h4>Duration: </h4>
                  <p><?php echo $tour['duration']; ?> Days,</p>
                  <p>From </p>
                  <h4><?php echo DateTime::createFromFormat('Y-m-d', $tour['start_date'])->format('j M'); ?></h4>
                  <p>to </p>
                  <h4><?php echo DateTime::createFromFormat('Y-m-d', $tour['end_date'])->format('j M'); ?></h4>
                </div>
                <div class="hotel-tour">
                  <h4>Hotel: </h4>
                  <p><?php echo $tour['hotel']; ?></p>
                </div>
                <h3><?php echo $tour['price']; ?> DZD</h3>
                <button class='cancel-btn' type='submit' value='<?php echo $tour['tr_id']; ?>' name='cancel-tour' >Cancel reservation</button>
              </div>  
            </form>
        <?php }} ?>
      </div>
      <br />
      <h2 class='heading' >Reserved Flights:</h2>
      <div class="card-container">
        <?php if($flight_reservation){ foreach($flight_reservation as $flight) { ?>
          <form method='POST' action='account.php' class='card-flight' id='<?php echo $flight[0]; ?>'>
            <div>
              <span style='margin-right: 15px;'><span>From: </span><strong><?php echo $flight['location_from']; ?></strong></span>
              <span><span>To: </span><strong><?php echo $flight['location_to']; ?></strong></span>
            </div>
            <div>
              <span style='margin-right: 15px;'><span>Departure: </span><strong><?php echo $flight['depart_date']; ?></strong></span>
              <span><span>Return: </span><strong><?php echo $flight['return_date']; ?></strong></span>
            </div>
            <div>
              <span>Places: </span><strong><?php echo $flight['number_of_places']; ?></strong>
            </div>
            <button class='cancel-btn' type='submit' value='<?php echo $flight['id']; ?>' name='cancel-flight' >Cancel reservation</button>
        </form>
        <?php }} ?>
      </div>
    </div>
  </main>
</body>
</html>