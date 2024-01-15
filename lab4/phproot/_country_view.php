<?php
  echo "<h3>Cтрана</h3>";

  $rs = pg_query_params($conn, 'SELECT name FROM country WHERE id=$1', array($param_id));
  $row = pg_fetch_assoc($rs);
  $name = $row["name"];

  echo "<table>";
  echo "<tr><td class='header'>Наименование</td><td>";
  echo "$name";
  echo "</td></tr>";
  echo "</table>";

  echo "<br>";
  echo "<a href='country.php?mode=edit&id=$param_id'>* Редактировать страну</a>";
  echo "<br>";
  echo "<a href='country.php?mode=remove&id=$param_id'>- Удалить страну</a>";

  echo "<h3>Список фильмов, снятых в этой стране</h3>";

  $rs = pg_query_params($conn, 'SELECT movie.id AS movie_id, movie.name AS movie_name, release_date, genre.id AS genre_id, genre.name AS genre_name FROM movie LEFT JOIN genre ON genre.id = movie.genre_id WHERE country_id=$1 ORDER BY movie.name', array($param_id));

  if (pg_num_rows($rs) > 0)
  {
    echo "<table><th>Фильм</th><th>Дата выхода</th><th>Жанр</th>";
    while ($row = pg_fetch_assoc($rs)) 
    {
      $movie_id = $row["movie_id"];
      $movie_name = $row["movie_name"];
      $release_date = $row["release_date"];
      $genre_id = $row["genre_id"];
      $genre_name = $row["genre_name"];
      echo "<tr><td>";
      echo "<a href='movie.php?id=$movie_id'>$movie_name</a>";
      echo "</td><td>";
      echo "$release_date</a>";
      echo "</td><td>";
      echo "<a href='genre.php?id=$genre_id'>$genre_name</a>";
      echo "</td></tr>";
    }
    echo "</table>";
  }
  else
  {
    echo "Нет фильмов<br>";
  }

  echo "<h3>Список персоналий из этой страны</h3>";

  $rs = pg_query_params($conn, 'SELECT id, first_name, last_name FROM person WHERE country_id=$1 ORDER BY last_name, first_name', array($param_id));

  if (pg_num_rows($rs) > 0)
  {
    echo "<table><th>Название</th>";
    while ($row = pg_fetch_assoc($rs)) 
    {
      $id = $row["id"];
      $first_name = $row["first_name"];
      $last_name = $row["last_name"];
      echo "<tr><td>";
      echo "<a href='person.php?id=$id'>$first_name $last_name</a>";
      echo "</td></tr>";
    }
    echo "</table>";
  }
  else
  {
    echo "Нет персоналий<br>";
  }
?>
