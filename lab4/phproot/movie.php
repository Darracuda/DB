<?php
  include "_header.php";

  if ($param_mode == "add")
    include "_movie_add.php";
  elseif ($param_id >=0 && $param_mode == "edit")
    include "_movie_edit.php";
  elseif ($param_id >=0 && $param_mode == "remove")
    include "_movie_remove.php";
  elseif ($param_id >=0)
    include "_movie_view.php";
  else 
    include "_movie_list.php";

  include "_footer.php";
?>
