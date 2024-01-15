<?php
  echo "<h3>Добавление участие персоналии в фильме</h3>";

  if ($param_submit != "")
  {
    try 
    {
      $rs = pg_query_params($conn, 'INSERT INTO crew (person_id, movie_id, crew_position_id, role) VALUES($1, $2, $3, $4)', array($param_person_id, $param_movie_id, $param_crew_position_id, $param_role));
      echo "<br>";
      echo "Участие персоналии в фильме добавлено";
    }
    catch (exception $e) 
    {
      echo "<br>";
      echo "Участие персоналии в фильме не удалось добавить";
    }
  }
  else
  {
    echo "<form method=get action='crew.php'>";
    echo "<input type='hidden' name='mode' value='add'>";
    echo "<table>";

    echo "<tr><td class='header'>Имя и фамилия</td><td>";
    if ($param_person_id != "")
    {
      $rs = pg_query_params($conn, 'SELECT first_name, last_name FROM person WHERE id=$1', array($param_person_id));
      $row = pg_fetch_assoc($rs);
      $first_name = $row["first_name"];
      $last_name = $row["last_name"];
      echo "<input type='hidden' name='person_id' value='$param_person_id'>";
      echo "$first_name $last_name";
    }
    else
    {
      $rs = pg_query($conn, 'SELECT id, first_name, last_name FROM person ORDER BY last_name, first_name');
      echo "<select name='person_id'>";
      while ($row = pg_fetch_assoc($rs))
      {
        $id = $row["id"];
        $first_name = $row["first_name"];
        $last_name = $row["last_name"];
        echo "<option value=$id>$first_name $last_name</option>";
      }
      echo "</select>";
    }
    "</td></tr>";

    $rs = pg_query($conn, 'SELECT id, name FROM crew_position ORDER BY name');
    echo "<tr><td class='header'>Профессия</td><td><select name='crew_position_id'>";
    while ($row = pg_fetch_assoc($rs))
    {
      $id = $row["id"];
      $name = $row["name"];
      echo "<option value=$id>$name</option>";
    }
    echo "</select></td></tr>";

    echo "<tr><td class='header'>Роль (опционально)</td><td>";
    echo "<input type='text' name='role' value=''>";
    echo "</td></tr>";

    echo "<tr><td class='header'>Фильм</td><td>";
    if ($param_movie_id != "")
    {
      $rs = pg_query_params($conn, 'SELECT name FROM movie WHERE id=$1', array($param_movie_id));
      $row = pg_fetch_assoc($rs);
      $name = $row["name"];
      echo "<input type='hidden' name='movie_id' value='$param_movie_id'>";
      echo "$name";
    }
    else
    {
      $rs = pg_query($conn, 'SELECT id, name FROM movie ORDER BY name');
      echo "<select name='movie_id'>";
      while ($row = pg_fetch_assoc($rs))
      {
        $id = $row["id"];
        $name = $row["name"];
        echo "<option value=$id>$name</option>";
      }
      echo "</select>";
    }
    echo "</td></tr>";

    echo "</table>";
    echo "<br>";
    echo "<button type='submit' name='submit' value='yes'>Добавить участие персоналии в фильме</button>";
    echo "</form>";
  }
?>
