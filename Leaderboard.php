<!DOCTYPE html>
  <head>
  <title>Leaderboards</title>
  </head>
  <body>
  <table>
    <tr>
        <td>Rank</td>
        <td>User</td>
        <td>Score</td>
    </tr>
  </table>
  <?php
  include 'HytecFunctions.php';
  $conn=connectDB();

  $rank = 1;

      $sql = 'SELECT Name, Score FROM Names ORDER BY Score DESC';
    foreach ($conn->query($sql) as $row) {
    echo "<table>
            <tr>
            <td>$rank</td>
            <td>$row[Name]</td>
            <td>$row[Score]</td>
            </tr>
    </table>";
}


      $conn->close();
  ?>
  </body>
</html>
