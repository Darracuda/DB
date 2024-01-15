<?php
  include "_header.php";

  if ($param_mode == "add")
    include "_person_add.php";
  elseif ($param_id >=0 && $param_mode == "edit")
    include "_person_edit.php";
  elseif ($param_id >=0 && $param_mode == "remove")
    include "_person_remove.php";
  elseif ($param_id >=0)
    include "_person_view.php";
  else 
    include "_person_list.php";

  include "_footer.php";
?>
