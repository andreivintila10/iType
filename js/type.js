var box;
var words, wIndex, numberOfWords, positionInWord;
var keyboard;
var start;
var beginner, intermediate, advanced, level;
var clock, minutes, seconds, timer;
var wpm;
var performanceArray = [], difficultyArray = [];


getAllElementsById();
globalInitialisations();
requestPerformance();


function getAllElementsById()
{
  box = document.getElementById("box");
  keyboard = document.getElementById("keyboard");
  start = document.getElementById("start-reset");
  clock = document.getElementById("timer");
  beginner = document.getElementById("beginner");
  intermediate = document.getElementById("intermediate");
  advanced = document.getElementById("advanced");
  phoneTextField = document.getElementById("phone");
} // getAllElementsById


function globalInitialisations()
{
  beginner.style.backgroundColor = '#8c8c8c';
  level = 1;
} // globalInitialisations


// Start/Reset button, add mouse events; (Begin or Reset a Round).
start.onmouseover = function()
                    {
                      start.style.backgroundColor = '#8c8c8c'; 
                    } // function

start.onmouseout  = function()
                    {
                      start.style.backgroundColor = 'lightgrey'; 
                    } // function

start.onclick     = function()
                    {
                      if (start.innerHTML === 'START')
                      {
                        startRound();
                      } // if
                      else
                      {
                        resetRound();
                      } // else 
                    } // function


// Beginner button, add mouse events; (Keyboard and Keys).
beginner.onmouseover  = function()
                        {
                          beginner.style.backgroundColor = '#8c8c8c'; 
                        } // function

beginner.onmouseout   = function()
                        {
                          if (level === 1)
                          {
                            beginner.style.backgroundColor = '#8c8c8c';
                          } // if
                          else
                          {
                            beginner.style.backgroundColor = 'lightgrey'; 
                          } // else
                        } // function

beginner.onclick      = function()
                        {
                          if (!gameIsRunning())
                          {
                            intermediate.style.backgroundColor = 'lightgrey';
                            advanced.style.backgroundColor = 'lightgrey';
                            level = 1;
                              
                            changeKeyboardImage();
                          } // if
                        } // function


// Intermediate button, add mouse events; (Basic Keyboard).
intermediate.onmouseover  = function()
                            {
                              intermediate.style.backgroundColor = '#8c8c8c';
                            } // function

intermediate.onmouseout   = function()
                            {
                              if (level === 2)
                              {
                                intermediate.style.backgroundColor = '#8c8c8c';
                              } // if
                              else
                              {
                                intermediate.style.backgroundColor = 'lightgrey'; 
                              } // else
                            } // function

intermediate.onclick      = function()
                            {
                              if (!gameIsRunning())
                              {
                                beginner.style.backgroundColor = 'lightgrey';
                                advanced.style.backgroundColor = 'lightgrey';
                                level = 2;
                                changeKeyboardImage();
                              } // if
                            } // function


// Advanced button, add mouse events; (No Keyboard).
advanced.onmouseover  = function()
                        {
                          advanced.style.backgroundColor = '#8c8c8c'; 
                        } // function

advanced.onmouseout   = function()
                        {
                          if (level === 3)
                          {
                            advanced.style.backgroundColor = '#8c8c8c';
                          } // if
                          else
                          {
                            advanced.style.backgroundColor = 'lightgrey'; 
                          } // else
                        } // function

advanced.onclick      = function()
                        {
                          if (!gameIsRunning())
                          {
                            beginner.style.backgroundColor = 'lightgrey';
                            intermediate.style.backgroundColor = 'lightgrey';
                            level = 3;
                            changeKeyboardImage();
                          } // if
                        } // function


function startRound()
{
  start.innerHTML = 'RESET';

  requestWords();

  wIndex = 0;

  setTimer(1, 0);
  myTimer();
  timer = setInterval(myTimer, 1000);

  wpm = 0;

  printWord();

  phoneTextField.focus();
  phoneTextField.value = "";

  var coordX = box.offsetLeft + box.offsetWidth / 3.5;
  var coordY = box.offsetTop;
  window.scrollTo(coordX, coordY);
} // startRound


function resetRound()
{
  clearInterval(timer);
  setTimer(0, 0);
  clock.innerHTML = '00:00';

  start.innerHTML = 'START';
  box.innerHTML = '';
  changeKeyboardImage();
  words = [];
  phoneTextField.blur();
} // resetRound


function endRound()
{
  clearInterval(timer);
  wpm /= 5;
  start.innerHTML = 'NEXT ROUND';
  printScoreMessage();

  changeKeyboardImage();

  updatePerformance();
  savePerformance();
  phoneTextField.blur();
} // nextRound


