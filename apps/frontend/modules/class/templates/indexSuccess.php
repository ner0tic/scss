<?php load_assets('class') ?>
<?php load_assets('data-table') ?>
<?php include_partial('global/infobox',array('page'=>'classes')) ?>
<div class="box main-content">
  <div class="box-content datagrid">
    <h2>Classes</h2>
    <table class="data-table" id="class-table">
      <tbody>
<?php foreach($courses as $i => $course): ?>
        <tr class="table-row <?php echo fmod($i,2) ? 'even-row' : 'odd-row' ?>">
          <td><?php echo ucwords($course->getLabel()) ?></td>
          <?php foreach($periods as $i => $per): ?>
          <?php include_component('class','miniform',array('course'=>$course,'period'=>$per)) ?>          
          <?php endforeach; ?>
          <td class="table-controls">
            <div class="table-controls">
              <?php echo link_to(image_tag('/images/icons/delete-icon.png',array('width'=>'16','height'=>'16','alt'=>'delete')).'<span class="control-txt">edit</span>',@course_delete,$course) ?>
            </div>
          </td>
        </tr>          
<?php break; endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
