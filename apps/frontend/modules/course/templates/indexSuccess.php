<?php load_assets('class') ?>
<?php load_assets('data-table') ?>
<?php include_partial('global/infobox',array('page'=>'courses')) ?>
<div class="box main-content">
  <div class="box-content datagrid">
    <h2>Courses</h2>
    <table class="data-table" id="course-table">
      <tbody>
<?php foreach($pager->getResults() as $i => $mb): ?>
<?php $tgl = new ddWidgetFormInputToggleSwitch(array('labels'=>array('NO','YES')),array('checked'=> in_array($mb->getID(),$courses))); ?>
        <tr class="table-row <?php echo fmod($i,2) ? 'even-row' : 'odd-row' ?>">
            <td><?php echo ucwords($mb->getName())?></td>
            <td><?php echo $tgl ?></td>
        </tr>
<?php endforeach; ?>        
    </table>
  </div>
</div>
