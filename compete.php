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

        <div id="practise" unselectable="on" onselectstart="return false;" onmousedown="return false;"> <a href="gamepage.php">Practise</a> </div>

        <div id="home" unselectable="on" onselectstart="return false;" onmousedown="return false;"> <a href="index.php">Home</a> </div>
      </div>

      <div id="pageContent" class="pageContent">
      
      <div id="competebox">
        COMING SOON!!
      </div>
    </div>
  </body>
</html>