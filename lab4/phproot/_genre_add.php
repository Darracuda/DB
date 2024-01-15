<?php
  echo "<h3>Добавление жанра</h3>";

  if ($param_submit != "")
  {
    $rs = pg_query_params($conn, 'INSERT INTO genre (name) VALUES($1)', array($param_name));
    echo "<br>";
    echo "Жанр добавлен";
  }
  else
  {
    echo "<form method=get action='genre.php'>";
    echo "<input type='hidden' name='mode' value='add'>";
    echo "<table>";
    echo "<tr><td class='header'>Наименование</td><td>";
    echo "<input type='text' name='name' value='' />";
    echo "</td></tr>";
    echo "</table>";
    echo "<br>";
    echo "<button type='submit' name='submit' value='yes'>Добавить жанр</button>";
    echo "</form>";
  }
?>
