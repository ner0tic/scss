<fieldset class="settings-widget" id="current-enroll-widget">
  <legend>current enrollment</legend>
  <div class="content">
    <label for="auto-renew">auto registration</label>
    <?php //$cb_a->render('auto-renew'); ?> 
    
    <input type="checkbox" id="auto-renew" name="auto-renew" data-on="ON" data-off="OFF" />
    <div class="indent readonly">
<?php /*
      <div>
        <label for="camp-availability">camp availability</label>
        <input type="checkbox" class="checkmark" name="camp-availability" id="camp-availability" value="<?php echo $checks_c ?>" />
      </div>
      <div>
        <label for="week-availability">week availability</label>
        <input type="checkbox" class="checkmark" name="week-availability" id="week-availability" value="<?php echo $checks_w ?> "/>
      </div> 
 */ ?>
      <div>
        <label for="site-availability">site availability</label>
        <?php echo $cb_s->render('site-availability') ?>
      </div>
    </div>
  </div>    
</fieldset>