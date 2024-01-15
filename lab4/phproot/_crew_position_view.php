<?php
  echo "<h3>Профессия</h3>";

  $rs = pg_query_params($conn, 'SELECT name FROM crew_position WHERE id=$1', array($param_id));
  $row = pg_fetch_assoc($rs); 
  $name = $row["name"];

  echo "<table>";
  echo "<tr><td class='header'>Наименование</td><td>";
  echo "$name";
  echo "</td></tr>";
  echo "</table>";

  echo "<br>";
  echo "<a href='crew_position.php?mode=edit&id=$param_id'>* Редактировать профессию</a>";
  echo "<br>";
  echo "<a href='crew_position.php?mode=remove&id=$param_id'>- Удалить профессию</a>";

  echo "<h3>Список персоналий с этой профессией в фильмах</h3>";

  $rs = pg_query_params($conn, 'SELECT person.id AS person_id, first_name, last_name, person_country.id AS person_country_id, person_country.name AS person_country_name, movie.id AS movie_id, movie.name AS movie_name, movie_country.id AS movie_country_id, movie_country.name AS movie_country_name, crew_position.name AS crew_position_name, role, genre.id AS genre_id, genre.name AS genre_name FROM person JOIN crew ON crew.person_id = person.id JOIN movie ON crew.movie_id = movie.id JOIN country AS person_country ON person_country.id = person.country_id JOIN country AS movie_country ON movie_country.id = movie.country_id JOIN crew_position ON crew_position.id = crew.crew_position_id JOIN genre ON genre.id = movie.genre_id WHERE crew_position.id=$1 ORDER BY last_name, first_name', array($param_id));

  if (pg_num_rows($rs) > 0)
  {
    echo "<table><th>Имя и фамилия</th><th>Страна</th><th>Профессия</th><th>Фильм</th><th>Страна</th><th>Жанр</th>";
    while ($row = pg_fetch_assoc($rs)) 
    {
      $person_id = $row["person_id"];
      $first_name = $row["first_name"];
      $last_name = $row["last_name"];
      $person_country_id = $row["person_country_id"];
      $person_country_name = $row["person_country_name"];
      $movie_id = $row["movie_id"];
      $movie_name = $row["movie_name"];
      $movie_country_id = $row["movie_country_id"];
      $movie_country_name = $row["movie_country_name"];
      $crew_position_name = $row["crew_position_name"];
      $role = $row["role"];
      $genre_id = $row["genre_id"];
      $genre_name = $row["genre_name"];
      echo "<tr><td>";
      echo "<a href='person.php?id=$person_id'>$first_name $last_name</a>";
      echo "</td><td>";
      echo "<a href='country.php?id=$person_country_id'>$person_country_name</a>";
      echo "</td><td>";
      echo "$crew_position_name";
      if ($role != "")
        echo ", роль - '$role'";
      echo "</td><td>";
      echo "<a href='movie.php?id=$movie_id'>$movie_name</a>";
      echo "</td><td>";
      echo "<a href='country.php?id=$movie_country_id'>$movie_country_name</a>";
      echo "</td><td>";
      echo "<a href='genre.php?id=$genre_id'>$genre_name</a>";
      echo "</td></tr>";
    }
    echo "</table>";
  }
  else
  {
    echo "Нет персоналий<br>";
  }
?>
