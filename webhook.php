<?php
header('Content-type: application/json');

// php://input contains raw data, POST can only handle simple key value
// whereas input can handle more complicated such as nested arrays, etc
$body = file_get_contents("php://input");
$webhook = json_decode($body, true);

// What pokemon did the user guess?
$guesses = $webhook['result']['parameters']['pokemon'];
$correct = false;
foreach ($guesses as $pokemon_guess) {
  if(strcasecmp($pokemon_guess, 'bulbasaur') == 0) {
    // User guessed the correct pokemon
    $response->speech = "That's correct!";
    $response->displayText = "That's correct!";
    $response->source = "googlevoicepractice";
    $correct = true;
  }
}

// User guess the wrong pokemon
if(!$correct){
    $response->speech = "Nope, guess again!";
    $response->displayText =  "Nope, guess again!";
    $response->source = "googlevoicepractice";
}

echo json_encode($response);
?>
