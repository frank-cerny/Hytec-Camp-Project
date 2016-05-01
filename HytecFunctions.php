<?php

function connectDB() {
  $servername = "localhost";
  $username = "root";
  $password = "C1e2r3n4y5f629#";
  $dbname = "QuizApp";

  //Create a connection object and return it to the caller

  $conn = new mysqli($servername, $username,
  $password, $dbname);

  if ($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
  }

  return $conn;
  }

  function addName($name) {
    $conn = connectDB();

    //Insert into the QuizApp table the element with the passed information

    $sql = $conn->prepare("INSERT INTO Names (Name, Score)
    VALUES(?, 0)");

    // Puts values into above ?s

    $sql->bind_param('s', $name);
    $sql->execute();

    $sql->close();
    $conn->close();
  }

  function showQuestion($number) {
    $conn = connectDB();

    //Select everything from the Question table and print it to the screen within <radio tags>

    $sql = $conn->prepare("SELECT id, question, a, b, c, d, answer FROM Question WHERE id='$number'");

    $sql->execute();
    $sql->bind_result($id, $question, $a, $b, $c, $d, $answer);

    while($sql->fetch()) {
      echo "<h1>Question $id </h1>";
      echo "<p>$question</p>";
      $id++;
      echo "<form action=\"\" method=\"POST\">
        <input type=\"radio\" name=\"Useranswer\" value=\"a\">$a<br>
        <input type=\"radio\" name=\"Useranswer\" value=\"b\">$b<br>
        <input type=\"radio\" name=\"Useranswer\" value=\"c\">$c<br>
        <input type=\"radio\" name=\"Useranswer\" value=\"d\">$d<br>
        <input type=\"submit\" name=\"Next\">
        <input type=\"hidden\" name=\"question\" value=\"$id\">
      </form>";
      if((isset($_POST["Useranswer"]))  ) {
      $userInput = $_POST["Useranswer"];
      checkAnswer($number, $userInput);
      }
      else {
        // echo "Crap";
      }
      echo "<a href=\"http://localhost/Html/QuizApp/HytecCampProjectLogin.php\">Login Page </a>";
      }

    $sql->close();
    $conn->close();
  }

  function checkAnswer($questionNumber, $answer) {
    $conn = connectDB();
    $questionNumber--;
    $sql = $conn->prepare("SELECT answer FROM Question WHERE id=?");
    $sql->bind_param('i',$questionNumber);

    $sql->execute();
    $sql->bind_result($DBanswer);
    $sql->fetch();


    // echo "DB" .$DBanswer;
    // echo "user" .$answer;

    if ($answer == $DBanswer) {
      echo "<p>Correct!</p>";
      updateScore();
    }
    else {
      echo "<p>Incorrect, correct answer was $DBanswer</p>";
    }
    $sql->close();
    $conn->close();
  }
  function updateScore() {

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $conn = connectDB();

    // Score Update
    $name = $_SESSION["userName"];
    // echo $name;

    $sql = $conn->prepare("SELECT Score FROM Names WHERE Name=?");
    $sql->bind_param('s',$name);
    $sql->execute();
    $sql->bind_result($score);
    $sql->fetch();
    $sql->close();

    // echo "This actually works";
    // echo "Score Before" .$score;
    $score++;
    // echo "Score After" .$score;

    $sql = $conn->prepare("UPDATE Names SET Score=? WHERE Name=?");
    $sql->bind_param('is',$score, $name);
    $sql->execute();

    $sql->close();
    $conn->close();
  }
  function EndGame() {
    $conn = connectDB();
    $name = $_SESSION["userName"];

    $sql = $conn->prepare("SELECT Score FROM Names WHERE Name=?");
    $sql->bind_param('s',$name);
    $sql->execute();
    $sql->bind_result($score);
    $sql->fetch();
    $sql->close();

    echo "<p>You recieved a $score/10</p>";

    echo "<a href=\"http://localhost/Html/QuizApp/HytecCampProjectLogin.php\">Login Page </a>";
  }
?>
