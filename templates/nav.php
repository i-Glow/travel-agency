<?php 
  $auth = isset($_SESSION['auth']) && $_SESSION['auth'] === true;
?>
<link rel="stylesheet" href="../styles/nav.css">
<nav>
  <div class='nav'>
    <a href='/'>Travelious</a>
    <div>
      <a href='/hotels.php'>Hotels</a>
      <a href='/tours.php'>Tours</a>
      <a href='/destinations.php'>Destinations</a>
      <a href='/about.php'>About us</a>
    </div>
    <?php if($auth) { ?>
      <a style='font-size: 24px' href='/account.php'>Account</a>
    <?php } else { ?>
      <a href="/login.php">
        <button>Sign in</button>
      </a>
    <?php } ?>
  </div>
</nav>
