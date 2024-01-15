<?php
  echo "<h3>Список фильмов</h3>";

  $rs = pg_query($conn, 'SELECT movie.id AS movie_id, movie.name AS movie_name, release_date, genre.id AS genre_id, genre.name AS genre_name, country.id AS country_id, country.name AS country_name FROM movie LEFT JOIN genre ON genre.id = movie.genre_id LEFT JOIN country ON country.id = movie.country_id ORDER BY movie.name');

  echo "<table><th>Фильм</th><th>Дата выхода</th><th>Жанр</th><th>Страна</th>";
  while ($row = pg_fetch_assoc($rs)) 
  {
    $movie_id = $row["movie_id"];
    $movie_name = $row["movie_name"];
    $release_date = $row["release_date"];
    $genre_id = $row["genre_id"];
    $genre_name = $row["genre_name"];
    $country_id = $row["country_id"];
    $country_name = $row["country_name"];
    echo "<tr><td>";
    echo "<a href='movie.php?id=$movie_id'>$movie_name</a>";
    echo "</td><td>";
    echo "$release_date</a>";
    echo "</td><td>";
    echo "<a href='genre.php?id=$genre_id'>$genre_name</a>";
    echo "</td><td>";
    echo "<a href='country.php?id=$country_id'>$country_name</a>";
    echo "</td></tr>";
  }
  echo "</table>";
  echo "<br>";
  echo "<a href='movie.php?mode=add'>+ Добавить фильм</a>";
?>