function gameIsRunning()
{
  return wIndex < numberOfWords && (seconds > 0 || minutes > 0);
} // gameIsRunning


function preventUndefinedError()
{
  return positionInWord >= 0 && words && wIndex >= 0;
} // preventUndefinedError


// Function to request performance. USE ONLY ONCE.
function requestPerformance()
{
  var xmlhttp = new XMLHttpRequest();
  var address = "php/history.php";
  xmlhttp.open("GET", address, false);
  xmlhttp.send();

  var rawPerformanceArray = xmlhttp.responseText.split(";");

  for (var index = 0; index < 10; index++)
  {
    performanceArray[index] = rawPerformanceArray[index].split('-')[0];
    difficultyArray[index] = rawPerformanceArray[index].split('-')[1];
  } // for
} // requestPerformance


function updatePerformance()
{
  var difficulty = 'e';

  if (level === 2)
  {
    difficulty = 'i';
  } // if
  else if (level === 3)
  {
    difficulty = 'a';
  } // else if

  // Test if performanceArray exists (this prevents from getting the 'undefined' error message).
  if (performanceArray)
  {
    // Shift the array left one position.
    for (var index = 1; index < 10; index++)
    {
      performanceArray[index - 1] = performanceArray[index];
      difficultyArray[index - 1] = difficultyArray[index];
    } // for
    performanceArray[9] = wpm;
    difficultyArray[9] = difficulty;
  } // if
} // shiftArrayLeft


// Function to save performance into the database. USE AFTER EVERY COMPLETED ROUND.
function savePerformance()
{
  var xmlhttp = new XMLHttpRequest();
  var performance = "";
  var difficulty = 'e';

  if (level === 2)
  {
    difficulty = 'i';
  } // if
  else if (level === 3)
  {
    difficulty = 'a';
  } // else if

  for(var index = 0; index < 9; index++)
  {
    performance += performanceArray[index] + '-' + difficultyArray[index] + ";";
  } // for

  performance += performanceArray[9] + '-' + difficultyArray[9] + ";";

  var address = "php/history.php?hist=" + performance;
  xmlhttp.open("GET", address, false);
  xmlhttp.send();
} // savePerformance


function requestWords()
{
  // Compute the average wpm of the last 10 games.
  var wpmAverage = 0;
  for (var index = 0; index < performanceArray.length; index++)
  {
    wpmAverage += parseInt(performanceArray[index]);
  } // for
  wpmAverage /= performanceArray.length;

  var xmlhttp = new XMLHttpRequest();

  var address = "php/taskFactory.php?wpm=" + wpmAverage + "&wordNum=300";
  xmlhttp.open("GET", address, false);
  xmlhttp.send();

  words = JSON.parse(xmlhttp.responseText);
  numberOfWords = words.length;
} // requestWords


// This function prints a string in the "box".
function printString(stringToPrint)
{
  box.innerHTML = '';

  var textWidthPercentage = 0;
  for(var index = 0; index < stringToPrint.length; index++)
  {
    textWidthPercentage += letterCase(stringToPrint[index]);
  } // for

  var emptySpaceDiv = document.createElement('div');
  var emptySpaceWidthPercentage = (100 - textWidthPercentage) / 2;
  emptySpaceDiv.style.cssText = 'width:' + emptySpaceWidthPercentage + '%; position:relative; float:left; top:50%; transform: translate(0, -50%);';
  emptySpaceDiv.innerHTML = '&nbsp';
  box.appendChild(emptySpaceDiv);

  for(var index = 0; index < stringToPrint.length; index++)
  {
    var divElement = document.createElement('div');
    divElement.setAttribute("id", "div" + index);

    divElement.style.cssText = 'text-align:left; position:relative; float:left; font-size:1.8vw; font-weight:bold; top:50%; transform: translate(0, -50%);';

    // I need to do this because for some reason it doesn't print the space character inside the div block.
    if (stringToPrint[index] === ' ')
    {
      divElement.innerHTML = '&nbsp';
    } // if
    else
    {
      divElement.innerHTML = stringToPrint[index];
    } // else

    box.appendChild(divElement);
  } // for
} // printString


// This function prints the current word.
function printWord()
{
  positionInWord = 0;
  changeKeyboardImage();

  printString(words[wIndex]);
} // printWord


// This function prints the score.
function printScoreMessage()
{
  var scoreMessage = 'Your score is: ' + wpm + ' wpm';
  printString(scoreMessage);
} // printScoreMessage


