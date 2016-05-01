<!DOCTYPE html>
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


    <form action="HytecCampQuestionPage.php" method="POST">
      <p>Username:
      <input type="text" name="name" id="name">
      <input type="submit" value="Submit">

    </form>
  </body>
</html>
