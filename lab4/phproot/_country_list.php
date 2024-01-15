<?php
  echo "<h3>Список стран</h3>";

  $rs = pg_query($conn, 'SELECT id, name FROM country ORDER BY name');

  echo "<table><th>Название</th><th>*</th>";
  while ($row = pg_fetch_assoc($rs)) 
  {
    $id = $row["id"];
    $name = $row["name"];
    echo "<tr><td>";
    echo "<a href='country.php?id=$id'>$name</a>";
    echo "</td><td>";
    echo "<a href='country.php?mode=remove&id=$id' title='Удалить'>X</a>";
    echo "</td></tr>";
  }
  echo "</table>";
  echo "<br>";
  echo "<a href='country.php?mode=add'>+ Добавить страну</a>";
?>
