<?php
  echo "<h3>Удаление жанра</h3>";

  if ($param_submit != "")
  {
    try 
    {
      $rs = pg_query_params($conn, 'DELETE FROM genre WHERE id=$1', array($param_id));
      echo "<br>";
      echo "Жанр удален";
    }
    catch (exception $e) 
    {
      echo "<br>";
      echo "Жанр не удалось удалить";
    }
  }
  else
  {
    $rs = pg_query_params($conn, 'SELECT name FROM genre WHERE id=$1', array($param_id));
    $row = pg_fetch_assoc($rs);
    $name = $row["name"];

    echo "<form method=get action='genre.php'>";
    echo "<input type='hidden' name='mode' value='remove'>";
    echo "<input type='hidden' name='id' value='$param_id'>";
    echo "<table>";
    echo "<tr><td class='header'>Наименование</td><td>$name</td></tr>";
    echo "</table>";
    echo "<br>";
    echo "<button type='submit' name='submit' value='yes'>Удалить жанр</button>";
    echo "</form>";
  }
?>
