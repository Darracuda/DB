<?php
  echo "<h3>Фильм</h3>";

  $rs = pg_query_params($conn, 'SELECT movie.name AS movie_name, release_date, genre.id AS genre_id, genre.name AS genre_name, country.id AS country_id, country.name AS country_name FROM movie LEFT JOIN genre ON genre.id = movie.genre_id LEFT JOIN country ON country.id = movie.country_id WHERE movie.id = $1 ORDER BY movie.name', array($param_id));
  $row = pg_fetch_assoc($rs);
  $movie_name = $row["movie_name"];
  $release_date = $row["release_date"];
  $genre_id = $row["genre_id"];
  $genre_name = $row["genre_name"];
  $country_id = $row["country_id"];
  $country_name = $row["country_name"];

  echo "<table>";
  echo "<tr><td class='header'>Фильм</td><td>";
  echo "$movie_name";
  echo "</td></tr>";
  echo "<tr><td class='header'>Дата выпуска</td><td>";
  echo "$release_date</a>";
  echo "</td></tr>";
  echo "<tr><td class='header'>Жанр</td><td>";
  echo "<a href='genre.php?id=$genre_id'>$genre_name</a>";
  echo "</td></tr>";
  echo "<tr><td class='header'>Страна</td><td>";
  echo "<a href='country.php?id=$country_id'>$country_name</a>";
  echo "</td></tr>";
  echo "</table>";

  echo "<br>";
  echo "<a href='movie.php?mode=edit&id=$param_id'>* Редактировать фильм</a>";
  echo "<br>";
  echo "<a href='movie.php?mode=remove&id=$param_id'>- Удалить фильм</a>";

  echo "<h3>Список персоналий, участвовавших в данном фильме</h3>";

  $rs = pg_query_params($conn, 'SELECT crew.id AS crew_id, person.id AS person_id, first_name, last_name, country.id AS country_id, country.name AS country_name, crew_position.id AS crew_position_id, crew_position.name AS crew_position_name, role FROM person JOIN crew ON crew.person_id = person.id JOIN movie ON crew.movie_id = movie.id LEFT JOIN country ON country.id = person.country_id JOIN crew_position ON crew_position.id = crew.crew_position_id WHERE movie.id=$1 ORDER BY last_name, first_name', array($param_id));

  if (pg_num_rows($rs) > 0)
  {
    echo "<table><th>Имя и фамилия</th><th>Страна</th><th>Профессия</th><th>*</th>";
    while ($row = pg_fetch_assoc($rs)) 
    {
      $crew_id = $row["crew_id"];
      $person_id = $row["person_id"];
      $first_name = $row["first_name"];
      $last_name = $row["last_name"];
      $country_id = $row["country_id"];
      $country_name = $row["country_name"];
      $crew_position_id = $row["crew_position_id"];
      $crew_position_name = $row["crew_position_name"];
      $role = $row["role"];
      echo "<tr><td>";
      echo "<a href='person.php?id=$person_id'>$first_name $last_name</a>";
      echo "</td><td>";
      echo "<a href='country.php?id=$country_id'>$country_name</a>";
      echo "</td><td>";
      echo "<a href='crew_position.php?id=$crew_position_id'>$crew_position_name</a>";
      if ($role != "")
        echo ", роль - '$role'";
      echo "</td><td>";
      echo "<a href='crew.php?mode=remove&id=$crew_id' title='Удалить'>X</a>";
      echo "</td></tr>";
    }
    echo "</table>";
  }
  else
  {
    echo "Нет персоналий<br>";
  }
  echo "<br>";
  echo "<a href='crew.php?mode=add&movie_id=$param_id'>+ Добавить участии персоналии в фильме</a>";
?>
