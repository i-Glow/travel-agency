<?php
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $username = $_POST['username'];
      $password = $_POST['password'];
      $phone = $_POST['phone'];
      
      require('db.php');
      
      $sql = "INSERT INTO users (username, password, phone) VALUES ('$username', '$password', '$phone')";
      $result = mysqli_query($conn, $sql);

      $conn->close();
      header('Location: index.php');
  }
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles/login.css">
  <title>Login - Travelious</title>
  <?php require('./templates/head.php') ?>
</head>
<body>
  <?php require('./templates/nav.php') ?>
  <main>
    <form class="login-card" method="post" action="signup.php">
      <h1>Sign up</h1>
      <div>
        <label for="">Username</label>
        <input type="text" name='username' />
      </div>
      <div>  
        <label for="">Password</label>
        <input type="password" name='password' />
      </div>
      <div>
        <label for="">Phone</label>
        <input type="text" name='phone' />
      </div>
      <button type="submit">Signup</button>
      <div>
        <a href="/login.php">Already have an account?</a>
        <a href="/login.php">Login</a>
      </div>
    </form>
  </main>
</body>
</html>