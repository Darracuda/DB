<?php
  include "_header.php";

  if ($param_mode == "add")
    include "_country_add.php";
  elseif ($param_id >=0 && $param_mode == "edit")
    include "_country_edit.php";
  elseif ($param_id >=0 && $param_mode == "remove")
    include "_country_remove.php";
  elseif ($param_id >=0)
    include "_country_view.php";
  else 
    include "_country_list.php";

  include "_footer.php";
?>
