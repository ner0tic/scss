<div id="change-active-troop">
  <div class="relative">
    <a href="#" class="dropdown"><span><?php echo $sf_user->getUsername()?>&nbsp;<em>as</em>&nbsp;<?php echo $currentEnrollment['district_code'] ?>&nbsp;<?php echo $currentEnrollment['troop_number'] ?></span></a>
    <div id="change-active-troop-content" class="dropdown-content">
    <?php foreach($troops as $troop): ?>
      a<br />
        <?php echo link_to('<span>'.$troop->getDistrict()->getCode().' '.$troop->getNumber().'</span>', @change_active_troop, array(
            'district_slug' =>  $troop->getDistrict()->getSlug(),
            'troop_slug'    =>  $troop->getSlug(),
            'class'         =>  'active-troop-option')) ?>
    <?php endforeach; ?>
    </div>
  </div>
</div>