<?php
  echo "<h3>Удаление участия персоналии в фильме</h3>";

  if ($param_submit != "")
  {
    try 
    {
      $rs = pg_query_params($conn, 'DELETE FROM crew WHERE id=$1', array($param_id));
      echo "<br>";
      echo "Участие персоналии в фильме удалено";
    }
    catch (exception $e) 
    {
      echo "<br>";
      echo "Участие персоналии в фильме не удалось удалить";
    }
  }
  else
  {
    $rs = pg_query_params($conn, 'SELECT first_name, last_name, movie.id AS movie_id, movie.name AS movie_name, country.id AS country_id, country.name AS country_name, crew_position.id AS crew_position_id, crew_position.name AS crew_position_name, role FROM movie JOIN crew ON crew.movie_id = movie.id JOIN person ON crew.person_id = person.id LEFT JOIN country ON country.id = movie.country_id JOIN crew_position ON crew_position.id = crew.crew_position_id WHERE crew.id=$1', array($param_id));
    $row = pg_fetch_assoc($rs);
    $first_name = $row["first_name"];
    $last_name = $row["last_name"];
    $movie_id = $row["movie_id"];
    $movie_name = $row["movie_name"];
    $country_id = $row["country_id"];
    $country_name = $row["country_name"];
    $crew_position_id = $row["crew_position_id"];
    $crew_position_name = $row["crew_position_name"];
    $role = $row["role"];

    echo "<form method=get action='crew.php'>";
    echo "<input type='hidden' name='mode' value='remove'>";
    echo "<input type='hidden' name='id' value='$param_id'>";
    echo "<table>";
    echo "<tr><td class='header'>Имя и фамилия</td><td>$first_name $last_name</td></tr>";
    echo "<tr><td class='header'>Профессия</td><td>$crew_position_name";
    if ($role != "")
      echo ", роль - '$role'";
    echo "</td></tr>";
    echo "<tr><td class='header'>Фильм</td><td>$movie_name</td></tr>";
    echo "<tr><td class='header'>Страна</td><td>$country_name</td></tr>";
    echo "</table>";
    echo "<br>";
    echo "<button type='submit' name='submit' value='yes'>Удалить участие персоналии в фильме</button>";
    echo "</form>";
  }
?>
