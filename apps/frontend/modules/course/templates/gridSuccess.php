<!-- apps/frontend/models/course/templates/gridSuccess.php -->
<?php load_assets('class') ?>
<?php load_assets('grid') ?>
<?php include_partial('global/infobox',array('page'=>'courses')) ?>
<script>
	$('.nav-bar ul li').removeClass('active');
</script>
<div class="box main-content">
  <div class="box-content datagrid">
    <h2>Courses&nbsp;<?php echo link_to('<img src="/images/icons/add-icon.png" height="16" width="16" alt="Add A Course" />',@course_new) ?></h2>
    <table class="data-table" id="course-table">
      <tbody>
        <tr>
          <th>&nbsp;</th>
<?php foreach($camps as $c => $camp): ?>
          <th>
<?php echo link_to(ucwords($camp->getName()),@info_popup,array(
  'module'  => 'ScssCamp', // change this to something more dynamic, $camp->getModuleName() ????
  'id'      => $camp->getId())) ?>
          </th>
<?php endforeach; ?>
        </tr>
<?php foreach($badges as $b => $mb): ?>
        <tr>
          <th>
<?php echo link_to(ucwords($mb->getName()),@info_popup,array(
  'module'  => 'ScssMeritBadge',
  'id'      => $mb->getId())) ?>
          </th>
<?php foreach($camps as $c => $camp): ?>
          <td>
            <input type="checkbox" name="<?php echo $camp->getSlug().'_'.$mb->getSlug()?>" id="<?php echo $camp->getId().'_'.$mb->getId()?>" <?php echo $camp->hasCourse($mb->getId())? 'checked' : '' ?> class="checkbox" />
          </td>
<?php endforeach; ?>
        </tr>
<?php endforeach; ?>
      </tbody>
      <tfoot>
        <tr>
          <td><?php //$this->getUser()->getProfile()->getSettingBySlug('pagination')?SCSS::paginate ?></td>
        </tr>
      </tfoot>
    </table>
  </div>
</div>
