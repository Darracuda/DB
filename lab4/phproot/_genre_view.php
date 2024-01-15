<?php
  echo "<h3>Жанр</h3>";

  $rs = pg_query_params($conn, 'SELECT name FROM genre WHERE id=$1', array($param_id));
  $row = pg_fetch_assoc($rs); 
  $name = $row["name"];

  echo "<table>";
  echo "<tr><td class='header'>Наименование</td><td>";
  echo "$name";
  echo "</td></tr>";
  echo "</table>";

  echo "<br>";
  echo "<a href='genre.php?mode=edit&id=$param_id'>* Редактировать жанр</a>";
  echo "<br>";
  echo "<a href='genre.php?mode=remove&id=$param_id'>- Удалить жанр</a>";

  echo "<h3>Список фильмов, снятых в этом жанре</h3>";

  $rs = pg_query_params($conn, 'SELECT id, name FROM movie WHERE genre_id=$1 ORDER BY name', array($param_id));

  if (pg_num_rows($rs) > 0)
  {
    echo "<table><th>Название</th>";
    while ($row = pg_fetch_assoc($rs)) 
    {
      $id = $row["id"];
      $name = $row["name"];
      echo "<tr><td>";
      echo "<a href='movie.php?id=$id'>$name</a>";
      echo "</td></tr>";
    }
    echo "</table>";
  }
  else
  {
    echo "Нет фильмов<br>";
  }
?>
