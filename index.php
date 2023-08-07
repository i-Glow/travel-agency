<?php
  session_start();
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(!isset($_SESSION['auth']))
      header('Location: login.php');
      
    $from = $_POST['from'];
    $to = $_POST['to'];
    $dateDepart = $_POST['dateDepart'];
    $dateReturn = $_POST['dateReturn'];
    $nb = $_POST['nb'];
    $userid = $_SESSION['user'];
    
    require('db.php');

    $sql = "INSERT INTO reservations (user_id, location_from, location_to, depart_date, return_date, number_of_places) VALUES ('$userid', '$from', '$to', '$dateDepart', '$dateReturn', '$nb')";
    $result = mysqli_query($conn, $sql);
    
    $conn->close();
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles/index.css">
  <?php require('./templates/head.php') ?>
  <title>Travelious</title>
</head>
<body>
  <?php require('./templates/nav.php') ?>
  <section class='hero'>
    <div class='background'></div>
    <div>
      <h1>Discover A Beautiful</h1>
      <h1>Place With Us</h1>
    </div>
    <div>
      <p>Would you explore nature paradise in the world, let's find the</p>
      <p>best destination in world with us.</p>
    </div>
  </section>
  <section class='presentation'>
    <div>
      <h2>Travelious: Your Passport to Unforgettable Adventures</h2>
      <p>
        Welcome to Travelious – your go-to source for unforgettable travel experiences. Explore the world with our
        curated travel packages and hotel accommodations, all at affordable prices. Our website is easy to navigate, and
        our team of travel experts is available 24/7 to assist you with any questions or concerns. Start planning your
        next adventure with Travelious today!
      </p>
    </div>
    <div class='image-ctn'>
      <div class="round-image"></div>
      <div class="round-image-s"></div>
    </div>
  </section>
  <section class='vol'>
    <h1>Reserve Your Flight Today!</h1>
    <form class='vol-reserve' method="POST" action="index.php">
      <div class='vol-ctn'>
        <div>
          <h5>From</h5>
          <input type='text' placeholder='Alger, Algeria' name="from"/>
        </div>
        <div>
          <h5>To</h5>
          <input type='text' placeholder='Madrid, Spain' name="to"/>
        </div>
      </div>
      <div class='vol-ctn'>
        <div>
          <h5>Depart</h5>
          <input type='date' name="dateDepart"/>
        </div>
        <div>
          <h5>Return</h5>
          <input type='date' name="dateReturn"/>
        </div>
      </div>
      <div class='vol-ctn'>
        <div>
          <h5>Audit</h5>
          <input type='number' placeholder='1' name="nb"/>
        </div>
      </div>
      <button type='submit' class='vol-btn'>
      <svg id='search' xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="currentColor" d="M15.5 14h-.79l-.28-.27a6.5 6.5 0 0 0 1.48-5.34c-.47-2.78-2.79-5-5.59-5.34a6.505 6.505 0 0 0-7.27 7.27c.34 2.8 2.56 5.12 5.34 5.59a6.5 6.5 0 0 0 5.34-1.48l.27.28v.79l4.25 4.25c.41.41 1.08.41 1.49 0c.41-.41.41-1.08 0-1.49L15.5 14zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5S14 7.01 14 9.5S11.99 14 9.5 14z"/></svg>
      </button>
    </form>
  </section>
</body>
<script src="../scripts/index.js"></script>
</html>