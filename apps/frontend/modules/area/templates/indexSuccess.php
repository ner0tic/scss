<?php load_assets('camp') ?>
<?php load_assets('data-table') ?>
<?php include_partial("global/infobox", array('page'=>'area')) ?>
<div class="box main-content">
  <div class="box-content datagrid">
    <h2>Areas</h2>
    <table class="data-table" id="area-table">
      <tbody>
<?php foreach($pager->getResults() as $i => $area): ?>
        <tr class="table-row <?php echo fmod($i,2) ? 'even-row' : 'odd-row' ?>">
          <td><?php echo ucwords($area->getName()) ?></td>
          <td><?php echo ($area->getParent()) ? ucwords($area->getParent()->getName()) : '' ?></td>
          <td class="table-controls">
            <div class="table-controls">
              <?php echo link_to(
                      image_tag('icons/edit-icon.png', array(
                          'width'   =>    '16',
                          'height'  =>    '16',
                          'alt'     =>    'edit'))
                      .'<span class="control-txt">edit</span>',
                      @area_edit,$area) ?>
              <?php echo link_to(
                      image_tag('icons/delete-icon.png', array(
                          'width'   =>    '16',
                          'height'  =>    '16',
                          'alt'     =>    'delete'))
                      .'<span class="control-txt">delete</span>',
                      @area_delete, $area) ?>
            <div>
          </td>
        </tr>
<?php endforeach; ?>
      </tbody>
<?php include_partial('global/pager', array(
    'colspan'       =>  3,
    'module'        =>  'area',
    'pager'         =>  $pager
)); ?>
    </table>
  </div>
</div>
