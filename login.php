<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    require('db.php');
    
    $sql = ("SELECT id, password FROM users WHERE username = '$username'");
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);
    
    if ($user['password'] === $password) {
      $_SESSION['auth'] = true;
      $_SESSION['user'] = $user['id'];;
    
      header('Location: index.php');
    } else {
        $error_message = "Invalid username or password.";
    }

      $conn->close();
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
    <form class="login-card" method="post" action="login.php">
      <h1>Login</h1>
      <div>
        <label for="">Username</label>
        <input type="text" name='username' />
      </div>
      <div>  
        <label for="">Password</label>
        <input type="password" name='password' />
      </div>
      <button type="submit">Login</button>
      <div>
        <a href="/signup.php">Don't have an account?</a>
        <a href="/signup.php">Sign Up</a>
      </div>
    </form>
  </main>
</body>
</html>