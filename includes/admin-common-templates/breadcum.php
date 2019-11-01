<div class="breadcum">
      <ul>
        <li><a href="#">Dash Board</a></li>
        <li>&raquo;</li>
        <li>Manage Account</li> 
        <li>&raquo;</li>
      </ul>
      <span class="clear"></span> 
  </div>
  
<div class="breadcum">
    <ul>
    <?php
        $szBreadCum = count($this->breadcum);
        foreach($this->breadcum as $kb=>$kv)
        {
            $cb = $kb + 1;
            if($cb < $szBreadCum)            
            {
                ?>
                <li><a href="<?php echo ADMIN_URL.$kv['action_link'] ?>"><?php echo $kv['action_title'] ?></a></li>
                <li>&raquo;</li>
                <?php
            }
            else
            {
                ?>
                <li class="last"><?php echo $kv['action_title'] ?></li>
                <?php
            }
        }
    ?>
    </ul>
</div>  