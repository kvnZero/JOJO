<?php

?>
<div class="container mt-4 ">
  <div class="job-ele row">
    <div class="col-md-3 col-12">
      <div class="mb-3 filter-box">
        <form id="job-list-default" class="form-monitor">
        <?php
        if($args['options']['support_search']) {
          ?>
          <label for="search_input" class="form-label"><?php _e('Search', "jojo"); ?></label>
          <input type="text" class="form-control" name="s" id="search_input" onkeydown="if(event.keyCode == 13) { return false; }">
          <?php
        }
        foreach($args['options']['filter_options'] as $filter) {
          ?>
          <label class="form-label mt-2"><?php echo $filter['label']; ?></label>
          <?php
          if($filter['type'] == 'checkbox') {
            foreach($filter['options'] as $option) {
              ?>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="<?php echo $option['key']; ?>" name="<?php echo $filter['name']; ?>" id="checkbox_<?php echo $filter['name'].'_'.$option['key']; ?>">
                  <label class="form-check-label" for="checkbox_<?php echo $filter['name'].'_'.$option['key']; ?>">
                    <?php echo $option['label']; ?>
                  </label>
                </div>
              <?php
            }  
          }
          if($filter['type'] == 'radio') {
            ?>
            <div class="form-check">
              <input class="form-check-input" type="radio" value="0" name="<?php echo $filter['name']; ?>" id="radio_<?php echo $filter['name'].'_0'; ?>" checked>
              <label class="form-check-label" for="radio_<?php echo $filter['name'].'_0'; ?>">
                <?php _e('All', "jojo"); ?>
              </label>
            </div>
            <?php
            foreach($filter['options'] as $option) {
              ?>
                <div class="form-check">
                  <input class="form-check-input" type="radio" value="<?php echo $option['key']; ?>" name="<?php echo $filter['name']; ?>" id="radio_<?php echo $filter['name'].'_'.$option['key']; ?>">
                  <label class="form-check-label" for="radio_<?php echo $filter['name'].'_'.$option['key']; ?>">
                    <?php echo $option['label']; ?>
                  </label>
                </div>
              <?php
            }  
          }
          if($filter['type'] == 'select') {
            ?>
              <div class="">
                <select class="form-select" aria-label="<?php echo $filter['name']?>" name="<?php echo $filter['name']; ?>" id="radio_<?php echo $filter['name'].'_'.$option['key']; ?>">
                  <option selected value="0"><?php _e('All', "jojo"); ?></option>
                  <?php
                  foreach($filter['options'] as $option) {
                  ?>
                  <option value="<?php echo $option['key']?>"><?php echo $option['label']?></option>
                  <?php
                  }  
                  ?>
                </select>
              </div>
            <?php
          }
        }
        ?>
        </form>
      </div>
    </div>
    <div class="col-md-9 col-12">
      <ul class="job-list offset-0" id="job-list-id_default">
        
      </ul>
    </div>
  </div>
</div>