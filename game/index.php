<?php include('navbar.php'); ?>
<div id="main" class="landing-page">
<?php if(isset($_SESSION['username'])) { ?>
    <div class="welcome-message">
    <h1 class="heading">Welcome to Pairs</h1>
    <a class="btn" href="pairs.php" class="button">Click here to play</a>
    </div>
  <?php } else { ?>
    <div class="register-message">
    <p class="text">You're not using a registered session? <a href="registration.php">Register now</a></p>
    </div>
  <?php } ?>

  </div>