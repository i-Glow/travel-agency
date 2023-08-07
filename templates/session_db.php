<?php
  session_start();
  $conn = new mysqli('localhost', 'travel', '12travel3', 'travelious');
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
?>