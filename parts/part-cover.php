<?php
    $id = $args['id'];
?>
<div class="cover" id="<?php echo esc_attr($id); ?>" style="background-image:url(<?php echo $args['covers'][0]['img']; ?>)">
  <h1 class="cover-title"<?php echo (!empty($args['title_color']) ? ' style="color:' . $args['title_color'] . '"' : ''); ?>><?php echo $args['covers'][0]['title']; ?></h1>

</div>



<?php
return;
?>
<div id="<?php echo esc_attr($id); ?>" class="carousel slide">
  <!-- <div class="carousel-indicators">
    <button type="button" data-bs-target="#<?php echo esc_attr($id); ?>" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#<?php echo esc_attr($id); ?>" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#<?php echo esc_attr($id); ?>" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div> -->
  <div class="carousel-inner">
    <?php
    foreach($args['covers'] as $i => $cover){
      ?>
      <div class="carousel-item<?php echo $i == 0 ? ' active' : ''?>">
        <img src="<?php echo $cover['img']; ?>" class="d-block w-100" alt="<?php echo $cover['img_alt']; ?>">
        <?php
        if($cover['show_text'] ?? false){
          ?>
          <div class="carousel-caption">
            <h1 class="cover-title"<?php echo (!empty($args['title_color']) ? ' style="color:' . $args['title_color'] . '"' : ''); ?>><?php echo $cover['title']; ?></h1>
            <p class="cover-subtitle"<?php echo (!empty($args['subtitle_color']) ? 'style="color:' . $args['subtitle_color'] . '"' : ''); ?>><?php echo $cover['desc']; ?></p>
          </div>
          <?php
        }
        ?>
      </div>
      <?php
    }
    ?>
  </div>
  <!-- <button class="carousel-control-prev" type="button" data-bs-target="#<?php echo esc_attr($id); ?>" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden"><?php _e('Previous', "jojo"); ?></span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#<?php echo esc_attr($id); ?>" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden"><?php _e('Next', "jojo"); ?></span>
  </button> -->
</div>