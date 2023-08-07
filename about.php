<?php
  session_start();
  if($_SERVER['REQUEST_METHOD'] === 'POST') {

    require('db.php');
    
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    
    $sql = "INSERT INTO ticket (name, email, message) VALUES ('$name', '$email', '$message')";
    $result = mysqli_query($conn, $sql);
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Travelious</title>
  <link rel="stylesheet" href="styles/about.css">
  <?php require('./templates/head.php') ?>
</head>
<body>
  <?php require('./templates/nav.php') ?>
  <main>
    <div class='layout'>
      <div class="details">
        <div>
          <h1>About Us</h1>
          <p>
            Welcome to Travelious, your go-to travel agency for all your travel needs. Our team of travel experts has extensive knowledge and experience in the travel industry, and we're passionate about sharing our love of travel with you. We curate a wide range of travel packages and hotel accommodations to offer you the best and most unique experiences around the globe. We also offer customized travel planning to create your dream itinerary. Our exceptional customer service and dedication to making your travel experience as smooth and enjoyable as possible sets us apart. Let us help you explore the world, one adventure at a time!
          </p>
        </div>
        <div>
          <h1>Contact Us With</h1>
          <h3>Phone</h3>
          <p>065349232</p>
          <h3>Email</h3>
          <p>contact@travelious.gmail.com</p>
          <h3>Address</h3>
          <p>Rue 34 La place, Annaba, Algeria</p>
        </div>
      </div>
      <form class='contact' method='POST' action='about.php'>
        <h1>Contact Us</h1>
        <input type='text' placeholder='name' />
        <input type='email' placeholder='email' />
        <textarea rows="10" placeholder='message'></textarea>
        <button type='submit'>Send</button>
      </form>
    </div>
  </main>
</body>
</html>