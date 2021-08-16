<?php

error_reporting(0);
@ini_set('display_errors', 0);

// this is the testbed for our word selection algorithm

// default starting percentages
// 1 - easy
// 2 - intermediate
// 3 - hard
$percentageArray = array(0, 0.75, 0.2, 0.05);

// the position of the words that are on the difficulty borders
// 20%/30%/50%
$difficultyDelimitersArray = array(0, 250, 24750, 49500);

// half of the user elo default, constant
$halfMaxWpm = 100;

// Load the configuration file containing your database credentials
require_once('../config.inc.php');
require_once('words.php');

// Connect to the group database
$mysqli = new mysqli($database_host, $database_user, $database_pass, $group_dbnames[0]);
// $mysqli = new mysqli('dbhost.cs.man.ac.uk', 'username', 'password', '2015_comp10120_z4');

// this function updates the easy, intermediate and hard word drop percentages
// according to the user's Elo
function updatePercentages($userWpm)
{
    global $halfMaxWpm, $percentageArray;

    // if the user is between beginner and average
    // update the easy and intermediate values
    // by using intermediate as reference
    if($userWpm <= $halfMaxWpm)
    {
        // f(x) = 20% + (55%/(total/2))x
        $newIntermediate = 0.20 + (0.55/$halfMaxWpm)*$userWpm;
        $delta = $newIntermediate - $percentageArray[2];

        $percentageArray[2] = $newIntermediate;
        $percentageArray[1] -= $delta;
    }
    else
    {
        updatePercentages($halfMaxWpm); // resets to the desired default conf

        // f(x) = 5% + (x/(total/2) - 1)*65%
        $newHard = 0.05 + ($userWpm/$halfMaxWpm - 1)*0.65;
        $delta = $newHard - $percentageArray[3];

        $percentageArray[3] = $newHard;
        $percentageArray[2] -= $delta;
    }
}

function getWords($wordNumber)
{
    global $percentageArray, $difficultyDelimitersArray, $wordsArray, $mysqli, $backupArray;

    if(!$mysqli -> connect_error) {

        for ($index = 0; $index < $wordNumber; $index++) {

            // get a random percentage
            $randVar = mt_rand(0, 100) / 100;
            $sum = 0;

            // calculate based on the percentages what kind of difficulty the next word should be
            for ($count = 1; $count <= 3; $count++) {
                $sum += $percentageArray[$count];
                if ($randVar <= $sum)
                    break;
            }

            // get a random word from the difficulty range that was picked
            $randVar = mt_rand($difficultyDelimitersArray[$count - 1],
                $difficultyDelimitersArray[$count]);

            if ($result = $mysqli->query("SELECT word FROM Words WHERE ID = " . $randVar)) {
                $row = $result->fetch_assoc();
                $wordsArray[] = $row['word'];
                $result->close(); // Remember to release the result set
            }
        }
    }
    // for showcase demo
    if (empty($wordsArray)) {
        $wordsArray = $backupArray;
        shuffle($wordsArray);
    }
    return $wordsArray;
}

$wpm = (int)$_REQUEST['wpm'];
$wordNum = (int)$_REQUEST['wordNum'];

updatePercentages($wpm);
$words = json_encode(getWords($wordNum));
echo $words;
