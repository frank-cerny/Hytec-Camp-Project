<!DOCTYPE html>
<html>
  <head>
  <title>Leaderboards</title>
  <style type="text/css">
    th {
      overflow: auto;
      font-size: 25px;
      border: 1px solid;
      padding: 5px;
      margin: 2px 2px 2px 2px;
    }
    td {
      font-size: 25px;
      padding-left: 30px;
      padding-top: 3px;
    }
  </style>
  </head>
  <body>
    <h1>Leaderboard</h1>
  <table>
    <tr>
        <th>Rank</th>
        <th>User</th>
        <th>Score</th>
    </tr>
  <?php
  include 'HytecFunctions.php';
  $conn=connectDB();

  $rank = 1;

      $sql = 'SELECT Name, Score FROM Names ORDER BY Score DESC';
    foreach ($conn->query($sql) as $row) {
    echo "
            <td>$rank</td>
            <td>$row[Name]</td>
            <td>$row[Score]</td>
            </tr>";
    $rank++;
}

      $conn->close();
  ?>
</table>
  </body>
</html>
