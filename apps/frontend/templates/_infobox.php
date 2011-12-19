<!-- START :: _infobox.php -->
<div class="page-margin-offset sidebar multiple">
  <div class="sidebar">
    <div class="custom-ui-stats user-stats module clearfix">
      <a class="scouts first" href="#">
        <span>Scouts</span>
        <span class="scouts count"><?php echo $sf_user->getProfile()->getActiveEnrollment()->getTroop()->getScoutCount() ?></span>
      </a>
      <a class="messages" href="#">
        <span>Messages</span>
        <span class="messages count">2</span>
      </a>
      <a class="patrols last" href="#">
        <span>Patrols</span>
        <span class="Patrols count"><?php echo $sf_user->getProfile()->getActiveEnrollment()->getTroop()->getPatrolCount() ?></span>
      </a>
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
    <h2>Welcome <?php echo link_to($sf_user->getGuardUser()->getUsername(),'user/:id',array('id'=>$sf_user->getGuardUser()->getId())) ?></h2>
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
<!-- END :: _infobox.php -->