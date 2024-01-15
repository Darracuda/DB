<?php
  include "_header.php";

  if ($param_mode == "add")
    include "_genre_add.php";
  elseif ($param_id >=0 && $param_mode == "edit")
    include "_genre_edit.php";
  elseif ($param_id >=0 && $param_mode == "remove")
    include "_genre_remove.php";
  elseif ($param_id >=0)
    include "_genre_view.php";
  else 
    include "_genre_list.php";

  include "_footer.php";
?>
