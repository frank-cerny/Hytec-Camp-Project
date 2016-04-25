<!DOCTYPE html>
<html>
  <head>
    <title>Question Page</title>
  </head>
  <body>
    <?php
    include 'HytecFunctions.php';

    if((isset($_POST["name"]))  ) {
    $name = $_POST["name"];
    addName($name);
    }
    else {
    }

    $questionNumber = 1;
    while ($questionNumber <= 10) {
      showQuestion($questionNumber);
      $questionNumber++;
    }
    ?>
  </body>
</html>
