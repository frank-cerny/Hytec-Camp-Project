<DOCTYPE html>
<html>
  <head>
    <title>Entrance Page</title>
  </head>
  <body>
    <h1>Welcome to our Quiz App V1 Alpha</h1>
    <p>Please select which quiz you would like to take, you will take all 10
      questions and at the end you can see how you stack up against everyone
      else. Please enter your name below.</p><br />

      <!-- This form will take in an entered username and put it into a database,
      if it is already in the database then they will be asked to take a new test,
      but they cannot retake an old one -->


    <form method="GET">
      <p>Username:
      <input type="text" name="name" id="name">
      <input type="submit" value="Submit">

      <?php

      if((isset($_GET['name']))  ) {
      $name = $_GET["name"];
      addName($name);
      }

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
           ?>

    </form>
  </body>
</html>
