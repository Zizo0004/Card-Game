
<?php

if(isset($_SESSION['username'])){
   header('Location: index.php');
   exit();
}
$emojis = array(
   "emoji1.png",
   "emoji2.png",
   "emoji3.png",
   "emoji4.png",
   "emoji5.png",
   "emoji6.png"
);
?>
<?php require("register.class.php") ?>
<?php

   if(isset($_POST['submit'])){


      $user = new RegisterUser($_POST['username'], $_POST['selectedEmoji']);

   }
?>
<?php include('navbar.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="styles.css">
   <title>Arcade Website</title>
</head>
<body>
<body>
<div id="main" >
   <form action="" method="post" enctype="multipart/form-data" autocomplete="off">
      <h2>Register Now</h2>

      <div>
    <h4 style="margin-top:20px;">Select an Emoji</h4>
    <div>
        <?php foreach($emojis as $emoji) { ?>

         <img style="width:70px;" src="<?php echo 'images/'.$emoji; ?>" alt="<?php echo $emoji; ?>" onclick="selectImage(this);">
          <?php } ?>
    </div>
    <input type="hidden" id="selectedEmoji" name="selectedEmoji" value="">
</div>
      <label style="margin-top:20px;">Username</label>
      <input type="text" name="username">

      <button type="submit" name="submit">Register</button>

      <p class="error"><?php echo @$user->error ?></p>

   </form>
   </div>
   <script>
    function selectImage(img) {
        // Remove 'selected' class from all images

        var images = document.querySelectorAll('img');
        for (var i = 0; i < images.length; i++) {
        images[i].classList.remove('selected');
        }

        // Add 'selected' class to clicked image
        img.classList.add('selected');

        // Set selected image value
        document.getElementById('selectedEmoji').value = img.alt;
    }
    document.querySelector('form').addEventListener('submit', function() {
        localStorage.clear();
    });
</script>







</body>

</html>
