<?php
  if($args['total'] <= $args['limit']){
    return;
  }
  $current_page = (int)$args['page'];
  $max_page = (int)ceil($args['total'] / $args['limit']);
?>
<nav aria-label="" id="<?php echo $args['id']; ?>">
  <ul class="pagination">
    <li class="page-item <?php echo $current_page == 1 ? 'disabled' : '';?>" id="pagination-previous"  data-page="<?php echo $current_page-1;?>">
      <span class="page-link"><?php _e("Previous Page", "jojo"); ?></span>
    </li>
    <?php
    for ($i=1; $i <= $max_page; $i++) { 
      ?>
      <li class="page-item <?php echo $i == $current_page ? 'active' : '';?>" data-page="<?php echo $i;?>">
        <a class="page-link"><?php echo $i;?></a>
      </li>
      <?php
    }
    ?>
    <li class="page-item <?php echo $current_page == $max_page ? 'disabled' : ''?>" id="pagination-next"  data-page="<?php echo $current_page+1;?>">
      <a class="page-link"><?php _e("Next Page", "jojo"); ?></a>
    </li>
  </ul>
</nav>