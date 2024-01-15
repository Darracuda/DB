<?php
  echo "<h3>Список профессий</h3>";

  $rs = pg_query($conn, 'SELECT id, name FROM crew_position ORDER BY name');

  echo "<table><th>Название</th>";
  while ($row = pg_fetch_assoc($rs)) 
  {
    $id = $row["id"];
    $name = $row["name"];
    echo "<tr><td>";
    echo "<a href='crew_position.php?id=$id'>$name</a>";
    echo "</td></tr>";
  }
  echo "</table>";
  echo "<br>";
  echo "<a href='crew_position.php?mode=add'>+ Добавить профессию</a>";
?>
