<fieldset class="settings-widget" id="current-enroll-widget">
  <label>current enrollment <span /></label>
  <div>
    <label for="auto-renew">auto registration</label>
    <input type="checkbox" name="auto-renew" id="auto-renew" class="toggle-switch" />
    <div class="indent readonly">
      <div>
        <label for="camp-availability">camp availability</label>
        <input type="checkbox" class="checkmark" name="camp-availability" id="camp-availability" value="<?php echo $checks['c'] ?>" />
      </div>
      <div>
        <label for="week-availability">week availability</label>
        <input type="checkbox" class="checkmark" name="week-availability" id="week-availability" value="<?php echo $checks['w'] ?> "/>
      </div>
      <div>
        <label for="site-availability">site availablity</label>
        <input type="checkbox" class="checkmark" name="site-availability" id="site-availability" value="<?php echo $checks['s'] ?>" />
      </div>
    </div>
  </div>    
</fieldset>