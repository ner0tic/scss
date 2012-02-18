<?php load_assets('camp') ?>
<?php load_assets('data-table') ?>
<?php include_partial("global/infobox", array('page'=>'camp')) ?>
<div class="box main-content">
  <div class="box-content datagrid">
    <h2>Camps</h2>
    <table class="data-table" id="camp-table">
      <tbody>
<?php foreach($pager->getResults() as $i => $camp): ?>
        <tr class="table-row <?php echo fmod($i,2) ? 'even-row' : 'odd-row' ?>">
          <td><?php echo link_to(ucwords($camp->getName()), @weeks_by_camp,$camp) ?></td>
<!--          <td></td> -->
          <td><?php echo $camp->getDistrict()->getName().', '.$camp->getDistrict()->getZone()->getCode() ?></td>
                <td class="table-controls">
                    <div class="table-controls">
                      <?php echo link_to(
                              image_tag('icons/edit-icon.png', array(
                                  'width'   =>    '16',
                                  'height'  =>    '16',
                                  'alt'     =>    'edit'))
                              .'<span class="control-txt">edit</span>',
                              @camp_edit, $camp) ?>  
                      <?php echo link_to(
                              image_tag('icons/delete-icon.png', array(
                                  'width'   =>    '16',
                                  'height'  =>    '16',
                                  'alt'     =>    'delete'))
                              .'<span class="control-txt">delete</span>',
                              @camp_delete, $camp) ?>                        
                    </div>
                </td>
<?php endforeach; ?>
            </tr>
            </tbody>
            <?php include_partial('global/pager',array(
                'colspan'      =>  3,
                'module'          =>  'camp',
                'pager'           =>  $pager
            )) ?>            
        </table>
      </div>
    </div>

