<?php
  include('connection.php');
  session_start();
  $user_check = $_SESSION['email'];


  if (!isset($_REQUEST['hist']))
  {
    $sql = mysqli_query($db, "SELECT history FROM users WHERE email='$user_check'");

    $row = mysqli_fetch_array($sql, MYSQLI_ASSOC);

    $history = $row['history'];

    if (!isset($user_check))
    {
      echo "0-e;0-e;0-e;0-e;0-e;0-e;0-e;0-e;0-e;0-e";
    } // if
    else
    {
      echo $history;
    } // else
  } // if
  else
  {
    if(isset($user_check))
    {
      $newHistory = $_REQUEST['hist'];
      mysqli_query($db, "UPDATE users SET history='$newHistory' WHERE email='$user_check'");
    } // if
  } // else
?>