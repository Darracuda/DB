<?php
  include "_header.php";

  if ($param_mode == "add")
    include "_crew_add.php";
  elseif ($param_id >=0 && $param_mode == "remove")
    include "_crew_remove.php";
  else 
    include "_crew_list.php";

  include "_footer.php";
?>
