<?php
  include ("connection.php");

  if (isset($_POST["submit"]))
  {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $username = $_POST["username"];

    $name = mysqli_real_escape_string($db, $name);
    $username = mysqli_real_escape_string($db, $username);
    $email = mysqli_real_escape_string($db, $email);
    $password = mysqli_real_escape_string($db, $password);
    $password = md5($password);

    $sql = "SELECT email FROM users WHERE email='$email'";
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

    $sql1 = "SELECT username FROM users WHERE username='$username'";
    $result1 = mysqli_query($db,$sql1);
    $row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC);

    if (mysqli_num_rows($result) == 1)
    {
      // Change this for the output you need.
      ?> <script> alert("Sorry...This email already exists..."); </script> <?php
    } // if
    else if (mysqli_num_rows($result1) == 1)
    {
      // Change this for the output you need.
      ?> <script> alert("Sorry...This username already exists..."); </script> <?php
    } // else if
    else
    {
      $query = mysqli_query($db, "INSERT INTO users (name, username, email, password)VALUES ('$name', '$username', '$email', '$password')");

      if($query)
      {
        ?> <script> alert("Thank you, you are now registered!"); </script> <?php
      } // if
    } // else
  } // if
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

        <!-- We set id to register because we need the right: 1%; indentation. -->
        <div id="register" unselectable="on" onselectstart="return false;" onmousedown="return false;"> <a href="login.php">LOGIN</a> </div>

        <div id="compete" unselectable="on" onselectstart="return false;" onmousedown="return false;"> <a href="../compete.php">Compete</a> </div>
        
        <div id="practise" unselectable="on" onselectstart="return false;" onmousedown="return false;"> <a href="../gamepage.php">Practise</a> </div>

        <div id="home" unselectable="on" onselectstart="return false;" onmousedown="return false;"> <a href="../index.php">Home</a> </div>
      </div>

      <div id="pageContent" class="pageContent">
        <div id="registerbox">
          <form method="post" autocomplete="off">
            <span style="color:#666666; font-weight:bold;">REGISTER</span> <br> <br>

            <input type="text" name="username" placeholder="Username" required>

            <input type="text" name="name" placeholder="Name" required>

            <input type="email" name="email" placeholder="E-mail Address" required>

            <input type="password" name="password" placeholder="Password" required>

            <input type="submit" name="submit" value="SIGN UP">
          </form>
        </div>
      </div>
    </div>
  </body>
</html>