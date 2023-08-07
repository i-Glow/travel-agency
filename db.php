<?php
  // change credentails depending on your database
  $conn = new mysqli('localhost', 'travel', '123travel', 'travelious');
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
?>