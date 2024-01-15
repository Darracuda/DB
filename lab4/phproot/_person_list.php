<?php
  echo "<h3>Список персоналий</h3>";

  $rs = pg_query($conn, 'SELECT person.id AS person_id, first_name, last_name, country.id AS country_id, country.name AS country_name FROM person LEFT JOIN country ON country.id = person.country_id ORDER BY last_name, first_name');

  echo "<table><th>Имя и фамилия</th><th>Страна</th>";
  while ($row = pg_fetch_assoc($rs)) 
  {
    $person_id = $row["person_id"];
    $first_name = $row["first_name"];
    $last_name = $row["last_name"];
    $country_id = $row["country_id"];
    $country_name = $row["country_name"];
    echo "<tr><td>";
    echo "<a href='person.php?id=$person_id'>$first_name $last_name</a>";
    echo "</td><td>";
    echo "<a href='country.php?id=$country_id'>$country_name</a>";
    echo "</td></tr>";
  }
  echo "</table>";
  echo "<br>";
  echo "<a href='person.php?mode=add'>+ Добавить персоналию</a>";
?>
