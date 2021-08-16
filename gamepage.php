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
            if (isset($_SESSION['username']))
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
        
        <div id="home" unselectable="on" onselectstart="return false;" onmousedown="return false;"> <a href="index.php">Home</a> </div>
      </div>

      <div id="pageContent">
        <div id="timer" unselectable="on" onselectstart="return false;" onmousedown="return false;">00:00</div>
        
        <center>
          <div id="box" unselectable="on" onselectstart="return false;" onmousedown="return false;"> </div>
          <input id="phone" type="phoneInput">
        </center>

        <div id="middle">
          <div id="space">&nbsp</div>
          
          <center>
            <div id="keyboardDiv">
              <img id="keyboard" width="1391" height="551" class="resizekeyboard" src="images/keyboard.png" unselectable="on" onselectstart="return false;" onmousedown="return false;">
              
              <div id="start-reset" unselectable="on" onselectstart="return false;" onmousedown="return false;" >START</div>
            </div>
          </center>

          <div id="levelButtons">
            <div id="beginner">
              Keyboard And Keys
            </div>

            <div id="intermediate">
              Basic Keyboard
            </div>

            <div id="advanced">
              No Keyboard
            </div>
          </div>
        </div>
      </div>
    </div>

    <script type="text/javascript" src="js/type.js"> </script>
  </body>
</html>