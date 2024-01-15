<?php
  echo "<h3>Список жaнров</h3>";

  $rs = pg_query($conn, 'SELECT id, name FROM genre ORDER BY name');

  echo "<table><th>Название</th><th>*</th>";
  while ($row = pg_fetch_assoc($rs)) 
  {
    $id = $row["id"];
    $name = $row["name"];
    echo "<tr><td>";
    echo "<a href='genre.php?id=$id'>$name</a>";
    echo "</td><td>";
    echo "<a href='genre.php?mode=remove&id=$id' title='Удалить'>X</a>";
    echo "</td></tr>";
  }
  echo "</table>";
  echo "<br>";
  echo "<a href='genre.php?mode=add'>+ Добавить жанр</a>";
?>
