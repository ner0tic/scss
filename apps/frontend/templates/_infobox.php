<!-- START :: _infobox.php -->
<div class="page-margin-offset sidebar multiple">
  <div class="sidebar">
    <div class="custom-ui-stats user-stats module clearfix">
      <?php echo link_to('<span>Scouts</span>
        <span class="scouts count">'.$sf_user->getProfile()->getActiveEnrollment()->getTroop()->getScoutCount().'</span>',
        @scouts_by_troop, array(
                  'district_slug' => $sf_user->getProfile()->getActiveEnrollment()->getTroop()->getDistrict()->getSlug(),
                  'troop_slug'    => $sf_user->getProfile()->getActiveEnrollment()->getTroop()->getSlug()),
                  array('class'         => 'scouts first'    
              )) ?>
      </a>
      <a class="messages" href="#">
        <span>Messages</span>
        <span class="messages count">2</span>
      </a>
      <?php echo link_to('<span>Patrols</span>
        <span class="Patrols count">'.$sf_user->getProfile()->getActiveEnrollment()->getTroop()->getPatrolCount().'</span>',
              @patrols_by_troop, array(
                  'district_slug' => $sf_user->getProfile()->getActiveEnrollment()->getTroop()->getDistrict()->getSlug(),
                  'troop_slug'    => $sf_user->getProfile()->getActiveEnrollment()->getTroop()->getSlug()),
                  array('class'         => 'patrol count last'    
              )) ?>
    </div>
  </div>
</div>
<div class="info-box-wrapper">
  <div id="info-box" class="box box-flat-left">
    <div class="avatar">
      <?php echo link_to(image_tag($sf_user->getProfile()->getAvatar(),array('height' => sfConfig::get('app_avatar_height'), 'width' => sfConfig::get('app_avatar_height'), 'alt' => $sf_user->getName())), @misc_settings) ?>     
    </div>
    <strong>
      Camp <u><?php echo $sf_user->getProfile()->getActiveEnrollment()->getWeek()->getCamp()->getName() ?></u> Week: <u><?php echo $sf_user->getProfile()->getActiveEnrollment()->getWeek()->getLabel() ?></u>
    </strong>
    <h2>Welcome <?php echo link_to($sf_user->getGuardUser()->getUsername(),'@profile',array('user_id'=>$sf_user->getGuardUser()->getId())) ?></h2>
    <hr />
    <p class="breadcrum">
      <span>scss</span>
      &raquo;
      <span>troop <?php echo $sf_user->getProfile()->getActiveEnrollment()->getTroop()->getNumber() ?></span>
      &raquo;
      <span>dashboard</span>
    </p>
  </div>
</div>
<?php if ($sf_user->hasFlash('notice')): ?>
  <div class="flash_notice"><?php echo $sf_user->getFlash('notice') ?></div>
<?php endif ?>
 
<?php if ($sf_user->hasFlash('error')): ?>
  <div class="flash_error"><?php echo $sf_user->getFlash('error') ?></div>
<?php endif ?>
<!-- END :: _infobox.php -->