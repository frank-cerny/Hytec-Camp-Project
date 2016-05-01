<!DOCTYPE html>
<html>
  <head>
    <title>Question Page</title>
  </head>
  <body>
    <?php
    session_start();
    include 'HytecFunctions.php';

    if((isset($_POST["name"]))  ) {
    $name = $_POST["name"];
    addName($name);
    $_SESSION["userName"] = $name;
    }
    else {
    }
    $questionNumber = 1;
    if((isset($_POST["question"]))) {
    $questionNumber = $_POST["question"];
  }
  if ($questionNumber < 11) {
  showQuestion($questionNumber);
  }
  else {
    EndGame();
    echo "<a href=\"http://localhost/Html/QuizApp/Leaderboard.php\">LearderBoard</a>";
  }
    ?>
  </body>
</html>
