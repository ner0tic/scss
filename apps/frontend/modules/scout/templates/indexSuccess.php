<?php load_assets('scout') ?>
<?php load_assets('data-table') ?>
<?php include_partial('global/infobox',array('page'=>'scouts')) ?>
<div class="box main-content">
    <div class="box-content datagrid">
        <h2>Scouts&nbsp;<?php echo link_to('<img src="/images/icons/add-icon.png" height="16" width="16" alt="Add A Scout" />',@scout_new, $sf_user->getProfile()->getActiveEnrollment()->getTroop())?></h2>
        <table class="data-table" id="scout-table">
            <tbody>
<?php foreach($pager->getResults() as $i => $scout): ?>
            <tr class="table-row <?php echo fmod($i,2) ? 'even-row' : 'odd-row' ?>">
                <td><?php echo ucwords($scout->getLastName())?></td>
                <td><?php echo ucwords($scout->getFirstName())?></td>
                <td><?php echo ucwords($scout->getPatrol()->getName()) ?></td>
                <td class="table-controls">
                    <div class="table-controls">
                      <?php echo link_to(
                              image_tag('icons/edit-icon.png', array(
                                  'width'   =>    '16',
                                  'height'  =>    '16',
                                  'alt'     =>    'edit'))
                              .'<span class="control-txt">edit</span>',
                              @scout_edit,$scout) ?>  
                      <?php echo link_to(
                              image_tag('icons/delete-icon.png', array(
                                  'width'   =>    '16',
                                  'height'  =>    '16',
                                  'alt'     =>    'delete'))
                              .'<span class="control-txt">delete</span>',
                              @scout_delete, $scout) ?>                        
                    </div>
                </td>
<?php endforeach; ?>
            </tr>
            </tbody>
            <?php include_partial('global/pager',array(
                'colspan'      =>  4,
                'module'          =>  'scout',
                'pager'           =>  $pager
            )) ?>            
        </table>
    </div>
</div>
