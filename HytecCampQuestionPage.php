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
    //getName();
    }
    else {
    }
    $questionNumber = 1;
    if((isset($_POST["question"]))) {
    $questionNumber = $_POST["question"];
  }
  showQuestion($questionNumber);
    ?>
  </body>
</html>
