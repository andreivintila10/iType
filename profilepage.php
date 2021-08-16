<?php
  session_start();
?>

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

        <div id="logout" unselectable="on" onselectstart="return false;" onmousedown="return false;"> <a href="php/logout.php">LOGOUT</a> </div>

        <div id="compete" unselectable="on" onselectstart="return false;" onmousedown="return false;"> <a href="compete.php">Compete</a> </div>
        
        <div id="practise" unselectable="on" onselectstart="return false;" onmousedown="return false;"> <a href="gamepage.php">Practise</a> </div>

        <div id="home" unselectable="on" onselectstart="return false;" onmousedown="return false;"> <a href="index.php">Home</a> </div>
      </div>

      <div id="pageContent" class="pageContent">
        <div id="profileStuff">
          <div id="profileImage">
            <a href ="uploadImage.html"> <img class="profilePhoto" src="images/profilePhoto.png"/> </a>
          </div>
        
          <div id="profileInfo">
            <strong>Username: </strong> <?php echo $_SESSION['username'];?>
            <br>
            <strong>Avg Word Diff: </strong><span id="avgWordDiff"></span>
            <br>
            <br>
            <strong>Name: </strong> <?php echo $_SESSION['name'];?>
            <br>
            <strong>E-mail: </strong> <?php echo $_SESSION['email'];?>
          </div>
        </div>

        <div id="timeline">
          <div id="timelineCaption">Progress Over Your Last 10 Rounds</div>

          <div id="graph">
            <canvas id="myCanvas" width="900" height="400">
              <script>
                var performanceArray = [];
                var difficultyArray = [];
                var xmlhttp = new XMLHttpRequest();
                var address = "php/history.php";
                xmlhttp.open("GET", address, false);
                xmlhttp.send();

                var rawPerformanceArray = xmlhttp.responseText.split(";");

                for (var i = 0; i < 10; i ++)
                {
                  performanceArray[i] = rawPerformanceArray[i].split('-')[0];
                  difficultyArray[i] = rawPerformanceArray[i].split('-')[1];
                }

                // Compute the average word difficulty for the profile info.
                var wpmAverage = 0;
                if (performanceArray)
                {
                  for (var index = 0; index < performanceArray.length; index++)
                  {
                    wpmAverage += parseInt(performanceArray[index]);
                  } // for
                  wpmAverage /= performanceArray.length;
                } // if

                document.getElementById("avgWordDiff").innerHTML = wpmAverage;

          
                var history_Array0 = performanceArray[0];
                var history_Array1 = performanceArray[1];
                var history_Array2 = performanceArray[2];
                var history_Array3 = performanceArray[3];
                var history_Array4 = performanceArray[4];
                var history_Array5 = performanceArray[5];
                var history_Array6 = performanceArray[6];
                var history_Array7 = performanceArray[7];
                var history_Array8 = performanceArray[8];
                var history_Array9 = performanceArray[9];
          
                var height_factor = 900 / 600;
                var length_factor = 400 / 170;
                var c = document.getElementById("myCanvas");
                var ctx = c.getContext("2d");
                ctx.beginPath();

                ctx.font = "30px Arial";

                ctx.moveTo(height_factor * 20, length_factor * 80);
                ctx.beginPath();
                ctx.arc(height_factor * 15, (length_factor * 80), 5, 0 * Math.PI, 2.0 * Math.PI);
                ctx.fillStyle = "#699";
                ctx.lineWidth = 3.5;
                ctx.stroke();
                ctx.strokeStyle = "#699";
                ctx.moveTo(height_factor * 20, length_factor * 80);
                ctx.lineTo(height_factor * 70, length_factor * 80);
                ctx.lineTo(height_factor * 70, length_factor * 40);
                ctx.lineWidth = 3.5;
                ctx.stroke();
                ctx.beginPath();
                ctx.arc(height_factor * 70, (length_factor * 30) - 10, 30, 0.5 * Math.PI, 2.5 * Math.PI);
                if (difficultyArray[0] == "e") ctx.fillStyle = "#00FF00";
                else if (difficultyArray[0] == "i") ctx.fillStyle = "#FFFF00";
                else ctx.fillStyle = "#FF0000";
                ctx.font = "30px Arial";

                if (history_Array0 < 10 && (history_Array0 % 1 == 0))
                  ctx.fillText(history_Array0, height_factor * 70 - 10, (length_factor * 30));
                else if (history_Array0 < 10 && (history_Array0 % 1 != 0))
                  ctx.fillText(history_Array0, height_factor * 70 - 17, (length_factor * 30));
                else if (history_Array0 < 100 && (history_Array0 % 1 == 0))
                {
                  ctx.font = "25px Arial";
                  ctx.fillText(history_Array0, height_factor * 70 - 15, (length_factor * 30) - 5);
                } // else if
                else if (history_Array0 < 100 && (history_Array0 % 1 != 0))
                {
                  ctx.font = "20px Arial";
                  ctx.fillText(history_Array0, height_factor * 70 - 20, (length_factor * 30) - 5);
                } // else if
                else if (history_Array0 < 1000 && (history_Array0 % 1 == 0)) {
                  ctx.font = "20px Arial";
                  ctx.fillText(history_Array0, height_factor * 70 - 15, (length_factor * 30) - 5);
                }
                else if (history_Array0 < 1000 && (history_Array0 % 1 != 0)) {
                  ctx.font = "20px Arial";
                  ctx.fillText(history_Array0, height_factor * 70 - 15, (length_factor * 30) - 5);
                }
                ctx.font = "30px Arial";
                ctx.lineWidth = 3.5;
                ctx.stroke();

                ctx.strokeStyle = "#699";
                ctx.moveTo(height_factor * 70, length_factor * 50);
                ctx.lineTo(height_factor * 70, length_factor * 80);
                ctx.lineTo(height_factor * 120, length_factor * 80);
                ctx.lineTo(height_factor * 120, length_factor * 130);
                ctx.lineWidth = 3.5;
                ctx.stroke();
                ctx.beginPath();
                ctx.arc(height_factor * 120, (length_factor * 140) + 10, 30, 1.5 * Math.PI, 3.5 * Math.PI);
                if (difficultyArray[1] == "e") ctx.fillStyle = "#00FF00";
                else if (difficultyArray[1] == "i") ctx.fillStyle = "#FFFF00";
                else ctx.fillStyle = "#FF0000";
                ctx.font = "30px Arial";

                if (history_Array1 < 10 && (history_Array1 % 1 == 0))
                  ctx.fillText(history_Array1, height_factor * 120 - 10, (length_factor * 140) + 20);
                else if (history_Array1 < 10 && (history_Array1 % 1 != 0))
                  ctx.fillText(history_Array1, height_factor * 120 - 17, (length_factor * 140) + 20);
                else if (history_Array1 < 100 && (history_Array1 % 1 == 0))
                {
                  ctx.font = "25px Arial";
                  ctx.fillText(history_Array1, height_factor * 120 - 15, (length_factor * 140) + 15);
                } // else if
                else if (history_Array1 < 100 && (history_Array1 % 1 != 0))
                {
                  ctx.font = "20px Arial";
                  ctx.fillText(history_Array1, height_factor * 120 - 20, (length_factor * 140) + 15);
                } // else if
                else if (history_Array1 < 1000 && (history_Array1 % 1 == 0)) {
                  ctx.font = "20px Arial";
                  ctx.fillText(history_Array1, height_factor * 120 - 15, (length_factor * 140) + 15);
                }
                else if (history_Array1 < 1000 && (history_Array1 % 1 != 0)) {
                  ctx.font = "20px Arial";
                  ctx.fillText(history_Array1, height_factor * 120 - 15, (length_factor * 140) + 15);
                }
                ctx.font = "30px Arial";
                ctx.lineWidth = 3.5;
                ctx.stroke();

                // ctx.fillText(history_Array1, height_factor * 120 - 15, (length_factor * 140) + 20);
                
                ctx.strokeStyle = "#699";
                ctx.moveTo(height_factor * 120, length_factor * 80);
                ctx.lineTo(height_factor * 170, length_factor * 80);
                ctx.lineTo(height_factor * 170, length_factor * 40);
                ctx.lineWidth = 3.5;
                ctx.stroke();
                ctx.beginPath();
                ctx.arc(height_factor * 170, (length_factor * 30) - 10, 30, 0.5 * Math.PI, 2.5 * Math.PI);
                if (difficultyArray[2] == "e") ctx.fillStyle = "#00FF00";
                else if (difficultyArray[2] == "i") ctx.fillStyle = "#FFFF00";
                else ctx.fillStyle = "#FF0000";
                ctx.font = "30px Arial";

                if (history_Array2 < 10 && (history_Array2 % 1 == 0))
                  ctx.fillText(history_Array2, height_factor * 170 - 10, (length_factor * 30));
                else if (history_Array2 < 10 && (history_Array2 % 1 != 0))
                  ctx.fillText(history_Array2, height_factor * 170 - 17, (length_factor * 30));
                else if (history_Array2 < 100 && (history_Array2 % 1 == 0))
                {
                  ctx.font = "25px Arial";
                  ctx.fillText(history_Array2, height_factor * 170 - 15, (length_factor * 30) - 5);
                } // else if
                else if (history_Array2 < 100 && (history_Array2 % 1 != 0))
                {
                  ctx.font = "20px Arial";
                  ctx.fillText(history_Array2, height_factor * 170 - 20, (length_factor * 30) - 5);
                } // else if
                else if (history_Array2 < 1000 && (history_Array2 % 1 == 0)) {
                  ctx.font = "20px Arial";
                  ctx.fillText(history_Array2, height_factor * 170 - 15, (length_factor * 30) - 5);
                }
                else if (history_Array2 < 1000 && (history_Array2 % 1 != 0)) {
                  ctx.font = "20px Arial";
                  ctx.fillText(history_Array2, height_factor * 170 - 15, (length_factor * 30) - 5);
                }
                ctx.font = "30px Arial";
                ctx.lineWidth = 3.5;
                ctx.stroke();

                // ctx.fillText(history_Array2, height_factor * 170 - 15, (length_factor * 30));
                
                ctx.strokeStyle = "#699";
                ctx.moveTo(height_factor * 170, length_factor * 80);
                ctx.lineTo(height_factor * 220, length_factor * 80);
                ctx.lineTo(height_factor * 220, length_factor * 130);
                ctx.lineWidth = 3.5;
                ctx.stroke();
                ctx.beginPath();
                ctx.arc(height_factor * 220, (length_factor * 140) + 10, 30, 1.5 * Math.PI, 3.5 * Math.PI);
                if (difficultyArray[3] == "e") ctx.fillStyle = "#00FF00";
                else if (difficultyArray[3] == "i") ctx.fillStyle = "#FFFF00";
                else ctx.fillStyle = "#FF0000";
                ctx.font = "30px Arial";

                if (history_Array3 < 10 && (history_Array3 % 1 == 0))
                  ctx.fillText(history_Array3, height_factor * 220 - 10, (length_factor * 140) + 20);
                else if (history_Array3 < 10 && (history_Array3 % 1 != 0))
                  ctx.fillText(history_Array3, height_factor * 220 - 17, (length_factor * 140) + 20);
                else if (history_Array3 < 100 && (history_Array3 % 1 == 0))
                {
                  ctx.font = "25px Arial";
                  ctx.fillText(history_Array3, height_factor * 220 - 15, (length_factor * 140) + 15);
                } // else if
                else if (history_Array3 < 100 && (history_Array3 % 1 != 0))
                {
                  ctx.font = "20px Arial";
                  ctx.fillText(history_Array3, height_factor * 220 - 20, (length_factor * 140) + 15);
                } // else if
                else if (history_Array3 < 1000 && (history_Array3 % 1 == 0)) {
                  ctx.font = "20px Arial";
                  ctx.fillText(history_Array3, height_factor * 220 - 15, (length_factor * 140) + 15);
                }
                else if (history_Array3 < 1000 && (history_Array3 % 1 != 0)) {
                  ctx.font = "20px Arial";
                  ctx.fillText(history_Array3, height_factor * 220 - 15, (length_factor * 140) + 15);
                }
                ctx.font = "30px Arial";
                ctx.lineWidth = 3.5;
                ctx.stroke();

                // ctx.fillText(history_Array3, height_factor * 220 - 15, (length_factor * 140) + 20);

                ctx.strokeStyle = "#699";
                ctx.moveTo(height_factor * 220, length_factor * 80);
                ctx.lineTo(height_factor * 270, length_factor * 80);
                ctx.lineTo(height_factor * 270, length_factor * 40);
                ctx.lineWidth = 3.5;
                ctx.stroke();
                ctx.beginPath();
                ctx.arc(height_factor * 270, (length_factor * 30) - 10, 30, 0.5 * Math.PI, 2.5 * Math.PI);
                if (difficultyArray[4] == "e") ctx.fillStyle = "#00FF00";
                else if (difficultyArray[4] == "i") ctx.fillStyle = "#FFFF00";
                else ctx.fillStyle = "#FF0000";
                ctx.font = "30px Arial";

                if (history_Array4 < 10 && (history_Array4 % 1 == 0))
                  ctx.fillText(history_Array4, height_factor * 270 - 10, (length_factor * 30));
                else if (history_Array4 < 10 && (history_Array4 % 1 != 0))
                  ctx.fillText(history_Array4, height_factor * 270 - 17, (length_factor * 30));
                else if (history_Array4 < 100 && (history_Array4 % 1 == 0))
                {
                  ctx.font = "25px Arial";
                  ctx.fillText(history_Array4, height_factor * 270 - 15, (length_factor * 30) - 5);
                } // else if
                else if (history_Array4 < 100 && (history_Array4 % 1 != 0))
                {
                  ctx.font = "20px Arial";
                  ctx.fillText(history_Array4, height_factor * 270 - 20, (length_factor * 30) - 5);
                } // else if
                else if (history_Array4 < 1000 && (history_Array4 % 1 == 0)) {
                  ctx.font = "20px Arial";
                  ctx.fillText(history_Array4, height_factor * 270 - 15, (length_factor * 30) - 5);
                }
                else if (history_Array4 < 1000 && (history_Array4 % 1 != 0)) {
                  ctx.font = "20px Arial";
                  ctx.fillText(history_Array4, height_factor * 270 - 15, (length_factor * 30) - 5);
                }
                ctx.font = "30px Arial";
                ctx.lineWidth = 3.5;
                ctx.stroke();

                // ctx.fillText(history_Array4, height_factor * 270 - 15, (length_factor * 30));


                ctx.strokeStyle = "#699";
                ctx.moveTo(height_factor * 270, length_factor * 80);
                ctx.lineTo(height_factor * 320, length_factor * 80);
                ctx.lineTo(height_factor * 320, length_factor * 130);
                ctx.lineWidth = 3.5;
                ctx.stroke();
                ctx.beginPath();
                ctx.arc(height_factor * 320, (length_factor * 140) + 10, 30, 1.5 * Math.PI, 3.5 * Math.PI);
                if (difficultyArray[5] == "e") ctx.fillStyle = "#00FF00";
                else if (difficultyArray[5] == "i") ctx.fillStyle = "#FFFF00";
                else ctx.fillStyle = "#FF0000";
                ctx.font = "30px Arial";

                if (history_Array5 < 10 && (history_Array5 % 1 == 0))
                  ctx.fillText(history_Array5, height_factor * 320 - 10, (length_factor * 140) + 20);
                else if (history_Array5 < 10 && (history_Array5 % 1 != 0))
                  ctx.fillText(history_Array5, height_factor * 320 - 17, (length_factor * 140) + 20);
                else if (history_Array5 < 100 && (history_Array5 % 1 == 0))
                {
                  ctx.font = "25px Arial";
                  ctx.fillText(history_Array5, height_factor * 320 - 15, (length_factor * 140) + 15);
                } // else if
                else if (history_Array5 < 100 && (history_Array5 % 1 != 0))
                {
                  ctx.font = "20px Arial";
                  ctx.fillText(history_Array5, height_factor * 320 - 20, (length_factor * 140) + 15);
                } // else if
                else if (history_Array5 < 1000 && (history_Array5 % 1 == 0)) {
                  ctx.font = "20px Arial";
                  ctx.fillText(history_Array5, height_factor * 320 - 15, (length_factor * 140) + 15);
                }
                else if (history_Array5 < 1000 && (history_Array5 % 1 != 0)) {
                  ctx.font = "20px Arial";
                  ctx.fillText(history_Array5, height_factor * 320 - 15, (length_factor * 140) + 15);
                }
                ctx.font = "30px Arial";
                ctx.lineWidth = 3.5;
                ctx.stroke();

                //ctx.fillText(history_Array5, height_factor *320 - 15, (length_factor * 140) + 20);

                ctx.strokeStyle = "#699";
                ctx.moveTo(height_factor * 320, length_factor * 80);
                ctx.lineTo(height_factor * 370, length_factor * 80);
                ctx.lineTo(height_factor * 370, length_factor * 40);
                ctx.lineWidth = 3.5;
                ctx.stroke();
                ctx.beginPath();
                ctx.arc(height_factor * 370, (length_factor * 30) - 10, 30, 0.5 * Math.PI, 2.5 * Math.PI);
                if (difficultyArray[6] == "e") ctx.fillStyle = "#00FF00";
                else if (difficultyArray[6] == "i") ctx.fillStyle = "#FFFF00";
                else ctx.fillStyle = "#FF0000";
                ctx.font = "30px Arial";

                if (history_Array6 < 10 && (history_Array6 % 1 == 0))
                  ctx.fillText(history_Array6, height_factor * 370 - 10, (length_factor * 30));
                else if (history_Array6 < 10 && (history_Array6 % 1 != 0))
                  ctx.fillText(history_Array6, height_factor * 370 - 17, (length_factor * 30));
                else if (history_Array6 < 100 && (history_Array6 % 1 == 0))
                {
                  ctx.font = "25px Arial";
                  ctx.fillText(history_Array6, height_factor * 370 - 15, (length_factor * 30) - 5);
                } // else if
                else if(history_Array6 < 100 && (history_Array6 % 1 != 0))
                {
                  ctx.font = "20px Arial";
                  ctx.fillText(history_Array6, height_factor * 370 - 20, (length_factor * 30) - 5);
                } // else if
                else if (history_Array6 < 1000 && (history_Array6 % 1 == 0)) {
                  ctx.font = "20px Arial";
                  ctx.fillText(history_Array6, height_factor * 370 - 15, (length_factor * 30) - 5);
                }
                else if (history_Array6 < 1000 && (history_Array6 % 1 != 0)) {
                  ctx.font = "20px Arial";
                  ctx.fillText(history_Array6, height_factor * 370 - 15, (length_factor * 30) - 5);
                }
                ctx.font = "30px Arial";
                ctx.lineWidth = 3.5;
                ctx.stroke();

                // ctx.fillText(history_Array6, height_factor * 370 - 15, (length_factor * 30));

                ctx.strokeStyle = "#699";
                ctx.moveTo(height_factor * 370, length_factor * 80);
                ctx.lineTo(height_factor * 420, length_factor * 80);
                ctx.lineTo(height_factor * 420, length_factor * 130);
                ctx.lineWidth = 3.5;
                ctx.stroke();
                ctx.beginPath();
                ctx.arc(height_factor * 420, (length_factor * 140) + 10, 30, 1.5 * Math.PI, 3.5 * Math.PI);
                if (difficultyArray[7] == "e") ctx.fillStyle = "#00FF00";
                else if (difficultyArray[7] == "i") ctx.fillStyle = "#FFFF00";
                else ctx.fillStyle = "#FF0000";
                ctx.font = "30px Arial";

                if (history_Array7 < 10 && (history_Array7 % 1 == 0))
                  ctx.fillText(history_Array7, height_factor * 420 - 10, (length_factor * 140) + 20);
                else if (history_Array7 < 10 && (history_Array7 % 1 != 0))
                  ctx.fillText(history_Array7, height_factor * 420 - 17, (length_factor * 140) + 20);
                else if (history_Array7 < 100 && (history_Array7 % 1 == 0))
                {
                  ctx.font = "25px Arial";
                  ctx.fillText(history_Array7, height_factor * 420 - 15, (length_factor * 140) + 15);
                } // else if
                else if (history_Array7 < 100 && (history_Array7 % 1 != 0))
                {
                  ctx.font = "20px Arial";
                  ctx.fillText(history_Array7, height_factor * 420 - 20, (length_factor * 140) + 15);
                } // else if
                else if (history_Array7 < 1000 && (history_Array7 % 1 == 0)) {
                  ctx.font = "20px Arial";
                  ctx.fillText(history_Array7, height_factor * 420 - 15, (length_factor * 140) + 15);
                }
                else if (history_Array7 < 1000 && (history_Array7 % 1 != 0)) {
                  ctx.font = "20px Arial";
                  ctx.fillText(history_Array7, height_factor * 420 - 15, (length_factor * 140) + 15);
                }
                ctx.font = "30px Arial";
                ctx.lineWidth = 3.5;
                ctx.stroke();

                // ctx.fillText(history_Array7, height_factor * 420 - 15, (length_factor * 140) + 20);

                ctx.strokeStyle = "#699";
                ctx.moveTo(height_factor * 420, length_factor * 80);
                ctx.lineTo(height_factor * 470, length_factor * 80);
                ctx.lineTo(height_factor * 470, length_factor * 40);
                ctx.lineWidth = 3.5;
                ctx.stroke();
                ctx.beginPath();
                ctx.arc(height_factor * 470, (length_factor * 30) - 10, 30, 0.5 * Math.PI, 2.5 * Math.PI);
                if (difficultyArray[8] == "e") ctx.fillStyle = "#00FF00";
                else if (difficultyArray[8] == "i") ctx.fillStyle = "#FFFF00";
                else ctx.fillStyle = "#FF0000";
                ctx.font = "30px Arial";

                if (history_Array8 < 10 && (history_Array8 % 1 == 0))
                  ctx.fillText(history_Array8, height_factor * 470 - 10, (length_factor * 30));
                else if (history_Array8 < 10 && (history_Array8 % 1 != 0))
                  ctx.fillText(history_Array8, height_factor * 470 - 17, (length_factor * 30));
                else if (history_Array8 < 100 && (history_Array8 % 1 == 0))
                {
                  ctx.font = "25px Arial";
                  ctx.fillText(history_Array8, height_factor * 470 - 15, (length_factor * 30) - 5);
                } // else if
                else if (history_Array8 < 100 && (history_Array8 % 1 != 0))
                {
                  ctx.font = "20px Arial";
                  ctx.fillText(history_Array8, height_factor * 470 - 20, (length_factor * 30) - 5);
                } // else if
                else if (history_Array8 < 1000 && (history_Array8 % 1 == 0)) {
                  ctx.font = "20px Arial";
                  ctx.fillText(history_Array8, height_factor * 470 - 15, (length_factor * 30) - 5);
                }
                else if (history_Array8 < 1000 && (history_Array8 % 1 != 0)) {
                  ctx.font = "20px Arial";
                  ctx.fillText(history_Array8, height_factor * 470 - 15, (length_factor * 30) - 5);
                }
                ctx.font = "30px Arial";
                ctx.lineWidth = 3.5;
                ctx.stroke();

                // ctx.fillText(history_Array8, height_factor * 470 - 15, (length_factor * 30));

                ctx.strokeStyle = "#699";
                ctx.moveTo(height_factor * 470, length_factor * 80);
                ctx.lineTo(height_factor * 520, length_factor * 80);
                ctx.lineTo(height_factor * 520, length_factor * 130);
                ctx.lineWidth = 3.5;
                ctx.stroke();
                ctx.beginPath();
                ctx.arc(height_factor * 520, (length_factor * 140) + 10, 30, 1.5 * Math.PI, 3.5 * Math.PI);
                if (difficultyArray[9] == "e") ctx.fillStyle = "#00FF00";
                else if (difficultyArray[9] == "i") ctx.fillStyle = "#FFFF00";
                else ctx.fillStyle = "#FF0000";
                ctx.font = "30px Arial";

                if (history_Array9 < 10 && (history_Array9 % 1 == 0))
                  ctx.fillText(history_Array9, height_factor * 520 - 10, (length_factor * 140) + 20);
                else if (history_Array9 < 10 && (history_Array9 % 1 != 0))
                  ctx.fillText(history_Array9, height_factor * 520 - 17, (length_factor * 140) + 20);
                else if (history_Array9 < 100 && (history_Array9 % 1 == 0))
                {
                  ctx.font = "25px Arial";
                  ctx.fillText(history_Array9, height_factor * 520 - 15, (length_factor * 140) + 15);
                } // else if
                else if (history_Array9 < 100 && (history_Array9 % 1 != 0))
                {
                  ctx.font = "20px Arial";
                  ctx.fillText(history_Array9, height_factor * 520 - 20, (length_factor * 140) + 15);
                } // else if
                else if (history_Array9 < 1000 && (history_Array9 % 1 == 0)) {
                  ctx.font = "20px Arial";
                  ctx.fillText(history_Array9, height_factor * 520 - 15, (length_factor * 140) + 15);
                }
                else if (history_Array9 < 1000 && (history_Array9 % 1 != 0)) {
                  ctx.font = "20px Arial";
                  ctx.fillText(history_Array9, height_factor * 520 - 15, (length_factor * 140) + 15);
                }
                ctx.font = "30px Arial";
                ctx.lineWidth = 3.5;
                ctx.stroke();

                // ctx.fillText(history_Array9, height_factor * 520 - 15, (length_factor * 140) + 20);

                ctx.fillStyle = "#699";
                ctx.moveTo(height_factor * 520, length_factor * 80);
                ctx.lineTo(height_factor * 570, length_factor * 80);
                ctx.strokeStyle = '#699';
                ctx.lineWidth = 3.5;

                ctx.stroke();
              </script>
            </canvas>
          </div>  <!--graph-->
        </div>  <!--timeline-->
      </div>  <!--pageContent-->
    </div>  <!--page-->
  </body>
</html>