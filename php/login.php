<?php
  session_start();
  include("connection.php");  // Establishing connection with our database.

  global $error;              // Variable for storing our errors.

  if (isset($_POST["submit"]))
  {
    if (empty($_POST["username"]) || empty($_POST["password"]))
    {
      $error = "Both fields are required.";
    } // if
    else
    {
      // Define $username and $password.
      $username = $_POST['username'];
      $password = $_POST['password'];

      // To protect from MySQL injection.
      $username = stripslashes($username);
      $password = stripslashes($password);
      $username = mysqli_real_escape_string($db, $username);
      $password = mysqli_real_escape_string($db, $password);
      $password = md5($password);

      // Check username and password from database.
      $sql = "SELECT name, email, history FROM users WHERE username='$username' and password='$password'";
      $result = mysqli_query($db, $sql);
      $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

      // If username and password exist in our database then create a session.
      // Otherwise echo error.
      if (mysqli_num_rows($result) == 1)
      {
        $_SESSION['username'] = $username;       // Initializing Session.
        $_SESSION['email'] = $row['email'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['history'] = explode(';', $row['history']);

        // home.php
        header("location: ../profilepage.php");  // Redirecting To Other Page.
      } // if
      else
      {
        $error = "Incorrect username or password.";
      } // else
    } // else

    if (!empty($error))
      ?> <script> alert("Incorrect username or password."); </script> <?php
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <title>iType</title>
    <link rel="stylesheet" type="text/css" href="../css/stylesheet.css">
  </head>

  <body>
    <div id="page"> 
      <div id="navbar">
        <div id="logo" unselectable="on" onselectstart="return false;" onmousedown="return false;">
          <a href="../index.php"> <img width="422" height="82" src="../images/logo.png" class="resizeLogo"> </a>
        </div>
        
        <div id="navbarSpace">&nbsp</div>

        <div id="register" unselectable="on" onselectstart="return false;" onmousedown="return false;"> <a href="register.php">REGISTER</a> </div>

        <div id="compete" unselectable="on" onselectstart="return false;" onmousedown="return false;"> <a href="../compete.php">Compete</a> </div>
        
        <div id="practise" unselectable="on" onselectstart="return false;" onmousedown="return false;"> <a href="../gamepage.php">Practise</a> </div>

        <div id="home" unselectable="on" onselectstart="return false;" onmousedown="return false;"> <a href="../index.php">Home</a> </div>
      </div>

      <div id="pageContent" class="pageContent">
        <div id="loginBox">
          <form method="post" autocomplete="off">
            <span style="color:#666666; font-weight:bold;">LOGIN</span> <br> <br>

            <input type="text" name="username" placeholder="Username" required>

            <input type="password" name="password" placeholder="Password" required>

            <input type="submit" name="submit" value="SIGN IN">
          </form>
        </div>
      </div>
    </div>
  </body>
</html>