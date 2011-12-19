<?php load_assets('class') ?>
<?php load_assets('data-table') ?>
<?php include_partial('global/infobox',array('page'=>'classes')) ?>
<script>
  $('.nav-bar ul li').removeClass('active');
</script>
<div class="box main-content"?>
  <div class="box-content datagrid">
    <h2>Classes&nbsp;<?php echo link_to('<img src="/images/icons/add-icon.png" height="16" width="16" alt="Add A Class" />','class_add', array(
      'district_slug' =>  $sf_user->getProfile()->getActiveEnrollment()->getWeek()->getCamp()->getDistrict()->getSlug(),
      'camp_slug'     =>  $sf_user->getProfile()->getActiveEnrollment()->getWeek()->getCamp()->getSlug())) ?></h2>
    <table class="data-table" id="class-table">
      <tbody>
<?php foreach($classes as $i => $class): ?>
        <tr class="table-row <?php echo fmod($i,2) ? 'even-row' : 'odd-row' ?>">
          <td><?php echo ucwords($class->getName()) ?>:</td>
          <td><?php echo ucwords($class->getArea()->getName()) ?></td>
          <td><?php echo $class->getPeriod()->getName() ?></td>
          <td><?php echo ucwords($class->getStaff()->getName()) ?></td>
          <td class="table-controls">
            <div class="table-controls">
              <a href="<?php echo url_for('class/edit?id='.$class->getId()) ?>">
                <img src="/images/icons/edit-icon.png" width="16" height="16" alt="edit" />
                <span class="control-txt">edit</span>
              </a>
              <a href="<?php echo url_for('class/delete?id='.$class->getId()) ?>">
                <img src="/images/icons/delete-icon.png" width="16" height="16" alt="delete" />
                <span class="control-txt">edit</span>
              </a>
            </div>
          </td>
<?php endforeach; ?>
        </tr>
      </tbody>
    </table>
  </div>
</div>
