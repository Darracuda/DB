<html>
  <head>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" type="text/css" href="main.css"/>
  </head>
  <body>

<div id="menu">
<table><tr>
<td><a href="/"><b>Главная страница</b></a></td>
<td><a href="genre.php">Жанры</a></td>
<td><a href="movie.php">Фильмы</a></td>
<td><a href="person.php">Персоналии</a></td>
<td><a href="country.php">Страны</a></td>
<td><a href="crew_position.php">Профессии</a></td>
</tr></table>
</div>

<div id="body">
<?php
  $param_mode = "list";
  $param_id = -1;
  $param_submit = "";
  $param_person_id = "";
  $param_movie_id = "";
  extract($_GET, EXTR_PREFIX_ALL, "param");
  $conn = pg_connect("host=localhost port=5432 dbname=DianaLabDB user=postgres password=******");
?>