// Getting the percentage width of letters.
function letterCase(letter)
{
  var requiredWidth;            //   (Letter/Div)     // (px)    // (%)                 // (The pixels 'px' of the letters are of fixed width, given the width of the box '937',
                                                                                        // and the percentages '%' show the general space occupied in any box size. We use the
  switch (letter)               //    Box Width       // 937     // 100                 // percentage only to compute the emptySpaceWidthPercentage.
  {
    case 'a':  requiredWidth = 2.454642475987193;     // 23      // 2.454642475987193
               break;
    case 'b':  requiredWidth = 2.668089647812166;     // 25      // 2.668089647812166
               break;
    case 'c':  requiredWidth = 2.134471718249733;     // 20      // 2.134471718249733
               break;
    case 'd':  requiredWidth = 2.774813233724653;     // 26      // 2.774813233724653
               break;
    case 'e':  requiredWidth = 2.347918890074707;     // 22      // 2.347918890074707
               break;
    case 'f':  requiredWidth = 1.6008537886873;       // 15      // 1.6008537886873
               break;
    case 'g':  requiredWidth = 2.347918890074707;     // 22      // 2.347918890074707
               break;
    case 'h':  requiredWidth = 2.774813233724653;     // 26      // 2.774813233724653
               break;
    case 'i':  requiredWidth = 1.494130202774813;     // 14      // 1.494130202774813
               break;
    case 'j':  requiredWidth = 1.387406616862327;     // 13      // 1.387406616862327
               break;
    case 'k':  requiredWidth = 2.56136606189968;      // 24      // 2.56136606189968
               break;
    case 'l':  requiredWidth = 1.387406616862327;     // 13      // 1.387406616862327
               break;
    case 'm':  requiredWidth = 4.16221985058698;      // 39      // 4.16221985058698
               break;
    case 'n':  requiredWidth = 2.88153681963714;      // 27      // 2.88153681963714
               break;
    case 'o':  requiredWidth = 2.56136606189968;      // 24      // 2.56136606189968
               break;
    case 'p':  requiredWidth = 2.774813233724653;     // 26      // 2.774813233724653
               break;
    case 'q':  requiredWidth = 2.56136606189968;      // 24      // 2.56136606189968
               break;
    case 'r':  requiredWidth = 2.134471718249733;     // 20      // 2.134471718249733
               break;
    case 's':  requiredWidth = 2.134471718249733;     // 20      // 2.134471718249733
               break;
    case 't':  requiredWidth = 1.6008537886873;       // 15      // 1.6008537886873
               break;
    case 'u':  requiredWidth = 2.774813233724653;     // 26      // 2.774813233724653
               break;
    case 'v':  requiredWidth = 2.347918890074707;     // 22      // 2.347918890074707
               break;
    case 'w':  requiredWidth = 3.52187833511206;      // 33      // 3.52187833511206
               break;
    case 'x':  requiredWidth = 2.454642475987193;     // 23      // 2.454642475987193
               break;
    case 'y':  requiredWidth = 2.347918890074707;     // 22      // 2.347918890074707
               break;
    case 'z':  requiredWidth = 2.134471718249733;     // 20      // 2.134471718249733
               break;
    case 'Y':  requiredWidth = 2.988260405549626;     // 28      // 2.988260405549626
               break;
    case ':':  requiredWidth = 1.494130202774813;     // 14      // 1.494130202774813
               break;
    case '.':  requiredWidth = 1.387406616862327;     // 13      // 1.387406616862327
               break;
    case ' ':  requiredWidth = 1.387406616862327;     // 13      // 1.387406616862327
               break;
    case '0':  requiredWidth = 2.88153681963714;      // 27      // 2.88153681963714
               break;
    case '1':  requiredWidth = 2.027748132337247;     // 19      // 2.027748132337247
               break;
    case '2':  requiredWidth = 2.56136606189968;      // 24      // 2.56136606189968
               break;
    case '3':  requiredWidth = 2.56136606189968;      // 24      // 2.56136606189968
               break;
    case '4':  requiredWidth = 2.668089647812166;     // 25      // 2.668089647812166
               break;
    case '5':  requiredWidth = 2.454642475987193;     // 23      // 2.454642475987193
               break;
    case '6':  requiredWidth = 2.668089647812166;     // 25      // 2.668089647812166
               break;
    case '7':  requiredWidth = 2.24119530416222;      // 21      // 2.24119530416222
               break;
    case '8':  requiredWidth = 2.774813233724653;     // 26      // 2.774813233724653
               break;
    case '9':  requiredWidth = 2.668089647812166;     // 25      // 2.668089647812166
               break;
    default:   requiredWidth = 2.37726787620064;      // 22.275  // 2.37726787620064
               break;
  } // switch

  return requiredWidth;
} // letterCase


