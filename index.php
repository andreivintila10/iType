<!DOCTYPE html>
<html>
  <head>
    <title>iType</title>
    <link rel="stylesheet" type="text/css" href="css/stylesheet.css">
  </head>

  <body>
    <div id="page"> 
      <div id="navbar">
        <div id="logo" unselectable="on" onselectstart="return false;" onmousedown="return false;">
          <a href="index.php"> <img width="422" height="82" src="images/logo.png" class="resizeLogo"> </a>
        </div>
        
        <div id="navbarSpace">&nbsp</div>

        <?php
          session_start();
          if (session_status() == PHP_SESSION_ACTIVE)
          {
            if(isset($_SESSION['username']))
            {
              echo '<div id="hello" unselectable="on" onselectstart="return false;" onmousedown="return false;"> <a href="profilepage.php">Hello, '.$_SESSION['username'].'</a> </div>';
              echo "\r\n" . "\r\n" . "        ";  // For HTML layout purposes.
              echo '<div id="profile" unselectable="on" onselectstart="return false;" onmousedown="return false;"> <a href="profilepage.php">Profile</a> </div>';
              echo "\r\n" . "        ";           // For HTML layout purposes.
            } // if
            else
            {
              echo '<div id="register" unselectable="on" onselectstart="return false;" onmousedown="return false;"> <a href="php/register.php">REGISTER</a> </div>';
              echo "\r\n" . "\r\n" . "        ";  // For HTML layout purposes.
              echo '<div id="login" unselectable="on" onselectstart="return false;" onmousedown="return false;"> <a href="php/login.php">LOGIN</a> </div>';
              echo "\r\n" . "        ";           // For HTML layout purposes.
            } // else
          } // if
        ?>

        <div id="compete" unselectable="on" onselectstart="return false;" onmousedown="return false;"> <a href="compete.php">Compete</a> </div>
        
        <div id="practise" unselectable="on" onselectstart="return false;" onmousedown="return false;"> <a href="gamepage.php">Practise</a> </div>
      </div>
   
      <div id="pageContent"> 
        <div id="descriptionbox">
          <strong>Welcome to iType!</strong> <br> <br>
          To start either create an account to save your progress or jump straight into practise mode. <br>
          When in the game, choose your difficulty, place your fingers over the f and j keys and type away. <br> <br>
          Have fun!
        </div>
        
        <div id="screenshotBox">
          <img width="1920" height="1080" class="resizeScreenshot1" src="images/gamepageScreenshot.png">

          <img width="1920" height="1080" class="resizeScreenshot2" src="images/profilepageScreenshot.png">
        </div>
      </div>
    </div>
  </body>
</html>