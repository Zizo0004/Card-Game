<?php
    // start session
    session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles.css">
    <title>Arcade Website</title>
  
</head>
<body>
    <!-- navbar -->
    <nav>
        <div>
            <a href="index.php" style="color: white; font-size: 16px;">Home</a>

        </div>
        <ul>
            <!-- Home link -->
          
            
            <?php
                // check if user is logged in
                if(isset($_SESSION['username'])){
                   
                    // show leaderboard and play pairs links
                    echo '<li><a href="pairs.php" name="memory">Play Pairs</a></li>';
                    echo '<li><a href="leaderboard.php" name="leaderboard">Leaderboard</a></li>';
                 
                    if(isset($_SESSION['emoji'])){
                        if($_SESSION['emoji'] != null){
                        echo '<img style="width:35px; padding-left:10px;" src="' ."images/". $_SESSION["emoji"] . '" alt="emoji">'; 
                        } 
                          
                    }
                  
                }
                else{
                    // show register link
                    echo '<li><a href="registration.php" name="register">Register</a></li>';
                }
            ?>
        </ul>
    </nav>
</body>
</html>