document.onkeydown =  function(e)
                      {
                        var x = e.which || e.keyCode;
                        var y = String.fromCharCode(x);
                        
                        e.preventDefault();

                        if (gameIsRunning() && preventUndefinedError())
                        {
                          if (x === 8 && positionInWord > 0)
                          {
                            positionInWord--;
                            changeKeyboardImage();
                            document.getElementById("div" + positionInWord).style.color = 'black';
                          } // if
                          else if (x === 32 && positionInWord === words[wIndex].length)
                          {
                            if (isValidWordSoFar())
                            {
                              // Wpm is the size of the word + 1 for the space key press.
                              wpm += words[wIndex].length + 1;
                              phoneTextField.value = "";
                              wIndex++;
                              // Less likely however, theoretically possible.
                              if (wIndex === numberOfWords)
                              {
                                endRound();
                              } // if
                              else
                              {
                                printWord();
                              } // else
                            } // if
                          } // else if
                          else if (x >= 32 && x <= 126 && positionInWord < words[wIndex].length)
                          {
                            if (y.toLowerCase() === words[wIndex][positionInWord])
                            {
                              document.getElementById("div" + positionInWord).style.color = '#00cc00';
                            } // if
                            else
                            {
                              document.getElementById("div" + positionInWord).style.color = 'red';
                            } // else
                            positionInWord++;
                            changeKeyboardImage();
                          } // else if

                          phoneTextField.focus();
                        } // if
                        else if (x === 13 && start.innerHTML === 'START')
                        {
                          startRound();
                        } // else if
                      } // function


function changeKeyboardImage()
{
  if (level === 1)
  {
    keyboard.style.visibility = "visible";
    if (gameIsRunning())
    {
      if (isValidWordSoFar())
      {
        if (preventUndefinedError() && positionInWord < words[wIndex].length)
        {
          var source = "images/keyboard" + words[wIndex][positionInWord].toUpperCase() + ".png";
          keyboard.src = source;
        } // if
        else
        {
          keyboard.src = "images/keyboardSPACE.png";
        } // else
      } // if
      else
      {
        keyboard.src = "images/keyboardBACKSPACE.png";
      } // else
    } // if
    else
    {
      keyboard.src = "images/keyboard.png";
    } // else
  } // if
  else if (level === 2)
  {
    keyboard.style.visibility = "visible";
    keyboard.src = "images/keyboard.png";
  } // else if
  else
  {
    keyboard.style.visibility = "hidden";
  } // else
} // changeKeyboardImage


function isValidWordSoFar()
{
  if (positionInWord >= 0)
  {
    for (var index = 0; index < positionInWord; index++)
    {
      if (document.getElementById("div" + index).style.color === 'red')
      {
        return false;
      } // if
    } // for

    return true;
  } // if

  return false;
} // isValidWord


function twoDigits(n)
{
  return (n <= 9 ? "0" + n : n);
} // twoDigits


function myTimer()
{
  if (seconds > 0)
  {
    seconds--;
    clock.innerHTML = twoDigits(minutes) + ':' + twoDigits(seconds);
  } // if
  else if (minutes > 0)
  {
    minutes--;
    seconds = 59;
    clock.innerHTML = twoDigits(minutes) + ':' + twoDigits(seconds);
  } // else if
  else
  {
    clock.innerHTML = 'Time\'s Up!';

    endRound();
  } // else
} // myTimer


// Update time (first minutes, last seconds).
function setTimer(requiredMinutes, requiredSeconds)
{
  minutes = requiredMinutes;
  seconds = requiredSeconds;
} // setTimer


// Focus back in the box after any key or mouse event.
document.onkeypress   = function()
                        {
                          if (gameIsRunning())
                          {
                            phoneTextField.focus();
                          } // if
                        } // function

document.onkeyup      = function()
                        {
                          if (gameIsRunning())
                          {
                            phoneTextField.focus();
                          } // if
                        } // function

document.onclick      = function()
                        {
                          if (gameIsRunning())
                          {
                            phoneTextField.focus();
                          } // if
                        } // function

document.onmousedown  = function()
                        {
                          if (gameIsRunning())
                          {
                            phoneTextField.focus();
                          } // if
                        } // function

document.onmouseup    = function()
                        {
                          if (gameIsRunning())
                          {
                            phoneTextField.focus();
                          } // if
                        } // function

document.ondblclick   = function()
                        {
                          if (gameIsRunning())
                          {
                            phoneTextField.focus();
                          } // if
                        } // function