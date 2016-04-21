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
  function showQuestion() {
    $conn = connectDB();

    //Select everything from the Question table and print it to the screen within <radio tags>

    $sql = $conn->prepare("SELECT id, question, a, b, c, d, answer FROM Question WHERE id=1");

    $sql->execute();
    $sql->bind_result($id, $question, $a, $b, $c, $d, $answer);

    while($sql->fetch()) {
      echo "<h1>Question $id </h1>";
      echo "<p>$question</p>";
      echo "<form>
        <input type=\"radio\" name=\"answer\" value=\"a\">$a<br>
        <input type=\"radio\" name=\"answer\" value=\"b\">$b<br>
        <input type=\"radio\" name=\"answer\" value=\"c\">$c<br>
        <input type=\"radio\" name=\"answer\" value=\"d\">$d<br>
        <input type=\"submit\" name=\"Submit\">
      </form>";
    }
    $sql->close();
    $conn->close();
  }
?>
