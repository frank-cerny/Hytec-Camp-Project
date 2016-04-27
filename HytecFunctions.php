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

    $sql->bind_param("s", $name);
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
        <input type=\"submit\" name=\"Submit\">
        <input type=\"hidden\" name=\"question\" value=\"$id\">
      </form>";
      if((isset($_POST["Useranswer"]))  ) {
      $userInput = $_POST["Useranswer"];
      checkAnswer($number, $userInput);
      }
      else {
        echo "Crap";
      }
      echo "<a href=\"http://localhost/Html/QuizApp/HytecCampProjectLogin.php\">Login Page </a>";
      }

    $sql->close();
    $conn->close();
  }

  function checkAnswer($questionNumber, $answer) {
    $conn = connectDB();

    $sql = $conn->prepare("SELECT answer FROM Question WHERE id=?");
    $sql->bind_param("i",$questionNumber);

    $sql->execute();
    $sql->bind_result($DBanswer);
    $sql->fetch();

    /*
    echo "DB" .$DBanswer;
    echo "user" .$answer;
    */

    if ($answer == $DBanswer) {
      echo "Winner";
      updateScore();
    }
    else {
      echo "Loser";
    }
    $sql->close();
    $conn->close();
  }
  function updateScore() {
    $conn = connectDB();

    // Score Update
    $name = "Trial1";
    // $name = getName();
    $sql = $conn->prepare("SELECT Score FROM Names WHERE Name=?");
    $sql->bind_param("s",$name);
    $sql->execute();
    $sql->bind_result($score);
    $sql->fetch();

    echo "This actually works";
    $score++;
    echo $score;

    $sql = $conn->prepare("UPDATE Names SET Score='$score' WHERE Name=?");
    $sql->bind_param("s",$name);
    $sql->execute();
    $sql->fetch();

    $sql->close();
    $conn->close();

  }
  /*
  function getName() {
    if((isset($_POST["name"]))  ) {
    $name = $_POST["name"];
    }
    else {
    }
    return $name;
  }
  */
?>
