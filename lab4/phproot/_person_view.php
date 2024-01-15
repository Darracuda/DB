<?php
  echo "<h3>Персоналия</h3>";

  $rs = pg_query_params($conn, 'SELECT first_name, last_name, country.id AS country_id, country.name AS country_name FROM person LEFT JOIN country ON country.id = person.country_id WHERE person.id=$1 ORDER BY last_name, first_name', array($param_id));
  $row = pg_fetch_assoc($rs);
  $first_name = $row["first_name"];
  $last_name = $row["last_name"];
  $country_id = $row["country_id"];
  $country_name = $row["country_name"];

  echo "<table>";
  echo "<tr><td class='header'>Имя и фамилия</td><td>";
  echo "$first_name $last_name";
  echo "</td></tr>";
  echo "<tr><td class='header'>Страна</td><td>";
  echo "<a href='country.php?id=$country_id'>$country_name</a>";
  echo "</td></tr>";
  echo "</table>";

  echo "<br>";
  echo "<a href='person.php?mode=edit&id=$param_id'>* Редактировать персоналию</a>";
  echo "<br>";
  echo "<a href='person.php?mode=remove&id=$param_id'>- Удалить персоналию</a>";

  echo "<h3>Список фильмов, в создании которых персоналия приняла участие</h3>";

  $rs = pg_query_params($conn, 'SELECT crew.id AS crew_id, movie.id AS movie_id, movie.name AS movie_name, country.id AS country_id, country.name AS country_name, crew_position.id AS crew_position_id, crew_position.name AS crew_position_name, role FROM movie JOIN crew ON crew.movie_id = movie.id JOIN person ON crew.person_id = person.id LEFT JOIN country ON country.id = movie.country_id JOIN crew_position ON crew_position.id = crew.crew_position_id WHERE person.id=$1 ORDER BY movie.name', array($param_id));

  if (pg_num_rows($rs) > 0)
  {
    echo "<table><th>Наименование</th><th>Страна</th><th>Профессия</th><th>*</th>";
    while ($row = pg_fetch_assoc($rs)) 
    {
      $crew_id = $row["crew_id"];
      $movie_id = $row["movie_id"];
      $movie_name = $row["movie_name"];
      $country_id = $row["country_id"];
      $country_name = $row["country_name"];
      $crew_position_id = $row["crew_position_id"];
      $crew_position_name = $row["crew_position_name"];
      $role = $row["role"];
      echo "<tr><td>";
      echo "<a href='movie.php?id=$movie_id'>$movie_name</a>";
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
    echo "Нет фильмов<br>";
  }
  echo "<br>";
  echo "<a href='crew.php?mode=add&person_id=$param_id'>+ Добавить участие персоналии в фильме</a>";
?>
