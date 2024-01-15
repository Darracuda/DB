<?php
  echo "<h3>Редактирование жанра</h3>";

  if ($param_submit != "")
  {
    $rs = pg_query_params($conn, 'UPDATE genre SET name=$2 WHERE id=$1', array($param_id, $param_name));
    echo "<br>";
    echo "Жанр сохранен";
  }
  else
  {
    $rs = pg_query_params($conn, 'SELECT id, name FROM genre WHERE id=$1', array($param_id));
    $row = pg_fetch_assoc($rs);
    $name = $row["name"];

    echo "<form method=get action='genre.php'>";
    echo "<input type='hidden' name='mode' value='edit'>";
    echo "<input type='hidden' name='id' value='$param_id'>";
    echo "<table>";
    echo "<tr><td class='header'>Наименование</td><td>";
    echo "<input type='text' name='name' value='$name' />";
    echo "</td></tr>";
    echo "</table>";
    echo "<br>";
    echo "<button type='submit' name='submit' value='yes'>Сохранить жанр</button>";
    echo "</form>";
  }
?>
