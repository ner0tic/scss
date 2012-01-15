<?php load_assets('change-active'); ?>
<div id="change-active-btn">
  <span><a href="#" class="dropdown"><?php echo $sf_user->getUsername()?>&nbsp;<em>as</em>&nbsp;<?php echo $currentEnrollment['district_code'] ?>&nbsp;<?php echo $currentEnrollment['troop_number'] ?></a></span>
</div>  
<div id="change-active-content">
  <div>
    <h2></h2>
    <fieldset>
      <legend></legend>
      <?php foreach($changes as $name => $select): ?>        
      <div class="change-active-item" id="change-active-item-<?php echo $name ?>">
        <label for="<?php echo $name ?>">Change <?php echo $name ?> to:</label>
        <?php $select ?>
      </div>
      <?php endforeach; ?>
    </fieldset>
  </div>
</div>