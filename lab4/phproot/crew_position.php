<?php
  include "_header.php";

  if ($param_mode == "add")
    include "_crew_position_add.php";
  elseif ($param_id >=0 && $param_mode == "edit")
    include "_crew_position_edit.php";
  elseif ($param_id >=0 && $param_mode == "remove")
    include "_crew_position_remove.php";
  elseif ($param_id >=0)
    include "_crew_position_view.php";
  else 
    include "_crew_position_list.php";

  include "_footer.php";
?>
